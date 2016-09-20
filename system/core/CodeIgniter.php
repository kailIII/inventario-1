<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright		Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * System Initialization File
 *
 * Loads the base classes and executes the request.
 *
 * @package		CodeIgniter
 * @subpackage	codeigniter
 * @category	Front-controller
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/
 */

/**
 * CodeIgniter Version
 *
 * @var string
 *
 */
	define('CI_VERSION', '2.2.1');

/**
 * CodeIgniter Branch (Core = TRUE, Reactor = FALSE)
 *
 * @var boolean
 *
 */
	define('CI_CORE', FALSE);
/*
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
	require(BASEPATH.'core/Common.php');

/*
 * ------------------------------------------------------
 *  Load the framework constants
 * ------------------------------------------------------
 */
	if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
	{
		require(APPPATH.'config/'.ENVIRONMENT.'/constants.php');
	}
	else
	{
		require(APPPATH.'config/constants.php');
	}

/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
	set_error_handler('_exception_handler');

	if ( ! is_php('5.3'))
	{
		@set_magic_quotes_runtime(0); // Kill magic quotes
	}

/*
 * ------------------------------------------------------
 *  Set the subclass_prefix
 * ------------------------------------------------------
 *
 * Normally the "subclass_prefix" is set in the config file.
 * The subclass prefix allows CI to know if a core class is
 * being extended via a library in the local application
 * "libraries" folder. Since CI allows config items to be
 * overriden via data set in the main index. php file,
 * before proceeding we need to know if a subclass_prefix
 * override exists.  If so, we will set this value now,
 * before any classes are loaded
 * Note: Since the config file data is cached it doesn't
 * hurt to load it here.
 */
	if (isset($assign_to_config['subclass_prefix']) AND $assign_to_config['subclass_prefix'] != '')
	{
		get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
	}

/*
 * ------------------------------------------------------
 *  Set a liberal script execution time limit
 * ------------------------------------------------------
 */
	if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
	{
		@set_time_limit(300);
	}

/*
 * ------------------------------------------------------
 *  Start the timer... tick tock tick tock...
 * ------------------------------------------------------
 */
	$BM =& load_class('Benchmark', 'core');
	$BM->mark('total_execution_time_start');
	$BM->mark('loading_time:_base_classes_start');

/*
 * ------------------------------------------------------
 *  Instantiate the hooks class
 * ------------------------------------------------------
 */
	$EXT =& load_class('Hooks', 'core');

/*
 * ------------------------------------------------------
 *  Is there a "pre_system" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('pre_system');

/*
 * ------------------------------------------------------
 *  Instantiate the config class
 * ------------------------------------------------------
 */
	$CFG =& load_class('Config', 'core');

	// Do we have any manually set config items in the index.php file?
	if (isset($assign_to_config))
	{
		$CFG->_assign_to_config($assign_to_config);
	}

