# edd-api-client
PHP HTTP Client For Easy Digital Downloads API

# Installation
`composer require calderawp/edd-api-client`

* Requires: PHP7.0+
* Uses Guzzle 6

## Usage

### EDD Core

* Create Client
```
  //make a guzzle instance
  $client = new GuzzleHttp\Client( [ 'base_uri' => 'https://something.com/edd-api/' ]  );
  $key = '5419894a576acf9e773cdcdd1a8f9613';
  $token = '4198047e657734f58a18f3a4051a6af8';
  //create site instance
  $site = new \CalderaWP\EDD\API\Site( $client, $key, $token  );
  
```

#### Get Customers
* Page 1

  `$customers = $site->customers();`

* Page 2

  `$customers = $site->customers(2);`

* 50 Customers
  `$customers = $site->customers(1,50);`

* Customer with ID 42

  `$customer = $site->customerr( 42 );`
  
  
#### Get Products
* Page 1

  `$products = $site->products();`

* Page 2

  `$products = $site->products(2);`

* 50 Products

  `$products = $site->product(1,50);`
 
* Prodcut with ID 42

  `$product = $site->product( 42 );`


#### Get Sales
* Most recent
		
    `$sales = $site->sales();`
    
* Sales by customer Email

  `$sales = $site->sales( 'roy@roysivan.com' );`
  
* Sale with ID 42

  `$sals = $site->sale( 42 );`
  
### EDD Recurring
NOTE: I submitted some pull requests to make this work, use the api-fix branch in my fork for now.

#### Get Subscriptions

```
$subscriptions = new \CalderaWP\EDD\API\Subscriptions( $client, $key, $token );
$page1 = $subscriptions->subscriptions();
$page2 = $subscriptions->subscriptions(2);
```

#### Get Subscription
```
$sub = $subscriptions->subscription(42);
```

## License
Copyright 2016+ CalderaWP LLC. Licnesed under the GNU GPL V2+
