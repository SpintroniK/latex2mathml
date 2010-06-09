<?php

error_reporting(E_ALL  | E_STRICT);

if(@stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml"))
	header("Content-type: application/xhtml+xml; charset=utf-8");
else
	header("Content-type: text/html; charset=utf-8"); 

require('latex2xml.class.php');
require('config.class.php');
require('commands.class.php');
require('config.php');

$m = memory_get_usage();

$l2xml = LaTeX2Xml::getInstance();

if(isset($_POST['message']))
{

	if(get_magic_quotes_gpc()==0)

		$l2xml->parseMath($_POST['message']);
	else
		$l2xml->parseMath(str_replace('\\\\', '\\', $_POST['message']));
}
else
	$l2xml->parseMath(file_get_contents('file.tex'));


echo $l2xml->parse();

?>

