<?php 
	namespace FrancisNg;
	
	require_once 'php/Psr4Autoloader.php';
	
	$loader = new Psr4Autoloader;
	$loader->addNamespace(
	    'FrancisNg',
	    '.'
	);
	
	$loader->addNamespace(
	    'FrancisNg\Controllers',
	    'php/controllers'
	);
	
	$loader->addNamespace(
	    'FrancisNg\Models',
	    'php/models'
	);
	
	$loader->addNamespace(
	    'FrancisNg\Utils',
	    'php/utils'
	);
	$loader->addNamespace(
	    'FrancisNg\Views',
	    'php/views'
	);
	$loader->register();
	
	$controller = new \FrancisNg\Controllers\ProfileController;
	$controller->loadData();
	$pageView = $controller->getPageView();
	
	$pageView->output();
?>