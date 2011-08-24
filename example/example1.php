<?php

// Serve the document as an xml file.
header("Content-type: application/xhtml+xml; charset=utf-8");

// These files are required to get the script fully functional.

require('../files/config.class.php');
require('../files/commands.class.php');
require('../files/config.php');
require('../files/latex2xml.class.php');

// Instantiation of the class.
$l2xml = LaTeX2Xml::getInstance();

// Parse a simple formula.
$l2xml->parseMath("\\frac{\\pi}{2}");

// Display the MathML of the previous formula.
echo $l2xml->parse();

?>
