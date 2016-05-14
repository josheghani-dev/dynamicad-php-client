<?php

require_once( 'vendor/autoload.php' );

use Anetwork\Dynamicad\Client;

var_dump( Client::product()->get() );

// $data = [
//     'id' => 'abc',
//     'title' => 'this is title',
//     'url' => 'http://google.com',
//     'image' => 'http://i.telegraph.co.uk/multimedia/archive/03589/Wellcome_Image_Awa_3589699k.jpg'
//   ];
//
// var_dump( Anetwork\Dynamicad\Client::product()->get( $data ) );

$data = [
    'id' => 'abc',
    'title' => 'this is title',
    'url' => 'http://google.com',
    'image' => 'http://i.telegraph.co.uk/multimedia/archive/03589/Wellcome_Image_Awa_3589699k.jpg'
  ];

// var_dump( Anetwork\Dynamicad\Client::product()->get( $data ) );

// var_dump( Anetwork\Dynamicad\Client::logo()->get() );
