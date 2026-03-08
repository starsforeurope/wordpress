<?php
/**
 * Widget Social Links
 *
 * @package Benevolent
 */

// register Benevolent_Social_Links widget 
function benevolent_register_social_links_widget() {
    register_widget( 'Benevolent_Social_Links' );
}
add_action( 'widgets_init', 'benevolent_register_social_links_widget' );

if ( ! class_exists('Benevolent_Social_Links') ) { 
	 /**
	 * Adds Benevolent_Social_Links widget.
	 */
	class Benevolent_Social_Links extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		function __construct() {
			parent::__construct(
				'benevolent_social_links', // Base ID
				__( 'RARA: Social Links', 'benevolent' ), // Name
				array( 'description' => __( 'A Social Links Widget', 'benevolent' ), ) // Args
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
		   
			$title      = ! empty( $instance['title'] ) ? strip_tags( $instance['title'] ) : __( 'Subscribe & Follow', 'benevolent' );		
			$facebook   = ! empty( $instance['facebook'] ) ? esc_url( $instance['facebook'] ) : '' ;
			$twitter    = ! empty( $instance['twitter'] ) ? esc_url( $instance['twitter'] ) : '' ;
			$pinterest  = ! empty( $instance['pinterest'] ) ? esc_url( $instance['pinterest'] ) : '' ;
			$linkedin   = ! empty( $instance['linkedin'] ) ? esc_url( $instance['linkedin'] ) : '' ;
			$googleplus = ! empty( $instance['google_plus'] ) ? esc_url( $instance['google_plus'] ) : '' ;
			$instagram  = ! empty( $instance['instagram'] ) ? esc_url( $instance['instagram'] ) : '' ;
			$youtube    = ! empty( $instance['youtube'] ) ? esc_url( $instance['youtube'] ) : '' ;
			$tiktok    	= ! empty( $instance['tiktok'] ) ? esc_url( $instance['tiktok'] ) : '' ;
			
			if( $facebook || $twitter || $pinterest || $linkedin || $googleplus || $instagram || $youtube || $tiktok ){ 
			echo $args['before_widget'];
			echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
			?>
				<ul class="social-networks">
					<?php if( $facebook ){ ?>
					<li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'benevolent' ); ?>" ><i class="fa fa-facebook"></i></a></li>
					<?php } if( $twitter ){ ?>
					<li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'benevolent' ); ?>" ><i class="fab fa-x-twitter"></i></a></li>
					<?php } if( $pinterest ){ ?>
					<li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" title="<?php esc_attr_e( 'Pinterest', 'benevolent' ); ?>" ><i class="fa fa-pinterest-p"></i></a></li>
					<?php } if( $linkedin ){ ?>
					<li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" title="<?php esc_attr_e( 'Linkedin', 'benevolent' ); ?>" ><i class="fa fa-linkedin"></i></a></li>
					<?php } if( $googleplus ){ ?>
					<li><a href="<?php echo esc_url( $googleplus ); ?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'benevolent' ); ?>" ><i class="fa fa-google-plus"></i></a></li>
					<?php } if( $instagram ){ ?>
					<li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'benevolent' ); ?>"><i class="fa fa-instagram"></i></a></li>
					<?php } if( $youtube ){ ?>
					<li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank" title="<?php esc_attr_e( 'YouTube', 'benevolent' ); ?>" ><i class="fa fa-youtube"></i></a></li>
					<?php } if( $tiktok ){ ?>
					<li><a href="<?php echo esc_url( $tiktok ); ?>" target="_blank" title="<?php esc_attr_e( 'Tiktok', 'benevolent' ); ?>" ><i class="fab fa-tiktok"></i></a></li>
					<?php } ?>
				</ul>
			<?php
			echo $args['after_widget'];
			}
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			
			$title      = ! empty( $instance['title'] ) ? strip_tags( $instance['title'] ) : __( 'Subscribe & Follow', 'benevolent' );		
			$facebook   = ! empty( $instance['facebook'] ) ? esc_url( $instance['facebook'] ) : '' ;
			$twitter    = ! empty( $instance['twitter'] ) ? esc_url( $instance['twitter'] ) : '' ;
			$pinterest  = ! empty( $instance['pinterest'] ) ? esc_url( $instance['pinterest'] ) : '' ;
			$linkedin   = ! empty( $instance['linkedin'] ) ? esc_url( $instance['linkedin'] ) : '' ;
			$googleplus = ! empty( $instance['google_plus'] ) ? esc_url( $instance['google_plus'] ) : '' ;
			$instagram  = ! empty( $instance['instagram'] ) ? esc_url( $instance['instagram'] ) : '' ;
			$youtube    = ! empty( $instance['youtube'] ) ? esc_url( $instance['youtube'] ) : '' ;
			$tiktok    	= ! empty( $instance['tiktok'] ) ? esc_url( $instance['tiktok'] ) : '' ;
			
			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php _e( 'Facebook', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_url( $facebook ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php _e( 'Twitter', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_url( $twitter ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php _e( 'Pinterest', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_url( $pinterest ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php _e( 'LinkedIn', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_url( $linkedin ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>"><?php _e( 'Google Plus', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_plus' ) ); ?>" type="text" value="<?php echo esc_url( $googleplus ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php _e( 'Instagram', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_url( $instagram ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php _e( 'YouTube', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_url( $youtube ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'tiktok' ) ); ?>"><?php _e( 'Tiktok', 'benevolent' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tiktok' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tiktok' ) ); ?>" type="text" value="<?php echo esc_url( $tiktok ); ?>" />
			</p>
			<?php 
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			
			$instance = array();
			
			$instance['title']      = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : __( 'Subscribe & Follow', 'benevolent' );
			$instance['facebook']   = ! empty( $new_instance['facebook'] ) ? esc_url_raw( $new_instance['facebook'] ) : '';
			$instance['twitter']    = ! empty( $new_instance['twitter'] ) ? esc_url_raw( $new_instance['twitter'] ) : '';
			$instance['pinterest']  = ! empty( $new_instance['pinterest'] ) ? esc_url_raw( $new_instance['pinterest'] ) : '';
			$instance['linkedin']   = ! empty( $new_instance['linkedin'] ) ? esc_url_raw( $new_instance['linkedin'] ) : '';
			$instance['google_plus']= ! empty( $new_instance['google_plus'] ) ? esc_url_raw( $new_instance['google_plus'] ) : '';
			$instance['instagram']  = ! empty( $new_instance['instagram'] ) ? esc_url_raw( $new_instance['instagram'] ) : '';
			$instance['youtube']    = ! empty( $new_instance['youtube'] ) ? esc_url_raw( $new_instance['youtube'] ) : '';
			$instance['tiktok']    	= ! empty( $new_instance['tiktok'] ) ? esc_url_raw( $new_instance['tiktok'] ) : '';
			
			return $instance;
					
		}

	} // class Benevolent_Social_Links 
}