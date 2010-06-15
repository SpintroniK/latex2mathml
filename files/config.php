<?php

$config = config::getInstance();

// Complex commands definition

$com = commands::getInstance();


$com->newCommand('\binom', 		2, '\\begin{pmatrix} #1 \\\\ #2 \\end{pmatrix}');
$com->newCommand('\overset',		2, '\\moverset{#2}{#1}');
$com->newCommand('\msqrt', 		2, '\\root{#2}{#1}');
$com->newCommand('\mathrm', 		1, '\\text{#1}');

// Accents, defined by using overset

$com->newCommand('\dot', 		1, '\\overset{#1}{.}');
$com->newCommand('\vec', 		1, '\\woverset{#1}{\\rightarrow{}}');
$com->newCommand('\overline', 		1, '\\woverset{#1}{\\moverline{}}');

/**
* Add LaTeX special chars... 
* Use the following syntax : 
*
* $config->add_symbol('LaTeX command',	'mathml_tag',	'&#Html_entity;');
*/

//Special symbols and commands (created especially for the script...)

$config->add_symbol('moverline',	'mo',		'&#x00AF;');
$config->add_command('moverset',	'mover',	2);
$config->add_command('woverset',	'mover',	2,			array('accent' => 'true'));
$config->add_command('root',		'mroot',	2);


//Ellipsis (dots) characters

$config->add_symbol('cdots', 		'mo', 		'&#x2026;');
$config->add_symbol('ddots', 		'mo', 		'&#x22f1;');
$config->add_symbol('dots', 		'mo', 		'&#x2026;');
$config->add_symbol('dotsb', 		'mo', 		'&#x00b7;');
$config->add_symbol('dotsc', 		'mo', 		'&#x2026;');
$config->add_symbol('dotsi', 		'mo', 		'&#x22c5;');
$config->add_symbol('dotsm', 		'mo', 		'&#x22c5;');
$config->add_symbol('dotso', 		'mo', 		'&#x2026;');
$config->add_symbol('hdots', 		'mo', 		'&#x2026;');
$config->add_symbol('ldots', 		'mo', 		'&#x2026;');
$config->add_symbol('vdots', 		'mo', 		'&#x22ee;');

// Ponctuation and spaces

$config->add_symbol('quad',	 	'mspace',	'',			array('width' => '1em'));
$config->add_symbol('qquad',	 	'mspace',	'',			array('width' => '2em'));
$config->add_symbol('thickspace', 	'mspace',	'',			array('width' => '0.278em'));
$config->add_symbol(';',	 	'mspace',	'',			array('width' => '0.278em'));
$config->add_symbol('medspace',	 	'mspace',	'',			array('width' => '0.222em'));
$config->add_symbol(':',	 	'mspace',	'',			array('width' => '0.222em'));
$config->add_symbol('thinspace',	'mspace',	'',			array('width' => '0.167em'));
$config->add_symbol(',',	 	'mspace',	'',			array('width' => '0.167em'));
$config->add_symbol('!',	 	'mspace',	'',			array('width' => '-0.167em'));

// Delimiters

$config->add_symbol('lgroup',	 	'mo', 		'(');
$config->add_symbol('lbrace',	 	'mo', 		'{');
$config->add_symbol('lvert',	 	'mo', 		'&#x007c;');
$config->add_symbol('rbrace',	 	'mo', 		'}');
$config->add_symbol('rgroup',	 	'mo', 		')');
$config->add_symbol('rvert',	 	'mo', 		'&#x007c;');
$config->add_symbol('lVert',	 	'mo', 		'&#x2016;');
$config->add_symbol('lceil',	 	'mo', 		'&#x2308;');
$config->add_symbol('lfloor',	 	'mo', 		'&#x230a;');
$config->add_symbol('lmoustache', 	'mo', 		'&#x23b0;');
$config->add_symbol('langle',	 	'mo', 		'&#x2329;');
$config->add_symbol('rVert',	 	'mo', 		'&#x2016;');
$config->add_symbol('rceil',	 	'mo', 		'&#x2309;');
$config->add_symbol('rfloor',	 	'mo', 		'&#x230b;');
$config->add_symbol('rmoustache', 	'mo', 		'&#x23b1;');
$config->add_symbol('rangle',	 	'mo', 		'&#x232a;');



// Big operators

