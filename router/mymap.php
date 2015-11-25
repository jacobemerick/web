<?php

$direct = array(
	'/' => array(
		'controller' => 'main',
		'robot' => 'disallow',
		'sitemap' => .5
	),
	'/setData/' => array(
		'controller' => 'setData',
		'robot' => 'disallow',
		'sitemap' => false
	)
);

$redirect = array(
	'/' => array(
		'/index.(html|htm|php)',
		''
	)
);

Router::route($redirect,$direct);

?>