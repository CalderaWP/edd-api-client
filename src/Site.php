<?php
namespace CalderaWP\EDD\API;


/**
 * Class Site
 *
 * Easy Digital Downloads API Client for a site
 *
 * @see http://docs.easydigitaldownloads.com/article/1131-edd-rest-api-introduction
 * @author Josh Pollock <Josh@CalderaWP.com>
 * @license GPLv2+
 */
class Site extends Client{

	/**
	 * Get one sale
	 *
	 * @param int $id Sales ID
	 *
	 * @return \stdClass
	 */
	public function sale( int $id ) : \stdClass
	{
		return $this->get( 'sales', [ 'id' => $id ] );
	}

	/**
	 * Get sales
	 *
	 * @param null|string $email Optional. Customer email -- please URL encode -- to get sales for.
	 * @param int $number Optional. Numer of sales to get. Default is 20.
	 *
	 * @return \stdClass
	 */
	public function sales( string  $email = null, int $number = 20 ) : \stdClass
	{
		$args = [
			'number' => $number,

		];
		if( null != $email ){
			$args[ 'email'] = $email;
		}

		return $this->get( 'sales', $args );
	}

	/**
	 * Get one product
	 *
	 * @param int $id Product ID
	 *
	 * @return \stdClass
	 */
	public function product( int $id )  : \stdClass
	{
		return $this->get( 'products', [ 'product' => $id ] );
	}

	/**
	 * Get many products
	 *
	 * @param int $number Optional. Default is 20 products
	 * @param int $page Optional. Default is page 1.
	 *
	 * @return \stdClass
	 */
	public function products ( int $number = 20, int $page = 1 ) : \stdClass
	{
		return $this->get( 'products', [
			'number' => $number,
			'page'   => $page
		] );
	}

	/**
	 * Get a customer
	 *
	 * @param int $id Customer ID
	 *
	 * @return \stdClass
	 */
	public function customer( int $id ) : \stdClass
	{
		return $this->get( 'customers', [ 'customer' => $id ] );
	}

	/**
	 * Get customers
	 *
	 * @param int $number Optional. Default is 20 products
	 * @param int $page Optional. Default is page 1.
	 *
	 * @return \stdClass
	 */
	public function customers( int $number = 20, int $page = 1 ) : \stdClass
	{
		return $this->get( 'customers', [
			'number' => $number,
			'page'   => $page
		] );
	}

}
