<?php
ini_set('display_errors', 'On');

/**
 * Legal Stuff
 *
 * @copyright  2015 FFY00 (Filipe Laíns)
 * @license https://creativecommons.org/licenses/by-nc-sa/4.0/legalcode.txt Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
 * @author Filipe Laíns <filipe.lains@gmail.com>
 */
 
/**
 * Resolver function
 * @param string $domain
 * @return array all DNS records found
 */
function resolver($domain = "google.com") {
	// I was to lazy to create functions ^.^
	$subdomain[0] = array(
                        "",
                        "www",
                        "mail",
                        "webmail",
                        "ftp",
                        "cpanel",
                        "forum",
                        "blog",
                        "direct",
                        "connect",
                        "direct-connect",
                        "mail-direct-connect",
                        "dev",
                        "client",
                        "server",
                        "java",
                        "swf",
                        "my",
                        "btc",
                        "admin",
                        "pop",
                        "imap",
                        "beta",
                        "portal",
                        "wiki",
                        "record",
                        "ssl",
                        "dns",
                        "help",
                        "helpdesk",
                        "ts3",
                        "ts",
                        "ajax",
                        "eu",
                        "us",
                        "ip4",
                        "ip6",
                        "ipv4",
                        "ipv6"
	);
	$subdomain[1] = range('A', 'Z');
	$subdomain[2] = range('0', '9');
	$record_type[0][0] = "A";
	$record_type[1][0] = "MX";
	$record_type[0][1] = DNS_A;
	$record_type[1][1] = DNS_MX;
	$result = array();
	foreach($subdomain as $sub) {
		foreach($sub as $sd) {
			$d = $sd.".".$domain;
			if($sd === "") $d = $domain;
			foreach($record_type as $type){
				$r = dns_get_record($d, $type[1]);
				foreach($r as $n){
					if($n["type"]==$type[0]) {
					    $r2 = dns_get_record($n["target"], DNS_A);
						if(count($r2)==1) {
							if($r2[0]["type"]=="A") {
								$result["MX"][$r2[0]["host"]] = $r2[0]["ip"];
							}
						} else {
							$ip = array();
							foreach($r2 as $n2){
								if($n2["type"]=="A") {
									array_push($ip, $n2["ip"]);
								}
							}
							$result["MX"][$n2["host"]] = $ip;
						}
					}
				}
			}
		}
	}
	return $result;
}

?>
