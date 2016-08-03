<?php

Loader::load('utility', [
    'Request',
    'Validate',
]);

use Jacobemerick\Web\Domain\Comment\Comment\ServiceCommentRepository;

class CommentSubmitModule
{

    private $site;
    private $path;
    private $fullPath;

    public function __construct($site, $path, $fullPath, $pageTitle)
    {
        $this->site = $site;
        $this->path = $path;
        $this->fullPath = $fullPath;
    }

    public function activate()
    {
        // todo why is this responsible for checking on valid calls
        if (!Request::hasPost()) {
            return false;
        }
        if (!Request::getPost('submit') == 'Submit Comment') {
            return false;
        }
        if (!Request::getPost('catch') !== '') {
            return false;
        }

        $errors = $this->checkValidation();
        if (count($errors) > 0) {
            return $errors;
        }

        $commentId = $this->save(Request::getPost());
        // todo broken notifications
        $this->redirectToComment($commentId);
    }

    private function checkValidation()
    {
        $errors = array();
        if (!Validate::checkRequest('post', 'name', 'name')) {
            $errors['name'] = 'You must include a valid name';
        }
        if (!Validate::checkRequest('post', 'email', 'email')) {
            $errors['email'] = 'You must include a valid email';
        }
        if (Request::getPost('website') && !Validate::checkRequest('post', 'website', 'url')) {
            $errors['website'] = 'Please enter a valid website';
        }
        if (!Validate::checkRequest('post', 'comment', 'string')) {
            $errors['comment'] = 'You must enter a comment';
        }
        if (Request::getPost('notify') && Request::getPost('notify') != 'check') {
            $errors['notify'] = 'You entered an invalid notify request';
        }
        if (Request::getPost('reply') && !Validate::checkRequest('post', 'reply', 'integer')) {
            $errors['reply'] = 'You entered an invalid reply request';
        }

        return $errors;
    }

    private function save(array $data)
    {
        $path = $_SERVER['REQUEST_URI'];
        $path = explode('/', $path);
        $path = array_filter($path);
        $path = array_slice($path, 0, 2);
        $path = implode('/', $path);

        $body = [
            'commenter' => [
                'name' => $data['name'],
                'email' => $data['email'],
                'website' => $data['website'],
            ],
            'body' => $data['comment'],
            'should_notify' => (isset($data['notify']) && $data['notify'] == 'check'),
            'domain' => (URLDecode::getSite() == 'blog' ? 'blog.jacobemerick.com' : 'waterfallsofthekeweenaw.com'),
            'path' => $path,
            'url' => "{$this->fullPath}#comment-{{id}}",
            'thread' => 'comments',
            'reply_to' => ($data['type'] == 'new' ? 0 : $data['type']),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'referrer' => $_SERVER['HTTP_REFERER'],
        ];

        global $container;
        $repository = new ServiceCommentRepository($container['comment_service_api']);
        try {
            $response = $repository->createComment($body);
        } catch (Exception $e) {
            $container['logger']->warning("CommentService | Create | {$e->getMessage()}");
        }

        return $response->getId();
    }

    private function redirectToComment($commentId)
    {
        $url = '';
        $url .= $this->fullPath;
        $url .= "#comment-{$commentId}";

        Loader::loadNew('controller', 'Error303Controller', array($url))->activate();
        exit;
    }
}
