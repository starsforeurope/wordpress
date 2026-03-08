<?php
/**
 * Stats Section
 * 
 * @package Benevolent
 */
 
$stats = array(
    'one'   => array(
        'title' => get_theme_mod( 'benevolent_first_stats_title' ),
        'number'=> get_theme_mod( 'benevolent_first_stats_number' )
    ),
    'two'   => array(
        'title' => get_theme_mod( 'benevolent_second_stats_title' ),
        'number'=> get_theme_mod( 'benevolent_second_stats_number' )
    ),
    'three'   => array(
        'title' => get_theme_mod( 'benevolent_third_stats_title' ),
        'number'=> get_theme_mod( 'benevolent_third_stats_number' )
    ),
    'four'   => array(
        'title' => get_theme_mod( 'benevolent_fourth_stats_title' ),
        'number'=> get_theme_mod( 'benevolent_fourth_stats_number' )
    )
);
 
?>
<div class="container">
	<div class="row">
		<?php 
            foreach( $stats as $stat ){
                benevolent_stat_helper( $stat['title'], $stat['number'] );
            }
        ?>
	</div>
</div>