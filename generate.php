<?php
require_once 'LibGenerator.php';

if($argc < 3)
{
	die('XSD path or URL and library prefix are required input arguments');
}

$path = __DIR__ . DIRECTORY_SEPARATOR . 'lib';
if($argc > 3)
{
	$path = $argv[3];
}
if(!file_exists($path))
	mkdir($path, 750, true);
$path = realpath($path);

$generator = new LibGenerator($argv[1], $argv[2]);
$generator->generate($path);
