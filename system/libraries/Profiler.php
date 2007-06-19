<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Kohana
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * NOTE: This file has been modified from the original CodeIgniter version for
 * the Kohana framework by the Kohana Development Team.
 *
 * @package          Kohana
 * @author           Kohana Development Team
 * @copyright        Copyright (c) 2007, Kohana Framework Team
 * @link             http://kohanaphp.com
 * @license          http://kohanaphp.com/user_guide/license.html
 * @since            Version 1.0
 * @orig_package     CodeIgniter
 * @orig_author      Rick Ellis
 * @orig_copyright   Copyright (c) 2006, EllisLab, Inc.
 * @orig_license     http://www.codeignitor.com/user_guide/license.html
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Kohana Profiler Class
 *
 * This class enables you to display benchmark, query, and other data
 * in order to help with debugging and optimization.
 *
 * Note: At some point it would be good to move all the HTML in this class
 * into a set of template files in order to allow customization.
 *
 * @package		Kohana
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Rick Ellis
 * @link		http://kohanaphp.com/user_guide/general/profiling.html
 */
class Core_Profiler {

	var $CORE;

 	function Core_Profiler()
 	{
 		$this->CORE =& get_instance();
 		$this->CORE->load->language('profiler');
 	}

	// --------------------------------------------------------------------

	/**
	 * Auto Profiler
	 *
	 * This function cycles through the entire array of mark points and
	 * matches any two points that are named identically (ending in "_start"
	 * and "_end" respectively).  It then compiles the execution times for
	 * all points and returns it as an array
	 *
	 * @access	private
	 * @return	array
	 */
 	function _compile_benchmarks()
 	{
  		$profile = array();
 		foreach ($this->CORE->benchmark->marker as $key => $val)
 		{
 			// We match the "end" marker so that the list ends
 			// up in the order that it was defined
 			if (preg_match('/(.+?)_end$/iD', $key, $match))
 			{
 				if (isset($this->CORE->benchmark->marker[$match[1].'_end']) AND isset($this->CORE->benchmark->marker[$match[1].'_start']))
 				{
 					$profile[$match[1]] = $this->CORE->benchmark->elapsed_time($match[1].'_start', $key);
 				}
 			}
 		}

		// Build a table containing the profile data.
		// Note: At some point we should turn this into a template that can
		// be modified.  We also might want to make this data available to be logged

		$output  = "\n\n";
		$output .= '<fieldset style="border:1px solid #990000;padding:6px 10px 10px 10px;margin:0 0 20px 0;background-color:#eee">';
		$output .= "\n";
		$output .= '<legend style="color:#990000;">&nbsp;&nbsp;'.$this->CORE->lang->line('profiler_benchmarks').'&nbsp;&nbsp;</legend>';
		$output .= "\n";
		$output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";

		foreach ($profile as $key => $val)
		{
			$key = ucwords(str_replace(array('_', '-'), ' ', $key));
			$output .= "<tr><td width='50%' style='color:#000;font-weight:bold;background-color:#ddd;'>".$key."&nbsp;&nbsp;</td><td width='50%' style='color:#990000;font-weight:normal;background-color:#ddd;'>".$val."</td></tr>\n";
		}

		$output .= "</table>\n";
		$output .= "</fieldset>";

 		return $output;
 	}

	// --------------------------------------------------------------------

	/**
	 * Compile Queries
	 *
	 * @access	private
	 * @return	string
	 */
	function _compile_queries()
	{
		$query_count = ( ! isset($this->CORE->db)) ? '0' : $this->CORE->db->query_count;
		
		$output  = "\n\n";
		$output .= '<fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
		$output .= "\n";
		$output .= '<legend style="color:#0000FF;">&nbsp;&nbsp;'.$this->CORE->lang->line('profiler_queries').' ('.$query_count.')&nbsp;&nbsp;</legend>';
		$output .= "\n";

		if ( ! class_exists('Core_DB_driver'))
		{
			$output .= "<div style='color:#0000FF;font-weight:normal;padding:4px 0 0 0;'>".$this->CORE->lang->line('profiler_no_db')."</div>";
		}
		else
		{
			if ($this->CORE->db->query_count < 1)
			{
				$output .= "<div style='color:#0000FF;font-weight:normal;padding:4px 0 4px 0;'>".$this->CORE->lang->line('profiler_no_queries')."</div>";
			}
			else
			{
				$output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";

				for ($i = 0; $i < $this->CORE->db->query_count; $i++)
				{
					$output .= '<tr>';
					$output .= "<td width='85%' style='color:#000;background-color:#ddd;'>".htmlspecialchars($this->CORE->db->queries[$i])."</td>";
					$output .= "<td width='15%' style='color:#0000FF;font-weight:normal;background-color:#ddd;'>".number_format($this->CORE->db->query_times[$i], 4)."</td>";
					$output .= "</tr>\n";
				}

				$output .= "</table>\n";
			}
		}

		$output .= "</fieldset>";

		return $output;
	}

	// --------------------------------------------------------------------

	/**
	 * Compile $_POST Data
	 *
	 * @access	private
	 * @return	string
	 */
	function _compile_post()
	{
		$output  = "\n\n";
		$output .= '<fieldset style="border:1px solid #009900;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
		$output .= "\n";
		$output .= '<legend style="color:#009900;">&nbsp;&nbsp;'.$this->CORE->lang->line('profiler_post_data').'&nbsp;&nbsp;</legend>';
		$output .= "\n";

		if (count($_POST) == 0)
		{
			$output .= "<div style='color:#009900;font-weight:normal;padding:4px 0 4px 0'>".$this->CORE->lang->line('profiler_no_post')."</div>";
		}
		else
		{
			$output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";

			foreach ($_POST as $key => $val)
			{
				$output .= "<tr><td width='50%' style='color:#000;background-color:#ddd;'>".$key."</td><td width='50%' style='color:#009900;font-weight:normal;background-color:#ddd;'>";
				if (is_array($val))
				{
					$output .= "<pre>" . htmlspecialchars(print_r($val, true)) . "</pre>";
				}
				else
				{
					$output .= htmlspecialchars($val);
				}
				$output .= "</td></tr>\n";
			}

			$output .= "</table>\n";
		}
		$output .= "</fieldset>";

		return $output;
	}

	// --------------------------------------------------------------------

	/**
	 * Run the Profiler
	 *
	 * @access	private
	 * @return	string
	 */
	function run($output = '')
	{
		$output = '<br clear="all" />';
		$output .= "<div style='background-color:#fff;padding:10px;'>";

		$output .= $this->_compile_benchmarks();
		$output .= $this->_compile_post();
		$output .= $this->_compile_queries();

		$output .= '</div>';

		return $output;
	}

}

// END Core_Profiler class
?>