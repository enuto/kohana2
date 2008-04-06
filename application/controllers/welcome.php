<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Welcome_Controller extends Controller {

	// Disable this controller when Kohana is set to production mode.
	// See http://doc.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	public function index()
	{
		// In Kohana, all views are loaded and treated as objects.
		$welcome = new View('welcome');

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$welcome->title = 'Welcome to Kohana!';

		// An array of links to display. Assiging variables to views is completely
		// asyncronous. Variables can be set in any order, and can be any type
		// of data, including objects.
		$welcome->links = array
		(
			'Home Page'     => 'http://kohanaphp.com/',
			'Documentation' => 'http://doc.kohanaphp.com/',
			'Forum'         => 'http://forum.kohanaphp.com/',
			'License'       => 'Kohana License.html',
			'Donate'        => 'http://kohanaphp.com/donate.html',
		);

		// Using views inside of views is completely transparent. In the welcome
		// view, printing the $content variable will render the welcome_content view.
		$welcome->content = new View('welcome_content');

		// Using render(TRUE) forces the view to display now, instead of
		// returning an HTML string.
		$welcome->render(TRUE);
	}

	public function _default()
	{
		// By defining a method called _default, all pages routed to this controller
		// that result in 404 errors will be handled by this method, instead of
		// being displayed as "Page Not Found" errors.
		echo 'This is a _default handler. If you expected the index page, you need to use: welcome/index/'.substr(Router::$current_uri, 8);
	}

}