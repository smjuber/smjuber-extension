<?php
/**
 * Author Social filter
 */

if ( ! class_exists( 'Smjuber_Extension_Author_Social_links' ) ) {
    
    class Smjuber_Extension_Author_Social_links {

        function __construct() {
            add_filter('user_contactmethods', array( $this, 'smjuber_ext_author_social_method' ) ,10 ,1);
        }

        public function smjuber_ext_author_social_method( $smjuber_ext_author_social_link ) {
        
            $smjuber_ext_author_social_link['500px'] = esc_html__( '500px' , 'smjuber-ext');
            $smjuber_ext_author_social_link['behance'] = esc_html__( 'Behance' , 'smjuber-ext');
            $smjuber_ext_author_social_link['bloglovin'] = esc_html__( 'Bloglovin' , 'smjuber-ext');
            $smjuber_ext_author_social_link['codepen'] = esc_html__( 'Codepen' , 'smjuber-ext');
            $smjuber_ext_author_social_link['dribbble'] = esc_html__( 'Dribbble' , 'smjuber-ext');
            $smjuber_ext_author_social_link['facebook'] = esc_html__( 'Facebook' , 'smjuber-ext');
            $smjuber_ext_author_social_link['flickr'] = esc_html__( 'Flickr' , 'smjuber-ext');
            $smjuber_ext_author_social_link['github'] = esc_html__( 'Github', 'smjuber-ext');
            $smjuber_ext_author_social_link['instagram'] = esc_html__( 'Instagram', 'smjuber-ext');
            $smjuber_ext_author_social_link['linkedin'] = esc_html__( 'Linkedin', 'smjuber-ext');
            $smjuber_ext_author_social_link['medium'] = esc_html__( 'Medium', 'smjuber-ext');
            $smjuber_ext_author_social_link['meetup'] = esc_html__( 'Meetup', 'smjuber-ext');
            $smjuber_ext_author_social_link['mixcloud'] = esc_html__( 'Mixcloud', 'smjuber-ext');
            $smjuber_ext_author_social_link['pinterest'] = esc_html__( 'Pinterest', 'smjuber-ext');
            $smjuber_ext_author_social_link['quora'] = esc_html__( 'Quora', 'smjuber-ext');
            $smjuber_ext_author_social_link['reddit'] = esc_html__( 'Reddit', 'smjuber-ext');
            $smjuber_ext_author_social_link['soundcloud'] = esc_html__( 'Soundcloud', 'smjuber-ext');
            $smjuber_ext_author_social_link['stackoverflow'] = esc_html__( 'Stackoverflow', 'smjuber-ext');
            $smjuber_ext_author_social_link['tumblr'] = esc_html__( 'Tumblr', 'smjuber-ext');
            $smjuber_ext_author_social_link['twitter'] = esc_html__( 'Twitter', 'smjuber-ext');
            $smjuber_ext_author_social_link['vimeo'] = esc_html__( 'Vimeo', 'smjuber-ext');
            $smjuber_ext_author_social_link['vk'] = esc_html__( 'Vk', 'smjuber-ext');
            $smjuber_ext_author_social_link['wordpress'] = esc_html__( 'Wordpress', 'smjuber-ext');
            $smjuber_ext_author_social_link['youtube'] = esc_html__( 'Youtube', 'smjuber-ext');
            $smjuber_ext_author_social_link['mailto'] = esc_html__( 'Mail ID', 'smjuber-ext');
            $smjuber_ext_author_social_link['feed'] = esc_html__( 'RSS', 'smjuber-ext');
            
            return $smjuber_ext_author_social_link;
        }

    }

    new Smjuber_Extension_Author_Social_links;
}