$config->add_symbol('bigcap', 		'mo', 		'&#x22c2;',		array('largeop' => 'true'));
$config->add_symbol('bigcup', 		'mo', 		'&#x22c3;',		array('largeop' => 'true'));
$config->add_symbol('bigodot', 		'mo', 		'&#x2a00;',		array('largeop' => 'true'));
$config->add_symbol('bigoplus', 	'mo', 		'&#x2a01;',		array('largeop' => 'true'));
$config->add_symbol('bigotimes', 	'mo', 		'&#x2a02;',		array('largeop' => 'true'));
$config->add_symbol('bigsqcup', 	'mo', 		'&#x2a06;',		array('largeop' => 'true'));
$config->add_symbol('biguplus', 	'mo', 		'&#x2a04;',		array('largeop' => 'true'));
$config->add_symbol('bigvee', 		'mo', 		'&#x22c1;',		array('largeop' => 'true'));
$config->add_symbol('bigwedge', 	'mo', 		'&#x22c0;',		array('largeop' => 'true'));
$config->add_symbol('coprod', 		'mo', 		'&#x2210;',		array('largeop' => 'true'));
$config->add_symbol('prod', 		'mo', 		'&#x220f;',		array('largeop' => 'true'));
$config->add_symbol('sum', 		'mo', 		'&#x2211;',		array('largeop' => 'true'));
$config->add_symbol('downarrow', 	'mo', 		'&#x2193;',		array('largeop' => 'true'));
$config->add_symbol('Downarrow', 	'mo', 		'&#x21d3;',		array('largeop' => 'true'));
$config->add_symbol('uparrow', 		'mo', 		'&#x2191;',		array('largeop' => 'true'));
$config->add_symbol('Uparrow', 		'mo', 		'&#x21d1;',		array('largeop' => 'true'));
$config->add_symbol('updownarrow',	'mo', 		'&#x2195;',		array('largeop' => 'true'));
$config->add_symbol('Updownarrow', 	'mo', 		'&#x21d5;',		array('largeop' => 'true'));

// Integrals 

$config->add_symbol('int', 		'mo', 		'&#x222b;',		array('largeop' => 'true'));
$config->add_symbol('oint', 		'mo', 		'&#x222e;',		array('largeop' => 'true'));
$config->add_symbol('smallint', 	'mo', 		'&#x222b;',		array('largeop' => 'false'));

// Greek letters

$config->add_symbol('alpha', 		'mi', 		'&#x03b1;');
$config->add_symbol('Alpha', 		'mi', 		'&#x0391;');
$config->add_symbol('beta', 		'mi', 		'&#x03b2;');
$config->add_symbol('Beta', 		'mi', 		'&#x0392;');
$config->add_symbol('chi', 		'mi', 		'&#x03c7;');
$config->add_symbol('Chi', 		'mi', 		'&#x03a7;');
$config->add_symbol('delta', 		'mi', 		'&#x03b4;');
$config->add_symbol('Delta', 		'mi', 		'&#x0394;');
$config->add_symbol('digamma', 		'mi', 		'&#x03dd;');
$config->add_symbol('Digamma', 		'mi', 		'&#x03dc;');
$config->add_symbol('epsilon', 		'mi', 		'&#x03f5;');
$config->add_symbol('Epsilon', 		'mi', 		'&#x0395;');
$config->add_symbol('eta', 		'mi', 		'&#x03b7;');
$config->add_symbol('Eta', 		'mi', 		'&#x0397;');
$config->add_symbol('gamma', 		'mi', 		'&#x03b3;');
$config->add_symbol('Gamma', 		'mi', 		'&#x0393;');
$config->add_symbol('iota', 		'mi', 		'&#x03b9;');
$config->add_symbol('Iota', 		'mi', 		'&#x0399;');
$config->add_symbol('kappa', 		'mi', 		'&#x03ba;');
$config->add_symbol('Kappa', 		'mi', 		'&#x039a;');
$config->add_symbol('lambda', 		'mi', 		'&#x03bb;');
$config->add_symbol('Lambda', 		'mi', 		'&#x039b;');
$config->add_symbol('mu',	 	'mi', 		'&#x03bc;');
$config->add_symbol('Mu',	 	'mi', 		'&#x039c;');
$config->add_symbol('nu', 		'mi', 		'&#x03bd;');
$config->add_symbol('Nu', 		'mi', 		'&#x039d;');
$config->add_symbol('omega', 		'mi', 		'&#x03c9;');
$config->add_symbol('Omega', 		'mi', 		'&#x03a9;');
$config->add_symbol('phi', 		'mi', 		'&#x03d5;');
$config->add_symbol('Phi', 		'mi', 		'&#x03a6;');
$config->add_symbol('pi', 		'mi', 		'&#x03c0;');
$config->add_symbol('Pi', 		'mi', 		'&#x03a0;');
$config->add_symbol('psi', 		'mi', 		'&#x03c8;');
$config->add_symbol('Psi', 		'mi', 		'&#x03a8;');
$config->add_symbol('rho', 		'mi', 		'&#x03c1;');
$config->add_symbol('Rho', 		'mi', 		'&#x03a1;');
$config->add_symbol('sigma', 		'mi', 		'&#x03c3;');
$config->add_symbol('Sigma', 		'mi', 		'&#x03a3;');
$config->add_symbol('tau', 		'mi', 		'&#x03c4;');
$config->add_symbol('Tau', 		'mi', 		'&#x03a4;');
$config->add_symbol('theta', 		'mi', 		'&#x03b8;');
$config->add_symbol('Theta', 		'mi', 		'&#x0398;');
$config->add_symbol('upsilon', 		'mi', 		'&#x03c5;');
$config->add_symbol('Upsilon', 		'mi', 		'&#x03d2;');
$config->add_symbol('varepsilon', 	'mi', 		'&#x03b5;');
$config->add_symbol('varkappa', 	'mi', 		'&#x03f0;');
$config->add_symbol('varphi', 		'mi', 		'&#x03c6;');
$config->add_symbol('varpi', 		'mi', 		'&#x03d6;');
$config->add_symbol('varrho', 		'mi', 		'&#x03f1;');
$config->add_symbol('varsigma', 	'mi', 		'&#x03c2;');
$config->add_symbol('vartheta', 	'mi', 		'&#x03d1;');
$config->add_symbol('xi',	 	'mi', 		'&#x03be;');
$config->add_symbol('Xi', 		'mi', 		'&#x039e;');
$config->add_symbol('zeta', 		'mi', 		'&#x03b6;');
$config->add_symbol('Zeta', 		'mi', 		'&#x0396;');



