<?php

session_start();

/*
 Check if session is not registered, redirect back to main page.
 Put this code in first line of web page.
 */

include 'defines.php';

if (isset($_SESSION["user"]) and isset($_SESSION["pass"])) {
	$_SESSION["authorized"] = true;
	//session_regenerate_id();
	header("Location: ../navigation/");

	// set time-out period (in seconds)
	$inactive = 600;

	// check to see if $_SESSION["timeout"] is set
	if (isset($_SESSION["timeout"])) {
		// calculate the session's "time to live"
		$sessionTTL = time() - $_SESSION["timeout"];
		if ($sessionTTL > $inactive) {
			session_destroy();
			header("Location: ../navigation/");
		}
	}

	$_SESSION["timeout"] = time();
}

else {
	unset($_SESSION['user']);
	unset($_SESSION['pass']);
	session_destroy();
	header("Location: ../index.html");;
}


?>
