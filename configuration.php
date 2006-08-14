<?php
if (!isset($_SESSION))
{
	session_start();
}
global $configuration;
$configuration['soap'] = "http://www.phpobjectgenerator.com/services/soap.php?wsdl";
$configuration['revisionNumber'] = ".1";
$configuration['versionNumber'] = "2.0";

$configuration['db_encoding'] = 0;

// edit the information below to match your database settings

$configuration['db']	= 'inventory'; 		//	database name
$configuration['host']	= 'localhost';	//	database host
$configuration['user']	= 'tildemark';		//	database user
$configuration['pass']	= 'tildemark';		//	database password
$configuration['port'] 	= '3306';		//	database port

// Program defaults
$configuration['company'] 	= 'SB Marketing';		//	
$configuration['address'] = 'Cagayan de Oro City';
$configuration['devurl'] = 'http://www.ehostingcdo.com';
$configuration['developer'] = 'eHosting CDO';
?>
