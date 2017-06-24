<?php


namespace CalderaWP\EDD\API;

use GuzzleHttp\Client as Guzzle;
/**
 * Class Client
 * @package CalderaWP\EDD\API
 */
abstract class Client {
	/**
	 * @var Guzzle
	 */
	protected $guzzle;

	/**
	 * @var array
	 */
	protected $keys = [];

	/**
	 * Client constructor.
	 *
	 * @param Guzzle $guzzle
	 * @param string $public Public key
	 * @param string $token Token
	 */
	public function __construct( Guzzle $guzzle, string $public, string $token )
	{
		$this->guzzle = $guzzle;
		$this->keys = [
			'key' => $public,
			'token' => $token,
		];


	}

	/**
	 * Generic GET method
	 *
	 * @param string $endpoint Endpoint URL. Base url will be prepended.
	 * @param array $args Optional. Additional query args. API keys will be added.
	 *
	 * @return \stdClass
	 */
	protected function get(  string  $endpoint,  array $args = [] )
	{
		$args = array_merge( $args, $this->keys );
		$r = $this->guzzle->get( $endpoint, [
			'query' => $args
		]);

		$x = $r->getBody()->getContents();
		if( 200 == $r->getStatusCode() && null != ( $body = json_decode( $r->getBody() )  ) && isset( $body->$endpoint )  ){
			return (object) $body->$endpoint;
		}else{
			return new \stdClass();
		}
	}
}