// Comparaisons symbols

$config->add_symbol('approx', 		'mo', 		'&#x2248;');
$config->add_symbol('approxeq',	 	'mo', 		'&#x224a;');
$config->add_symbol('asymp',	 	'mo', 		'&#x224d;');
$config->add_symbol('backsim',	 	'mo', 		'&#x223d;');
$config->add_symbol('backsimeq',	'mo', 		'&#x22cd;');
$config->add_symbol('bumpeq',	 	'mo', 		'&#x224f;');
$config->add_symbol('Bumpeq',	 	'mo', 		'&#x224e;');
$config->add_symbol('circeq',	 	'mo', 		'&#x2257;');
$config->add_symbol('curlyeqprec', 	'mo', 		'&#x22de;');
$config->add_symbol('curlyeqsucc', 	'mo', 		'&#x22df;');
$config->add_symbol('doteq',	 	'mo', 		'&#x2250;');
$config->add_symbol('doteqdot',	 	'mo', 		'&#x2251;');
$config->add_symbol('eqcirc',	 	'mo', 		'&#x2256;');
$config->add_symbol('eqsim',	 	'mo', 		'&#x2242;');
$config->add_symbol('eqslantgtr', 	'mo', 		'&#x2a96;');
$config->add_symbol('eqslantless', 	'mo', 		'&#x2a95;');
$config->add_symbol('equiv',	 	'mo', 		'&#x2261;');
$config->add_symbol('fallingdotseq', 	'mo', 		'&#x2252;');
$config->add_symbol('ge',	 	'mo', 		'&#x2265;');
$config->add_symbol('geq',	 	'mo', 		'&#x2265;');
$config->add_symbol('geqq',	 	'mo', 		'&#x2267;');
$config->add_symbol('geqslant',	 	'mo', 		'&#x2a7e;');
$config->add_symbol('gg',	 	'mo', 		'&#x226b;');
$config->add_symbol('ggg',	 	'mo', 		'&#x22d9;');
$config->add_symbol('gggtr',	 	'mo', 		'&#x22d9;');
$config->add_symbol('gnapprox',	 	'mo', 		'&#x2a8a;');
$config->add_symbol('gneq',	 	'mo', 		'&#x2a88;');
$config->add_symbol('gneqq',	 	'mo', 		'&#x2269;');
$config->add_symbol('gnsim',	 	'mo', 		'&#x22e7;');
$config->add_symbol('gtrapprox', 	'mo', 		'&#x2a86;');
$config->add_symbol('gtreqless',	'mo', 		'&#x22db;');
$config->add_symbol('gtreqqless', 	'mo', 		'&#x2a8c;');
$config->add_symbol('gtrless',	 	'mo', 		'&#x2277;');
$config->add_symbol('gtrsim',	 	'mo', 		'&#x2273;');
$config->add_symbol('gvertneqq', 	'mo', 		'&#x2269;');
$config->add_symbol('le',	 	'mo', 		'&#x2264;');
$config->add_symbol('leq',	 	'mo', 		'&#x2264;');
$config->add_symbol('leqq',	 	'mo', 		'&#x2266;');
$config->add_symbol('leqslant',	 	'mo', 		'&#x2a7d;');
$config->add_symbol('lessapprox', 	'mo', 		'&#x2a85;');
$config->add_symbol('lesseqgtr',	'mo', 		'&#x22da;');
$config->add_symbol('lesseqqgtr', 	'mo', 		'&#x2a8b;');
$config->add_symbol('lessgtr',	 	'mo', 		'&#x2276;');
$config->add_symbol('lesssim',	 	'mo', 		'&#x2272;');
$config->add_symbol('ll',	 	'mo', 		'&#x226a;');
$config->add_symbol('llless',	 	'mo', 		'&#x22d8;');
$config->add_symbol('lnapprox',	 	'mo', 		'&#x2a89;');
$config->add_symbol('lneq',	 	'mo', 		'&#x2a87;');
$config->add_symbol('lneqq',	 	'mo', 		'&#x2268;');
$config->add_symbol('lnsim',	 	'mo', 		'&#x22e6;');
$config->add_symbol('lvertneqq', 	'mo', 		'&#x2268;');
$config->add_symbol('ncong',	 	'mo', 		'&#x2247;');
$config->add_symbol('ne',	 	'mo', 		'&#x2260;');
$config->add_symbol('neq',	 	'mo', 		'&#x2260;');
$config->add_symbol('ngeq',	 	'mo', 		'&#x2271;');
$config->add_symbol('ngeqq',	 	'mo', 		'&#x2267;');
$config->add_symbol('ngeqslant', 	'mo', 		'&#x2a7e;');
$config->add_symbol('ngtr',	 	'mo', 		'&#x226f;');
$config->add_symbol('nleq',	 	'mo', 		'&#x2270;');
$config->add_symbol('nleqq',	 	'mo', 		'&#x2266;');
$config->add_symbol('neqslant',	 	'mo', 		'&#x2a7d;');
$config->add_symbol('nless',	 	'mo', 		'&#x226e;');
$config->add_symbol('nprec',	 	'mo', 		'&#x2280;');
$config->add_symbol('npreceq',	 	'mo', 		'&#x2aaf;');
$config->add_symbol('nsim',	 	'mo', 		'&#x2241;');
$config->add_symbol('nsucc',	 	'mo', 		'&#x2281;');
$config->add_symbol('nsucceq',	 	'mo', 		'&#x2ab0;');
$config->add_symbol('prec',	 	'mo', 		'&#x227a;');
$config->add_symbol('precapprox', 	'mo', 		'&#x2ab7;');
$config->add_symbol('preccurlyeq', 	'mo', 		'&#x227c;');
$config->add_symbol('preceq',	 	'mo', 		'&#x2aaf;');
$config->add_symbol('precnapprox', 	'mo', 		'&#x2ab9;');
$config->add_symbol('precneqq',	 	'mo', 		'&#x2ab5;');
$config->add_symbol('precnsim',	 	'mo', 		'&#x22e8;');
$config->add_symbol('precsim',	 	'mo', 		'&#x227e;');
$config->add_symbol('rsingdotseq', 	'mo', 		'&#x2253;');
$config->add_symbol('sim',	 	'mo', 		'&#x223c;');
$config->add_symbol('simeq',	 	'mo', 		'&#x2243;');
$config->add_symbol('succ',	 	'mo', 		'&#x227b;');
$config->add_symbol('succeq',	 	'mo', 		'&#x2ab0;');
$config->add_symbol('succapprox', 	'mo', 		'&#x2aba;');
$config->add_symbol('succneqq',	 	'mo', 		'&#x2ab6;');
$config->add_symbol('succnsim',	 	'mo', 		'&#x22e9;');
$config->add_symbol('succsim',	 	'mo', 		'&#x227f;');
$config->add_symbol('thickapprox',	'mo', 		'&#x2248;');
$config->add_symbol('thicksim',	 	'mo', 		'&#x223c;');
$config->add_symbol('triangleq',	'mo', 		'&#x225c;');


