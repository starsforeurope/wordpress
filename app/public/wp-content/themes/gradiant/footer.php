<div class="footer-one">
    <?php do_action('gradiant_above_footer'); ?>
</div>
</div> 
 <!--===// Start: Footer
    =================================-->
<?php 
$gradiant_footer_effect_enable	= get_theme_mod('footer_effect_enable','1');
?>	
    <footer id="footer-section" class="footer-one footer-section  <?php if($gradiant_footer_effect_enable=='1'): echo esc_attr_e('footer-effect-active','gradiant'); endif; ?>">
		<?php 
			$gradiant_footer_middle_content	= get_theme_mod('footer_widget_middle_content','<i class="fa fa-whatsapp"></i>');		
			if(is_active_sidebar( 'gradiant-footer-1' )  || is_active_sidebar( 'gradiant-footer-2' )  || is_active_sidebar( 'gradiant-footer-3' )) { 
		?>
        <div class="footer-main">
            <div class="av-container">
			   <div class="av-columns-area">
					<?php if ( is_active_sidebar( 'gradiant-footer-1' ) ) : ?>
						<div class="av-column-6 col-md-6 mb-xl-0 mb-4 pr-md-5">
						   <?php dynamic_sidebar( 'gradiant-footer-1'); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'gradiant-footer-2' ) ) : ?>
						<div class="av-column-3 col-md-6 mb-xl-0 mb-4 pl-md-5">
						   <?php dynamic_sidebar( 'gradiant-footer-2'); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'gradiant-footer-3' ) ) : ?>
						<div class="av-column-3 col-md-6 mb-xl-0 mb-4">
							<?php dynamic_sidebar( 'gradiant-footer-3'); ?>
						</div>
					<?php endif; ?>
				</div>	       
            </div>
			<?php if(!empty($gradiant_footer_middle_content)): ?>
				<div class="footer-info-overwrap"><div class="icon"><?php echo wp_kses_post($gradiant_footer_middle_content); ?></div></div>
			<?php endif; ?>	
        </div>
		
		<?php
			}
			$gradiant_footer_first_img 	= get_theme_mod('footer_first_img');
			if ( function_exists( 'gradiant_get_social_icon_default' ) ) :
				$gradiant_footer_social_icons 	= get_theme_mod('footer_social_icons',gradiant_get_social_icon_default());
			else:
				$gradiant_footer_social_icons 	= get_theme_mod('footer_social_icons');
			endif;	
			$gradiant_copyright 	= get_theme_mod('footer_third_custom','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
			if(!empty($gradiant_footer_first_img) || !empty($gradiant_footer_social_icons)  || !empty($gradiant_copyright)) {
		?>
			<div class="footer-copyright">
				<div class="av-container">
					<div class="av-columns-area">
							<div class="av-column-4 av-md-column-6 text-md-left text-center">
								<div class="widget-left">
									<?php  if ( ! empty( $gradiant_footer_first_img ) ){ ?>
										<div class="logo">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title"><img src="<?php echo esc_url($gradiant_footer_first_img); ?>"></a>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="av-column-4 av-md-column-6 text-md-center text-center">
								<div class="widget-center">
									<?php if( $gradiant_footer_social_icons!='' ){ ?>
										<aside class="share-toolkit widget widget_social_widget">
											<a href="#" class="toolkit-hover"><i class="fa fa-share-alt"></i></a>
											<ul>
												<?php
													$gradiant_footer_social_icons = json_decode($gradiant_footer_social_icons);
													foreach($gradiant_footer_social_icons as $social_item){	
													$social_icon = ! empty( $social_item->icon_value ) ? apply_filters( 'gradiant_translate_single_string', $social_item->icon_value, 'Footer section' ) : '';	
													$social_link = ! empty( $social_item->link ) ? apply_filters( 'gradiant_translate_single_string', $social_item->link, 'Footer section' ) : '';
												?>
													<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="fa <?php echo esc_attr( $social_icon ); ?>"></i></a></li>
												<?php } ?>
											</ul>
										</aside>
									<?php } ?>
								</div>
							</div>
							<div class="av-column-4 av-md-column-6 text-av-right text-md-left text-center">
								<div class="widget-right">                          
									<?php 	
										$gradiant_copyright_allowed_tags = array(
											'[current_year]' => date_i18n('Y'),
											'[site_title]'   => get_bloginfo('name'),
											'[theme_author]' => sprintf(__('<a href="https://www.nayrathemes.com/gradiant-free/" target="_blank">Gradiant</a>', 'gradiant')),
										);
									?>                        
									<div class="copyright-text">
										<?php
											echo apply_filters('gradiant_footer_copyright', wp_kses_post(gradiant_str_replace_assoc($gradiant_copyright_allowed_tags, $gradiant_copyright)));
										?>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		<?php } ?>
    </footer>
    <!-- End: Footer
    =================================-->
    
    <!-- ScrollUp -->
	<?php 
		$gradiant_hs_scroller 	= get_theme_mod('hs_scroller','1');		
		if($gradiant_hs_scroller == '1') :
	?>
		<button type=button class="scrollup"><i class="fa fa-arrow-up"></i></button>
	<?php endif; ?>
</div>
<?php 
wp_footer(); ?>
</body>
</html>
