<?php

Loader::load('utility', array(
	'Environment',
	'Mail'));

class PlatformEnvironment extends Environment
{

	private static $MATCH_MOBILE		= 'j2me';
	private static $MATCH_IPHONE		= 'iphone';
	private static $MATCH_WINDOWS_PHONE	= 'windows ce';
	private static $MATCH_NOKIA			= 'nokia';
	private static $MATCH_IPOD			= 'ipod';
	private static $MATCH_MAC			= 'mac';
	private static $MATCH_DARWIN		= 'darwin';
	private static $MATCH_WEBTV			= 'webtv';
	private static $MATCH_WII			= 'nintendo wii';
	private static $MATCH_WINDOWS_3		= 'win16';
	private static $MATCH_WINDOWS_4		= array(
											'windows nt 4.0',
											'winnt4.0',
											'winnt');
	private static $MATCH_WINDOWS_95	= array(
											'windows 95',
											'win95',
											'windows_95');
	private static $MATCH_WINDOWS_98	= array(
											'windows 98',
											'win98');
	private static $MATCH_WINDOWS_2000	= array(
											'windows nt 5.0',
											'windows 2000');
	private static $MATCH_WINDOWS_ME	= 'windows me';
	private static $MATCH_WINDOWS_S_03	= 'windows nt 5.2';
	private static $MATCH_WINDOWS_XP	= array(
											'windows nt 5.1',
											'windows xp');
	private static $MATCH_WINDOWS_VISTA	= 'windows nt 6.0';
	private static $MATCH_WINDOWS_7		= array(
											'windows nt 6.1',
											'windows nt 7.0');
	private static $MATCH_OPENBSD		= 'openbsd';
	private static $MATCH_FREEBSD		= 'freebsd';
	private static $MATCH_SUNOS			= 'sunos';
	private static $MATCH_LINUX			= array(
											'linux',
											'x11');
	private static $MATCH_GOOGLEBOT		= 'googlebot';
	private static $MATCH_GOOGLE_VIEW	= 'google web preview';
	private static $MATCH_GOOGLE_READER	= 'feedfetcher-google';
	private static $MATCH_GOOGLE_DESK	= 'google desktop';
	private static $MATCH_BING			= array(
											'bingbot',
											'msnbot');
	private static $MATCH_ASK			= 'ask jeeves';
	private static $MATCH_EXABOT		= 'exabot';
	private static $MATCH_GEOHASH		= 'geohasher';
	private static $MATCH_POST_RANK		= 'postrank';
	private static $MATCH_RADIAN		= 'r6_commentreader';
	private static $MATCH_BAIDU_SPIDER	= 'baiduspider';
	private static $MATCH_BLEKKO_SPIDER	= 'scoutjet';
	private static $MATCH_WLA			= 'wla syndication platform';
	private static $MATCH_FACEBOOK		= 'facebookexternalhit';
	private static $MATCH_BLOGLINES		= 'bloglines';
	private static $MATCH_R6			= 'r6_feedfetcher';
	private static $MATCH_AOL_FAVICON	= 'ee://aol/http';
	private static $MATCH_YAHOO			= 'slurp';
	private static $MATCH_YAHOO_FEED	= 'yahoocachesystem';
	private static $MATCH_YANDEX		= 'yandexbot';
	private static $MATCH_HUAWEI		= 'huaweisymantecspider';
	private static $MATCH_SOGOU			= 'sogou web spider';
	private static $MATCH_MLBOT			= 'mlbot';
	private static $MATCH_NETCRAFT		= 'netcraftsurveyagent';
	private static $MATCH_TURNITIN		= 'turnitinbot';
	private static $MATCH_LINKEDINBOT	= 'linkedinbot';
	private static $MATCH_ABOUT_US		= 'aboutusbot';
	private static $MATCH_COSMIX		= 'voyager';
	private static $MATCH_PYCURL		= 'pycurl';
	private static $MATCH_MAJESTIC		= 'mj12bot';
	private static $MATCH_GIGABOT		= 'gigabot';
	private static $MATCH_ZOOKA			= 'zookabot';
	private static $MATCH_PANSCIENT		= 'panscient';
	private static $MATCH_LIBWWW		= 'libwww-perl';
	private static $MATCH_DOTBOT		= 'dotbot';
	private static $MATCH_ARCHIVER		= 'ia_archiver';
	private static $MATCH_ZEND			= 'zend_http_client';
	private static $MATCH_PYTHON		= 'python-urllib';
	private static $MATCH_JAKARATA		= 'jakarta commons';

