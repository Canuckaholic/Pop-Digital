<?php
/*
Plugin Name: WP-Table Reloaded Extensions
Plugin URI: http://tobias.baethge.com/wordpress-plugins/wp-table-reloaded-english/extensions/
Description: Custom Extensions for WP-Table Reloaded
Version: 1.0
Author: Adrian Jones, Tobias Baethge
*/
 
/**
 * Show only rows that match the "filter" parameter value/contained logical expression
 */
function wp_table_reloaded_filter_rows( $output_options, $table_id, $table ) {
    // early exit if no "filter" parameter given
    if ( empty( $output_options['filter'] ) )
        return $output_options;
 
    $filter = $output_options['filter']; // from the Shortcode parameter "filter"
 
    // &#038;&#038; is the passed value for &&
    if ( false !== strpos( $filter, '&#038;&#038;' ) ) {
        $compare = 'and';
        $filter = explode( '&#038;&#038;', $filter );
    } elseif ( false !== strpos( $filter, '||' ) ) {
        $compare = 'or';
        $filter = explode( '||', $filter );
    } else {
        $compare = 'none'; // single filter word
        $filter = array( $filter );
    }
 
    foreach ( $filter as $key => $string ) {
        // remove HTML entities and turn them into characters, escape/slash other characters
        $filter[ $key ] = addslashes( wp_specialchars_decode( $string, ENT_QUOTES, false, true ) );
    }
 
    $row_match = false;
    foreach ( $table['data'] as $row_idx => $row ) {
        if ( 0 == $row_idx && $output_options['first_row_th'] )
            continue;
 
        $found = array();
        foreach ( $filter as $key => $string ) {
            $found[ $key ] = in_array( $string, $row );
        }
 
        switch ( $compare ) {
            case 'none':
            case 'or':
                if ( in_array( true, $found ) ) // at least one word was found / only filter word was found
                    $row_match = true;
                else
                    $output_options['hide_rows'][] = (string)$row_idx;
                break;
            case 'and':
                if ( ! in_array( false, $found ) ) // if not (at least one word was *not* found) == all words were found
                    $row_match = true;
                else
                    $output_options['hide_rows'][] = (string)$row_idx;
                break;
        }
    }
 
    // if search term(s) was/were not found in any of the rows, all rows need to be hidden
    // but only if first row is used as table head
    if ( ! $row_match && $output_options['first_row_th'] ) {
        $row_idx = 0;
        $output_options['hide_rows'][] = (string)$row_idx;
    }
 
    return $output_options;
}
 
/**
 * Add "filter" as a valid parameter to the [table] Shortcode
 */
function wp_table_reloaded_shortcode_parameter_filter( $default_atts ) {
    $default_atts['filter'] = '';
    return $default_atts;
}
 
/**
 * Register necessary Plugin Filters
 */
add_filter( 'wp_table_reloaded_frontend_output_options', 'wp_table_reloaded_filter_rows', 10, 3 );
add_filter( 'wp_table_reloaded_shortcode_table_default_atts', 'wp_table_reloaded_shortcode_parameter_filter' );
 
?>

