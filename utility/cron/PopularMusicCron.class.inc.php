<?

Loader::load('collector', 'data/MusicCollector');
Loader::load('utility', 'Content');
Loader::load('utility', 'cron/Cron');

final class PopularMusicCron extends Cron
{

	private static $QUERY = "INSERT INTO `jpemeric_data`.`popular_music` (`album`,`artist`,`count`,`date`,`display`) VALUES ('%s','%s','%d','%s','%d')";
	private static $XML_PATH = 'http://ws.audioscrobbler.com/2.0/?method=user.gettopalbums&user=jpemeric&period=7day&api_key=SECRET_KEY';

	private $xml;

	function __construct()
	{
		$xml = simplexml_load_file(self::$XML_PATH);
		$this->xml = $xml;
	}

	public function activate()
	{
		if(!$this->xml)
			return $this->error('Could not connect to feed.');
		
		$date = date('Y-m-d');
		
		foreach($this->xml->topalbums->album as $record)
		{
			$album = $record->name;
			$album = $this->check_album($album);
			
			$artist = $record->artist->name;
			$artist = $this->check_artist($artist);
			
			$playcount = $record->playcount;
			$playcount = $this->get_playcount($album, $artist, $date, $playcount);
			
			if($playcount < 1)
				continue;
			
			$display = (
				Content::instance('Acceptable', $album)->check() &&
				Content::instance('Acceptable', $artist)->check()) ? 1 : 0;
			
			$album = Database::escape($album);
			$artist = Database::escape($artist);
			
			$query = self::$QUERY;
			$query = sprintf($query, $album, $artist, $playcount, $date, $display);
			Database::execute($query);
		}
		return true;
	}