// Miscellaneous simple symbols

$config->add_symbol('angle', 		'mo', 		'&#x2220;');
$config->add_symbol('backprime',	'mo', 		'&#x2035;');
$config->add_symbol('bigstar', 		'mo', 		'&#x2605;');
$config->add_symbol('blacklozenge',	'mo', 		'&#x29eb;');
$config->add_symbol('blacksquare',	'mo', 		'&#x25aa;');
$config->add_symbol('blacktriangle',	'mo', 		'&#x25b4;');
$config->add_symbol('blacktriangledown','mo', 		'&#x25be;');
$config->add_symbol('bot', 		'mo', 		'&#x22a5;');
$config->add_symbol('clubsuit',		'mo', 		'&#x2663;');
$config->add_symbol('diagdown',		'mo', 		'&#x2572;');
$config->add_symbol('diagup', 		'mo', 		'&#x2571;');
$config->add_symbol('diamondsuit',	'mo', 		'&#x2662;');
$config->add_symbol('emptyset',		'mo', 		'&#x2205;');
$config->add_symbol('exists', 		'mo', 		'&#x2203;');
$config->add_symbol('flat', 		'mo', 		'&#x266d;');
$config->add_symbol('forall', 		'mo', 		'&#x2200;');
$config->add_symbol('heartsuit', 	'mo', 		'&#x2661;');
$config->add_symbol('infty', 		'mo', 		'&#x221e;');
$config->add_symbol('lnot', 		'mo', 		'&#x00ac;');
$config->add_symbol('lozenge', 		'mo', 		'&#x25ca;');
$config->add_symbol('measuredangle',	'mo', 		'&#x2221;');
$config->add_symbol('nabla', 		'mo', 		'&#x2207;');
$config->add_symbol('natural', 		'mo', 		'&#x266e;');
$config->add_symbol('neg', 		'mo', 		'&#x00ac;');
$config->add_symbol('nexists', 		'mo', 		'&#x2204;');
$config->add_symbol('prime', 		'mo', 		'&#x2032;');
$config->add_symbol('sharp', 		'mo', 		'&#x266f;');
$config->add_symbol('surd', 		'mo', 		'&#x221a;');
$config->add_symbol('top', 		'mo', 		'&#x22a4;');
$config->add_symbol('triangle',		'mo', 		'&#x25b5;');
$config->add_symbol('triangledown',	'mo', 		'&#x25bf;');
$config->add_symbol('varnothing',	'mo', 		'&#x2205;');