/*
 * ------------------------------------------------------
 *  Instantiate the UTF-8 class
 * ------------------------------------------------------
 *
 * Note: Order here is rather important as the UTF-8
 * class needs to be used very early on, but it cannot
 * properly determine if UTf-8 can be supported until
 * after the Config class is instantiated.
 *
 */

	$UNI =& load_class('Utf8', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the URI class
 * ------------------------------------------------------
 */
	$URI =& load_class('URI', 'core');
	// unset($URI->config);
		// echo "<pre>";
		// print_r($URI);
		// echo "<pre>";
/*
 * ------------------------------------------------------
 *  Instantiate the routing class and set the routing
 * ------------------------------------------------------
 */
// require BASEPATH.'core/Controller.php';
// 		// echo BASEPATH.'core/Controller.php';
// 	function &get_instance()
// 	{
// 		return CI_Controller::get_instance();
// 	}
	$RTR =& load_class('Router', 'core');
	$RTR->_set_routing();

	if (isset($routing))
	{
		$RTR->_set_overrides($routing);	
	}
		unset($RTR->uri);
		unset($RTR->config);
		// echo "<pre>";
		// print_r($RTR);
		// echo "<pre>";
/*
 * ------------------------------------------------------
 *  Instantiate the output class
 * ------------------------------------------------------
 */
	$OUT =& load_class('Output', 'core');
		// echo "<pre>";
		// print_r($OUT);
		// echo "<pre>";
/*
 * ------------------------------------------------------
 *	Is there a valid cache file?  If so, we're done...
 * ------------------------------------------------------
 */
	if ($EXT->_call_hook('cache_override') === FALSE)
	{
		if ($OUT->_display_cache($CFG, $URI) == TRUE)
		{
			exit;
		}
	}

/*
 * -----------------------------------------------------
 * Load the security class for xss and csrf support
 * -----------------------------------------------------
 */
	$SEC =& load_class('Security', 'core');

/*
 * ------------------------------------------------------
 *  Load the Input class and sanitize globals
 * ------------------------------------------------------
 */
	$IN	=& load_class('Input', 'core');
		// unset($IN->security);


/*
 * ------------------------------------------------------
 *  Load the Language class
 * ------------------------------------------------------
 */
	$LANG =& load_class('Lang', 'core');
		// echo "<pre>";
		// print_r($LANG);
		// echo "<pre>";
/*
 * ------------------------------------------------------
 *  Load the app controller and local controller
 * ------------------------------------------------------
 *
 */
	// Load the base controller class
	require BASEPATH.'core/Controller.php';
		// echo BASEPATH.'core/Controller.php';
	function &get_instance()
	{
		return CI_Controller::get_instance();
	}


	if (file_exists(APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php'))
	{
		// APP_controller
		require APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php';
	}



	// if(class_exists($class)){
		// echo "hola1";
		// $methodClass=get_class_methods($class);
	// }else{
	// 	echo "hola2";

	// }
	// if($directory and $controller){ //redirecciona para ver un solo post
	// 	return $segments = array(0=>"inicio",1=>"mipost");
	// }elseif($directory){ //Aqui busca la categoria seleccionada y trae sus artiulos
	// 	$this->module = "articulos";
	// 	$this->directory = $offset.'articulos/controllers/';
	// 	return $segments = array(0=>"articulos",1=>"category");
	// }	
	// print_r(class_exists($class));

	// if(in_array($method,$methodClass))
	// 	echo "si esta";
	// print_r($methodClass);
	// print_r($class);
	// print_r($method);
	// print_r(APPPATH.'controllers/'.$RTR->fetch_directory());
	// print_r($RTR->fetch_class());
	// print_r(get_class_methods($class));
		// Los datos de fetch_directory() son agregados en el proceso y se extraen de URI ode otras clases
	if ( ! file_exists(APPPATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().'.php'))
	{
		// show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
		// show_404("",true);
		include("application/controllers/../modules/inicio/controllers/inicio.php");
		$class  = "inicio";

	}else{
		// Los datos de fetch_class() son agregados en el proceso y se extraen de URI ode otras clases
		include(APPPATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().'.php');
		$class  = $RTR->fetch_class();
		
	}
	$method = $RTR->fetch_method();

	
	// if(class_exists($class)){
		// echo "hola1";
		// $methodClass=get_class_methods($class);
	// print_r($methodClass);
	// }else{
	// 	// echo "hola2";

	// }
	// if($directory and $controller){ //redirecciona para ver un solo post
	// 	return $segments = array(0=>"inicio",1=>"mipost");
	// }elseif($directory){ //Aqui busca la categoria seleccionada y trae sus artiulos
	// 	$this->module = "articulos";
	// 	$this->directory = $offset.'articulos/controllers/';
	// 	return $segments = array(0=>"articulos",1=>"category");
	// }	
	// print_r(class_exists($class));

	// if(in_array($method,$methodClass))
	// 	echo "si esta";
	// print_r($methodClass);
	// print_r($class);
	// print_r($method);
	// print_r(APPPATH.'controllers/'.$RTR->fetch_directory());
	// print_r(get_class_methods($class));	
	// Set a mark point for benchmarking
	$BM->mark('loading_time:_base_classes_end');

//  * ------------------------------------------------------
//  *  Security check
//  * ------------------------------------------------------
	// $class  = $RTR->fetch_class();

	if ( ! class_exists($class)
		OR strncmp($method, '_', 1) == 0
		OR in_array(strtolower($method), array_map('strtolower', get_class_methods('CI_Controller')))
		)
	{
		if ( ! empty($RTR->routes['404_override']))
		{
			$x = explode('/', $RTR->routes['404_override']);
			$class = $x[0];
			$method = (isset($x[1]) ? $x[1] : 'index');
			if ( ! class_exists($class))
			{
				if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
				{
					show_404("{$class}/{$method}");
				}

				include_once(APPPATH.'controllers/'.$class.'.php');
			}
		}
		else
		{
			show_404("{$class}/{$method}");
		}
	}

/*
 * ------------------------------------------------------
 *  Is there a "pre_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('pre_controller');

/*
 * ------------------------------------------------------
 *  Instantiate the requested controller
 * ------------------------------------------------------
 */
	// Mark a start point so we can benchmark the controller
	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_start');

	$CI = new $class();
		// unset($CI->config);
		// echo "<pre>";
		// print_r($CI);
		// echo "<pre>";	
/*
 * ------------------------------------------------------
 *  Is there a "post_controller_constructor" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_controller_constructor');


 // * ------------------------------------------------------
 // *  Call the requested method
 // * ------------------------------------------------------
 
	// Is there a "remap" function? If so, we call it instead

	if (method_exists($CI, '_remap'))
	{
		$CI->_remap($method, array_slice($URI->rsegments, 2));
	}
	else
	{
		// is_callable() returns TRUE on some versions of PHP 5 for private and protected
		// methods, so we'll use this workaround for consistent behavior
		if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($CI))))
		{
			// Check and see if we are using a 404 override and use it.
			if ( ! empty($RTR->routes['404_override']))
			{
				$x = explode('/', $RTR->routes['404_override']);
				$class = $x[0];
				$method = (isset($x[1]) ? $x[1] : 'index');
				if ( ! class_exists($class))
				{
					if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
					{
						show_404("{$class}/{$method}");
					}

					include_once(APPPATH.'controllers/'.$class.'.php');
					unset($CI);
					$CI = new $class();
				}
			}
			else
			{
				show_404("{$class}/{$method}");
			}
		}

		// Call the requested method.
		// Any URI segments present (besides the class/function) will be passed to the method for convenience
		// print_r($URI->rsegments);
		call_user_func_array(array(&$CI, $method), array_slice($URI->rsegments, 2));
	}


	// Mark a benchmark end point
	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_end');

/*
 * ------------------------------------------------------
 *  Is there a "post_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_controller');

/*
 * ------------------------------------------------------
 *  Send the final rendered output to the browser
 * ------------------------------------------------------
 */
	if ($EXT->_call_hook('display_override') === FALSE)
	{
		$OUT->_display();
	}

/*
 * ------------------------------------------------------
 *  Is there a "post_system" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_system');

/*
 * ------------------------------------------------------
 *  Close the DB connection if one exists
 * ------------------------------------------------------
 */
	if (class_exists('CI_DB') AND isset($CI->db))
	{
		$CI->db->close();
	}

/* End of file CodeIgniter.php */
/* Location: ./system/core/CodeIgniter.php */