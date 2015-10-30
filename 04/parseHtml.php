<?php
	function eliminateHtml($arg1){
		// don't allow html tags in reporter name and subject
		$arg1 = str_replace("<", "&lt;", $arg1);
		$arg1 = str_replace(">", "&gt;", $arg1);
		return $arg1;
	}

	function parseContent($arg1){
		// first disallow all
		$arg1 = str_replace("<", "&lt;", $arg1);
		$arg1 = str_replace(">", "&gt;", $arg1);
		// replace all newline
		$arg1 = str_replace("\n", "<br>", $arg1);	
		// only allow <b> (bold), <i> (cursiv), <u> (underline), <a> (link), <h1> - <h3>, <font size=..>
		if (strpos($arg1, "&lt;b&gt;") !== false){
			$arg1 = str_replace('&lt;b&gt;', '<b>', $arg1);
			$arg1 = str_replace('&lt;/b&gt;', '</b>', $arg1);
		}
		if (strpos($arg1, "&lt;i&gt;") !== false){
			$arg1 = str_replace('&lt;i&gt;', '<i>', $arg1);
			$arg1 = str_replace('&lt;/i&gt;', '</i>', $arg1);
		}
		if (strpos($arg1, "&lt;u&gt;") !== false){
			$arg1 = str_replace('&lt;u&gt;', '<u>', $arg1);
			$arg1 = str_replace('&lt;/u&gt;', '</u>', $arg1);
		}
		if (strpos($arg1, "&lt;h1&gt;") !== false){
			$arg1 = str_replace('&lt;h1&gt;', '<h1>', $arg1);
			$arg1 = str_replace('&lt;/h1&gt;', '</h1>', $arg1);
		}
		if (strpos($arg1, "&lt;h2&gt;") !== false){
			$arg1 = str_replace('&lt;h2&gt;', '<h2>', $arg1);
			$arg1 = str_replace('&lt;/h2&gt;', '</h2>', $arg1);
		}
		if (strpos($arg1, "&lt;h3&gt;") !== false){
			$arg1 = str_replace('&lt;h3&gt;', '<h3>', $arg1);
			$arg1 = str_replace('&lt;/h3&gt;', '</h3>', $arg1);
		}
		if (strpos($arg1, "&lt;font size=") !== false){
			$arg1 = preg_replace('/&lt;font size=\"(\d+)(\w+)\"&gt;/i', '<span style="font-size:${1}${2};">', $arg1);
			echo $arg1;
			$arg1 = preg_replace('/&lt;\/font&gt;/', '<\/span>', $arg1);
		}
		if (strpos($arg1, "&lt;a href=") !== false){
			$arg1 = preg_replace('/&lt;a href=\"(\w+):\/\/(\w+)\.(\w+)\.(.*)\"&gt;/i', '<a href="${1}://${2}.${3}.${4}">', $arg1);		// http://www.google.com
			$arg1 = preg_replace('/&lt;a href=\"(\w+)\.(\w+)\.(.*)\"&gt;/i', '<a href="http://${1}.${2}.${3}">', $arg1);					// www.google.com
			$arg1 = preg_replace('/&lt;a href=\"(\w+)\.(.*)\"&gt;/i', '<a href="http://${1}.${2}">', $arg1);								// google.com
			$arg1 = preg_replace('/&lt;a href=\"(\w+):\/\/(\w+)\.(.*)\"&gt;/i', '<a href="${1}://${2}.${3}.${4}">', $arg1);				// http://google.com
			$arg1 = preg_replace('/&lt;\/a&gt;/', '<\/a>', $arg1);
		}
		return $arg1;
	}
?>