// Miscellaneous

$config->add_symbol('backepsilon', 	'mo', 		'&#x03f6;');
$config->add_symbol('because',	 	'mo', 		'&#x2235;');
$config->add_symbol('between',	 	'mo', 		'&#x226c;');
$config->add_symbol('blacktriangleleft','mo', 		'&#x25c0;');
$config->add_symbol('blacktriangleright','mo', 		'&#x25b6;');
$config->add_symbol('bowtie',	 	'mo', 		'&#x22c8;');
$config->add_symbol('dashv',	 	'mo', 		'&#x22a3;');
$config->add_symbol('frown',	 	'mo', 		'&#x2323;');
$config->add_symbol('in',	 	'mo', 		'&#x220a;');
$config->add_symbol('mid',	 	'mo', 		'&#x2223;');
$config->add_symbol('models',	 	'mo', 		'&#x22a7;');
$config->add_symbol('ni',	 	'mo', 		'&#x220b;');
$config->add_symbol('nmid',	 	'mo', 		'&#x2224;');
$config->add_symbol('nshortparallel', 	'mo', 		'&#x2226;');
$config->add_symbol('nsubseteq', 	'mo', 		'&#x2288;');
$config->add_symbol('nsubseteqq', 	'mo', 		'&#x2ac5;');
$config->add_symbol('nsupseteq', 	'mo', 		'&#x2289;');
$config->add_symbol('nsupseteqq', 	'mo', 		'&#x2ac6;');
$config->add_symbol('ntriangleleft', 	'mo', 		'&#x22ea;');
$config->add_symbol('ntrianglelefteq', 	'mo', 		'&#x22ec;');
$config->add_symbol('ntriangleright', 	'mo', 		'&#x22eb;');
$config->add_symbol('ntrianglerighteq',	'mo', 		'&#x22ed;');
$config->add_symbol('nvdash',	 	'mo', 		'&#x22ac;');
$config->add_symbol('nvDash',	 	'mo', 		'&#x22ad;');
$config->add_symbol('nVdash',	 	'mo', 		'&#x22ae;');
$config->add_symbol('nVDash',	 	'mo', 		'&#x22af;');
$config->add_symbol('owns',	 	'mo', 		'&#x220d;');
$config->add_symbol('parallel',	 	'mo', 		'&#x2225;');
$config->add_symbol('perp',	 	'mo', 		'&#x22a5;');
$config->add_symbol('pitchfork', 	'mo', 		'&#x22d4;');
$config->add_symbol('propto',	 	'mo', 		'&#x221d;');
$config->add_symbol('shortmid',	 	'mo', 		'&#x2223;');
$config->add_symbol('shortparallel', 	'mo', 		'&#x2225;');
$config->add_symbol('smallfrown', 	'mo', 		'&#x2322;');
$config->add_symbol('smallsmile', 	'mo', 		'&#x2323;');
$config->add_symbol('smile',	 	'mo', 		'&#x2223;');
$config->add_symbol('sqsubset',	 	'mo', 		'&#x228f;');
$config->add_symbol('sqsubseteq', 	'mo', 		'&#x2291;');
$config->add_symbol('subset',	 	'mo', 		'&#x2282;');
$config->add_symbol('Subset',	 	'mo', 		'&#x22d0;');
$config->add_symbol('subseteq',	 	'mo', 		'&#x2286;');
$config->add_symbol('subseteqq', 	'mo', 		'&#x2ac5;');
$config->add_symbol('subsetneq', 	'mo', 		'&#x228a;');
$config->add_symbol('subsetneqq', 	'mo', 		'&#x2acb;');
$config->add_symbol('supset',	 	'mo', 		'&#x2283;');
$config->add_symbol('Supset',	 	'mo', 		'&#x22d1;');
$config->add_symbol('supseteq',	 	'mo', 		'&#x2287;');
$config->add_symbol('supseteqq', 	'mo', 		'&#x2ac6;');
$config->add_symbol('supsetneq', 	'mo', 		'&#x228b;');
$config->add_symbol('supsetneqq', 	'mo', 		'&#x2acc;');
$config->add_symbol('therefore', 	'mo', 		'&#x2234;');
$config->add_symbol('trianglelefteq', 	'mo', 		'&#x22b4;');
$config->add_symbol('trianglerighteq', 	'mo', 		'&#x22b5;');
$config->add_symbol('varpropto', 	'mo', 		'&#x221d;');
$config->add_symbol('varsubsetneq', 	'mo', 		'&#x228a;');
$config->add_symbol('varsubsetneqq', 	'mo', 		'&#x2acb;');
$config->add_symbol('varsupsetneq', 	'mo', 		'&#x228b;');
$config->add_symbol('varsupsetneqq', 	'mo', 		'&#x2acc;');
$config->add_symbol('vartriangle', 	'mo', 		'&#x25b5;');
$config->add_symbol('vartriangleleft', 	'mo', 		'&#x22b2;');
$config->add_symbol('vartriangleright',	'mo', 		'&#x22b3;');
$config->add_symbol('vdash',	 	'mo', 		'&#x22a2;');
$config->add_symbol('vDash',	 	'mo', 		'&#x22a8;');
$config->add_symbol('Vdash',	 	'mo', 		'&#x22a9;');
$config->add_symbol('Vvdash',	 	'mo', 		'&#x22aa;');


