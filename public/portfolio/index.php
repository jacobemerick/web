<?php

require_once __DIR__ . '/../../bootstrap.php';

Loader::loadInstance('utility', 'Debugger');

// sets a few global settings
date_default_timezone_set('America/Chicago');
ini_set('display_errors', 0);
error_reporting(-1);
set_error_handler(array('Debugger', 'internal_error'));
register_shutdown_function(array('Debugger', 'shutdown'));

Loader::loadInstance('router', 'Router');
