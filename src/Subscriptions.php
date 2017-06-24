<?php


namespace CalderaWP\EDD\API;


/**
 * Class Subscriptions
 * @package CalderaWP\EDD\API
 */
class Subscriptions extends Client{

	/**
	 * Get subscriptions by page
	 *
	 * @param int $page
	 * @param int $number
	 *
	 * @return \stdClass
	 */
	public function subscriptions( int $page = 1, int $number = 20 )
	{
		$args = [
			'page' => $page,
			'number' => $number
		];

		return $this->get( 'subscriptions', $args );
	}

	/**
	 * Get a subscription
	 *
	 * @param int $id
	 *
	 * @return \stdClass
	 */
	public function subscription( int $id )
	{
		return $this->get( 'subscriptions', [ 'id' => $id ] );
	}
}