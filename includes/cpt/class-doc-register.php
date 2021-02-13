<?php
/**
 * SMJUBER Doc register post type and taxonomy
 */

if ( ! class_exists( 'Smjuber_Doc_Register' ) ) {

	class Smjuber_Doc_Register{

		public function __construct(){
			add_action( 'init', array( $this, 'smjuber_doc_remove_comment' ) );
			add_action( 'init', array( $this, 'smjuber_doc_register_post_type' ) );
			add_action( 'init', array( $this, 'smjuber_doc_register_taxonomy' ) );
			add_action( 'add_meta_boxes', array( $this, 'smjuber_doc_meta_box' ) );
			add_action( 'save_post', array( $this, 'smjuber_doc_save_meta_box' ),  10, 2 );
		}

		/**
		 * Remove Doc post type comment support
		 */
		public function smjuber_doc_remove_comment() {
		    remove_post_type_support( 'doc', 'comments' );
		}

		/**
		 * Register Doc post type
		 */
		public function smjuber_doc_register_post_type() {
			register_post_type( 'doc', array(
				'labels'					=>	array(
					'name'                  => esc_html_x( 'Docs', 'Post Type General Name', 'smjuber-ext' ),
					'singular_name'         => esc_html_x( 'Doc', 'Post Type Singular Name', 'smjuber-ext' ),
					'menu_name'             => esc_html__( 'Docs', 'smjuber-ext' ),
					'name_admin_bar'        => esc_html__( 'Docs', 'smjuber-ext' ),
					'archives'              => esc_html__( 'Doc Archives', 'smjuber-ext' ),
					'parent_item_colon'     => esc_html__( 'Parent Doc:', 'smjuber-ext' ),
					'all_items'             => esc_html__( 'All Docs', 'smjuber-ext' ),
					'add_new_item'          => esc_html__( 'Add New Doc', 'smjuber-ext' ),
					'add_new'               => esc_html__( 'Add New', 'smjuber-ext' ),
					'new_item'              => esc_html__( 'New Doc', 'smjuber-ext' ),
					'edit_item'             => esc_html__( 'Edit Doc', 'smjuber-ext' ),
					'update_item'           => esc_html__( 'Update Doc', 'smjuber-ext' ),
					'view_item'             => esc_html__( 'View Doc', 'smjuber-ext' ),
					'search_items'          => esc_html__( 'Search Doc', 'smjuber-ext' ),
					'not_found'             => esc_html__( 'Not found', 'smjuber-ext' ),
					'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'smjuber-ext' ),
					'featured_image'        => esc_html__( 'Featured Image', 'smjuber-ext' ),
					'set_featured_image'    => esc_html__( 'Set featured image', 'smjuber-ext' ),
					'remove_featured_image' => esc_html__( 'Remove featured image', 'smjuber-ext' ),
					'use_featured_image'    => esc_html__( 'Use as featured image', 'smjuber-ext' ),
					'insert_into_item'      => esc_html__( 'Insert into item', 'smjuber-ext' ),
					'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'smjuber-ext' ),
					'items_list'            => esc_html__( 'Docs list', 'smjuber-ext' ),
					'items_list_navigation' => esc_html__( 'Docs list navigation', 'smjuber-ext' ),
					'filter_items_list'     => esc_html__( 'Filter docs list', 'smjuber-ext' ),
				),
				'description'   			=> esc_html__( 'Doc List', 'smjuber-ext'),
				'public'        			=> true,
				'publicly_queryable' 		=> true,
				'show_in_rest'				=> true,
				'show_ui' 					=> true,
				'show_in_menu' 				=> true,
				'show_in_admin_bar'     	=> true,
				'show_in_nav_menus'     	=> true,
				'show_admin_column' 		=> true,
			    'query_var' 				=> true,
			    'has_archive' 				=> true,
			    'hierarchical' 				=> true,
				'menu_position' 			=> null,
				'exclude_from_search' 		=> false,
				'capability_type' 			=> 'post',
				'menu_icon' 				=> 'dashicons-media-document',
				'rewrite'       			=> array( 'slug' => 'doc' ),
				'supports'      			=> array( 'title', 'editor', 'thumbnail', 'revisions', )
			) );
		} 

		/**
		 * Register Doc taxonomy
		 */
		public function smjuber_doc_register_taxonomy() {
			register_taxonomy( 'doc-type', 'doc', array(
				'labels'					=>	array(
					'name'                       => esc_html_x( 'Doc Types', 'Taxonomy General Name', 'smjuber-ext' ),
					'singular_name'              => esc_html_x( 'Doc Type', 'Taxonomy Singular Name', 'smjuber-ext' ),
					'menu_name'                  => esc_html__( 'Doc Types', 'smjuber-ext' ),
					'all_items'                  => esc_html__( 'All Doc Types', 'smjuber-ext' ),
					'parent_item'                => esc_html__( 'Parent Doc Type', 'smjuber-ext' ),
					'parent_item_colon'          => esc_html__( 'Parent Doc Type:', 'smjuber-ext' ),
					'new_item_name'              => esc_html__( 'New Doc Type Name', 'smjuber-ext' ),
					'add_new_item'               => esc_html__( 'Add New Doc Type', 'smjuber-ext' ),
					'edit_item'                  => esc_html__( 'Edit Doc Type', 'smjuber-ext' ),
					'update_item'                => esc_html__( 'Update Doc Type', 'smjuber-ext' ),
					'view_item'                  => esc_html__( 'View Doc Type', 'smjuber-ext' ),
					'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'smjuber-ext' ),
					'add_or_remove_items'        => esc_html__( 'Add or remove items', 'smjuber-ext' ),
					'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'smjuber-ext' ),
					'popular_items'              => esc_html__( 'Popular Doc Types', 'smjuber-ext' ),
					'search_items'               => esc_html__( 'Search Doc Types', 'smjuber-ext' ),
					'not_found'                  => esc_html__( 'Not Found', 'smjuber-ext' ),
					'no_terms'                   => esc_html__( 'No items', 'smjuber-ext' ),
					'items_list'                 => esc_html__( 'Doc Types list', 'smjuber-ext' ),
					'items_list_navigation'      => esc_html__( 'Doc Types list navigation', 'smjuber-ext' ),
				),
				'public'					=> true,
				'show_in_rest'				=> true,
				'show_ui'					=> true,
				'show_in_nav_menus'         => true,
				'show_admin_column'         => true,
				'query_var' 				=> true,
				'hierarchical'				=> true,
				'show_tagcloud'				=> false,
				'rewrite' 					=> array( 'slug' => 'doc-type' ),
			) );
		}

		/**
		 * Add Doc meta box
		 */
		public function smjuber_doc_meta_box() {
			
			add_meta_box(
				'smjuber_doc_metabox',
				'Doc Meta Data',
				array( $this, 'smjuber_doc_render_meta_box' ),
				'doc',
				'normal',
				'high',
				array(
			        '__block_editor_compatible_meta_box' => true,
			    ),
			);
		}

		/**
		 * Doc meta box HTML output
		 */
		function smjuber_doc_render_meta_box( $post ) {

			$smjuber_doc_meta_field = get_post_custom( $post->ID );
			$smjuber_doc_version = ! isset( $smjuber_doc_meta_field['theme_version'][0] ) ? '' : $smjuber_doc_meta_field['theme_version'][0];
			$smjuber_doc_short_details = ! isset( $smjuber_doc_meta_field['theme_short_details'][0] ) ? '' : $smjuber_doc_meta_field['theme_short_details'][0];
			$smjuber_doc_author = ! isset( $smjuber_doc_meta_field['theme_author'][0] ) ? '' : $smjuber_doc_meta_field['theme_author'][0];
			$smjuber_doc_update = ! isset( $smjuber_doc_meta_field['theme_update'][0] ) ? '' : $smjuber_doc_meta_field['theme_update'][0];
			$smjuber_doc_copyright_year = ! isset( $smjuber_doc_meta_field['theme_copyright_year'][0] ) ? '' : $smjuber_doc_meta_field['theme_copyright_year'][0];

			wp_nonce_field( basename( __FILE__ ), 'smjuber_doc_metabox' ); ?>

			<table class="form-table">

				<tr>
					<td class="team_meta_box_td" colspan="2">
						<label for="theme_version"><?php esc_html_e( 'Version', 'smjuber-ext' ); ?>
						</label>
					</td>
					<td colspan="4">
						<input type="text" name="theme_version" class="regular-text" value="<?php echo $smjuber_doc_version; ?>">
					</td>
				</tr>

				<tr>
					<td class="team_meta_box_td" colspan="2">
						<label for="theme_short_details"><?php esc_html_e( 'Short Details', 'smjuber-ext' ); ?>
						</label>
					</td>
					<td colspan="4">
						<input type="text" name="theme_short_details" class="regular-text" value="<?php echo $smjuber_doc_short_details; ?>">
					</td>
				</tr>

				<tr>
					<td class="team_meta_box_td" colspan="2">
						<label for="theme_author"><?php esc_html_e( 'Author', 'smjuber-ext' ); ?>
						</label>
					</td>
					<td colspan="4">
						<input type="text" name="theme_author" class="regular-text" value="<?php echo $smjuber_doc_author; ?>">
					</td>
				</tr>

				<tr>
					<td class="team_meta_box_td" colspan="2">
						<label for="theme_update"><?php esc_html_e( 'Updated', 'smjuber-ext' ); ?>
						</label>
					</td>
					<td colspan="4">
						<input type="text" name="theme_update" class="regular-text" value="<?php echo $smjuber_doc_update; ?>">
					</td>
				</tr>

				<tr>
					<td class="team_meta_box_td" colspan="2">
						<label for="theme_copyright_year"><?php esc_html_e( 'Copyright Year', 'smjuber-ext' ); ?>
						</label>
					</td>
					<td colspan="4">
						<input type="text" name="theme_copyright_year" class="regular-text" value="<?php echo $smjuber_doc_copyright_year; ?>">
					</td>
				</tr>

			</table>

		<?php 
		}

		/**
		 * Doc save meta box
		 */
		function smjuber_doc_save_meta_box( $post_id ) {

			global $post;

			// Verify nonce
			if ( !isset( $_POST['smjuber_doc_metabox'] ) || !wp_verify_nonce( $_POST['smjuber_doc_metabox'], basename(__FILE__) ) ) {
				return $post_id;
			}

			// Check Autosave
			if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) {
				return $post_id;
			}

			// Don't save if only a revision
			if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
				return $post_id;
			}

			// Check permissions
			if ( !current_user_can( 'edit_post', $post->ID ) ) {
				return $post_id;
			}

			$smjuber_doc_meta_field['theme_version'] = ( isset( $_POST['theme_version'] ) ? esc_textarea( $_POST['theme_version'] ) : '' );

			$smjuber_doc_meta_field['theme_short_details'] = ( isset( $_POST['theme_short_details'] ) ? esc_textarea( $_POST['theme_short_details'] ) : '' );

			$smjuber_doc_meta_field['theme_author'] = ( isset( $_POST['theme_author'] ) ? esc_textarea( $_POST['theme_author'] ) : '' );

			$smjuber_doc_meta_field['theme_update'] = ( isset( $_POST['theme_update'] ) ? esc_textarea( $_POST['theme_update'] ) : '' );

			$smjuber_doc_meta_field['theme_copyright_year'] = ( isset( $_POST['theme_copyright_year'] ) ? esc_textarea( $_POST['theme_copyright_year'] ) : '' );

			foreach ( $smjuber_doc_meta_field as $key => $value ) {
				update_post_meta( $post->ID, $key, $value );
			}
		}

	}

	new Smjuber_Doc_Register();

}