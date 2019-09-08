<?php
/**
 * Handle purchase-related api requests to CK.
 *
 * @package  LifterLMS_ConvertKit/Classes
 * @since    2.1.0
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_CK_Purchases class..
 */
class LLMS_CK_Purchases {

	/**
	 * Constructor.
	 *
	 * @since    2.1.0
	 * @version  2.1.0
	 */
	public function __construct() {

		if ( LLMS_ConvertKit()->get_integration()->get_option( 'purchases', 'yes' ) ) {

			// add hooks.
			add_action( 'lifterlms_transaction_status_succeeded', array( 'LLMS_CK_Purchases', 'succeeded' ), 20, 1 );

			// register transaction post type properties.
			add_filter( 'llms_get_transaction_properties', array( $this, 'register_properties' ), 10, 1 );

		}

	}

	/**
	 * Register transaction custom fields with the LLMS core fields api
	 *
	 * @param   array $props Existing fields data.
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	public function register_properties( $props ) {

		$props['ck_txn_id'] = 'absint';
		return $props;

	}

	/**
	 * Record successful transactions into CK
	 *
	 * @param   LLMS_Transaction $txn Transaction object.
	 * @return  void
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	public static function succeeded( $txn ) {

		$req = LLMS_ConvertKit()->api()->purchase( self::get_purchase_data( $txn ) );

		if ( $req ) {

			$txn->set( 'ck_txn_id', $req['id'] );
			do_action( 'llms_ck_purchase_succeeded', $req, $txn );

		}

	}

	/**
	 * Retrieve the Purchase data object for a given transaction
	 *
	 * @param   LLMS_Transaction $txn Transaction object.
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private static function get_purchase_data( $txn ) {

		$order = $txn->get_order();
		$plan  = llms_get_post( $order->get( 'plan_id' ) );

		$purchase = array(
			'transaction_id'   => $txn->get( 'id' ),
			'email_address'    => $order->get( 'billing_email' ),
			'first_name'       => $order->get( 'billing_first_name' ),
			'discount'         => $order->get( 'sale_value' ) + $order->get( 'coupon_value' ),
			'total'            => $txn->get( 'amount' ),
			'currency'         => $txn->get( 'currency' ),
			'transaction_time' => $txn->get( 'date' ),
			'status'           => 'paid',
			'integration'      => 'LifterLMS',
			'products'         => array(
				array(
					'pid'        => $order->get( 'plan_id' ),
					'lid'        => 1,
					'name'       => sprintf( '%1$s (%2$s)', $order->get( 'product_title' ), $order->get( 'plan_title' ) ),
					'sku'        => $plan ? $plan->get( 'sku' ) : '',
					'unit_price' => (float) $order->get( 'original_total' ),
					'quantity'   => 1,
				),
			),
		);

		return apply_filters( 'llms_ck_get_purchase_data', $purchase, $txn );

	}


}

return new LLMS_CK_Purchases();
