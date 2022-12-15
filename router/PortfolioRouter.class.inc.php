<?

Loader::load('router', 'Router');

class PortfolioRouter extends Router
{

    protected function get_redirect_array()
    {
        $paths = [
            [
                'pattern' => '@/index.(html|htm|php)$@',
                'replace' => '/',
            ],
            [
                'pattern' => '@^/print(/?)$@',
                'replace' => '/projects/',
            ],
            [
                'pattern' => '@^/web(/?)$@',
                'replace' => '/projects/',
            ],
            [
                'pattern' => '@^/(web|print)/([a-z0-9-]+)(/?)$@',
                'replace' => '/projects/',
            ],
        ];

        return array_map(function ($row) {
            return (object) $row;
        }, $paths);
    }

    protected function get_direct_array()
    {
        $paths = [
            [
                'match' => '/',
                'controller' => 'AboutController',
            ],
            [
                'match' => '/projects/',
                'controller' => 'ProjectsController',
            ],
            [
                'match' => '/resume/',
                'controller' => 'ResumeController',
            ],
        ];

        return array_map(function ($row) {
            return (object) $row;
        }, $paths);
    }

}
