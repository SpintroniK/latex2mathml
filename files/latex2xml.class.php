<?php

/**
* @brief LaTeX2MathML parser
* @author Jeremy Oden
* This is the main class of LaTeX2MathML
*/

class LaTeX2Xml
{

	
	//!DOM variable
	private $dom;

	//!LaTeX code
	private $math;
	private $xhtml;

	private static $instance;

	private $symbol;
	private $symbol_replace;
	private $prev_char = '';
	private $lastTag;
	private $tag = array();


	/**
	* Here's the constructor.
	* The DOM instance is created here.
	* @param $doctitle Title of the document.
	* @param $config The config class is needed to parse symdols, commands and operators.
	*/
	private function __construct($doctitle='')
	{


		// Getting all commands and symbols
		$this->element = config::getInstance()->getElements();

		// Getting all operators
		$this->operators = config::getInstance()->getOperators();

		// Used to convert all elements into parsable entities
		foreach($this->element as $k=>$v)
			if(in_array('char', $v))
				$this->symbol['\\'.$k] = '\\'.$k.'{}';

		
	}


	/**
	* This method is used to create a singleton.
	*/

	public static function getInstance()
        {
                if( !isset(self::$instance) )
                        self::$instance = new LaTeX2Xml();
                       
                return self::$instance;
        }



/*** PUBLIC METHODS ***/

	public function getSymbols()
	{
		return $this->symbol;
	}

	/**
	* This method is used to create the mathml element of the dom document.
	* The namespace for mathml is given here (http://www.w3.org/1998/Math/MathML)
	* @param $math The LaTeX math formula to convert
	*/

	public function parseMath($math)
	{
		
                $this->tag = array();

                $this->dom = new DOMDocument();

                $this->dom->encoding = 'utf-8';
                $this->dom->standalone = false;
                $this->dom->validateOnParse = true;
                $this->dom->preserveWhiteSpace = false;
                $this->dom->formatOutput   = true;

		// Adding the stylesheet.
		//$pi = new DOMProcessingInstruction("xml-stylesheet", "type=\"text/css\" href=\"./style.css\"");
		//$this->dom->appendChild($pi);

		// Drop new lines.
		$math = str_replace(chr(10),'', $math.' ');

		// Create the namespace.
		$this->math = $this->dom->createElement('math');
		$this->math->setAttribute('display','block');
		$this->math->setAttribute('xmlns','http://www.w3.org/1998/Math/MathML');
		$this->math->setAttribute('title',$math);
		//$this->math->setAttribute('title', $math);
		
		// Replace some symbols and functions.
		$math = commands::getInstance()->replaceAll($math);

		// Parsing...
		$this->_opentag('mrow');
		$this->_parseExpr($math);
		$this->_closeTag();

		// Getting formula's node.
		$this->math->appendChild($this->lastTag);

	}


/*** PRIVATE METHODS ***/

	/**
	* This is the main method to parse an expression
	* The expression is analysed char by char and parsed
	* @param $expr Expression to parse
	*/

	private function _parseExpr(&$expr)
	{
		// Get the first and second char.
		$char = $expr[0];
		$nextchar = substr($expr, 1, 1);

		if(strlen($char)>0)
		{
			// Parse a number (ex : 1 or 12 or 1234)
			if($char == '0' || is_numeric($char))

				$this->_parseNb($expr, $char);

			// If $char is an operator
			elseif(isSet($this->operators[$char]))

				$this->_parseOp($expr, $char);

			// if $char is a letter (indicator => mi tag)
			elseif(preg_match('/[a-zA-Z]/', $char))

				$this->_parseInd($expr, $char);

			elseif($this->prev_char != '\\' && ($char == '^' || $char == '_'))

				$this->_parseSubSup($expr, $char, $nextchar);

			elseif($char == '\\' && $nextchar == '\\')

				$this->_parseRow($expr);

			elseif($char != '\\' && $nextchar == '&')

				$this->_parseCol($expr);

			elseif($char == " ")

				$this->_skip($expr);

			elseif($char == '\\' && preg_match('/[a-zA-Z,;:\!\.\|\#]{1}/U', $nextchar))
			{

				$command = commands::getInstance()->getCommand($expr);	
				$this->_parseFormula($command, $expr);
			
			}
			else
				$this->_parseInd($expr, $char);
		}
	}


	/**
	* Get the name of an environment.
	* @param $expr 
	* @return $env The name of the current environment.
	*/

