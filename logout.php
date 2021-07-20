<?php
	include_once('./config/config.php');
    include_once('./config/session.php');
    include_once('./config/redirect.php');
	session_destroy();

	RedirectTo('index.php');

?>