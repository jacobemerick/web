<?

Loader::load('collector', array(
    'waterfall/CompanionCollector',
    'waterfall/CountyCollector',
    'waterfall/LogCollector',
    'waterfall/LogTagCollector',
    'waterfall/PeriodCollector',
    'waterfall/WatercourseCollector',
    'waterfall/WaterfallCollector',
));
Loader::load('controller', '/SitemapController');
Loader::load('utility', 'Content');

final class WaterfallSitemapController extends SitemapController
{

    private static $HOME_PAGE_RANK                      = .9;

    private static $WATERFALL_LISTING_RANK              = .3;
    private static $WATERFALL_COUNTY_LISTING_RANK       = .6;
    private static $WATERFALL_WATERCOURSE_LISTING_RANK  = .6;
    private static $WATERFALL_LISTING_SUBPAGES_RANK     = .1;
    private static $WATERFALL_PAGE_RANK                 = .8;

    private static $MAP_PAGE_RANK                       = .6;

    private static $LOG_LISTING_RANK                    = .3;
    private static $LOG_COMPANION_LISTING_RANK          = .3;
    private static $LOG_PERIOD_LISTING_RANK             = .3;
    private static $LOG_LISTING_SUBPAGES_RANK           = .1;
    private static $LOG_PAGE_RANK                       = .7;

    private static $ABOUT_PAGE_RANK                     = .6;


    private static $HOME_PAGE_CHANGEFREQ                      = 'daily';

    private static $WATERFALL_LISTING_CHANGEFREQ              = 'monthly';
    private static $WATERFALL_COUNTY_LISTING_CHANGEFREQ       = 'monthly';
    private static $WATERFALL_WATERCOURSE_LISTING_CHANGEFREQ  = 'monthly';
    private static $WATERFALL_LISTING_SUBPAGES_CHANGEFREQ     = 'monthly';
    private static $WATERFALL_PAGE_CHANGEFREQ                 = 'weekly';

    private static $MAP_PAGE_CHANGEFREQ                       = 'monthly';

    private static $LOG_LISTING_CHANGEFREQ                    = 'weekly';
    private static $LOG_COMPANION_LISTING_CHANGEFREQ          = 'monthly';
    private static $LOG_PERIOD_LISTING_CHANGEFREQ             = 'monthly';
    private static $LOG_LISTING_SUBPAGES_CHANGEFREQ           = 'monthly';
    private static $LOG_PAGE_CHANGEFREQ                       = 'weekly';

    private static $ABOUT_PAGE_CHANGEFREQ                     = 'yearly';


    private static $WATERFALLS_PER_LISTING              = 24;
    private static $WATERFALLS_PER_COUNTY_LISTING       = 12;
    private static $WATERFALLS_PER_WATERCOURSE_LISTING  = 12;

    private static $LOGS_PER_LISTING                    = 10;
    private static $LOGS_PER_COMPANION_LISTING          = 10;
    private static $LOGS_PER_PERIOD_LISTING             = 10;

    protected function set_data()
    {
        $this->add_home_pages();
        $this->add_waterfall_pages();
        $this->add_map_pages();
        $this->add_log_pages();
        $this->add_about_pages();
    }

    private function add_home_pages()
    {
        $this->addURL('', date('Y-m-d'), self::$HOME_PAGE_CHANGEFREQ, self::$HOME_PAGE_RANK);
    }

