<?

$config = json_decode(file_get_contents(__DIR__ . 'config.json'));

include_once('utility/Loader.class.inc.php');

Loader::loadInstance('utility', 'Debugger');

date_default_timezone_set('America/Chicago');
ini_set('display_errors', 0);
error_reporting(-1);
set_error_handler(array('Debugger', 'internal_error'));
register_shutdown_function(array('Debugger', 'shutdown'));

Loader::loadInstance('utility', 'Visitor');
Loader::loadInstance('router', 'Router');
