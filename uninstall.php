<?php
//Runs when plugin is deleted
if( !defined( 'ABSPATH' ) && !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();
	
delete_option("cmsify");
delete_option("cmsifypro");
?>