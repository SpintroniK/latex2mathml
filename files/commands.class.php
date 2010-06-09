<?php

class commands
{

	/**
	* Used to create a singleton.
	*/
	private static $instance;

	private $config;
	private $commands	= array();
	private $from 		= array();
	private $to		= array();

	private function __construct()
	{

	}


        public static function getInstance()
        {
                if( !isset(self::$instance) )
                        self::$instance = new commands();
                       
                return self::$instance;
        }

	public function newCommand($name, $num, $def)
	{
		$this->commands[$name] = $num.$def;
		$this->config->element[$name]['args'] = $num;
	}

	/**
	* Get the name of a LaTeX command.
	* @param $expr 
	* @return substr($expr, 1, $p) The name of the command.
	*/
	
	public function getCommand(&$expr)
	{
		$p = strpos($expr, '{')-1;
		return substr($expr, 1, $p);
	}



	/**
	* Getting arguments of a command (ex : \\frac{a}{b} returns array('a', 'b');)
	* @param $command The formula (ex : frac)
	* @param $expr The next expression
	* @return $args Array containing the arguments.
	*/

	public function _getArgs($command, &$expr, $pcmd=0)
	{

		$elements = config::getInstance()->getElements();
		$l2xml    = LaTeX2Xml::getInstance();

		if(isSet($elements[$command]['args']))
		{
			$nArgs = $elements[$command]['args'];
		}
		elseif(isSet($this->commands['\\'.$command]))
		{
			$nArgs = $this->commands['\\'.$command][0];	
			
		}
		elseif($pcmd==0)
		{
			$off = strpos($expr, ' ');
		 	$err =  substr($expr, 0, $off);
			$l2xml->_setTag('merror', 'Undefined symbol or command : '.$err);
			$expr = substr($expr, $off);
			return array( $expr);
		}
		else return;

		$args = array();

		if($nArgs == 0 && $pcmd == 0)
		{
			$l2xml->_setTag($elements[$command]['m'], $elements[$command]['char'], $elements[$command]['attr']);

			$args = array(substr($expr, 3+strlen($command)));
		}
		else
		{
			$s = $expr[0];
			$l = strlen($expr);
			$p = strpos($expr, '{')+1;
			$b = 1;
			$s = 1;

			for($i = $p; $nArgs > 0; $i++)
			{
				if($expr[$i] == '{')		$b++;
				elseif($expr[$i] == '}')	$b--;

				if($b==0)
				{
					$nArgs--;
					$b = 1;
					$args[] = substr($expr, $s+1, $i-$s-1);
					$s = $i+1;
					$i++;
				}
					
			}

			$args[] = substr($expr, $s, $l);



		}
			return $args;
	}




	/**
	* Replace all LaTeX symbols.
	* @param $math The LaTeX formula.
	* @return $math The replaced content.
	*/

	public function replaceAll($math)
	{
		
		$math = str_replace('\\left\{', '\\left{', $math);
		$math = str_replace('\\right\}', '\\right}', $math);
		$math = str_replace('\\left\}', '\\left}', $math);
		$math = str_replace('\\right\{', '\\right{', $math);

		$math = preg_replace('/\\\sqrt\[([0-9])\]\{/U','\\msqrt{$1}{', $math); 

		$math = strtr($math, LaTeX2Xml::getInstance()->getSymbols());

		$this->_parseCmd($math);

		$math = str_replace($this->from, $this->to, $math);
		

		return ' '.$math;
	}

	private function _parseCmd($expr)
	{
		// Get the first and second char.
		$char = $expr[0];
		$nextchar = substr($expr, 1, 1);

		if(strlen($char)>0)
		{

			if($char == '\\' && preg_match('/[a-zA-Z,;:\!\.\|\#]{1}/U', $nextchar))
			{

				$command = $this->getCommand($expr);	

				$this->_replaceCmd($command, $expr);
			}
			else
			{
				$this->_parseCmd(substr($expr, 1));

			}
		}

	}

	private function _replaceCmd($command,&$expr)
	{

		$args = $this->_getArgs($command, $expr, 1);

		$nArgs = count($args) - 1;

		if($nArgs > 0 && isSet($this->commands['\\'.$command]))
		{

			$args[0] = substr($args[0], strlen($command));

			$from = '\\'.$command;
			$rArgs = array();

			for($i=0; $i < $nArgs; $i++)
			{

				$from.='{'.$args[$i].'}';
				$rArgs[] = '#'.($i+1);

			}

			$this->from[] = $from;
			$this->to[]   = str_replace($rArgs, $args, substr($this->commands['\\'.$command],1));

			$this->_parseCmd($args[$i]);
		}


		
		$this->_parseCmd(substr($expr, strlen($command)+1));
	}


}
?>
