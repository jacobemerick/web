<?

Loader::load('utility', array(
	'Asset',
	'Content',
	'Header'));

final class HomeController
{

	public function __construct()
	{
		Debugger::hide();
	}

	public function activate()
	{
		$file = URLDecode::getPiece(2);
		//$file = substr($file, 1);
		$last_modified = Asset::getLastModified('styles', $file);
		$file = "final/{$file}";
		
		Header::sendCSS($last_modified);
		
		ob_start();
		Loader::load('styles', $file);
		$contents = ob_get_clean();
		$contents = Content::instance('FixImage', $contents)->activate();
		
		echo $contents;
	}

}