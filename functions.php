<?php
//database connection function
function getConnection(){
	try{
		$connection = new PDO("mysql:host=localhost;dbname=unn_w18002837","unn_w18002837", "Password");
		$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $connection;
	} catch(Exception $e){
		throw new Exception("Connection error ". $e->getMessage(), 0, $e);
	}
}


//session related functions
//sets passed in session variable $key to the passed in $value
function set_session($key, $value){
	$_SESSION[$key] = $value;
	return true;
}

//returns the value of the passed in session variable $key
function get_session($key){
	if(isset($_SESSION[$key])){
		return $_SESSION[$key];
	}
	return null;
}

//returns true or false depending on if the session variable 'logged-in' has a value
function check_login(){
	if(get_session('logged-in')){
		return true;
	}
	else{
		return false;
	}
}

//website generation functions
//create the beginning of a html web page, passing in a title and css file name to use within the structure.
function makePageStart($title, $cssFile) {
	$pageStartContent = <<<PAGESTART
	<!doctype html>
	<html lang="en">
	<head>
	<meta charset="UTF-8">
	<title>$title</title>
	<link href="$cssFile" rel="stylesheet" type="text/css">
	</head>
	<body>
	<div id="gridContainer">
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
}


//header with a variable passed in for the <h1> tag content, right div is populated with a form for log in details - directing the user to loginProcess.php
function makeHeaderWithLogin($header){
	$headContent = <<<HEAD
	<header>

	<div id='left'>
		<h1>$header</h1>
	</div>

	<div id='right'>
		<form method='post' action='loginProcess.php'>
			<table>
				<tr>
					<td>Username</td>
					<td>Password</td>
				</tr>
				<tr>
					<td><input type='text' name='username'></td>
					<td><input type='password' name='password'></td>
					<td><input type='submit' value='log in'></td>
				</tr>
			</table>
		</form>
	</div>
	</header>
HEAD;
	$headContent .="\n";
	return $headContent;
}

//header with a variable passed in for the <h1> tag content, right div is populated with an <a> tag for a log out button - directing the user to logoutProcess.php
function makeHeaderWithoutLogin($header){
	$headContent = <<<HEAD
	<header>

	<div id='left'>
		<h1>$header</h1>
	</div>

	<div id='right'>
		<a id='logout' href='logoutProcess.php'>Log out</a>
	</div>
	</header>
HEAD;
	$headContent .="\n";
	return $headContent;
}

function makeHeader($header){
	$headContent = <<<HEAD
	<header>

		<div id='left'>
			<h1>$header</h1>
		<div>

		<div id='right'>
		</div>
	</header>
HEAD;
	$headContent .="\n";
	return $headContent;

}

//generates a nav menu with a passed in array of links
function makeNavMenu( array $links) {

	echo "<nav>\n";
	echo "<ul>\n";
	//loops through the array, setting the key ($link) as the <a> tag, and $name as the displayed text
	foreach($links as $link=>$name){
		echo"<li><a href='$link'>$name</a></li>\n";
	}
	
	echo "</ul>\n
	</nav>\n";
	
}

//generates the opening main tag
function startMain(){
	return "<main>\n";
}

//generates the closing main tag
function endMain(){
	return "</main>\n";
}

//generates the footer with the passed in footer text displayed in the section
function makeFooter($footerText) {
	$footContent = <<<FOOT
	<footer>
	<p>$footerText</p>
	</footer>
FOOT;
	$footContent .="\n";
	return $footContent;
}

//closes off remaining open tags and closes html
function makePageEnd() {
	return "</div>\n</body>\n</html>";
}

//function to take errors array and put them is a displayable format
function show_errors($errors){
	$output = "";
	//if there is any errors, loop through the errors, concatenating the error to a single string. 
	if(count($errors) > 0){
		foreach($errors as $msg){
			$output .= "<p>".$msg."</p>";
		}
		
		//it will then return the string to be echoed out. 
		return $output;
	}
}


//exception related functions
function exceptionHandler($e){
	echo "<p><strong>Problem occurred</strong></p>";
	log_error($e);
}

set_exception_handler('exceptionHandler');

function errorHandler($errno, $errstr, $errfile, $errline){
	if(!(error_reporting() & $errno)){
		return;
	}
	throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

set_error_handler('errorHandler');

function log_error($e){
	$errorDate = date('D M j G:i:s T Y');
	$errorMessage = $e->getMessage();


	$toReplace = array("\r\n", "\n", "\r");
	$replaceWith = '';
	$errorMessage = str_replace($toReplace, $replaceWith, $errorMessage);

	$file = fopen("error_log_file.log","ab");
	fwrite($file, "$errorDate|$errorMessage".PHP_EOL);
	fclose($file);
}


?>