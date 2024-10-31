<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}

$module_files = glob( __DIR__ . '/modules/*/*.php' );

// Load custom Divi Builder modules.
foreach ( (array) $module_files as $module_file ) {
	if ( $module_file && preg_match( '/\/modules\/\b([^\/]+)\/class-[^-]+-(\w+)\.php$/', $module_file, $matches ) ) {
		$class_name = 'DIRM_' . ucwords( $matches[2] );
		require_once $module_file;
	}
}
