<?

Loader::load('utility', 'Header');

class HomeController
{

	public function __construct()
	{
		Debugger::hide();
	}

	public function activate()
	{
		Header::sendJS();
		
		$file = URLDecode::getPiece(2);
		//$file = substr($file, 1);
		$file = "final/{$file}";
		
		Loader::load('scripts', $file);
	}

}