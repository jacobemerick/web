<?

Loader::load('collector', 'stream/TwitterCollector');
Loader::load('utility', 'Content');
Loader::load('utility', 'cron/Cron');

final class TwitterCron extends Cron
{

	private static $INSERT_NEW_QUERY = "INSERT INTO `jpemeric_stream`.`twitter` (`twitter_id`,`text`,`text_formatted`,`text_formatted_full`,`source`,`retweets`,`favorites`,`date`,`is_reply`,`is_retweet`,`raw`) VALUES ('%s','%s','%s','%s','%s','%d','%d','%s','%d','%d','%s')";
	private static $UPDATE_FAVORITES_QUERY = "UPDATE `jpemeric_stream`.`twitter` SET `favorites` = '%d' WHERE `id` = '%d'";
	private static $UPDATE_RETWEETS_QUERY = "UPDATE `jpemeric_stream`.`twitter` SET `retweets` = '%d' WHERE `id` = '%d'";

	private static $REQUEST_URL = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	private static $SCREEN_NAME = 'jpemeric';
	private static $COUNT = '200';

	private static $HASHTAG_LINK = '<a href="https://twitter.com/search?q=%%23%1$s&src=hash" rel="nofollow" target="_blank" title="Twitter / Search - #%1$s">#%1$s</a>';
	private static $URL_LINK = '<a href="%s" rel="nofollow" target="_blank" title="%s">%s</a>';
	private static $USER_MENTION_LINK = '<a href="https://twitter.com/%1$s" rel="nofollow" target="_blank" title="%2$s (%1$s) on Twitter">@%1$s</a>';
	private static $MEDIA_LINK = '<a class="photo" href="%s" rel="nofollow" target="_blank" title="%s"><img src="%s:%s" alt="%s" height="%s" width="%s" /></a>';

    private $consumer_key;
    private $consumer_secret;
    private $access_token;
    private $access_secret;

	private $json;

	public function __construct()
	{
        global $config;

        $this->consumer_key = $config->twitter->consumer_key;
        $this->consumer_secret = $config->twitter->consumer_secret;
        $this->access_token = $config->twitter->access_token;
        $this->access_secret = $config->twitter->access_secret;

		$json = $this->get_data();
		
		$json = json_decode($json);
		$this->json = $json;
	}

	private function get_data()
	{
		$curl_request = curl_init();
		curl_setopt($curl_request, CURLOPT_HTTPHEADER, $this->get_curl_headers());
		curl_setopt($curl_request, CURLOPT_HEADER, false);
		curl_setopt($curl_request, CURLOPT_URL, $this->get_curl_url());
		curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);
		$json = curl_exec($curl_request);
		curl_close($curl_request);
		
