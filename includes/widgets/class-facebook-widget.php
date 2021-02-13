<?php
/**
 * Custom widget class ( Facebook Page ) 
 */

if ( ! class_exists( 'Smjuber_Extension_Facebook_Widget' ) ) :

class Smjuber_Extension_Facebook_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'Smjuber_Extension_Facebook_Widget',
            esc_html__( 'Smjuber :: Facebook Page', 'smjuber-ext' ),
            array( 
                'classname'     =>   'smjuber-ext-widget-facebook',
                'description'   =>   esc_html__( 'Display Facebook page widget.', 'smjuber-ext' ) ) );
    }

    /*
     * Widget
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $smjuber_ext_title = apply_filters('widget_title', $instance['title'] );
        $smjuber_ext_href = $instance['href'];
        $smjuber_ext_small_header = ($instance['small_header'] == "1" ? "true" : "false");
        $smjuber_ext_hide_cover = ($instance['hide_cover'] == "1" ? "true" : "false");
        $smjuber_ext_show_facepile = ($instance['show_facepile'] == "1" ? "true" : "false");
        $smjuber_ext_show_post = ($instance['show_post'] == "1" ? "true" : "false");
        add_action('wp_footer', array($this,'smjuber_ext_fb_js'));
        echo wp_kses_post( $before_widget );
         if ( ! empty( $smjuber_ext_title ) ) {
                echo wp_kses_post( $before_title . $smjuber_ext_title . $after_title );
            }
        ?>
        <div class="fb-page"
            data-href="<?php echo esc_url( $smjuber_ext_href ); ?>"
            data-width="360"
            data-small-header="<?php echo esc_attr( $smjuber_ext_small_header ); ?>"
            data-hide-cover="<?php echo esc_attr( $smjuber_ext_hide_cover ); ?>"
            data-show-facepile="<?php echo esc_attr( $smjuber_ext_show_facepile ); ?>"
            data-show-posts="<?php echo esc_attr( $smjuber_ext_show_post ); ?>"
            data-adapt-container-width="true">
        </div>
        <?php echo wp_kses_post( $after_widget );
    }
    function smjuber_ext_fb_js() {
    echo '<div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, \'script\', \'facebook-jssdk\'));</script>';
    }

    /*
     * Form
     */
    public function form( $instance ) {
        $defaults = array(
            'title' => '',
            'href' => '',
            'small_header' => '',
            'hide_cover' => '',
            'show_facepile' => '',
            'show_post' => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <!-- Title -->
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'smjuber-ext' ) ?></label>
        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
        <!-- Page URL -->
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>"><?php esc_html_e('Type Facebook Page URL:', 'smjuber-ext') ?></label>
        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'href' ) ); ?>" value="<?php echo esc_attr( $instance['href'] ); ?>" /></p>
        <!-- Small header -->
        <p><input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'small_header' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'small_header' ) ); ?>" value="<?php echo esc_attr( '1' );?>" <?php echo esc_attr( $instance['small_header'] == "true" ? "checked" : "" ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'small_header' ) ); ?>"><?php esc_html_e('Small Header', 'smjuber-ext') ?></label>
        <br>
        <!-- Hide cover -->
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hide_cover' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_cover' ) ); ?>" value="<?php echo esc_attr( '1' );?>" <?php echo esc_attr( $instance['hide_cover'] == "true" ? "checked" : "" ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'hide_cover' ) ); ?>"><?php esc_html_e('Hide Cover', 'smjuber-ext') ?></label>
        <br>
        <!-- Show faces -->
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_facepile' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_facepile' ) ); ?>" value="<?php echo esc_attr( '1' );?>" <?php echo esc_attr( $instance['show_facepile'] == "true" ? "checked" : "" ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'show_facepile' ) ); ?>"><?php esc_html_e('Show Friend\'s Faces', 'smjuber-ext') ?></label>
        <br>
        <!-- Show stream -->
        <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_post' ) ); ?>" value="<?php echo esc_attr( '1' ); ?>" <?php echo esc_attr( $instance['show_post'] == "true" ? "checked" : "" ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"><?php esc_html_e('Show Stream', 'smjuber-ext') ?></label></p>
        <?php
    }

    /*
     * Update
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['href'] = ( !empty( $new_instance['href'] ) ) ? strip_tags( $new_instance['href'] ) : '';
        $instance['small_header'] = ( !empty( $new_instance['small_header'] ) ) ? (bool)$new_instance['small_header'] : '';
        $instance['hide_cover'] = ( !empty( $new_instance['hide_cover'] ) ) ? (bool)$new_instance['hide_cover'] : '';
        $instance['show_facepile'] = ( !empty( $new_instance['show_facepile'] ) ) ? (bool)$new_instance['show_facepile'] : '';
        $instance['show_post'] = ( !empty( $new_instance['show_post'] ) ) ? (bool)$new_instance['show_post'] : '';
        return $instance;
    }
}
endif;
