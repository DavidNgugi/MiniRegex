<?php

// namespace MiniRegex;

/**
 * @package    MiniRegex
 * @author     David Ngugi <david@davidngugi.com>
 * @copyright  (c) 2016, Davidic Labs
 * @link       http://github.com/DavidNgugi15/Miniregex 		GitHub Repository Page
 * @link       http://miniregex.davidngugi.com                  Official Docs Site
 * @license    http://opensource.org/licenses/MIT MIT
 *
 *
 */

class Miniregex{
	
	/**
     * POSIX style Regex character quantifiers and delimiters
     *
     * @var array
     */
	protected $symbols 		= [
		'start'				=> '^', // Beginning of a line
		'end'				=> '$', // End of a line
		'at'				=> '@', // at symbol
		'or'				=> '|', // OR
		'followed_by'		=> '?', // Followed By
		'dontCaptureGroup' 	=> '?:', // Don't Capture group
		'underscore'		=> '_', // Underscore
		'hyphen'			=> '-', // Hyphen, To for ranges e.g 0-9
		'plus'				=> '+', // Followed By One or More
		'upperaToz'			=> 'a-z', // Range of Characters in the Alphabet (Lowercase)
		'upperAtoZ'			=> 'A-Z', // Range of Characters in the Alphabet (Uppercase)
		'0To9'				=> '0-9', // Range of numerals from 0 to 9
		'o_brace'			=> '{', // For matching exact values e.g {6}
		'c_brace'			=> '}', // For matching exact values e.g {6}
		'o_bracket'			=> '[', // Enclosure e.g [a-zA-Z0-9]
		'c_bracket'			=> ']', // Enclosure e.g [a-zA-Z0-9]
		'f_slash'			=> '/', // Delimiter for Enclosure e.g /[a-zA-Z0-9]/
		'b_slash'			=> '\/', // Escape
		'comma'				=> ',', // Comma
		'colon'				=> ':', // Colon
		'any'				=> '.', // Any character
		'zeroOrMore'		=> '*' // Zero or More
	];


	/**
     * PERL Style Meta Characters
     * PHP supports the PCRE (Perl Compatible Regular Expresions) Library (http://php.net/manual/en/book.pcre.php)
     *
     * @var array
     */
	protected $metaCharacters = [
		'singleCharacter'	=> '.', // a single character
		'anyDigit'			=> '\d', // a digit (0‐9)
		'nonDigit'			=> '\D', // a non‐digit
		'anyWordCharacter'	=> '\w', // a word character (a‐z, A‐Z, 0‐9, _)
		'nonWordCharacter'	=> '\W', // a non‐word character
		'whiteSpaces'		=> '\s', // a whitespace character (space, tab, newline)
		'nonWhiteSpace'		=> '\S', // a non‐whitespace character
	];

	/**
     * Predefined Character ranges
     *
     * @var array
     */
	protected $characterRanges = [
		'alpha'				=> '[[:alpha]]', // It matches any string containing alphabetic characters aA through zZ
		'digit'				=> '[[:digit]]', // It matches any string containing numerical digits 0 through 9
		'alnum'				=> '[[:alnum]]', // It matches any string containing alphanumeric characters aA->zZ and 0->9
		'space'				=> '[[:space]]', // It matches any string containing a space
	];

	/**
     * Instance of Miniregex
     *
     * @var instantiable
     */
	private static $instance = null;

	/**
     * Regex string built during execution
     *
     * @var string
     */
	public $reg;

	/**
     * Regex array built during execution
     *
     * @var array
     */
	public $regArr = [];

	/**
     * Constructor
     *
     * @param  none
     * @return void
    */
	public function __construct(){
		self::$instance = $this;
	}

	/**
     * Get's a Singleton instance of the class 
     *
     * @param  none
     * @return Object
    */
	protected static function getInstance(){
		return self::$instance;
	}

	/**
     * Begins a regular expression
     *
     * @param  none
     * @return string
    */
    public function begin(){
    	return array_push($this->regArr, "/");
    }

    /**
     * 
     *
     * @param  none
     * @return void
    */
    public function startsWith($value){
    	return array_push($this->regArr, $symbols['start']);
    }
    /**
     * Ends/Closes a regular expression
     *
     * @param  none
     * @return string
    */
    public function end(){
    	return array_push($this->regArr, "/");
    }

