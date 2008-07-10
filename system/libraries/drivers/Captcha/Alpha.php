<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Captcha driver for "basic" style.
 *
 * $Id$
 *
 * @package    Captcha
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Captcha_Alpha_Driver extends Captcha_Driver {

	/**
	 * Generates a new Captcha challenge.
	 *
	 * @return  string  the challenge answer
	 */
	public function generate_challenge()
	{
		// Complexity setting is used as character count
		return text::random('distinct', max(1, Captcha::$config['complexity']));
	}

	/**
	 * Outputs the Captcha image.
	 *
	 * @param   boolean  html output
	 * @return  mixed
	 */
	public function render($html)
	{
		// Creates $this->image
		$this->image_create(Captcha::$config['background']);

		// Add a random gradient
		$color1 = imagecolorallocate($this->image, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
		$color2 = imagecolorallocate($this->image, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
		$this->image_gradient($color1, $color2);

		// Calculate character font-size and spacing
		$default_size = min(Captcha::$config['width'], Captcha::$config['height'] * 2) / strlen(Captcha::$answer);
		$spacing = (int) (Captcha::$config['width'] * 0.9 / strlen(Captcha::$answer));

		// Background alphabetic character attributes
		$color_limit = mt_rand(96, 160);
		$chars = 'ABEFGJKLPQRTVY';

		// Draw each Captcha character with varying attributes
		for ($i = 0, $strlen = strlen(Captcha::$answer); $i < $strlen; $i++)
		{
			$angle = mt_rand(-40, 20);
			// Scale the character size on image height
			$size = $default_size / 10 * mt_rand(8, 12);
			$box = imageftbbox($size, $angle, Captcha::$config['font'], Captcha::$answer[$i]);

			// Calculate character starting coordinates
			$x = $spacing / 4 + $i * $spacing;
			$y = Captcha::$config['height'] / 2 + ($box[2] - $box[5]) / 4;

			// Draw "ghost" alphabetic character
			$text_color = imagecolorallocatealpha($this->image, mt_rand($color_limit + 8, 255), mt_rand($color_limit + 8, 255), mt_rand($color_limit + 8, 255), mt_rand(60, 120));
			$char = substr($chars, mt_rand(0,14), 1);
			imagettftext($this->image, $size, ($angle + (mt_rand(5,10))), ($x - (mt_rand(5,10))), ($y + (mt_rand(5,10))), $text_color, Captcha::$config['font'], $char);

			// Draw captcha text character
			// Allocate random color, size and rotation attributes to text
			$color = imagecolorallocate($this->image, mt_rand(150, 255), mt_rand(200, 255), mt_rand(0, 255));

			// Write text character to image
			imagefttext($this->image, $size, $angle, $x, $y, $color, Captcha::$config['font'], Captcha::$answer[$i]);
		}

		// Output
		return $this->image_render($html);
	}

} // End Captcha Alpha Driver Class