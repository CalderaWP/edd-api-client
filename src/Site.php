<?php
namespace CalderaWP\EDD\API;
use GuzzleHttp\Client;

/**
 * Class client
 *
 * Easy Digital Downloads API Client
 *
 * @see http://docs.easydigitaldownloads.com/article/1131-edd-rest-api-introduction
 * @author Josh Pollock <Josh@CalderaWP.com>
 * @license GPLv2+
 */
class Site {

	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * @var array
	 */
	protected $keys = [];

	/**
	 * @var string
	 */
	protected $base;
	function __construct( Client $client, string $base, string $public, string $token ) {
		$this->client = $client;
		$this->base = $base;
		$this->keys = [
			'key' => $public,
			'token' => $token,
		];
	}

	/**
	 * Get one sale
	 *
	 * @param int $id Sales ID
	 *
	 * @return stdClass
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
	 * @return stdClass
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
	 * @return stdClass
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
	 * @return stdClass
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
	 * @return stdClass
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
	 * @return stdClass
	 */
	public function customers( int $number = 20, int $page = 1 ) : \stdClass
	{
		return $this->get( 'customers', [
			'number' => $number,
			'page'   => $page
		] );
	}

	/**
	 * Generic GET method
	 *
	 * @param string $endpoint Endpoint URL. Base url will be prepended.
	 * @param array $args Optional. Additional query args. API keys will be added.
	 *
	 * @return stdClass
	 */
	public function get( string  $endpoint, array $args = [] ) : \stdClass
	{
		$r = $this->client->request('GET', $this->form_url( $endpoint, $args ) );
		if( 200 == $r->getStatusCode() ){

			return json_decode( $r->getBody() );
		}else{
			return null;
		}

	}

	/**
	 * Perpare request arguments by adding keys
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	protected function prepare_args( array  $args ) : array
	{
		return array_merge( $args, $this->keys );
	}

	/**
	 * Form URL, including adding query args
	 *
	 * @param string $endpoint
	 * @param array $args
	 *
	 * @return string
	 */
	protected function form_url( string $endpoint, array $args ) : string
	{
		return $this->base . $endpoint . '?' . http_build_query( $this->prepare_args( $args ) );
	}

}
