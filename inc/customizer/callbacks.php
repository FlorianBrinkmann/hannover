<?php
/**
 * Customizer callback functions.
 *
 * @version 2.0.0
 *
 * @package Hannover
 */

/**
 * Sanitize integer.
 *
 * @link https://make.wordpress.org/core/2016/07/05/customizer-apis-in-4-6-for-setting-validation-and-notifications/
 *
 * @param string $value The input value.
 *
 * @return WP_Error|null|integer
 */
function hannover_sanitize_absint( $value ) {
	$can_validate = method_exists( 'WP_Customize_Setting', 'validate' );
	if ( ! is_numeric( $value ) ) {
		return $can_validate ? new WP_Error( 'nan', __( 'This is not a number', 'hannover' ) ) : null;
	}

	return absint( $value );
}

/**
 * Checkbox sanitization callback.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes
 * `$checked` as a boolean value, either TRUE or FALSE.
 *
 * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @param bool $checked Whether the checkbox is checked.
 *
 * @return bool Whether the checkbox is checked.
 */
function hannover_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Drop-down Pages sanitization callback.
 *
 * - Sanitization: dropdown-pages
 * - Control: dropdown-pages
 *
 * Sanitization callback for 'dropdown-pages' type controls. This callback
 * sanitizes `$page_id` as an absolute integer, and then validates that $input
 * is the ID of a published page.
 *
 * @see  absint() https://developer.wordpress.org/reference/functions/absint/
 * @see  get_post_status()
 *       https://developer.wordpress.org/reference/functions/get_post_status/
 *
 * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @param int                  $page_id Page ID.
 * @param WP_Customize_Setting $setting Setting instance.
 *
 * @return int|string Page ID if the page is published; otherwise, the setting
 *                    default.
 */
function hannover_sanitize_dropdown_pages( $page_id, $setting ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $page_id );

	$post_status = get_post_status( $page_id );

	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	return ( 'publish' === $post_status || 'auto-draft' === $post_status ? $page_id : $setting->default );
}


/**
 * Select sanitization callback for categories select control.
 *
 * @param string $input Value of select field.
 *
 * @return string
 */
function hannover_sanitize_categories_select( $input ) {
	$can_validate = method_exists( 'WP_Customize_Setting', 'validate' );

	$term = get_term( $input );

	if ( 'category' !== $term->taxonomy ||  is_wp_error( $term ) || null === $term ) {
		return $can_validate ? new WP_Error( 'nan', __( 'The ID does not match a category.', 'hannover' ) ) : null;
	}

	return $input;
}
