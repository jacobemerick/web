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
                'replace' => '/',
            ],
            [
                'pattern' => '@^/web(/?)$@',
                'replace' => '/',
            ],
            [
                'pattern' => '@^/(web|print)/([a-z0-9-]+)(/?)$@',
                'replace' => '/',
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
                'controller' => 'HomeController',
            ],
            [
                'match' => '/contact/',
                'controller' => 'ContactController',
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
