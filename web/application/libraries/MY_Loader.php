<?php 
/**
 * Idea - a prototyping Framework for PHP developers
 * Copyright (C) 2011  Fat Panda, LLC
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
 
/**
 * Slightly different paradigm with respect to loading libraries. 
 * @author Aaron Collegeman 
 * @see My_Loader->library
 */
class MY_Loader extends CI_Loader {
  
  function MY_Loader() {
    parent::CI_Loader();
  }
  
  /**
   * @param mixed $library A single library or an array of libraries
   * @param mixed $params Can be an array or a scalar value - CI_Loader only allows for arrays
   * @param string $object_name The name to use for storing the object reference on the global $CI object
   */
  function library($library = '', $params = NULL, $object_name = NULL)
	{
		if ($library == '')
		{
			return FALSE;
		}
		
		if (is_null($params)) {
		  $params = $this->_get_config($library);
		}

		if (is_array($library))
		{
			foreach ($library as $class)
			{
				$this->_ci_load_class($class, $params, $object_name);
			}
		}
		else
		{
			$this->_ci_load_class($library, $params, $object_name);
		}
		
		$this->_ci_assign_to_models();
	}
	
	function _get_config($library) {

	  if ($env = @$_ENV['CI_ENV']) {
	    $file = strtolower($library . '-' . $env);
	    
	    if (file_exists(APPPATH.'config/'.$file.EXT))
  		{
  			include(APPPATH.'config/'.$file.EXT);
  		}			
  		else {
  		  $file = ucfirst(strtolower($library));
  		  
  		  if (file_exists(APPPATH.'config/'.$file.EXT))
  		  {
    			include(APPPATH.'config/'.$file.EXT);
    		}
    	}
	  } 
	  
	  if (!isset($config)) {
  	  if (file_exists(APPPATH.'config/'.strtolower($library).EXT))
  		{
  			include(APPPATH.'config/'.strtolower($library).EXT);
  		}			
  		elseif (file_exists(APPPATH.'config/'.ucfirst(strtolower($library)).EXT))
  		{
  			include(APPPATH.'config/'.ucfirst(strtolower($library)).EXT);
  		}
  	}
		
		return @$config;
	}
  
}