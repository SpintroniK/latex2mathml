<?php

// Serve the document as an xml file.
header("Content-type: text/html; charset=utf-8"); 

// These files are required to get the script fully functional.

require('../files/config.class.php');
require('../files/commands.class.php');
require('../files/config.php');
require('../files/latex2xml.class.php');

// Instantiation of the class.
$l2xml = LaTeX2Xml::getInstance();

// Parse a simple formula.
$l2xml->parseMath("\\begin{matrix} x^2y^2 & \\, _2F_3 & \\frac{x+y^2}{k+1} & x + y^{\\frac{2}{k+1}} \\\\ \\frac{a}{b/2} & a_0 + \\dfrac{1}{a_1 + \\dfrac{1}{a_2 + \\dfrac{1}{a_3 + \\dfrac{1}{a_4}}}} & a_0 + \\frac{1}{a_1 + \\frac{1}{a_2 + \\frac{1}{a_3 + \\frac{1}{a_4}}}} & \\binom{n}{k/2} \\\\ \\binom{p}{2} x^2 y^{p-2} - \\frac{1}{1-x} \\frac{1}{1-x^2} & \\sum_{\\substack{0 \\le i \\le m \\\\ 0 < j < m}} P(i,j) & x^{2y} & \\sum_{i=1}^p \\sum_{j=1}^q \\sum_{k=1}^r a_{ij} b_{jk} c_{ki} \\\\  \\sqrt{1+ \\sqrt{1+ \\sqrt{1+ \\sqrt{1+ \\sqrt{1+ \\sqrt{1+ \\sqrt{1+x}}}}}}} & \\begin{pmatrix} \\frac{\\partial^2}{\\partial x^2} + \\frac{\\partial^2}{\\partial y^2}\\end{pmatrix} \\left| \\varphi(x+iy)\\right|^2 = 0 & 2^{2^{2^x}} & \\int_1^x \\frac{d t}{t} \\\\ \\int \\int_D d x d y & f(x) = \\begin{cases} 1/3 \\quad \\text{ if }\\, 0 \\le x \\le 1; \\\\ 2/3 \\quad \\text{ if }\\, 3 \\le x \\le 4; \\\\ 0 \\quad \\text{elsewhere.} \\end{cases} & \\text{Overbrace is not yet implemented...} & y_{x^2}  \\\\ \\sum_{\\text{p prime}} f(p) = \\int_{t > 1} f(t) d\\pi(t) &  \\text{Needs overbrace...} & \\begin{pmatrix} \\begin{pmatrix} a & b \\\\ c & d \\end{pmatrix} & \\begin{pmatrix} e & f \\\\ g & h \\end{pmatrix} \\\\ \\begin{matrix} 0 \\end{matrix} & \\begin{pmatrix} i & j \\\\ k & l \\end{pmatrix} \\end{pmatrix} & \\det\\begin{vmatrix} c_0 & c_1 & c_2 & \\dots & c_n \\\\ c_1 & c_2 & c_3 & \\dots & c_{n+1} \\\\ c_2 & c_3 & c_4 & \\dots & c_{n+2} \\\\ \\vdots & \\vdots & \\vdots &  & \\vdots \\\\ c_n & c_{n+1} & c_{n+2} & \\dots & c_{2n}\\end{vmatrix} > 0 \\\\ y_{x_2} & x_{92}^{31415} + \\pi & x_{y_a^b}^{z_c^d} & y_3^{\\prime\\prime\\prime} \\end{matrix}");

// Display the MathML of the previous formula.
echo $l2xml->parse();

?>