		return $json;
	}

	private function get_curl_url()
	{
		$url = '';
		$url .= self::$REQUEST_URL;
		$url .= '?';
		$url .= 'screen_name=' . self::$SCREEN_NAME;
		$url .= '&';
		$url .= 'count=' . self::$COUNT;
		
		return $url;
	}

	private function get_curl_headers()
	{
		$authorization_array = $this->get_oauth_array();
		$authorization_array['oauth_signature'] = $this->get_oauth_signature();
		$authorization_array = $this->encode_oauth_array($authorization_array, true);
		$authorization_string = implode(', ', $authorization_array);
		
		return array(
			"Authorization: Oauth {$authorization_string}",
			'Expect:');
	}

	private $oauth_array;
	private function get_oauth_array()
	{
		if(!isset($this->oauth_array))
		{
			$this->oauth_array = array(
				'screen_name' => self::$SCREEN_NAME,
				'count' => self::$COUNT,
				'oauth_consumer_key' => $this->consumer_key,
				'oauth_nonce' => time(),
				'oauth_signature_method' => 'HMAC-SHA1',
				'oauth_token' => $this->access_token,
				'oauth_timestamp' => time(),
				'oauth_version' => '1.0');
		}
		return $this->oauth_array;
	}

	private function get_oauth_signature()
	{
		$base = 'GET';
		$base .= '&';
		$base .= rawurlencode(self::$REQUEST_URL);
		$base .= '&';
		$base .= rawurlencode(implode('&', $this->encode_oauth_array($this->get_oauth_array())));
		
		$key = rawurlencode($this->consumer_secret);
		$key .= '&';
		$key .= rawurlencode($this->access_secret);
		return base64_encode(hash_hmac('sha1', $base, $key, true));
	}

	private function encode_oauth_array($array, $wrap_values = false)
	{
		$encoded_array = array();
		ksort($array);
		foreach($array as $key => $value)
		{
			$value = rawurlencode($value);
			$value = ($wrap_values) ? '"' . $value . '"' : $value;
			$encoded_array[] = "{$key}={$value}";
		}
		return $encoded_array;
	}

	public function activate()
	{
		if(!$this->json)
			return $this->error('Could not connect to twitter json feed.');
		
		$count = 0;
		foreach($this->json as $status)
		{
			$text = Database::escape($status->text);
			$date = date('Y-m-d H:i:s', strtotime($status->created_at));
			
			$tweet_result = TwitterCollector::getTweetByFields($date, $text);
			if($tweet_result !== null)
			{
				$favorites = (int) $status->favorite_count;
				if($favorites != 0 && $tweet_result->favorites != $favorites)
				{
					$query = sprintf(self::$UPDATE_FAVORITES_QUERY, $favorites, $tweet_result->id);
					Database::execute($query);
				}
				
				$retweets = (int) $status->retweet_count;
				if($retweets != 0 && $tweet_result->retweets != $retweets)
				{
					$query = sprintf(self::$UPDATE_RETWEETS_QUERY, $retweets, $tweet_result->id);
					Database::execute($query);
				}
			}
			else
			{
				$twitter_id = (string) $status->id_str;
				
				if(isset($status->retweeted_status))
				{
					$text_formatted = $this->get_formatted($status->retweeted_status->text, $status->retweeted_status->entities);
					$text_formatted_full = $this->get_formatted($status->retweeted_status->text, $status->retweeted_status->entities, 'full');
					
					$text_formatted = $this->prepend_original_user($status->retweeted_status->user, $text_formatted);
					$text_formatted_full = $this->prepend_original_user($status->retweeted_status->user, $text_formatted_full);
				}
				else
				{
					$text_formatted = $this->get_formatted($status->text, $status->entities);
					$text_formatted_full = $this->get_formatted($status->text, $status->entities, 'full');
				}
				
				$source = $this->get_source($status->source);
				$retweets = (int) $status->retweet_count;
				$favorites = (int) $status->favorite_count;
				$is_reply = ($status->in_reply_to_user_id != null) ? 1 : 0;
				$is_retweet = isset($status->retweeted_status) ? 1 : 0;
				
				$raw = json_encode($status);
				$raw = Database::escape($raw);
				
				$query = sprintf(self::$INSERT_NEW_QUERY, $twitter_id, $text, $text_formatted, $text_formatted_full, $source, $retweets, $favorites, $date, $is_reply, $is_retweet, $raw);
				Database::execute($query);
			}
		}
		return true;
	}

	private function prepend_original_user($user, $text)
	{
		$prefix = '';
		$prefix .= 'RT';
		$prefix .= ' ';
		$prefix .= sprintf(self::$USER_MENTION_LINK, $user->screen_name, $user->name);
		$prefix .= ' ';
		
		return $prefix . $text;
	}

	private function get_source($source)
	{
		if(stristr($source, 'tweetdeck'))
			return 'tweetdeck';
		if(stristr($source, 'windows phone'))
			return 'phone';
		else
			return '';
	}

	private function get_formatted($text, $entities, $type = 'short')
	{
		$holder = array();
		foreach($entities as $entity_type => $entity_collection)
		{
			foreach($entity_collection as $entity)
			{
				$start = $entity->indices[0];
				$end = $entity->indices[1];
				$replace = $this->get_replace_text($entity_type, $entity, $type);
				
				$holder[$end] = (object) array(
					'start' => $start,
					'end' => $end,
					'replace' => $replace);
			}
		}
		
		krsort($holder);
		
		foreach($holder as $entity)
		{
			$text = mb_substr($text, 0, $entity->start, 'UTF-8') . $entity->replace . mb_substr($text, $entity->end, 5000, 'UTF-8');
		}
		
		$text = mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8');
		$text = Database::escape($text);
		
		return $text;
	}

	private function get_replace_text($entity_type, $entity, $type)
	{
		switch($entity_type)
		{
			case 'hashtags' :
				$replace = sprintf(self::$HASHTAG_LINK, $entity->text);
				break;
			case 'urls' :
				$replace = sprintf(self::$URL_LINK, $entity->url, $entity->expanded_url, $entity->display_url);
				break;
			case 'user_mentions' :
				$replace = sprintf(self::$USER_MENTION_LINK, $entity->screen_name, $entity->name);
				break;
			case 'media' :
				if($type == 'full')
					$replace = sprintf(self::$MEDIA_LINK, $entity->url, $entity->display_url, $entity->media_url, 'large', 'Photo from Twitter', $entity->sizes->large->h, $entity->sizes->large->w);
				else
					$replace = sprintf(self::$URL_LINK, $entity->url, $entity->expanded_url, $entity->display_url);
				break;
			default :
				$replace = '';
				break;
		}
		
		return $replace;
	}

}
