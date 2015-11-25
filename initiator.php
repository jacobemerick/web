<?

$config = json_decode(file_get_contents('config.json'));

include_once('utility/Loader.class.inc.php');

Loader::loadInstance('utility', 'Debugger');

date_default_timezone_set('America/Chicago');
ini_set('display_errors', 1);
error_reporting(E_ALL);
// set_error_handler(array('Debugger', 'internal_error'));
// register_shutdown_function(array('Debugger', 'shutdown'));

Loader::loadInstance('utility', 'Visitor');
Loader::loadNew('utility', 'CronController')->activate();
// Loader::loadInstance('router', 'Router');
