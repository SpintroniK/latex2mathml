<?php

/**
* This class is used to set operators and symbols
* used by LaTeX.
* @brief Configuration class
* @author Jeremy Oden
*
*/

class config
{

	/**
	* Used to create a singleton.
	*/
	private static $instance;

	/**
	* This array contains all operators defined in LaTeX.
	*/
	protected $operators=array();

	/**
	* This array contains all symbols defined in LaTeX.
	*/
	protected $element = array();

	/**
	* This is the constructor...
	*/
	private function __construct()
	{

	}

        public static function getInstance()
        {
                if( !isset(self::$instance) )
                        self::$instance = new config();
                       
                return self::$instance;
        }

	/**
	* This method is used to define LaTeX symbols.
	* It can be used as the following example : 
	*
	* $config->add_symbol('alpha', 	'mi', 	'&\#x03b1;');
	* 
	* Which add the alpha letter, considered as an indicator (mi).
	* 
	* @param $latex The LaTeX representation of the symbol.
	* @param $mml 	The MathML corresponding entity.
	* @param $char	Html entity of the symbol.
	* @param $attr  Optional attributes for this symbol.
	*/

	public function add_symbol($latex, $mml, $char, array $attr = array())
	{
		$this->element[$latex] = array('m' =>  $mml, 'args' => 0, 'char' => $char, 'attr' => $attr);
	
	}

	/**
	* The following method can be use to define LaTeX commands.
	* For example, it can be used to add the \\frac{num}{den} command :
	* 
	* $config->add_command('frac', 'mfrac', 2);
	*
	* <b>Nota</b> : You don't have to add optional arguments, it will be automatically added.
	*
	* @param $latex The LaTeX command (frac for example)
	* @param $mml   The MathML corresponding tag (mfrac)
	* @param $args  The number of argument for the command.
	*/

	public function add_command($latex, $mml, $args)
	{
		$this->element[$latex] = array('m' => $mml, 'args' => $args);
	}

	/**
	* 
	*/

	public function add_operator($op)
	{
		$this->operators[$op] = TRUE;
	}

	/**
	* This method returns all LaTeX entities defined by 
	* the add_symbol and add_command methods.
	*
	* @return $this->element
	*/

	public function getElements()
	{
		return $this->element;
	}

	/**
	* This method returns all LaTeX operators defined by 
	* the add_operator method.
	*
	* @return $this->operators
	*/

	public function getOperators()
	{
		return $this->operators;
	}


}

?>