	private static $NAME_MOBILE			= 'mobile';
	private static $NAME_IPHONE			= 'iphone';
	private static $NAME_WINDOWS_PHONE	= 'windows phone';
	private static $NAME_NOKIA			= 'nokia';
	private static $NAME_IPOD			= 'ipod';
	private static $NAME_MAC			= 'macintosh';
	private static $NAME_WEBTV			= 'webtv';
	private static $NAME_WII			= 'wii';
	private static $NAME_WINDOWS_3		= 'windows 3';
	private static $NAME_WINDOWS_4		= 'windows 4';
	private static $NAME_WINDOWS_95		= 'windows 95';
	private static $NAME_WINDOWS_98		= 'windows 98';
	private static $NAME_WINDOWS_2000	= 'windows 2000';
	private static $NAME_WINDOWS_ME		= 'windows me';
	private static $NAME_WINDOWS_S_03	= 'windows server 2003';
	private static $NAME_WINDOWS_XP		= 'windows xp';
	private static $NAME_WINDOWS_VISTA	= 'windows vista';
	private static $NAME_WINDOWS_7		= 'windows 7';
	private static $NAME_OPENBSD		= 'openbsd';
	private static $NAME_FREEBSD		= 'freebsd';
	private static $NAME_SUNOS			= 'sun os';
	private static $NAME_LINUX			= 'linux';
	private static $NAME_GOOGLEBOT		= 'googlebot';
	private static $NAME_GOOGLE_READER	= 'google reader';
	private static $NAME_GOOGLE_VIEW	= 'google preview';
	private static $NAME_GOOGLE_DESKTOP	= 'google desktop';
	private static $NAME_BING			= 'bing';
	private static $NAME_ASK			= 'ask';
	private static $NAME_EXABOT			= 'exabot';
	private static $NAME_GEOHASH		= 'geohasher';
	private static $NAME_POST_RANK		= 'post rank';
	private static $NAME_RADIAN			= 'radian comments';
	private static $NAME_BAIDU_SPIDER	= 'baidu';
	private static $NAME_BLEKKO_SPIDER	= 'blekko';
	private static $NAME_WLA			= 'wla bot';
	private static $NAME_FACEBOOK		= 'facebook';
	private static $NAME_BLOGLINES		= 'bloglines';
	private static $NAME_R6				= 'r6 feedfetcher';
	private static $NAME_AOL_FAVICON	= 'aol favicon';
	private static $NAME_YAHOO			= 'yahoo';
	private static $NAME_YAHOO_FEED		= 'yahoo rss';
	private static $NAME_YANDEX			= 'yandexbox';
	private static $NAME_HUAWEI			= 'huawei-symantec';
	private static $NAME_SOGOU			= 'sogou';
	private static $NAME_MLBOT			= 'mlbot';
	private static $NAME_NETCRAFT		= 'netcraftbot';
	private static $NAME_TURNITIN		= 'turnitinbot';
	private static $NAME_LINKEDINBOT	= 'linkedinbot';
	private static $NAME_ABOUT_US		= 'aboutusbot';
	private static $NAME_COSMIX			= 'cosmixbot';
	private static $NAME_PYCURL			= 'pycurl';
	private static $NAME_MAJESTIC		= 'majestic 12';
	private static $NAME_GIGABOT		= 'gigabot';
	private static $NAME_ZOOKA			= 'zookabot';
	private static $NAME_PANSCIENT		= 'panscient';
	private static $NAME_LIBWWW			= 'libwww-perl';
	private static $NAME_DOTBOT			= 'dotbot';
	private static $NAME_ARCHIVER		= 'internet archive';
	private static $NAME_ZEND			= 'zend';
	private static $NAME_PYTHON			= 'python';
	private static $NAME_JAKARATA		= 'jakarata';
	private static $NAME_UNKNOWN		= 'unknown';