// Other alphabetic symbols

$config->add_symbol('aleph', 		'mo', 		'&#x2135;');
$config->add_symbol('Bbbk', 		'mo', 		'&#x1d55;');
$config->add_symbol('beth', 		'mo', 		'&#x2136;');
$config->add_symbol('circledS',		'mo', 		'&#x24c8;');
$config->add_symbol('complement',	'mo', 		'&#x2201;');
$config->add_symbol('daleth', 		'mo', 		'&#x2138;');
$config->add_symbol('ell', 		'mo', 		'&#x2113;');
$config->add_symbol('eth', 		'mo', 		'&#x00f0;');
$config->add_symbol('Finv', 		'mo', 		'&#x2132;');
$config->add_symbol('Game', 		'mo', 		'&#x2141;');
$config->add_symbol('gimel', 		'mo', 		'&#x2137;');
$config->add_symbol('hbar', 		'mo', 		'&#x210f;');
$config->add_symbol('hslash', 		'mo', 		'&#x210f;');
$config->add_symbol('lm', 		'mo', 		'&#x2111;');
$config->add_symbol('mho', 		'mo', 		'&#x2127;');
$config->add_symbol('partial', 		'mo', 		'&#x2202;');
$config->add_symbol('Re', 		'mo', 		'&#x211c;');
$config->add_symbol('wp', 		'mo', 		'&#x2118;');



// Arrows

$config->add_symbol('curvearrowleft',	'mo', 		'&#x21b6;');
$config->add_symbol('curvearrowright',	'mo', 		'&#x21b7;');
$config->add_symbol('downdownarrows',	'mo', 		'&#x21ca;');
$config->add_symbol('downharpoonleft',	'mo', 		'&#x21c3;');
$config->add_symbol('downharpoonright',	'mo', 		'&#x21c2;');
$config->add_symbol('gets', 		'mo', 		'&#x2190;');
$config->add_symbol('hookleftarrow',	'mo', 		'&#x21a9;');
$config->add_symbol('hookrightarrow',	'mo', 		'&#x21aa;');
$config->add_symbol('leftarrow',	'mo', 		'&#x2190;');
$config->add_symbol('Leftarrow',	'mo', 		'&#x21d0;');
$config->add_symbol('leftarrowtail',	'mo', 		'&#x21a2;');
$config->add_symbol('leftharpoondown',	'mo', 		'&#x21bd;');
$config->add_symbol('leftharpoonup',	'mo', 		'&#x21bc;');
$config->add_symbol('leftleftarrows',	'mo', 		'&#x21c7;');
$config->add_symbol('leftrightarrow',	'mo', 		'&#x21bc;');
$config->add_symbol('leftrightarrows',	'mo', 		'&#x21c6;');
$config->add_symbol('leftrightharpoons','mo', 		'&#x21cb;');
$config->add_symbol('leftrightsuigarrow','mo', 		'&#x21ad;');
$config->add_symbol('Lleftarrow',	'mo', 		'&#x21da;');
$config->add_symbol('longleftarrow',	'mo', 		'&#x27f5;');
$config->add_symbol('Longleftarrow',	'mo', 		'&#x27f8;');
$config->add_symbol('logleftrightarrow','mo', 		'&#x27f7;');
$config->add_symbol('Longleftrightarrow','mo', 		'&#x27fa;');
$config->add_symbol('looparrowleft',	'mo', 		'&#x21ab;');
$config->add_symbol('looparrowright',	'mo', 		'&#x21ac;');
$config->add_symbol('Lsh', 		'mo', 		'&#x21b0;');
$config->add_symbol('mapsto', 		'mo', 		'&#x21a6;');
$config->add_symbol('multimap',		'mo', 		'&#x22b8;');
$config->add_symbol('nearrow', 		'mo', 		'&#x2197;');
$config->add_symbol('nleftarrow',	'mo', 		'&#x219a;');
$config->add_symbol('nLeftarrow',	'mo', 		'&#x21cd;');
$config->add_symbol('nleftrightarrow',	'mo', 		'&#x21ae;');
$config->add_symbol('nLeftrightarrow',	'mo', 		'&#x21ce;');
$config->add_symbol('nrightarrow',	'mo', 		'&#x219b;');
$config->add_symbol('nRightarrow',	'mo', 		'&#x21cf;');
$config->add_symbol('nwarrow', 		'mo', 		'&#x2196;');
$config->add_symbol('restriction',	'mo', 		'&#x21be;');
$config->add_symbol('rightarrow',	'mo', 		'&#x2192;');
$config->add_symbol('Rightarrow',	'mo', 		'&#x21d2;');
$config->add_symbol('rightarrowtail',	'mo', 		'&#x21a3;');
$config->add_symbol('rightharpoondown',	'mo', 		'&#x21c1;');
$config->add_symbol('rightharpoonup',	'mo', 		'&#x21c0;');
$config->add_symbol('rightleftarrows',	'mo', 		'&#x21c4;');
$config->add_symbol('rightleftharpoons','mo', 		'&#x21cc;');
$config->add_symbol('rightrightarrows',	'mo', 		'&#x21c9;');
$config->add_symbol('rightsquidarrow',	'mo', 		'&#x219d;');
$config->add_symbol('Rrightarrow',	'mo', 		'&#x21db;');
$config->add_symbol('Rsh', 		'mo', 		'&#x21b1;');
$config->add_symbol('searrow', 		'mo', 		'&#x2198;');
$config->add_symbol('swarrow', 		'mo', 		'&#x2199;');
$config->add_symbol('to', 		'mo', 		'&#x2192;');
$config->add_symbol('twoheadleftarrow',	'mo', 		'&#x219e;');
$config->add_symbol('twoheadrightarrow','mo', 		'&#x21a0;');
$config->add_symbol('upharpoonleft',	'mo', 		'&#x21bf;');
$config->add_symbol('upharpoonright',	'mo', 		'&#x21be;');
$config->add_symbol('upuparrows',	'mo', 		'&#x21c8;');