	private function check_album($album)
	{
		switch($album)
		{
			case '<3' :
				$album = '3';
			break;
			case '; John - Single';
				$album = 'John';
			break;
			case 'Absolute Garbage (Parental Advisory)' :
				$album = 'Absolute Garbage';
			break;
			case 'Absolution (New 09 Version)' :
				$album = 'Absolution';
			break;
			case 'Always Outnumbered, Never Outgunned (Parental Advisory)' :
				$album = 'Always Outnumbered, Never Outgunned';
			break;
			case "America's Sweetheart (Parental Advisory)";
				$album = "America's Sweetheart";
			break;
			case 'As Cruel As School Children (Bonus Track) (Parental Advisory)' :
				$album = 'As Cruel as School Children';
			break;
			case 'B*Witched' :
				$album = 'BeWitched';
			break;
			case 'Back to Black (Parental Advisory)' :
				$album = 'Back to Black';
			break;
			case 'Best Of/20th Eco' :
				$album = 'Best Of 20th Century';
			break;
			case 'blink-182 (Parental Advisory)' :
				$album = 'blink-182';
			break;
			case 'Bonfire Blondes (Single)' :
				$album = 'Bonfire Blondes';
			break;
			case 'Born To Die (Bonus Track Version)' :
				$album = 'Born to Die';
			break;
			case 'Beaus$Eros' :
				$album = 'Beaus Eros';
			break;
			case 'Cansei De Ser Sexy (Parental Advisory)' :
				$album = 'Cansei De Ser Sexy';
			break;
			case 'Ceremonials (Deluxe Edition)' :
				$album = 'Ceremonials';
			break;
			case 'Charmed And Strange (US Version)' :
				$album = 'Charmed And Strange';
			break;
			case 'Chocolate Starfish And The Hot Dog Flavored Water (Parental Advisory)' :
				$album = 'Chocolate Starfish And The Hot Dog Flavored Water';
			break;
			case 'Clump - Single' :
				$album = 'Clump';
			break;
			case 'Costello Music (US Version)' :
				$album = 'Costello Music';
			break;
			case 'Did My Time (3-Track Maxi-Single)' :
				$album = 'Did My Time';
			break;
			case 'Dummy (Non UK Version)' :
				$album = 'Dummy';
			break;
			case 'Ellen Disingenuous (Single)' :
				$album = 'Ellen Disingenuous';
			break;
			case 'Ellipse (Deluxe Edition)' :
				$album = 'Ellipse';
			break;
			case 'Fabulously Lazy (Single)' :
				$album = 'Fabulously Lazy';
			break;
			case 'Far (Deluxe DMD)' :
				$album = 'Far';
			break;
			case 'Fashion Nugget (Parental Advisory)' :
				$album = 'Fashion Nugget';
			break;
			case 'Frank (E-Version - Parental Advisory)' :
				$album = 'Frank';
			break;
			case 'Fumbling Towards Ecstasy (Legacy Edition)' :
				$album = 'Fumbling Towards Ecstasy';
			break;
			case 'Foundations (4-Track Maxi-Single)' :
				$album = 'Foundations';
			break;
			case 'Franz Ferdinand (Special Edition Version)' :
				$album = 'Franz Ferdinand';
			break;
			case 'Gish (Deluxe Edition)' :
				$album = 'Gish';
			break;
			case 'Glad Rag Doll (Deluxe Edition)' :
				$album = 'Glad Rag Doll';
			break;
			case 'Golden State (U.S. Version)' :
				$album = 'Golden State';
			break;
			case 'Good News For People Who Love Bad News (Parental Advisory)' :
				$album = 'Good News For People Who Love Bad News';
			break;
			case 'Hands (Us)' :
				$album = 'Hands';
			break;
			case 'Hands All Over (Deluxe)' :
				$album = 'Hands All Over';
			break;
			case 'Heligoland (Deluxe Edition)' :
				$album = 'Heligoland';
			break;
			case 'Holy Wood (In The Shadow Of The Valley Of Death) (Parental Advisory)' :
				$album = 'Holy Wood (In The Shadow Of The Valley Of Death)';
			break;
			case 'Illuminations EP' :
				$album = 'Illuminations';
			break;
			case 'In Concert; . - Single' :
				$album = 'Period';
			break;
			case 'In Concert; B - Single' :
				$album = 'B';
			break;
			case 'In Concert; N - Single' :
				$album = 'N';
			break;
			case 'In Concert; O - Single' :
				$album = 'O';
			break;
			case 'In Concert; T - Single' :
				$album = 'T';
			break;
			case 'In Concert; U-2 - Single' :
				$album = 'U-2';
			break;
			case 'In Concert; Y - Single' :
				$album = 'Y';
			break;
			case 'Invaders Must Die: Remixes & Bonus Tracks' :
				$album = 'Invaders Must Die';
			break;
			case 'Issues (Parental Advisory)' :
				$album = 'Issues';
			break;
			case 'Jettsetter' :
				$album = 'Jetsetter';
			break;
			case 'Keep On Your Mean Side (Digital Download)' :
				$album = 'Keep On Your Mean Side';
			break;
			case 'Leaving On A Mayday (Us Version)' :
				$album = 'Leaving On A Mayday';
			break;
			case 'Life Is Peachy (Parental Advisory)' :
				$album = 'Life is Peachy';
			break;
			case 'Lost in Transition (Bonus Track Version)' :
				$album = 'Lost in Transition';
			break;
			case 'Loud (Parental Advisory)' :
				$album = 'Loud';
			break;
			case 'MDNA (Deluxe Version)' :
				$album = 'MDNA';
			break;
			case 'Me And Armini (US Edition)' :
				$album = 'Me And Armini';
			break;
			case 'Musique, Vol.1 (1993-2005)' :
				$album = 'Musique, Vol. 1';
			break;
			case 'My Beautiful Dark Twisted Fantasy (Parental Advisory)' :
				$album = 'My Beautiful Dark Twisted Fantasy';
			break;
			case "No One's First, And You're Next EP" :
				$album = "No One's First, And You're Next";
			break;
			case "Nobody's Daughter (Parental Advisory)" :
				$album = "Nobody's Daughter";
			break;
			case 'not your kind of people (deluxe)' :
				$album = 'not your kind of people';
			break;
			case 'Nothing But The Beat 2.0' :
				$album = 'Nothing But The Beat';
			break;
			case 'Nth Degree (Single)' :
				$album = 'Nth Degree';
			break;
			case 'Ooh La La' :
				$album = 'Supernature';
			break;
			case 'Pink Friday (Parental Advisory - Deluxe Version)' :
				$album = 'Pink Friday';
			break;
			case 'Old World Underground, Where Are You Now?' :
				$album = 'Old World Underground, Where Are You Now';
			break;
			case 'Opheliac - The Deluxe Edition' :
				$album = 'Opheliac';
			break;
			case 'Past, Present & Future (Parental Advisory)' :
				$album = 'Past, Present & Future';
			break;
			case 'Province EP' :
				$album = 'Province';
			break;
			case 'Punk Statik Paranoia (Parental Advisory)' :
				$album = 'Punk Statik Paranoia';
			break;
			case 'Recovery (Parental Advisory)' :
				$album = 'Recovery';
			break;
			case 'Run Devil Run New 2010' :
				$album = 'Run Devil Run';
			break;
			case 'Scott Pilgrim vs. the World (Original Motion Picture Soundtrack)' :
				$album = 'Scott Pilgrim vs. the World';
			break;
			case 'Showbiz (09 Version)' :
				$album = 'Showbiz';
			break;
			case 'Smile (4-Track Maxi-Single) (Parental Advisory)' :
				$album = 'Smile';
			break;
			case 'Staring at the Sun EP' :
				$album = 'Staring at the Sun';
			break;
			case 'Still (Parental Advisory)' :
				$album = 'Still';
			break;
			case 'Solid Gold Hits (Parental Advisory)' :
				$album = 'Solid Gold Hits';
			break;
			case 'Something For The Rest Of Us (Deluxe)' :
				$album = 'Something For The Rest Of Us';
			break;
			case 'Something Is Not Right With Me (Single)' :
				$album = 'Something Is Not Right With Me';
			break;
			case 'Songs For The Deaf (Parental Advisory)' :
				$album = 'Songs For The Deaf';
			break;
			case 'Speak in Code (Standard Edition)' :
				$album = 'Speak in Code';
			break;
			case '$O$' :
				$album = 'SOS';
			break;
			case 'The Downward Spiral: Deluxe Edition';
				$album = 'The Downward Spiral';
			break;
			case 'Things Falling Apart (Parental Advisory)' :
				$album = 'Things Falling Apart';
			break;
			case 'Timebomb (Single)' :
				$album = 'Timebomb';
			break;
			case 'The Beginning (Deluxe)' :
				$album = 'The Beginning';
			break;
			case 'The Best Of (2-Disc Version)(Parental Advisory)' :
				$album = 'The Best Of';
			break;
			case 'The Gift Of Game (Parental Advisory)' :
				$album = 'The Gift Of Game';
			break;
			case 'The Idler Wheel Is Wiser Than the Driver of the Screw and Whipping Cords Will Serve You More Than Ropes Will Ever Do' :
				$album = 'The Idler Wheel';
			break;
			case 'The Night The Sun Came Up (Parental Advisory)' :
				$album = 'The Night The Sun Came Up';
			break;
			case 'Turtleneck & Chain (Parental Advisory)' :
				$album = 'Turtleneck & Chain';
			break;
			case 'Volta (Limited Edition With Bonus Track)' :
				$album = 'Volta';
			break;
			case 'Vows (Deluxe Version)' :
				$album = 'Vows';
			break;
			case 'Waterloo To Anywhere (Parental Advisory)' :
				$album = 'Waterloo To Anywhere';
			break;
			case 'We Are Pilots (Parental Advisory)' :
				$album = 'We Are Pilots';
			break;
			case 'When the Pawn Hits the Conflicts He Thinks Like a King...' :
				$album = 'When the Pawn';
			break;
			case 'Y By Zoo Brazil - Single' :
				$album = 'Y By Zoo Brazil';
			break;
			case "You've Come A Long Way, Baby (Parental Advisory)" :
				$album = "You've Come A Long Way, Baby";
			break;
		}
		
		return (string) $album;
	}