	private function _getEnv($expr)
	{
		$expr = substr($expr, 6);
		$p = strpos($expr, '}');
		$env = substr($expr, 1, $p-1);

		return $env;

	}


	/**
	* Get the mathml tag associated to a LaTeX command
	* @param $command The command.
	* @return The corresponding mathml tag.
	*/

	private function _getTag($command)
	{
		return $this->element[$command]['m'];
	}

	/**
	* Get the mathml attribute to put in the xml document
	* @param $command The command.
	* @return The corresponding mathml attribute.
	*/

	private function _getAttr($command)
	{
		return $this->element[$command]['attr'];
	}

	/**
	* Create a new mathml node.
	* @param $tag The name of the node.
	* @param $content The content of the node.
	* @param $attr Attributes (optional)
	*/

	public function _setTag($tag, $content, array $attr = array())
	{

		$c = count($this->tag)-1;
		$elt = $this->dom->createElement($tag, $content);

		if(count($attr) > 0)
			foreach($attr as $a => $v)
				$elt->setAttribute($a, $v);

		$this->tag[$c]->appendChild($elt);
		$this->lastTag = &$this->tag[$c];
	}


	/**
	* 
	* @param $expr
	*/

	private function _upExpr(&$expr, $l=1)
	{
		$this->prev_char = $expr[0];
		$expr = substr($expr, $l);
	}

	/**
	* Open a new mathml tag (which needs to be closed).
	* @param $tag The tag title.
	* @param $attr Optinal attributes.
	*/

	private function _openTag($tag, array $attr = array())
	{		
		$elt = $this->dom->createElement($tag);

		if(count($attr) > 0)
			foreach($attr as $a => $v)
				$elt->setAttribute($a, $v);

		array_push($this->tag, $elt);
	}

	/**
	* Close a previously opened tag.
	*/

	private function _closeTag()
	{

		$cb = count($this->tag)-1;
		$c = $cb-1;


		if($cb > 0)
		{
			$last = array_pop($this->tag);
			$this->tag[$c]->appendChild($last);
			$this->lastTag = &$this->tag[$c];
		}
		
	}


/*** PARSING METHODS ***/

	/**
	* Parse a LaTeX command or environment.
	* @param $command LaTeX command (ex : frac) or environment (ex : begin{pmatrix})
	* @param $expr
	*/	

	private function _parseFormula($command, &$expr)
	{

		if(substr($command, 0, 4) == 'left')
		{
			list($content, $ochar, $cchar) = $this->_getLRContent($expr);
			$lleft = strlen('\\left');
			$lright= strlen('\\right');

			$ochar2 = str_replace('\lVert', '‖', $ochar);
			$cchar2 = str_replace('\rVert', '‖', $cchar);

			$this->_parseEnv('leftright', $content, array('open' => $ochar2, 'close' => $cchar2));

			$expr = substr($expr, strlen($content)+$lleft+$lright+strlen($ochar)+strlen($cchar)+4);

			$this->_parseExpr($expr);
		}
		else
		switch($command) 
		{
	
			case 'begin':

				$env = $this->_getEnv($expr);

				$content =  $this->_getEnvContent($expr, $env);

				$this->_parseEnv($env, $content);
				$expr = substr($expr, strlen($content)+strlen('\\begin{'.$env.'}\\end{'.$env.'}'));


				$this->_parseExpr($expr);
			
			break;

			case 'substack':
			
				$args = commands::getInstance()->_getArgs($command, $expr);
				$args[0] = substr($args[0], strlen($command));
				$this->_parseEnv('substack', $args[0]);

				$expr = substr($expr, strlen($args[0])+strlen($command)+3);
				$this->_parseExpr($expr);
			break;

			case 'text':
			
				$args = commands::getInstance()->_getArgs($command, $expr);
				$args[0] = substr($args[0], strlen($command));
				$this->_setTag('mtext', $args[0]);

				$expr = substr($expr, strlen($args[0])+strlen($command)+3);
				$this->_parseExpr($expr);
			
			break;


			default:

				$args = commands::getInstance()->_getArgs($command, $expr);

				$nArgs = count($args) - 1;

				if($nArgs > 0)
				{
					$this->_openTag($this->_getTag($command), $this->_getAttr($command));
					$args[0] = substr($args[0], strlen($command));
					for($i=0; $i < $nArgs; $i++)
					{
						if($command != 'woverset' || $i!=1)
						$this->_openTag('mrow');

						$this->_parseExpr($args[$i]);

						if($command != 'woverset' || $i!=1)
						$this->_closeTag();
					}

					$this->_closeTag();

					$this->_parseExpr($args[$i]);
				}
				else
				{
					$this->_parseExpr($args[0]);
				}

					$expr = $this->_upExpr($expr);
					$this->prev_char = $expr[0];
					$this->_parseExpr($expr);
			break;
		}

	}