// Word operators

$config->add_symbol('arccos',		'mo',		'arccos');
$config->add_symbol('arcsin',		'mo',		'arcsin');
$config->add_symbol('arctan',		'mo',		'arctan');
$config->add_symbol('arg',		'mo',		'arg');
$config->add_symbol('bmod',		'mo',		'mod');
$config->add_symbol('cos',		'mo',		'cos');
$config->add_symbol('cosh',		'mo',		'cosh');
$config->add_symbol('cot',		'mo',		'cot');
$config->add_symbol('coth',		'mo',		'coth');
$config->add_symbol('csc',		'mo',		'csc');
$config->add_symbol('deg',		'mo',		'deg');
$config->add_symbol('det',		'mo',		'det');
$config->add_symbol('dim',		'mo',		'dim');
$config->add_symbol('exp',		'mo',		'exp');
$config->add_symbol('inf',		'mo',		'inf');
$config->add_symbol('injlim',		'mo',		'inj lim');
$config->add_symbol('lim',		'mo',		'lim');
$config->add_symbol('liminf',		'mo',		'lim inf');
$config->add_symbol('limsup',		'mo',		'lim sup');
$config->add_symbol('gcd',		'mo',		'gcd');
$config->add_symbol('hom',		'mo',		'hom');
$config->add_symbol('ker',		'mo',		'ker');
$config->add_symbol('lg',		'mo',		'lg');
$config->add_symbol('ln',		'mo',		'ln');
$config->add_symbol('log',		'mo',		'log');
$config->add_symbol('Pr',		'mo',		'Pr');
$config->add_symbol('sec',		'mo',		'sec');
$config->add_symbol('sin',		'mo',		'sin');
$config->add_symbol('sinh',		'mo',		'sinh');
$config->add_symbol('tan',		'mo',		'tan');
$config->add_symbol('tanh',		'mo',		'tanh');
$config->add_symbol('max',		'mo',		'max');
$config->add_symbol('min',		'mo',		'min');
$config->add_symbol('projlim',		'mo',		'proj lim');
$config->add_symbol('sup',		'mo',		'sup');


// Operator symbols

