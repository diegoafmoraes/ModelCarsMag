<?php
require 'environment.php';

global $config;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_ADM_URL", "http://localhost/Projects_SitePHP/modelcars/administrator/");
	define("BASE_URL", "http://localhost/Projects_SitePHP/modelcars/");
	$config['host']	  = 'localhost';
	$config['dbname'] = 'projetos_modelcars';
	$config['dbuser'] = 'admin';
	$config['dbpass'] = 'admin';
} else {
	define("MAIN_URL", "");
	define("BASE_URL", "");
	$config['host']	  = '';
	$config['dbname'] = '';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
}

// Hora Certa e Fuso sem Horario de Verao
date_default_timezone_set('America/Sao_Paulo');