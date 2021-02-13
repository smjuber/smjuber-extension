<?php
/**
 * Custom widget class ( Latest Post )
 */

if( ! class_exists( 'Smjuber_Extension_Latest_Post_Widget' ) ) :

class Smjuber_Extension_Latest_Post_Widget extends WP_Widget {
	public	function __construct() {
		parent::__construct(
			'Smjuber_Extension_Latest_Post_Widget',
			esc_html__( 'Smjuber :: Latest Post', 'smjuber-ext' ),
			array( 
				'classname' => 'smjuber-ext-widget-latest-post',
				'description' => esc_html__( 'Display recently published post with post image and date.', 'smjuber-ext' ),
				'customize_selective_refresh' => true,
				 ) );
	}
	
	/*
	 * Widget
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$smjuber_ext_title = apply_filters( 'widget_title', $instance['title'] );
		$smjuber_ext_categories = $instance['categories'];
		$smjuber_ext_count = $instance['count'];
		$args = array(
			'cat'					=>	$smjuber_ext_categories,
			'showposts' 			=>  $smjuber_ext_count,
			'nopaging' 				=> 	0, 
			'post_status' 			=> 	'publish',
			'ignore_sticky_posts' 	=> 	1,
		);
		$smjuber_ext_query = new WP_Query($args);
		echo wp_kses_post( $before_widget );
		if ( ! empty( $smjuber_ext_title ) ) {
                echo wp_kses_post( $before_title . $smjuber_ext_title . $after_title );
            } ?>
		<!-- Latest post -->
		<div class="latest-post-widget">
			<ol class="latest-post-widget-wrapper">
				<?php if ( $smjuber_ext_query->have_posts() ) : 
					while ( $smjuber_ext_query->have_posts() ) : $smjuber_ext_query->the_post(); ?>
					<li><!-- post -->
						<?php if( has_post_thumbnail() ) : ?>
							<div class="latest-post-thumbnail">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>">
									<?php the_post_thumbnail( 'medium' ); ?>		
								</a>
							</div>
						<?php endif; ?>
							<div class="latest-post-content">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>">
									<?php the_title();?>
								</a>
								<span>
									<?php the_time( get_option( 'date_format' ) );?>
								</span>
							</div>
					</li><!-- end post -->
				<?php endwhile; else: ?>
					<p><?php  esc_html_e('No posts were found, please create post.','smjuber-ext');?></p>
				<?php endif; 
				wp_reset_postdata();
				?>
			</ol>
		</div>
	<?php 
	echo wp_kses_post( $after_widget );
	}

	/*
	 * Form
	 */
	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'categories' => '',
			'count' => 5,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
    	<!-- Title -->
    	<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'smjuber-ext' ); ?></label>
    	<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
		<!-- Category -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php esc_html_e( 'Filter by Category:', 'smjuber-ext'); ?></label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>">
			<option value="<?php echo esc_attr( 'all' ); ?>" <?php if ( 'all' == $instance['categories'] ) echo 'selected'; ?>><?php esc_html_e( 'All categories', 'smjuber-ext' ); ?></option>
			<?php 
			$smjuber_ext_category_args = array(
				'type'				=> 'post',
				'hide_empty'		=> 1,
				'depth'				=> 1,
				'taxonomy'			=> 'category'
			);
			$smjuber_ext_categories = get_categories( $smjuber_ext_category_args );
			?>
			<?php foreach( $smjuber_ext_categories as $smjuber_ext_category ) : ?>
			<option value='<?php echo esc_attr( $smjuber_ext_category->term_id ); ?>' <?php if ( $smjuber_ext_category->term_id == $instance['categories'] ) echo 'selected'; ?>><?php echo esc_html_e( $smjuber_ext_category->cat_name ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>
		<!-- Count -->
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'smjuber-ext' );?></label>
		<input type="number" class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>" step="1" min="1" /></p>
        <?php 
	}

	/*
	 * Update
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['categories'] = ( !empty( $new_instance['categories'] ) ) ? strip_tags( $new_instance['categories'] ) : '';
		$instance['count'] = ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
		return $instance;
	}
}
endif;