	private function _getLRContent($expr)
	{
		$lleft = strlen('\\left');
		$lright= strlen('\\right');

		$str = substr($expr, $lleft);
		$l =  strpos($str, '{}');

		$b=1;
		for($i = 0; $b!=0; $i++)
		{
			if($str[$i] == '\\')
			{
				if(substr($str, $i, $lright) == '\\right')		$b--;
				elseif(substr($str, $i, $lleft) == '\\left')		$b++;
			}
		}


		$lt = substr($str, 0 , $l);
		$rt = substr($str, $i+$lright-1, $l);

		return array(substr($str, 2+$l, $i-3-$l), $lt, $rt);
	}


	private function _getEnvContent($expr,$env)
	{
		$str = substr($expr, strlen('\\begin{'.$env.'}'));


		$b=1;
		for($i = 0; $b!=0; $i++)
		{
			if($str[$i] == '\\')
			{
				if(substr($str, $i, strlen('\\end{'.$env.'}')) == '\\end{'.$env.'}')		$b--;
				elseif(substr($str, $i, strlen('\\begin{'.$env.'}')) == '\\begin{'.$env.'}')	$b++;
			}
		}

		return substr($str, 0, --$i);
	}

	/**
	* Environment parser.
	* @param $env Environment's name.
	* @param $content Environment's content
	*/

	private function _parseEnv($env, $content, $delim = array())
	{
		if($env == 'matrix') $env = 'omatrix';

		if(substr($env,1) == 'matrix')
		{
			$type = substr($env, 0, 1);

			switch($type)
			{
				case 'p': $p = array('open' => '(', 'close' => ')'); break;
				case 'b': $p = array('open' => '[', 'close' => ']'); break;
				case 'B': $p = array('open' => '{', 'close' => '}'); break;
				case 'v': $p = array('open' => '|', 'close' => '|'); break;
				case 'V': $p = array('open' => '‖', 'close' => '‖'); break;
				default : $p = array('open' => '',  'close' => '' );  break;
			}

				$this->_openTag('mfenced',$p);
					$this->_openTag('mrow');
						$this->_openTag('mtable');
							$this->_openTag('mtr');
								$this->_openTag('mtd');
									$this->_parseExpr($content);
								$this->_closeTag();
							$this->_closeTag();
						$this->_closeTag();
					$this->_closeTag();
				$this->_closeTag();
				$this->prev_char = '';

		}
		else
			switch($env)
			{
				case 'cases' : 

					$this->_openTag('mfenced',array('open' => '{', 'close' => ''));
							$this->_openTag('mrow');
								$this->_openTag('mtable');
									$this->_openTag('mtr');
										$this->_openTag('mtd');
											$this->_parseExpr($content);
										$this->_closeTag();
									$this->_closeTag();
								$this->_closeTag();
							$this->_closeTag();
						$this->_closeTag();
						$this->prev_char = '';

				break;

				case 'leftright' :

					$this->_openTag('mfenced', $delim);
						$this->_openTag('mrow');
							$this->_parseExpr($content);
						$this->_closeTag();
					$this->_closeTag();
				$this->prev_char = '';

				break;

				case 'substack' :

					$this->_openTag('mtable', array('rowspacing'=>'0'));
						$this->_openTag('mtr');
							$this->_openTag('mtd');
								$this->_parseExpr($content);
							$this->_closeTag();
						$this->_closeTag();
					$this->_closeTag();
				$this->prev_char = '';

				break;


			}

	}


	/**
	* Parse a number (mn tag in mathml)
	* @param $expr
	* @param $char The number to parse.
	*/

	private function _parsenb(&$expr, &$char)
	{
		$this->_upExpr($expr);

		while(is_numeric($expr[0]))
		{
			$char.=$expr[0];
			$this->_upExpr($expr);
		}

		$this->_setTag('mn', $char);
		$this->_parseExpr($expr);

	}

	/**
	* Parse an operator (mo tag)
	* @param $expr
	* @param $char The operator to parse.
	*/

