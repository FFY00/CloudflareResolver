<?php

/*
 * Legal Stuff
 *
 * @copyright  2015 FFY00 (Filipe Laíns)
 * @license https://creativecommons.org/licenses/by-nc-sa/4.0/legalcode.txt Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
 * @author Filipe Laíns <filipe.lains@gmail.com>
 */
 
 /*
  * Live Link: https://ffy00.cf/cfresolver/api.php
  */
 
header("Content-Type: text/plain");
require "resolver.php";

$error = array(
"success" => false,
"error" => "No domain"
);


if(isset($_REQUEST["d"])){
	$r = resolver($_REQUEST["d"]);
	$r["success"] = true;
	echo(json_encode($r));
} else {
	echo json_encode($error);
}
?>
