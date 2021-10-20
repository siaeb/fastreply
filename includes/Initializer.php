<?php


namespace siaeb\fastreply\includes;


class Initializer {

	public function __construct() {
		// Register plugin options
		add_action( 'cmb2_admin_init', [ $this, 'registerOptions' ], 11 );
	}

	/**
	 * Register option page
	 *
	 * @since 1.0
	 */
	public function registerOptions() {
		/**
		 * Registers options page menu item and form.
		 */
		$cmb_options = new_cmb2_box( array(
			'id'           => 'fast_reply_options_box',
			'title'        => esc_html__( 'متون آماده', 'fast-reply' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'fast_reply_options',
			'menu_title'   => esc_html__( 'متون آماده', 'fast-reply' ),
			'parent_slug'  => 'options-general.php',
			'capability'   => 'manage_options',
		) );

		$cmb_options->add_field( [
			'id'   => 'options_title',
			'type' => 'title',
		] );

		// Options fields IDs only need to be unique within this box. Prefix is not needed.
		$template = $cmb_options->add_field( [
			'id'         => 'templates',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'   => esc_html__( 'متن آماده {#}', 'fast-reply' ),
				'add_button'    => 'افزودن',
				'remove_button' => 'حذف',
				'closed'        => true,  // Repeater fields closed by default as page would otherwise be very long.
				'sortable'      => true,
			),
		] );
		$cmb_options->add_group_field( $template, [
			'name'       => esc_html__( 'عنوان دکمه', "fast-reply" ),
			'id'         => 'title',
			'type'       => 'text',
			'attributes' => [
				'required' => 'required',
			],
		] );
		$cmb_options->add_group_field( $template, [
			'name'       => __( 'متن', 'fast-reply' ),
			'desc'       => __( 'متن را بنویسید', 'fast-reply' ),
			'id'         => 'text',
			'type'       => 'wysiwyg',
			'attributes' => [
				'required' => 'required',
			],
		] );
	}

}