	public function getName()
	{
		if(stristr($this->user_agent, self::$MATCH_MOBILE))
			return self::$NAME_MOBILE;
		
		if(stristr($this->user_agent, self::$MATCH_IPHONE))
			return self::$NAME_IPHONE;
		
		if(stristr($this->user_agent, self::$MATCH_WINDOWS_PHONE))
			return self::$NAME_WINDOWS_PHONE;
		
		if(stristr($this->user_agent, self::$MATCH_NOKIA))
			return self::$NAME_NOKIA;
		
		if(stristr($this->user_agent, self::$MATCH_IPOD))
			return self::$NAME_IPOD;
		
		if(stristr($this->user_agent, self::$MATCH_MAC))
			return self::$NAME_MAC;
		
		if(stristr($this->user_agent, self::$MATCH_DARWIN))
			return self::$NAME_MAC;
		
		if(stristr($this->user_agent, self::$MATCH_WEBTV))
			return self::$NAME_WEBTV;
		
		if(stristr($this->user_agent, self::$MATCH_WII))
			return self::$NAME_WII;
		
		if(stristr($this->user_agent, self::$MATCH_WINDOWS_3))
			return self::$NAME_WINDOWS_3;
		
		foreach(self::$MATCH_WINDOWS_4 as $match)
		{
			if(stristr($this->user_agent, $match))
				return self::$NAME_WINDOWS_4;
		}
		
		foreach(self::$MATCH_WINDOWS_95 as $match)
		{
			if(stristr($this->user_agent, $match))
				return self::$NAME_WINDOWS_95;
		}
		
		foreach(self::$MATCH_WINDOWS_98 as $match)
		{
			if(stristr($this->user_agent, $match))
				return self::$NAME_WINDOWS_98;
		}
		
		foreach(self::$MATCH_WINDOWS_2000 as $match)
		{
			if(stristr($this->user_agent, $match))
				return self::$NAME_WINDOWS_2000;
		}
		
		if(stristr($this->user_agent, self::$MATCH_WINDOWS_ME))
			return self::$NAME_WINDOWS_ME;
		
		if(stristr($this->user_agent, self::$MATCH_WINDOWS_S_03))
			return self::$NAME_WINDOWS_S_03;
		
		foreach(self::$MATCH_WINDOWS_XP as $match)
		{
			if(stristr($this->user_agent, $match))
				return self::$NAME_WINDOWS_XP;
		}
		
		if(stristr($this->user_agent, self::$MATCH_WINDOWS_VISTA))
			return self::$NAME_WINDOWS_VISTA;
		
		foreach(self::$MATCH_WINDOWS_7 as $match)
		{
			if(stristr($this->user_agent, $match))
				return self::$NAME_WINDOWS_7;
		}
		
		if(stristr($this->user_agent, self::$MATCH_OPENBSD))
			return self::$NAME_OPENBSD;
		
		if(stristr($this->user_agent, self::$MATCH_FREEBSD))
			return self::$NAME_FREEBSD;
		
		if(stristr($this->user_agent, self::$MATCH_SUNOS))
			return self::$NAME_SUNOS;
		
		foreach(self::$MATCH_LINUX as $match)
		{
			if(stristr($this->user_agent, $match))
				return self::$NAME_LINUX;
		}
		
		if(stristr($this->user_agent, self::$MATCH_GOOGLEBOT))
			return self::$NAME_GOOGLEBOT;
		
		if(stristr($this->user_agent, self::$MATCH_GOOGLE_READER))
			return self::$NAME_GOOGLE_READER;
		
		if(stristr($this->user_agent, self::$MATCH_GOOGLE_VIEW))
			return self::$NAME_GOOGLE_VIEW;
		
		if(stristr($this->user_agent, self::$MATCH_GOOGLE_DESK))
			return self::$NAME_GOOGLE_DESKTOP;
		
		foreach(self::$MATCH_BING as $match)
		{
			if(stristr($this->user_agent, $match))
				return self::$NAME_BING;
		}
		
		if(stristr($this->user_agent, self::$MATCH_ASK))
			return self::$NAME_ASK;
		
		if(stristr($this->user_agent, self::$MATCH_EXABOT))
			return self::$NAME_EXABOT;
		
		if(stristr($this->user_agent, self::$MATCH_GEOHASH))
			return self::$NAME_GEOHASH;
		
		if(stristr($this->user_agent, self::$MATCH_POST_RANK))
			return self::$NAME_POST_RANK;
		
		if(stristr($this->user_agent, self::$MATCH_BAIDU_SPIDER))
			return self::$NAME_BAIDU_SPIDER;
		
		if(stristr($this->user_agent, self::$MATCH_RADIAN))
			return self::$NAME_RADIAN;
		
		if(stristr($this->user_agent, self::$MATCH_BLEKKO_SPIDER))
			return self::$NAME_BLEKKO_SPIDER;
		
		if(stristr($this->user_agent, self::$MATCH_WLA))
			return self::$NAME_WLA;
		
		if(stristr($this->user_agent, self::$MATCH_FACEBOOK))
			return self::$NAME_FACEBOOK;
		
		if(stristr($this->user_agent, self::$MATCH_BLOGLINES))
			return self::$NAME_BLOGLINES;
		
		if(stristr($this->user_agent, self::$MATCH_R6))
			return self::$NAME_R6;
		
		if(stristr($this->user_agent, self::$MATCH_AOL_FAVICON))
			return self::$NAME_AOL_FAVICON;
		
		if(stristr($this->user_agent, self::$MATCH_YAHOO))
			return self::$NAME_YAHOO;
		
		if(stristr($this->user_agent, self::$MATCH_YAHOO_FEED))
			return self::$NAME_YAHOO_FEED;
		
		if(stristr($this->user_agent, self::$MATCH_YANDEX))
			return self::$NAME_YANDEX;
		
		if(stristr($this->user_agent, self::$MATCH_HUAWEI))
			return self::$NAME_HUAWEI;
		
		if(stristr($this->user_agent, self::$MATCH_SOGOU))
			return self::$NAME_SOGOU;
		
		if(stristr($this->user_agent, self::$MATCH_MLBOT))
			return self::$NAME_MLBOT;
		
		if(stristr($this->user_agent, self::$MATCH_NETCRAFT))
			return self::$NAME_NETCRAFT;
		
		if(stristr($this->user_agent, self::$MATCH_TURNITIN))
			return self::$NAME_TURNITIN;
		
		if(stristr($this->user_agent, self::$MATCH_LINKEDINBOT))
			return self::$NAME_LINKEDINBOT;
		
		if(stristr($this->user_agent, self::$MATCH_ABOUT_US))
			return self::$NAME_ABOUT_US;
		
		if(stristr($this->user_agent, self::$MATCH_COSMIX))
			return self::$NAME_COSMIX;
		
		if(stristr($this->user_agent, self::$MATCH_PYCURL))
			return self::$NAME_PYCURL;
		
		if(stristr($this->user_agent, self::$MATCH_MAJESTIC))
			return self::$NAME_MAJESTIC;
		
		if(stristr($this->user_agent, self::$MATCH_GIGABOT))
			return self::$NAME_GIGABOT;
		
		if(stristr($this->user_agent, self::$MATCH_ZOOKA))
			return self::$NAME_ZOOKA;
		
		if(stristr($this->user_agent, self::$MATCH_PANSCIENT))
			return self::$NAME_PANSCIENT;
		
		if(stristr($this->user_agent, self::$MATCH_LIBWWW))
			return self::$NAME_LIBWWW;
		
		if(stristr($this->user_agent, self::$MATCH_DOTBOT))
			return self::$NAME_DOTBOT;
		
		if(stristr($this->user_agent, self::$MATCH_ARCHIVER))
			return self::$NAME_ARCHIVER;
		
		if(stristr($this->user_agent, self::$MATCH_ZEND))
			return self::$NAME_ZEND;
		
		if(stristr($this->user_agent, self::$MATCH_PYTHON))
			return self::$NAME_PYTHON;
		
		if(stristr($this->user_agent, self::$MATCH_JAKARATA))
			return self::$NAME_JAKARATA;
		
		return self::$NAME_UNKNOWN;
	}

}

?>