	private function check_artist($artist)
	{
		switch($artist)
		{
			case 'B*Witched' :
				$artist = 'BeWitched';
			break;
			case 'Blake Lewis featuring Lupe Fiasco' :
				$artist = 'Blake Lewis';
			break;
			case 'Britney Spears feat. Sabi' :
				$artist = 'Britney Spears';
			break;
			case 'BjÃ¶rk' :
			case 'Björk' :
			case 'Bjork feat. Antony as " The Conscience' :
				$artist = 'Bjork';
			break;
			case 'Busdriver' :
				$artist = 'Bus Driver';
			break;
			case 'Carly Rae Jepsen, Owl City' :
				$artist = 'Carly Rae Jepsen';
			break;
			case 'Coldplay & Rihanna' :
				$artist = 'Coldplay';
			break;
			case 'Does It Offend You, Yeah?' :
				$artist = 'Does It Offend You, Yeah';
			break;
			case 'Eiffel 65 feat. Papa Winnie' :
				$artist = 'Eiffel 65';
			break;
			case 'EVE 6' :
				$artist = 'Eve 6';
			break;
			case 'Florence + The Machine' :
			case 'Florence & The Machine' :
				$artist = 'Florence and The Machine';
			break;
			case "Girls' Generation" :
				$artist = 'Girls Generation';
			break;
			case 'Ke$ha' :
				$artist = 'Kesha';
			break;
			case 'Magnetic Man' :
				$artist = 'Katy B';
			break;
			case 'Martin Solveig & Dragonette' :
				$artist = 'Dragonette';
			break;
			case 'Michael Smith' :
				$artist = 'Michael W Smith';
			break;
			case 'Original Broadway Cast' :
				$artist = 'Various Artists';
			break;
			case 'Patti LuPone' :
				$artist = 'Various Artists';
			break;
			case 'Róisín Murphy' :
				$artist = 'Rosin Murphy';
			break;
			case "Sarah McLachlan featuring The Sarah McLachlan Music Outreach Children's Choir and Youth Choir" :
				$artist = 'Sarah McLachlan';
			break;
			case 'Smashing Pumpkins' :
				$artist = 'The Smashing Pumpkins';
			break;
			case 'Teddybears featuring Daddy Boastin' :
				$artist = 'Teddybears';
			break;
			case 'TÃ©lÃ©popmusik' :
				$artist = 'Telepopmusik';
			break;
			case 'UNKLE & Sleepy Sun' :
				$artist = 'UNKLE';
			break;
			case 'White Zombie' :
				$artist = 'Rob Zombie';
			break;
		}
		
		return (string) $artist;
	}

	private function get_playcount($album, $artist, $date, $playcount)
	{
		$start_date = strtotime("{$date} - 7 days");
		$start_date = date('Y-m-d', $start_date);
		
		$playcount_result = MusicCollector::getPlayCountOverLastSevenDays($album, $artist, $start_date);
		$playcount -= $playcount_result->playcount;
		return $playcount;
	}

}
