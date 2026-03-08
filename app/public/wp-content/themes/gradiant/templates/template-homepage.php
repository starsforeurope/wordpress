<?php 
/**
Template Name: Homepage
*/

get_header(); 
?>

<?php
	do_action( 'gradiant_sections', false );
	get_template_part('template-parts/sections/section','blog'); 
		
get_footer(); ?>