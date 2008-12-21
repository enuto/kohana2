<h2><span>By Geert De Deckere, &copy; 2007</span>XSS Filtering</h2>

<p>To protect your website against <abbr title="Cross Site Scripting">XSS</abbr> attacks, Kohana comes bundled with two XSS filters. In this short tutorial you will learn how to work with them.</p>


<h3>The basics of XSS filtering</h3>

<p>The main xss_clean function can be found in the Input Library.</p>

<?php

echo geshi_highlight('$tainted = \'Remove <img src="javascript:evil();" onload="evil();" /> malicious code.\';

// Call xss_clean with the default filter
echo $this->input->xss_clean($tainted);

// Alternatively, you could use the security helper
echo security::xss_clean($tainted);

// Output:
// Remove <img src="nojavascript...evil();" > malicious code.
', 'php', NULL, TRUE)

?>


<h3>Using HTML Purifier</h3>

<p>By default a filtering class from Bitflux will be used. It's quite fast. However, if you really want rock solid XSS filtering, HTML Purifier is what you need. As you can see in the output below, the whole img element is deleted from the tainted string.</p>

<p>HTML Purifier is triggered as XSS filter by passing the string 'htmlpurifier' to the second parameter of the  xss_clean function.</p>

<?php

echo geshi_highlight('$tainted = \'Remove <img src="javascript:evil();" onload="evil();" /> malicious code.\';

// Call xss_clean with the default filter
echo $this->input->xss_clean($tainted, \'htmlpurifier\');

// Output:
// Remove  malicious code.
', 'php', NULL, TRUE)

?>

<p>Note that the HTML Purifier XSS filter requires a fair amount of processing overhead. Therefore it is not something that should be used for general runtime processing. Instead only use it to deal with data upon submission.</p>


<h3>Global XSS filtering</h3>

<p>Global XSS filtering will automatically filter all incoming data like $_GET, $_POST, $_COOKIE and $_SERVER.</p>

<p>By default global XSS filtering is turned off for performance reasons. You can enable it by setting global_xss_filtering to TRUE. Alternatively, you could set it to the value 'htmlpurifier'. This setting can be found in application/config/config.php.</p>

<?php

echo geshi_highlight('$config = array
(
	// ...
	
	// Enable global XSS filtering using the default filter.
	\'global_xss_filtering\' => TRUE,
	
	// Or, enable global XSS filtering using HTML Purifier.
	\'global_xss_filtering\' => \'htmlpurifier\',
	
	// ...
);
', 'php', NULL, TRUE)

?>