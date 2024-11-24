<?php

namespace SandboxScheduler;

use SandboxLogger\Logger;
use WC_Product_Simple;

require __DIR__ . '/../logger-examples/class-logger.php';

add_action( 'import_products_action', __NAMESPACE__ . '\import_products' );

function import_products( $batch ) {

	$result = wp_remote_get( 'https://fakestoreapi.com/products' );

	if ( is_wp_error( $result ) ) {
		Logger::error( 'Error importing products: ' . $result->get_error_message(), array( 'source' => 'product-import' ) );

		as_schedule_single_action( strtotime( 'now + 5 minutes' ), 'import_products_action', array( $batch ) );
		return;
	}

	if ( 200 !== wp_remote_retrieve_response_code( $result ) ) {
		Logger::error( 'Error importing products: ' . wp_remote_retrieve_response_message( $result ), array( 'source' => 'product-import' ) );

		as_schedule_single_action( strtotime( 'now + 5 minutes' ), 'import_products_action', array( $batch ) );
		return;
	}

	$body = wp_remote_retrieve_body( $result );

	$products = json_decode( $body, true );

	Logger::info(
		'Products data from batch ' . $batch,
		array(
			'source'   => 'product-import',
			'products' => $products,
		)
	);

	for ( $i = 1; $i <= 10; $i++ ) {
		$product = new WC_Product_Simple();

		// Set product data.
		$no = $i + ( $batch - 1 ) * 10;
		$product->set_name( "Product $no from batch $batch" );
		$product->set_regular_price( wp_rand( 10, 100 ) );
		$product->set_description( 'Full description' );
		$product->set_short_description( 'Short description' );

		$product_id = $product->save();
		sleep( 1 );

		Logger::info( "Product no: $no from batch: $batch imported as Product_ID: $product_id ", array( 'source' => 'product-import' ) );
	}

	if ( $batch >= 3 ) {
		return;
	}

	as_schedule_single_action( time(), 'import_products_action', array( $batch + 1 ) );

}