    /**
     * Clears all data from specific properties
     *
     * @param  none
     * @return void
    */
    public function clear(){
    	$this->regArr = [];
    	$this->reg = "";
    }

    /**
     * Write a raw Regex pattern and pass to a specified PHP function
     *
     * @param string $pattern
     * @param string $fn 
     * @return void
    */
    public function raw($pattern, $fn){
    	//
    }





/******************************************* COMMON REGULAR EXPRESSIONS **************************************\
    
    /**
     * Match Alphabetic values
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchAphabetic($subject){
        return (preg_match('/^[a-zA-Z]*$/', $subject) == 1) ? true : false;
    }

    /**
     * Match Numeric values
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchNumeric($subject){
        return (preg_match('/^[0-9]*$/', $subject) == 1) ? true : false;
    }

    /**
     * Match Alphanumeric Value
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchAlphanumeric($subject){
    	return (preg_match('/^([a-zA-Z0-9])*$/', $subject) == 1) ? true : false;
    }

    /**
     * Match Hexadecimal Value
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchHex($subject){
        return (preg_match('/^#?([a‐f0‐9]{6}|[a‐f0‐9]{3})$/', $subject) == 1) ? true : false;
    }

    /**
     * Match URL
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchURL($subject){
        /* Thanks to Jack at https://jkwl.io/php/regex/2015/05/18/url-validation-php-regex.html */
        $regex = "#^" .
        // protocol identifier
        "(?:(?:https?|ftp):\\/\\/)?" .
        // user:pass authentication
        "(?:\\S+(?::\\S*)?@)?" .
        "(?:" .
        // IP address exclusion
        // private & local networks
        "(?!(?:10|127)(?:\\.\\d{1,3}){3})" .
        "(?!(?:169\\.254|192\\.168)(?:\\.\\d{1,3}){2})" .
        "(?!172\\.(?:1[6-9]|2\\d|3[0-1])(?:\\.\\d{1,3}){2})" .
        // IP address dotted notation octets
        // excludes loopback network 0.0.0.0
        // excludes reserved space >= 224.0.0.0
        // excludes network & broacast addresses
        // (first & last IP address of each class)
        "(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])" .
        "(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}" .
        "(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))" .
        "|" .
        // host name
        "(?:(?:[a-z\\x{00a1}-\\x{ffff}0-9]-*)*[a-z\\x{00a1}-\\x{ffff}0-9]+)" .
        // domain name
        "(?:\\.(?:[a-z\\x{00a1}-\\x{ffff}0-9]-*)*[a-z\\x{00a1}-\\x{ffff}0-9]+)*" .
        // TLD identifier
        "(?:\\.(?:[a-z\\x{00a1}-\\x{ffff}]{2,}))" .
        ")" .
        // port number
        "(?::\\d{2,5})?" .
        // resource path
        "(?:\\/\\S*)?" .
        "$#ui"; // unicode enabled + case insensitive
        return (preg_match($regex, $subject) === 1) ? true : false;
    }

    /**
     * Match Email Address
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchEmail($subject){
        return ( (preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $subject) === 1) || (filter_var($subject, FILTER_VALIDATE_EMAIL)) ) ? true : false;
    }

     /**
     * Match Date (DD/MM/YYYY)
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchDate($subject){
        return (eregi('/^((0?[1‐9]|[12][0‐9]|3[01])[‐ /.](0?[1‐9]|1[012])[‐ /.](19|20)?[0‐9]{2})*$/', $subject) === 1) ? true : false;
    }

    /**
     * Match Date (YYYY/MM/DD)
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchDate1($subject){
        return (preg_match('#^((19|20)?[0‐9]{2}[‐ /.](0?[1‐9]|1[012])[‐ /.](0?[1‐9]|[12][0‐9]|3[01]))*$#', $subject) === 1) ? true : false;
    }

    /**
     * Match Date (MM/DD/YYYY)
     *
     * @param  string $subject
     * @return boolean
    */
    public function matchDate2($subject){
        return (preg_match('/^((0?[1‐9]|1[012])[‐ /.](0?[1‐9]|[12][0‐9]|3[01])[‐ /.](19|20)?[0‐9]{2})*$/', $subject) === 1) ? true : false;
    }










    /**
     * 
     *
     * @param  none
     * @return void
    */
    public function temp(){
    	
    }

}

?>