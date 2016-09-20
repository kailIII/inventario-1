<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class APP_Sanitize{

	private $CI;

	public $total_replaced = 0;
    public $current_replaced = 0;

    // Define some common string types to be used.
    public $ALPHA;
    public $ALPHA_NUM;
    public $ALPHA_SPACE;
    public $ALPHA_DASH;
    public $ALPHA_PUNCTUATION;
    public $HEX;
    public $HEX_UPPER;
    public $HEX_LOWER;
    public $OCTAL;
    public $INTEGER;
    public $FLOAT;


	public function __construct(){

		$this->CI =& get_instance();

		$this->ALPHA = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $this->ALPHA_NUM = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	    $this->ALPHA_SPACE = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 0123456789';
	    $this->ALPHA_DASH = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 0123456789-_';
	    $this->ALPHA_PUNCTUATION = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 0123456789-_.,!?:;';
	    $this->HEX = '0123456789abcdefABCDEF';
	    $this->HEX_UPPER = '0123456789ABCDEF';
	    $this->HEX_LOWER = '0123456789abcdef';
	    $this->OCTAL = '0124567';
	    $this->INTEGER = '0123456789-';
	    $this->FLOAT = '0123456789.e-';

	}

	private function unique($input = array())
    {
        return array_flip(array_flip($input));
    }

  
    private function magic_quotes($input)
    {
        if(get_magic_quotes_gpc())
        {
            return stripslashes($input);
        }
        else
        {
            return $input;
        }
    }

    
    private function remove_null_byte($input)
    {
        if ((is_string($input)) && (!empty($input))) 
        {
            return str_replace("\0", '', $input);
        }
        else 
        {
            return $input;
        }
    }


    public function clean_boolean($input)
    {
        // This forces php to try to make $input a boolean.
        settype($input, 'boolean');
        return $input;
    }

    
    public function white_list_cleaner($input = '', $allowable = '', $replacement = '')
    {
        if ($allowable=='' || !is_string($allowable)){
            $allowable = $this->ALPHA_DASH;
        }

        // Init the current test
        $this->current_replaced = 0;

        // deal with magic_quotes right off the bat
        $input = $this->magic_quotes($input);
        // Remove any NULL BYTES from the input.
        $input = $this->remove_null_byte($input);

        // Sanity Checks
        if ((!is_string($allowable)))
        {
            throw new Exception('Allowable characters must be of type string.');
        }

        if (!is_string($replacement)) 
        {
            // The replacement is "broken" and something is wrong 
            throw new Exception('The specified replacement is broken nothing should be returned.');
        }

        $input = (string) $input;   // Juggle the type to a string.
        if (($input === '') || ($allowable === ''))
        {
            // if the input is empty no need to clean... return an empty string.
            // OR if there are no allowe chars.
            return '';
        }

        // Create an array of allowed chars.
        $allowed_chars = str_split($allowable);
        $size = strlen($input);
        $output = '';

        // Walk through the input
        for ($i = 0; $i < $size; $i++) {
            $char = $input[$i];
            // Check to see if the current char is allowed...
            if (in_array($char, $allowed_chars))
            {
                // if allowed... add to the output string.
                $output .= $char;
            }
            else 
            {
                // if not allowed... replace with the replacement string
                $output .= $replacement;
                $this->total_replaced++;
                $this->current_replaced++;
            }
        }
        return $output;
    }


    public function white_list_array($input = array(), $allowed_chars = '', $replacement = '')
    {
        if ($allowed_chars=='' || !is_string($allowed_chars)){
            $allowed_chars = $this->ALPHA_DASH;
        }


        if(is_array($input))
        {
            try
            {
                foreach ($input as $dirty_key => $dirty_string) {
                    $clean[$dirty_key] = $this->white_list_cleaner($dirty_string, $allowed_chars, $replacement);
                }
            }
            catch (Exception $e)
            {
                throw new Exception('Error processing request.');
            }
            return $clean;
        } 
        else
        {
            throw new Exception('Input for batch processing must be an array of strings.');
        }
    }


    public function black_list_cleaner($input = '', $banned_chars = '', $replacement = '')
    {
        // Init the current test.
        $this->current_replaced = 0;

        // deal with magic_quotes right off the bat
        $input = $this->magic_quotes($input);
        // Remove any NULL BYTES from the input.
        $input = $this->remove_null_byte($input);

        // Sanity Checks
        if ((!is_string($banned_chars)))
        {
            throw new Exception('Banned characters must be of type string.');
        }

        if (!is_string($replacement)) 
        {
            // The replacement is "broken" and something is wrong 
            throw new Exception('The specified replacement is broken nothing should be returned.');
        }

        $input = (string) $input;
        if ($input === '')
        {
            // if the input is empty no need to clean... return an empty string.
            return '';
        }

        // Create an array of banned chars.
        $banned_char_array = str_split($banned_chars);
        $size = strlen($input);
        $output = '';

        // Walk through the input
        for ($i = 0; $i < $size; $i++) {
            $char = $input[$i];
            // Check to see if the curren char is allowed...
            if (in_array($char, $banned_char_array))
            {
                // if blacklisted.. replace the char
                $output .= $replacement;
                $this->total_replaced++;
                $this->current_replaced++;
            }
            else 
            {
                // if allowed... add it to the string
                $output .= $char;
            }
        }
        return $output;

    }


    public function clean_integer($input = "0")
    {
        try 
        {
            $value = $this->white_list_cleaner($input, $this->INTEGER);
            settype($value, 'int');
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
        return $value;
    }

   
    public function clean_hex($input, $case = 'MIXED')
    {
        switch ($case) {
            case 'UPPER':
                try 
                {
                    $value = $this->white_list_cleaner($input, $this->HEX_UPPER);
                    settype($value, 'string');
                }
                catch (Exception $e) 
                {
                    throw new Exception($e->getMessage()); 
                }
                break;
            case 'LOWER':
                try 
                {
                    $value = $this->white_list_cleaner($input, $this->HEX_LOWER);
                    settype($value, 'string');
                }
                catch (Exception $e)
                {
                    throw new Exception($e->getMessage()); 
                }
                break;
            case 'MIXED':
            default:
                try 
                {
                    $value = $this->white_list_cleaner($input, $this->HEX);
                    settype($value, 'string');
                }
                catch (Exception $e)
                {
                    throw new Exception($e->getMessage()); 
                }
                break;
        }
        return $value;
    }


    public function clean_octal($input)
    {
        try 
        {
            $value = $this->white_list_cleaner($input, $this->OCTAL);
            settype($value, 'string');
        }
        catch (Execption $e)
        {
            throw new Exception($e->getMessage()); 
        }
        return $value;
    }


    public function clean_float($input = "0.0")
    {
        try 
        {
            $value = $this->white_list_cleaner($input, $this->FLOAT);
            settype($value, 'float');
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage()); 
        }
        return $value;
    }

 
    public function clean_string($input = '')
    {
        try 
        {
            $value = $this->white_list_cleaner($input, $this->ALPHA_DASH);
            settype($value, 'string');
        }
        catch (Exception $e) 
        {
            throw new Exception($e->getMessage());
        }
        return $value;
    }


}