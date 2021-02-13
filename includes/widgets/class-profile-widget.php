<?php
/**
 * Custom widget class ( Profile ) 
 */

if ( ! class_exists( 'Smjuber_Extension_Profile_Widget' ) ) :

class Smjuber_Extension_Profile_Widget extends WP_Widget {
    public	function __construct() {
		parent::__construct(
			'Smjuber_Extension_Profile_Widget', 
			esc_html__( 'Smjuber :: Profile', 'smjuber-ext' ),
			array( 
				'classname' => 'smjuber-ext-widget-profile', 
				'description' => esc_html__( 'Author or company short profile widget with image, description and signature', 'smjuber-ext' ),
				'customize_selective_refresh' => true, ) );
	}

	/*
	 * Widget
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$smjuber_ext_title = apply_filters( 'widget_title', $instance['title'] );
		$smjuber_ext_profile_image = $instance['profile_image'];
		$smjuber_ext_profile_detials = $instance['profile_details'];
		$smjuber_ext_profile_page = $instance['profile_page'];
		$smjuber_ext_profile_signature = $instance['profile_signature'];
		echo wp_kses_post( $before_widget );
		if ( ! empty( $smjuber_ext_title ) ) {
                echo wp_kses_post( $before_title . $smjuber_ext_title . $after_title );
            } ?>
			<div class="profile-widget">
				<div class="profile-image">
					<a href="<?php echo esc_url( $smjuber_ext_profile_page );?>">
						<img src="<?php echo esc_url( $smjuber_ext_profile_image ); ?>" alt>
					</a>
				</div>
				<div class="profile-details">
					<p><?php esc_html_e( $smjuber_ext_profile_detials, 'smjuber-ext'); ?></p>
					<?php if( $smjuber_ext_profile_signature == true ) : ?>
						<img src="<?php echo esc_url( $smjuber_ext_profile_signature ); ?>" alt>
					<?php endif; ?>
				</div>
			</div>
		<?php echo wp_kses_post( $after_widget );
	}

	/*
	 * Form
	 */
	public function form( $instance ) {
		$defaults = array( 
			'title' => '', 
			'profile_image' => '',
			'profile_details' => '',
			'profile_page' => '',
			'profile_signature' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Title -->
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'smjuber-ext' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
		<!-- Profile image URL -->
		<p><label for="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>"><?php esc_html_e( 'Profile image URL:', 'smjuber-ext' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'profile_image' )); ?>" type="text" value="<?php echo esc_attr( $instance['profile_image'] ); ?>" /></p>
		<!-- Profile description -->
		<p><label for="<?php echo esc_attr($this->get_field_id( 'profile_details' )); ?>"><?php esc_html_e( 'Describe more details:', 'smjuber-ext' ); ?></label>
		<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'profile_details' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'profile_details' ) ); ?>" rows="8" cols="20"><?php echo esc_attr( $instance['profile_details'] ); ?></textarea></p>
		<!-- Profile page URL -->
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'profile_page' ) ); ?>"><?php esc_html_e( 'Profile page URL:', 'smjuber-ext' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'profile_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'profile_page' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['profile_page'] ); ?>" /></p>
		<!-- Profile signature image URL -->
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'profile_signature' ) ); ?>"><?php esc_html_e( 'Profile signature image URL:', 'smjuber-ext' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'profile_signature' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'profile_signature' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['profile_signature'] ); ?>" /></p>
		<?php
	}

	/*
	 * Update
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['profile_image'] = ( !empty( $new_instance['profile_image'] ) ) ? strip_tags( $new_instance['profile_image'] ) : '';
		$instance['profile_details'] = ( !empty( $new_instance['profile_details'] ) ) ? strip_tags( $new_instance['profile_details'] ) : '';
		$instance['profile_page'] = ( !empty( $new_instance['profile_page'] ) ) ? strip_tags( $new_instance['profile_page'] ) : '';
		$instance['profile_signature'] = ( !empty( $new_instance['profile_signature'] ) ) ? strip_tags( $new_instance['profile_signature'] ) : '';
		return $instance;
	}	
} 
endif;