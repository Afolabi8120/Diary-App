<?php
	
	// this function is use for redirecting from one page to another
	function RedirectTo($newlocation){
		header('location:' . $newlocation);
		exit();
	}

?>