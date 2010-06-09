<?php

error_reporting(E_ALL  | E_STRICT);

if(@stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml"))
	header("Content-type: application/xhtml+xml; charset=utf-8");
else
	header("Content-type: text/html; charset=utf-8"); 

require('config.class.php');
require('config.php');
require('latex2xml.class.php');

$m = memory_get_usage();

$l2xml = new LaTeX2Xml("Document LaTeX", $config);


if($setting['filename'] == 'stdin')
{
	$str = '';
	$nbArgs = ($setting['output'] == 'stdout') ? $_SERVER['argc']:$_SERVER['argc']-2;

	for($i = 1; $i < $nbArgs; $i++)
	{
		$str.=$_SERVER['argv'][$i].' ';
	}

        $l2xml->parseMath($str);

}
else
{
	$l2xml->parseMath(file_get_contents($setting['filename']));
}
if($setting['output'] == 'stdout')
{
	echo $l2xml->parse();
}
else
{
	file_put_contents($setting['output'], $l2xml->parse());
}
//echo (memory_get_usage()-$m)/1024;

?>