    private function add_waterfall_pages()
    {
        $this->addURL('falls/', date('Y-m-01'), self::$WATERFALL_LISTING_CHANGEFREQ, self::$WATERFALL_LISTING_RANK);
        $count = WaterfallCollector::getListCount();
        $this->add_paginated_pages($count, self::$WATERFALLS_PER_LISTING, 'falls', 'waterfall');

        $county_list = CountyCollector::getCountyList();
        foreach ($county_list as $county) {
            $this->addURL("{$county->alias}/", date('Y-m-01'), self::$WATERFALL_COUNTY_LISTING_CHANGEFREQ, self::$WATERFALL_COUNTY_LISTING_RANK);
            $this->add_paginated_pages($county->count, self::$WATERFALLS_PER_COUNTY_LISTING, $county->alias, 'waterfall');
        }

        $watercourse_list = WatercourseCollector::getWatercourseList();
        foreach ($watercourse_list as $watercourse) {
            $this->addURL("{$watercourse->alias}/", date('Y-m-01'), self::$WATERFALL_WATERCOURSE_LISTING_CHANGEFREQ, self::$WATERFALL_WATERCOURSE_LISTING_RANK);
            $this->add_paginated_pages($watercourse->count, self::$WATERFALLS_PER_WATERCOURSE_LISTING, $watercourse->alias, 'waterfall');
        }

        $waterfall_list = WaterfallCollector::getList(500);
        foreach ($waterfall_list as $waterfall) {
            $this->addURL("{$waterfall->watercourse_alias}/{$waterfall->waterfall_alias}/", date('Y-m-d', strtotime('last Monday')), self::$WATERFALL_PAGE_CHANGEFREQ, self::$WATERFALL_PAGE_RANK);
        }
    }

    private function add_map_pages()
    {
        $this->addURL('map/', date('Y-m-01'), self::$MAP_PAGE_CHANGEFREQ, self::$MAP_PAGE_RANK);
    }

    private function add_log_pages()
    {
        $this->addURL('journal/', date('Y-m-d', strtotime('last Monday')), self::$LOG_LISTING_CHANGEFREQ, self::$LOG_LISTING_RANK);
        $count = LogCollector::getListCount();
        $this->add_paginated_pages($count, self::$LOGS_PER_LISTING, 'journal', 'log');

        $companion_list = CompanionCollector::getCompanionList();
        foreach ($companion_list as $companion) {
            $this->addURL("companion/{$companion->alias}/", date('Y-m-01'), self::$LOG_COMPANION_LISTING_CHANGEFREQ, self::$LOG_COMPANION_LISTING_RANK);
            $this->add_paginated_pages($companion->count, self::$LOGS_PER_COMPANION_LISTING, "companion/{$companion->alias}", 'log');
        }

        $period_list = PeriodCollector::getPeriodList();
        foreach ($period_list as $period) {
            $this->addURL("period/{$period->alias}/", date('Y-m-01'), self::$LOG_PERIOD_LISTING_CHANGEFREQ, self::$LOG_PERIOD_LISTING_RANK);
            $this->add_paginated_pages($period->count, self::$LOGS_PER_PERIOD_LISTING, "period/{$period->alias}", 'log');
        }

        $log_list = LogCollector::getList(500);
        foreach ($log_list as $log) {
            $this->addURL("journal/{$log->alias}/", date('Y-m-d', strtotime('last Monday')), self::$LOG_PAGE_CHANGEFREQ, self::$LOG_PAGE_RANK);
        }
    }

    private function add_about_pages()
    {
        $this->addURL('about/', date('Y-01-01'), self::$ABOUT_PAGE_CHANGEFREQ, self::$ABOUT_PAGE_RANK);
    }

    private function add_paginated_pages($count, $items_per_page, $base_url, $type)
    {
        switch($type) {
            case 'waterfall':
                $lastmod = date('Y-m-01');
                $changefreq = self::$WATERFALL_LISTING_SUBPAGES_CHANGEFREQ;
                $rank = self::$WATERFALL_LISTING_SUBPAGES_RANK;
                break;
            case 'log':
                $lastmod = date('Y-m-01');
                $changefreq = self::$LOG_LISTING_SUBPAGES_CHANGEFREQ;
                $rank = self::$LOG_LISTING_SUBPAGES_RANK;
                break;
        }

        for($i = 2; (($i - 1) * $items_per_page) < $count; $i++) {
            $this->addURL("{$base_url}/{$i}/", $lastmod, $changefreq, $rank);
        }
    }

}

