<?php
/**
 * Allows a template to be automatically loaded and displayed. Display can be
 * dynamically turned off in the controller methods, and the template file
 * can be overloaded.
 *
 * To use it, declare your controller to extend this class:
 * `class Your_Controller extends Template_Controller`
 *
 * $Id: template.php 3326 2008-08-09 21:24:30Z Shadowhand $
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
abstract class Controller_Template extends Controller {

	// Template view name
	public $template = 'template';

	// Default to do auto-rendering
	public $auto_render = TRUE;

	/**
	 * Template loading and setup routine.
	 */
	public function __construct()
	{
		parent::__construct();

		// Load the template
		$this->template = new View($this->template);

		if ($this->auto_render == TRUE)
		{
			// Render the template immediately after the controller method
			Event::add('system.post_controller', array($this, '_render'));
		}
	}

	/**
	 * Render the loaded template.
	 */
	public function _render()
	{
		if ($this->auto_render == TRUE)
		{
			// Render the template when the class is destroyed
			$this->template->render(TRUE);
		}
	}

} // End Template_Controller