$config->add_symbol('amalg',	 	'mo', 		'&#x2a3f;');
$config->add_symbol('ast',	 	'mo', 		'&#x2217;');
$config->add_symbol('barwedge',	 	'mo', 		'&#x22bc;');
$config->add_symbol('bigcirc',	 	'mo', 		'&#x25cb;');
$config->add_symbol('bigtriangledown', 	'mo', 		'&#x25bd;');
$config->add_symbol('bigtriangleup', 	'mo', 		'&#x25b3;');
$config->add_symbol('boxdot',	 	'mo', 		'&#x22a1;');
$config->add_symbol('boxminus',	 	'mo', 		'&#x229f;');
$config->add_symbol('boxplus',	 	'mo', 		'&#x229e;');
$config->add_symbol('boxtimes',	 	'mo', 		'&#x22a0;');
$config->add_symbol('bullet',	 	'mo', 		'&#x2022;');
$config->add_symbol('cap',	 	'mo', 		'&#x2229;');
$config->add_symbol('Cap',	 	'mo', 		'&#x22d2;');
$config->add_symbol('cdot',	 	'mo', 		'&#x22c5;');
$config->add_symbol('centerdot',	'mo', 		'&#x00b7;');
$config->add_symbol('circ',	 	'mo', 		'&#x2218;');
$config->add_symbol('circledast', 	'mo', 		'&#x229b;');
$config->add_symbol('circledcirc',	'mo', 		'&#x229a;');
$config->add_symbol('circleddash',	'mo', 		'&#x229d;');
$config->add_symbol('cup',	 	'mo', 		'&#x222a;');
$config->add_symbol('Cup',	 	'mo', 		'&#x22d3;');
$config->add_symbol('curlyvee', 	'mo', 		'&#x22ce;');
$config->add_symbol('curlyedge', 	'mo', 		'&#x22cf;');
$config->add_symbol('dagger',	 	'mo', 		'&#x2020;');
$config->add_symbol('ddagger',	 	'mo', 		'&#x2021;');
$config->add_symbol('diamond',	 	'mo', 		'&#x22c4;');
$config->add_symbol('div',	 	'mo', 		'&#x00f7;');
$config->add_symbol('divideontimes',	'mo', 		'&#x22c7;');
$config->add_symbol('dotplus',	 	'mo', 		'&#x2214;');
$config->add_symbol('doublebarwedge',	'mo', 		'&#x2306;');
$config->add_symbol('doublecap', 	'mo', 		'&#x22d2;');
$config->add_symbol('doublecup', 	'mo', 		'&#x22d3;');
$config->add_symbol('gtrdot',	 	'mo', 		'&#x22d7;');
$config->add_symbol('intercal',	 	'mo', 		'&#x22ba;');
$config->add_symbol('land',	 	'mo', 		'&#x2227;');
$config->add_symbol('leftthreetimes',	'mo', 		'&#x22cb;');
$config->add_symbol('lessdot',	 	'mo', 		'&#x22d6;');
$config->add_symbol('lor',	 	'mo', 		'&#x2228;');
$config->add_symbol('ltimes',	 	'mo', 		'&#x22c9;');
$config->add_symbol('mp',	 	'mo', 		'&#x2213;');
$config->add_symbol('odot',	 	'mo', 		'&#x2299;');
$config->add_symbol('ominus',	 	'mo', 		'&#x2296;');
$config->add_symbol('oplus',	 	'mo', 		'&#x2295;');
$config->add_symbol('oslash',	 	'mo', 		'&#x2298;');
$config->add_symbol('otimes',	 	'mo', 		'&#x2297;');
$config->add_symbol('pm',	 	'mo', 		'&#x00b1;');
$config->add_symbol('rightthreetimes',	'mo', 		'&#x22cc;');
$config->add_symbol('rtimes',	 	'mo', 		'&#x22ca;');
$config->add_symbol('setminus',	 	'mo', 		'&#x2216;');
$config->add_symbol('smallsetminus', 	'mo', 		'&#x2216;');
$config->add_symbol('sqcap',	 	'mo', 		'&#x2293;');
$config->add_symbol('sqcup',	 	'mo', 		'&#x2294;');
$config->add_symbol('star',	 	'mo', 		'&#x22c6;');
$config->add_symbol('times',	 	'mo', 		'&#x00d7;');
$config->add_symbol('triangleleft', 	'mo', 		'&#x25c1;');
$config->add_symbol('triangleright', 	'mo', 		'&#x25b7;');
$config->add_symbol('uplus',	 	'mo', 		'&#x228e;');
$config->add_symbol('vee',	 	'mo', 		'&#x2228;');
$config->add_symbol('veebar',	 	'mo', 		'&#x22bb;');
$config->add_symbol('wedge',	 	'mo', 		'&#x2227;');
$config->add_symbol('wr',	 	'mo', 		'&#x2240;');


// Commands

$config->add_command('frac',		'mfrac',	2);
$config->add_command('sqrt',		'msqrt',	1);
$config->add_command('substack',	'mrow',		1);
$config->add_command('text',		'mtext',	1);
$config->add_command('overset',		'mover',	2);
$config->add_command('operatorname',	'mo',		1);


// Left and Right

$config->add_symbol('left{',		'mo',		'left{');
$config->add_symbol('left|',		'mo',		'left|');
$config->add_symbol('left(',		'mo',		'left(');
$config->add_symbol('left[',		'mo',		'left[');
$config->add_symbol('left\\lVert',	'mo',		'left\\lVert');
$config->add_symbol('right{',		'mo',		'right{');
$config->add_symbol('right|',		'mo',		'right|');
$config->add_symbol('right(',		'mo',		'right(');
$config->add_symbol('right]',		'mo',		'right]');
$config->add_symbol('right\\rVert',	'mo',		'right\\rVert');

// Operators

$config->add_symbol('colon',		'mo', 		':');
$config->add_symbol('|',		'mo', 		'&#x2016;');
$config->add_symbol('backslash',	'mo', 		'\\');
$config->add_symbol('#',		'mo', 		'#');

$config->add_operator('-');
$config->add_operator('+');
$config->add_operator('*');
$config->add_operator(':');
$config->add_operator('=');
$config->add_operator('(');
$config->add_operator(')');
$config->add_operator(',');
$config->add_operator('/');
$config->add_operator('|');

?>
