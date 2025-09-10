<?php
/**
 * Sponsor Section
 * 
 * @package Benevolent
 */
 
$sponsor_section_title = get_theme_mod( 'benevolent_sponsor_section_title' );

$sponsors = array(
    'one'   => array(
        'logo'  => get_theme_mod( 'benevolent_sponsor_logo_one' ),
        'url'   => get_theme_mod( 'benevolent_sponsor_logo_one_url' )
    ),
    'two'   => array(
        'logo'  => get_theme_mod( 'benevolent_sponsor_logo_two' ),
        'url'   => get_theme_mod( 'benevolent_sponsor_logo_two_url' )
    ),
    'three'   => array(
        'logo'  => get_theme_mod( 'benevolent_sponsor_logo_three' ),
        'url'   => get_theme_mod( 'benevolent_sponsor_logo_three_url' )
    ),
    'four'   => array(
        'logo'  => get_theme_mod( 'benevolent_sponsor_logo_four' ),
        'url'   => get_theme_mod( 'benevolent_sponsor_logo_four_url' )
    ),
    'five'   => array(
        'logo'  => get_theme_mod( 'benevolent_sponsor_logo_five' ),
        'url'   => get_theme_mod( 'benevolent_sponsor_logo_five_url' )
    )
);

?>
<div class="container">
	<?php if( $sponsor_section_title ) echo '<h2 class="main-title">' . esc_html( $sponsor_section_title ) . '</h2>'; ?>
    
	<div class="row">
        <?php 
            foreach( $sponsors as $sponsor ){
                benevolent_sponsor_helper( $sponsor['logo'], $sponsor['url'] );        
            }
        ?>
	</div>
</div>
    