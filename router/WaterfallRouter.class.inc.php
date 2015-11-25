<?php

Loader::load('collector', array(
    'waterfall/LogCollector',
    'waterfall/WaterfallCollector'));
Loader::load('router', 'Router');

class WaterfallRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@/index.(html|htm|php)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/home(/?)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/falls/by-rating(/?)$@',
				'replace' => '/falls/'),
			(object) array(
				'pattern' => '@^/falls/by-rating/([0-9]+)(/?)$@',
				'replace' => '/falls/'),
			(object) array(
				'pattern' => '@^/falls/results(/?)$@',
				'replace' => '/falls/'),
            (object) array(
                'pattern' => '@^/log(/?)$@',
                'replace' => '/journal/'),
            (object) array(
                'pattern' => '@^/log/(\d+)(/?)$@',
                'replace' => '/journal/$1'),
            (object) array(
                'pattern' => '@^/map/([^/]+)(/?)$@',
                'replace' => '/map/'),
			(object) array(
				'pattern' => '@^/about/([a-z]*)(/?)$@',
				'replace' => '/about/'),
			(object) array(
				'pattern' => '@^/birch-creek/birch-creek-falls/?$@',
				'replace' => '/birch-creek/gold-mine-falls/'),
			(object) array(
				'pattern' => '@^/big-iron-river/bonanza-falls/?$@',
				'replace' => '/big-iron-river/greenwood-falls/'),
			(object) array(
				'pattern' => '@^/east-branch-huron-river/east-branch-huron-river-falls/?$@',
				'replace' => '/east-branch-huron-river/east-branch-falls/'),
			(object) array(
				'pattern' => '@^/montreal-river/lower-montreal-falls/?$@',
				'replace' => '/montreal-river/montreal-falls/'),
			(object) array(
				'pattern' => '@^/manganese-creek/manganese-gorge-falls/?$@',
				'replace' => '/manganese-creek/manganese-falls/'),
			(object) array(
				'pattern' => '@^/dead-river/tourist-park-dam-falls/?$@',
				'replace' => '/dead-river/tourist-park-falls/'),
			(object) array(
				'pattern' => '@^/sturgeon-river/upper-sturgeon-falls/?$@',
				'replace' => '/sturgeon-river/little-spruce-falls/'),
			(object) array(
				'pattern' => '@^/tahquamenon-river/upper-tahquamenon-falls/?$@',
				'replace' => '/tahquamenon-river/tahquamenon-falls/'),
			(object) array(
				'pattern' => '@^/west-branch-huron-river/west-branch-huron-river-falls/?@',
				'replace' => '/west-branch-huron-river/west-branch-falls/'),
			(object) array(
				'pattern' => '@^/west-branch-yellow-dog-river/west-branch-yellow-dog-falls/?@',
				'replace' => '/west-branch-yellow-dog-river/west-branch-falls/'),
		);
	}

	protected function check_for_special_redirect($uri)
	{
        if (preg_match('@^/falls/([a-z\'-]+)(/?)$@', $uri, $matches)) {
            $alias = $matches[1];
            $alias = str_replace("'", '', $alias);
            $alias .= '-falls';
            $result = WaterfallCollector::getByOldAlias($alias);
            if ($result !== null) {
                return "/{$result->watercourse_alias}/{$result->alias}/";
            } else {
                Loader::loadNew('controller', '/Error404Controller')->activate();
            }
        }
        
        if (preg_match('@^/photos/([a-z\'-]+)-([^/]+)(/?)$@', $uri, $matches)) {
            $alias = $matches[1];
            $alias = explode('-', $alias);
            array_pop($alias);
            $alias = implode('-', $alias);
            $alias = str_replace("'", '', $alias);
            $alias .= '-falls';
            $result = WaterfallCollector::getByOldAlias($alias);
            if ($result !== null) {
                return "/{$result->watercourse_alias}/{$result->alias}/";
            } else {
                Loader::loadNew('controller', '/Error404Controller')->activate();
            }
        }
        
        if (preg_match('@/log/([a-z]+-\d{2}-\d{4})(/?)$@', $uri, $matches)) {
            $date = $matches[1];
            $date = explode('-', $date);
            $date = mktime(0, 0, 0, date('n', strtotime($date[0])), $date[1], $date[2]);
            $date = date('Y-m-d', $date);
            $result = LogCollector::getByDate($date);
            if ($result !== null) {
                return "/journal/{$result->alias}/";
            } else {
                Loader::loadNew('controller', '/Error404Controller')->activate();
            }
        }
        
        if (preg_match('@/map/([a-z\'-]+)(/?)$@', $uri, $matches)) {
            $alias = $matches[1];
            $alias = str_replace("'", '', $alias);
            $alias .= '-falls';
            $result = WaterfallCollector::getByOldAlias($alias);
            if ($result !== null) {
                return "/map/#{$result->watercourse_alias}/{$result->alias}";
            } else {
                Loader::loadNew('controller', '/Error404Controller')->activate();
            }
        }
        
		return $uri;
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/falls/',
				'controller' => 'WaterfallListController'),
			(object) array(
				'match' => '/falls/([0-9]+)/',
				'controller' => 'WaterfallListController'),
			(object) array(
				'match' => '/([a-z]+)-county/',
				'controller' => 'CountyListController'),
			(object) array(
				'match' => '/([a-z]+)-county/([0-9]+)/',
				'controller' => 'CountyListController'),
			(object) array(
				'match' => '/([a-z0-9-]+)-(creek|river)/',
				'controller' => 'WatercourseListController'),
			(object) array(
				'match' => '/([a-z0-9-]+)-(creek|river)/([0-9]+)/',
				'controller' => 'WatercourseListController'),
			(object) array(
				'match' => '/category/([a-z]+)/',
				'controller' => 'CategoryListController'),
			(object) array(
				'match' => '/category/([a-z]+)/([0-9]+)/',
				'controller' => 'CategoryListController'),
			(object) array(
				'match' => '/([a-z0-9-]+)-(creek|river)/([a-z-]+)/',
				'controller' => 'WaterfallController'),
			(object) array(
				'match' => '/map/',
				'controller' => 'MapController'),
            (object) array(
                'match' => '/map/#[a-z-/]+',
                'controller' => 'MapController'),
			(object) array(
				'match' => '/journal/',
				'controller' => 'LogListController'),
			(object) array(
				'match' => '/journal/([0-9]+)/',
				'controller' => 'LogListController'),
			(object) array(
				'match' => '/journal/[a-z-]+/',
				'controller' => 'LogController'),
			(object) array(
				'match' => '/companion/([a-z-]+)/',
				'controller' => 'CompanionListController'),
			(object) array(
				'match' => '/companion/([a-z-]+)/([0-9]+)/',
				'controller' => 'CompanionListController'),
			(object) array(
				'match' => '/period/([a-z-]+)/',
				'controller' => 'PeriodListController'),
			(object) array(
				'match' => '/period/([a-z-]+)/([0-9]+)/',
				'controller' => 'PeriodListController'),
			(object) array(
				'match' => '/journal/tag/([a-z-]+)/',
				'controller' => 'LogTagListController'),
			(object) array(
				'match' => '/journal/tag/([a-z-]+)/([0-9]+)/',
				'controller' => 'LogTagListController'),
			(object) array(
				'match' => '/about/',
				'controller' => 'AboutController'),
			(object) array(
				'match' => '/contact/',
				'controller' => 'ContactController'));
	}

}
