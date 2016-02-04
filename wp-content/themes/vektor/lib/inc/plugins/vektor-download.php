<?php

add_action('generate_rewrite_rules', 'vd_rewrite_urls');

function the_download_attachment_url($attachment_id) {
	echo esc_url(get_vektor_download_attachment_url($attachment_id));
}
function get_the_download_attachment_url($attachment_id = -1) {
	if(empty($attachment_id) || $attachment_id == -1) {
		return '';
	}
	
	$content = wp_get_attachment_url($attachment_id);
	
	// The content_url + upload path
	$content_pre = content_url( '/' );
	// Supplied URL
	$content = esc_url( $content );

	// Remove content_url + upload path from the supplied URL
	$content = str_replace( $content_pre . vd_uploads_path( '/' ), '', $content );

	$url = home_url( '/' ) . vd_download_path( '/' ) . $content;
	
	return $url;
}

function vd_append_path( $path = '' ) {
	if ( ! empty( $path ) && is_string( $path ) && strpos( $path, '..' ) === false ) {
		$path = '/' . ltrim( $path, '/' );
	}
	return $path;
}

function vd_download_path( $path = '' ) {
	return 'download' . vd_append_path($path);
}

function vd_uploads_path( $path = '' ) {
	$upload_dir = wp_upload_dir();
	$upload_path = str_replace( content_url( '/' ), '', $upload_dir['baseurl'] );

	return $upload_path . vd_append_path( $path );
}

function vd_optional_subdir() {
	if ( site_url() != home_url() ) {
		return str_replace( home_url( '/' ), '', site_url( '/' ) );
	}
}

function vd_rewrite_urls( $wp_rewrite ) {
	$home_url = home_url('/');
	$force_download_url = get_template_directory_uri() . '/lib/inc/plugins/force-download.php';
	$wp_content_force_download_url = str_replace($home_url, '', $force_download_url);
	
	
	$wp_rewrite->add_external_rule( 
		sprintf( '%s/(.+)$', vd_download_path() ),
		sprintf( '%1$s' . $wp_content_force_download_url . '?file=%2$s/$1', vd_optional_subdir(), vd_uploads_path() )
	);
}