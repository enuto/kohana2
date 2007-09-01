/*
copyright (c) 2007 Kohana Team

This file should only be distributed with the Kohana framework. If you have
downloaded this file from somewhere other than KohanaPHP.com, pleaes report it.
*/
* { padding: 0; margin: 0; border: 0; }
/*
Default Styles
*/
body { background: #f7fbf1; color: #111; font-size: 82%; line-height: 140%; font-family: "Lucida Grande", Arial, Verdana, sans-serif; }
/* Hacks for Firefox and Safari */
body { text-shadow: 0 0 0 #000; -moz-opacity: 0.999999; }
a { color: #449; text-decoration: none; }
h1 { border-bottom: solid 1px #999; font-size: 2.5em; text-align: center; color: #b43f11; }
h1, h2, h3, h4, h5, h6 { padding: 0.5em 0; margin-bottom: 0.2em; }
p { padding-bottom: 1em; }
abbr { color: #141; border-bottom: dotted 1px #999; }
tt { font-family: monospace; background: #ddd; padding: 1px 2px; border: solid 1px #ccc; }
dl { padding: 0.5em; }
dt { float: left; clear: left; width: 12em; font-weight: bold; }
dd { padding-bottom: 0.5em; margin: 0 0 0.5em 12em; border-bottom: dotted 1px #aaa; }
/*
Template Styles
*/
#container { position: relative; margin: 0 12em 2em 1em; border: solid 0 #e7f5d7; border-width: 0 0.2em 0.3em 0.2em; }
#menu { position: fixed; top: 0; right: 1.5em; width: 10em; padding: 0.2em 0; }
* html body #menu { position: absolute; } /* Add this style for IE6 */
#menu ul { margin: 0 0.2em; list-style: none; color: #b43f11; }
#menu li.first { padding-top: 0.2em; }
#menu li.active li.lite { color: #b43f11; }
#menu li ul { padding: 0.1em 0; margin-right: 0; color: #444; }
#menu li ul a { padding-left: 0.4em; color: #333; }
#menu li ul a:hover { font-weight: bold; color: #2f4f14; }
#menu li ul li:before { content: "«"; }
#menu li span { text-shadow: 1px 1px 1px #333; font-size: 1.3em; cursor: pointer; }
* html body #menu { text-shadow: none; } /* Remove the text shadow in IE6 */
#body { padding: 0.3em 1em; background: #fff; }
#body ol, #body ul { margin: 1em; margin-left: 2.5em; }
#body ol { list-style: decimal; }
#body ul { list-style: circle; }
#body li { padding: 0.1em 0; }
#footer { padding: 0 1em; background: #fff; line-height: 2em; }
#loading { position: absolute; top: 0; right: 0; z-index: 9999; width: 32px; height: 32px; background: transparent url(spinner.gif) center center no-repeat; }
/*
Content Styles
*/
#copyright { border-top: solid 1px #999; text-align: center; font-size: 0.8em; color: #555; }
