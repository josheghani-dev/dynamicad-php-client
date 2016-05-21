<?php

namespace Anetwork\Dynamicad;

use GuzzleHttp\Client as Guzzle;

class Client {

  private $config;

  private $url;

  public function __construct( $type ) {

    $this->config = include( './config.php' );

    if ( $type == 'logo' ) {

      $this->url = $this->config[ 'api-url' ] . 'logo?token=' . $this->config[ 'token' ];

    } else {

      $this->url = $this->config[ 'api-url' ] . '?token=' . $this->config[ 'token' ];

    }

  }

  public function __call( $method, $arguments ) {

    try {

      if( method_exists( $this, $method ) ) {

          return call_user_func_array( array( $this,$method ),$arguments );

      }

    } catch ( \Exception $e ) {

          print get_class($e) . " thrown within the exception handler. Message: ". $e->getMessage() . " on line " . $e->getLine();

      }


  }

  public static function product() {

    return new Client( 'product' );

  }

  public static function logo() {

    return new Client( 'logo' );

  }

  public function get() {

    $client = new Guzzle();

    $res = $client->request( 'GET',  $this->url );

    return json_decode( $res->getBody() );

  }

  public function post( $data ) {

    $client = new Guzzle();

    $res = $client->request( 'POST',  $this->url, [
      'form_params' => $data
      ]
    );

    return json_decode( $res->getBody() );

  }

  public function put( $data ) {

    $client = new Guzzle();

    $res = $client->request( 'PUT',  $this->url, [
      'json' => $data
      ]
    );

    return json_decode( $res->getBody() );

  }

  public function delete( $id ){

    $client = new Guzzle();

    $res = $client->request( 'DELETE',  $this->url, [
      'json' => [ 'id' => $id ]
      ]
    );

    return json_decode( $res->getBody() );

  }

}
