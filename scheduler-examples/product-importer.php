<?php

namespace SandboxScheduler;

use SandboxLogger\Logger;
use WC_Product_Simple;

require __DIR__ . '/../logger-examples/class-logger.php';

add_action( 'import_products_action', __NAMESPACE__ . '\import_products' );

function import_products( $batch ) {

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
