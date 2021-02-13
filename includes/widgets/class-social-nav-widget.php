<?php
/**
 * Custom widget class ( Social Navigation Menu ) 
 */

if ( ! class_exists( 'Smjuber_Extension_Social_Nav_Widget' ) ) :

class Smjuber_Extension_Social_Nav_Widget extends WP_Widget {
    public	function __construct() {
		parent::__construct(
			'Smjuber_Extension_Social_Nav_Widget', 
			esc_html__( 'Smjuber :: Social Navigation Menu', 'smjuber-ext' ),
			array( 
				'classname' 	=> 'smjuber-ext-widget-social-nav', 
				'description' 	=> esc_html__( 'Social Navigation Widget', 'smjuber-ext' ),
				'customize_selective_refresh' => true, ) );
	}

	/*
	 * Widget
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$smjuber_ext_title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post( $before_widget );
		if ( ! empty( $smjuber_ext_title ) ) {
                echo wp_kses_post( $before_title . $smjuber_ext_title . $after_title );
            }
		if( has_nav_menu( 'social-sidebar' ) ) {
			wp_nav_menu( array(
               	'theme_location'	=> 'social-sidebar',
               	'depth'				=>	1,
               	'container'			=> 'div',
               	'container_class'	=> 'social-nav-menu',
               	'link_before'		=> '<span>',
               	'link_after'		=> '</span>'
           ) ); 
        }
		echo wp_kses_post( $after_widget );
	}

	/*
	 * From
	 */
	public function form( $instance ) {
		$defaults = array( 
			'title' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Title -->
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:','smjuber-ext'); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
        <?php if ( ! has_nav_menu( 'social' ) ) : ?>
        	<p>
            	<?php esc_html_e( 'Social menu is not set. Please create menu and assign it to Social Theme Location.', 'smjuber-ext' ); ?>
        	</p>
        <?php endif;
	}

	/*
	 * Update
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}	
} 
endif;