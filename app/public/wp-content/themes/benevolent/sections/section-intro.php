<?php
/**
 * Intro Section
 * 
 * @package Benevolent
 */
 

$intro_section_title   = get_theme_mod( 'benevolent_intro_section_title' );
$intro_section_content = get_theme_mod( 'benevolent_intro_section_content' );
$ed_new_tab            = get_theme_mod( 'benevolent_intro_section_new_tab', '1' );

$intros = array(
    'one'   => array(
        'image' => get_theme_mod( 'benevolent_intro_one_image' ),
        'logo'  => get_theme_mod( 'benevolent_intro_one_logo' ),
        'title' => get_theme_mod( 'benevolent_intro_one_title' ),
        'link'  => get_theme_mod( 'benevolent_intro_one_link' ),
        'url'   => get_theme_mod( 'benevolent_intro_one_url' )
    ),
    'two'   => array(
        'image' => get_theme_mod( 'benevolent_intro_two_image' ),
        'logo'  => get_theme_mod( 'benevolent_intro_two_logo' ),
        'title' => get_theme_mod( 'benevolent_intro_two_title' ),
        'link'  => get_theme_mod( 'benevolent_intro_two_link' ),
        'url'   => get_theme_mod( 'benevolent_intro_two_url' )
    ),
    'three' => array(
        'image' => get_theme_mod( 'benevolent_intro_three_image' ),
        'logo'  => get_theme_mod( 'benevolent_intro_three_logo' ),
        'title' => get_theme_mod( 'benevolent_intro_three_title' ),
        'link'  => get_theme_mod( 'benevolent_intro_three_link' ),
        'url'   => get_theme_mod( 'benevolent_intro_three_url' )
    )
);

?>
<div class="container">
	<?php if( $intro_section_title || $intro_section_content ){ ?>
    <header class="header">
		<?php 
            if( $intro_section_title ) echo '<h2 class="main-title">' . esc_html( $intro_section_title ) . '</h2>'; 
            if( $intro_section_content ) echo wpautop( esc_html( $intro_section_content ) );
        ?>
	</header>
    <?php } ?>
    
	<div class="row">
		<?php 
            foreach( $intros as $intro ){
                benevolent_intro_helper( $intro['image'], $intro['logo'], $intro['title'], $intro['link'], $intro['url'], $ed_new_tab );
            }
         ?>
	</div>
</div>