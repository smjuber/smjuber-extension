<?php 
/**
 * Social share buttons shortcode
 */

if ( ! class_exists( 'Smjuber_Extension_Social_Share_Shortcode_Init' ) ) :

	class Smjuber_Extension_Social_Share_Shortcode_Init {

		function __construct() {
	        add_shortcode( 'smjuber_ext_social_share', array( $this, 'smjuber_ext_social_share_button' ) );
	    }

		public function smjuber_ext_get_image_src( $smjuber_ext_src_image_id, $smjuber_ext_src_image_size = 'large' ) {
				$smjuber_ext_img_attr = wp_get_attachment_image_src( intval( $smjuber_ext_src_image_id ), $smjuber_ext_src_image_size );
				if ( ! empty( $smjuber_ext_img_attr[0] ) ) {
					return $smjuber_ext_img_attr[0];
				}
			}

		public function smjuber_ext_social_share_button() {
			$smjuber_ext_social_thumbnail_id = get_post_thumbnail_id();
			$smjuber_ext_social_share_facebook = add_query_arg( array(
				'u' => get_the_permalink(),
			), 'https://www.facebook.com/sharer.php' );
			$smjuber_ext_social_share_twitter = add_query_arg( array(
				'url' => get_the_permalink(),
			), 'https://twitter.com/intent/tweet' );
			$smjuber_ext_social_share_pinterest = add_query_arg( array(
				'url'         => get_the_permalink(),
				'description' => get_the_title(),
				'media'       => $this->smjuber_ext_get_image_src( get_post_thumbnail_id(), 'large' ),
			), 'https://pinterest.com/pin/create/bookmarklet/' );
			$smjuber_ext_social_share_linkedin = add_query_arg( array(
				'url' => get_the_permalink(),
				'title' => get_the_title(),
			), 'https://www.linkedin.com/sharing/share-offsite/');
			$smjuber_ext_social_share_email = add_query_arg( array(
				'subject' => get_the_title(),
				'body' => get_the_permalink(),
			), 'mailto:?');

			?>
			<ul class="share-button">
				<li class="facebook-share"><a href="<?php echo esc_url( $smjuber_ext_social_share_facebook ); ?>" target="_blank" class="social-icon" title="Share on Facebook"><i class="fa fa-facebook-f"></i><span><?php esc_html_e( 'Facebook', 'smjuber-ext' ); ?></span></a></li>
				<li class="twitter-share"><a href="<?php echo esc_url( $smjuber_ext_social_share_twitter ); ?>" target="_blank" class="social-icon" title="Share on Twitter"><i class="fa fa-twitter"></i><span><?php esc_html_e( 'Twitter', 'smjuber-ext' ); ?></span></a></li>
				<?php if ( ! empty( $smjuber_ext_social_thumbnail_id ) ): ?>
					<li class="pinterest-share"><a href="<?php echo esc_url( $smjuber_ext_social_share_pinterest ); ?>" target="_blank" class="social-icon" title="Pin on Pinterest"><i class="fa fa-pinterest-p"></i><span><?php esc_html_e( 'Pinterest', 'smjuber-ext' ); ?></span></a></li>
				<?php endif; ?>
				<li class="linkedin-share"><a href="<?php echo esc_url( $smjuber_ext_social_share_linkedin ); ?>" target="_blank" class="social-icon" title="Share on Linkedin"><i class="fa fa-linkedin"></i><span><?php esc_html_e( 'LinkedIn', 'smjuber-ext' ); ?></span></a></li>
				<li class="email-share"><a href="<?php echo esc_url( $smjuber_ext_social_share_email ); ?>" target="_blank" class="social-icon" title="Share on Email"><i class="fa fa-envelope-o"></i><span><?php esc_html_e( 'Email', 'smjuber-ext' ); ?></span></a></li>
			</ul>
		<?php
			return;
		}
	}

	new Smjuber_Extension_Social_Share_Shortcode_Init;

endif;