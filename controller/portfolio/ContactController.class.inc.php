<?php

Loader::load('controller', 'portfolio/DefaultPageController');

class ContactController extends DefaultPageController
{

    protected function set_head_data()
    {
        $this->set_title("Contact Page | Jacob Emerick's Portfolio");
        $this->set_description("Contact page for Jacob Emerick's Portfolio");
        $this->set_keywords([
            'portfolio',
            'programming portfolio',
            'contact',
            'Jacob Emerick',
            'information',
            'freelance',
        ]);
    }

    protected function set_body_data()
    {
        $this->set_body('body_view', 'Contact');

        $form_results = [];
        if (!empty($_POST)) {
            $form_results = $this->process_form_data();
        }
        $this->set_body('body_data', $form_results);

        $this->set_body_view('Page');

        parent::set_body_data();
    }

    private function process_form_data()
    {
        $errors = [];

        if (
            empty($_POST['name']) ||
            !is_string($_POST['name']) ||
            strlen($_POST['name']) > 100
        ) {
            $errors['name'] = 'Please enter a valid name.';
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email.';
        }

        if (
            empty($_POST['message']) ||
            !is_string($_POST['message']) ||
            strlen($_POST['message']) > 10000
        ) {
            $errors['message'] = 'Please enter a valid message.';
        }

        if (!empty($errors)) {
            $values = $_POST;
            $values = array_intersect_key($values, array_flip([
                'name',
                'email',
                'message',
            ]));

            return [
                'errors' => $errors,
                'values' => $values,
            ];
        }

        $message = [
            "Name: {$_POST['name']}",
            "Email: {$_POST['email']}",
            '',
            'Message:',
            $_POST['message'],
        ];
        $message = implode("\n", $message);

        global $container;
        $container['mail']
            ->addTo($container['config']->admin_email)
            ->setSubject('Portfolio Contact')
            ->setPlainMessage($message)
            ->send();

        return [
            'success' =>
                "Thank you for your message, {$_POST['name']}! " .
                "I'll get back to you as soon as possible."
        ];
    }
}
