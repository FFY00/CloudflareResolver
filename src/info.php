<?php

/*
 * Legal Stuff
 *
 * @copyright  2015 FFY00 (Filipe Laíns)
 * @license https://creativecommons.org/licenses/by-nc-sa/4.0/legalcode.txt Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
 * @author Filipe Laíns <filipe.lains@gmail.com>
 */
 
/*
 * Live Link: https://ffy00.cf/cfresolver/info.php
 */
  
echo '<link rel="stylesheet" type="text/css" href="http://ffy00.cf/bs/bootstrap.min.css"/><center>';
echo "<h1><b>Cloudflare Resolver</b></h1>";
if(isset($_GET["d"])){
	$json = resolver($_GET["d"]);
	if(isset($json["A"])) {
		echo "<h3><b>A</b></h3>";
		foreach($json["A"] as $d => $ip){
			if(is_array($ip)){
				$ip_total = "";
				foreach($ip as $ip2){
					$geo = json_decode(file_get_contents("http://ip-api.com/json/$ip2"), true);
					if(array_search($ip2, $ip)==0){
						$ip_total = $ip2." (".$geo["isp"].")";
					} else {
						$ip_total .= ", ".$ip2." (".$geo["isp"].")";
					}
				}
				echo "Domain: $d<br>IP: $ip_total<br><br>";
			} else {
					$geo = json_decode(file_get_contents("http://ip-api.com/json/$ip"), true);
				echo "Domain: $d<br>IP: $ip (".$geo["isp"].")<br><br>";
			}
		}
	}
	if(isset($json["MX"])) {
		echo "<h3><b>MX</b></h3><br>";
		foreach($json["MX"] as $d => $ip){
			if(is_array($ip)){
				$ip_total = "";
				foreach($ip as $ip2){
					$geo = json_decode(file_get_contents("http://ip-api.com/json/$ip2"), true);
					if(array_search($ip2, $ip)==0){
						$ip_total = $ip2." (".$geo["isp"].")";
					} else {
						$ip_total .= ", ".$ip2." (".$geo["isp"].")";
					}
				}
				echo "Domain: $d<br>IP: $ip_total<br><br>";
			} else {
				$geo = json_decode(file_get_contents("http://ip-api.com/json/$ip"), true);
				echo "Domain: $d<br>IP: $ip (".$geo["isp"].")<br><br>";
			}
		}
	}
	if(!isset($json["A"]) && !isset($json["MX"])) {
		echo "No DNS records found.";
	}
} else {
	echo "Give a domain to resolve.<br>Correct Use: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?d=google.com";
}
echo "</center>";
?>
