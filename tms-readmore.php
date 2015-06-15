<?php

/**
* Plugin Name: Read More - TMS Media
* Plugin URI: http://tms-media.co.uk
* Description: Adds shortcode for breaking up content using a read more/less link
* Version: 1.0
* Author: Ryan Knights - TMS Media
* Author URI: http://ryanknights.co.uk
*/
	
	if (!defined( 'ABSPATH'))
	{
		exit();
	}
	
	require_once('inc/tms-readmore.class.php');

	new TmsReadMore();
?>