	private function _parseOp(&$expr, &$char)
	{
		$this->_setTag('mo', $char, ($char == '(' || $char == ')') ? array('maxsize' => '1') : array());
		$this->_upExpr($expr);
		$this->_parseExpr($expr);
	}

	/**
	* Parse an indicator (mi tag)
	* @param $expr
	* @param $char The indicator to parse.
	*/

	private function _parseInd(&$expr, &$char)
	{
		$this->_setTag('mi', $char);
		$this->_upExpr($expr);
		$this->_parseExpr($expr);
	}

	/**
	* Superscript and subscript parser.
	* @param $expr
	* @param $char
	* @param $nextchar
	*/

	private function _parseSubSup(&$expr, &$char, $nextchar)
	{

		list($str, $len) = $this->_parseNSS($nextchar, $expr);

			$this->_upExpr($expr, $len+1);

			$row = $this->dom->createElement('mrow');

			if(($expr[0] == '^' || $expr[0] == '_') && $expr[0] != $char)
			{
				$s = $expr[0];
				$c = count($this->tag)-1;
				$sup = $this->dom->createElement(($this->tag[$c]->lastChild->nodeValue =='∑')? 'munderover':'msubsup');

				$sup->appendChild($this->tag[$c]->lastChild);
					$this->_openTag('mrow');
							$this->_parseExpr($str);
					$this->_closeTag();

				$n = $this->tag[$c]->lastChild;
				$sup->appendChild($n);

				$str = $expr[1];
				$len = 1;

				list($str, $len) = $this->_parseNSS($str, $expr);

				$this->_openTag('mrow');
					$this->_parseExpr($str);
				$this->_closeTag();

				$this->_upExpr($expr, $len+1);

				if($s == '_')
					$sup->insertBefore($this->tag[$c]->lastChild, $n);
				else
					$sup->appendChild($this->tag[$c]->lastChild);

				array_push($this->tag,$sup);
				$this->_closeTag();

				$this->_parseExpr($expr);
			}
			else
			{
				$c = count($this->tag)-1;

				if($char == '^')
				{
					$exp = 'msup';
				}
				else
				{
					$exp = ($this->tag[$c]->lastChild->nodeValue == '∑') ? 'munder':'msub';
				}

				$sup = $this->dom->createElement($exp);

				$row = $this->dom->createElement('mrow');
				$row->appendChild($this->tag[$c]->lastChild);

				$sup->appendChild($row);
				
				$this->_openTag('mrow');
					$this->_parseExpr($str);
				$this->_closeTag();
				$sup->appendChild($this->tag[$c]->lastChild);
			
				array_push($this->tag,$sup);
				$this->_closeTag();

				$this->_parseExpr($expr);
			}
		// Spin <3 Aura
	}

	private function _parseNSS(&$chr, &$expr)
	{
		if($chr == '{')
		{
			$b = 1;
			for($i=2; $b!=0; $i++)
			{
				if($expr[$i] == '}')		$b--;
				elseif($expr[$i] == '{') 	$b++;
			}
			$str = substr($expr, 2, $i-3);
			$len = $i-1;
		}
		else
		{
			$str = $chr;
			$len = 1;
			if($str[0] == "\\")
			{
				$p = strpos($expr, '}');
				$str = substr($expr, 1, $p+1);
				$len = $p+1;
			}	
		}
	
		return array($str, $len);

	}


	/**
	* Add a row.
	* @param $expr
	*/

	private function _parseRow(&$expr)
	{ 
	
		$this->_closeTag();
		$this->_closeTag();

		$this->_openTag('mtr');
		$this->_openTag('mtd');
		$this->_upExpr($expr);
		$this->_upExpr($expr);
		$this->_parseExpr($expr);
	}

	/**
	* Add a column.
	* @param $expr
	*/

	private function _parseCol(&$expr)
	{

		$this->_closeTag();

		$this->_openTag('mtd');
		$this->_upExpr($expr);
		$this->_upExpr($expr);
		$this->_parseExpr($expr);
	}

	/**
	* Skip the char and continue.
	* @param $expr
	*/

	private function _skip(&$expr)
	{
		$this->_upExpr($expr);
		$this->_parseExpr($expr);	
	}


	/**
	*	This method is used to parse the MathML output.
	*	It creates the xhtml dom node and return the xml output.
	*/

	public function parse()
	{


		$this->dom->appendChild($this->math);

		return $this->dom->saveXML();
	}

}


?>
