<?php
/**
* DynamicAd Client main class_alias
*
* @category Core
* @package Anetwork\Dynamicad
* @author Mehdi Hosseini <m.hosseini@anetwork.ir>
* @since Jun 12, 2016
*/
namespace Anetwork\Dynamicad;

use GuzzleHttp\Client as Guzzle;

class Client
{

    private $config;

    private $url;

    private static $token;

    public function __construct($type)
    {

        $this->config = include './config.php';

        if ($type == 'logo') {
            $this->url = $this->config[ 'api-url' ] . 'logo?token=' .
              self::$token;
        } else {
            $this->url = $this->config[ 'api-url' ] . '?token=' .
              self::$token;
        }

    }

    public function __call($method, $arguments)
    {

        try {
            if (method_exists($this, $method)) {
                return call_user_func_array(array( $this,$method ), $arguments);
            }
        } catch (\Exception $e) {
              print get_class($e) .
                " thrown within the exception handler. Message: " .
                $e->getMessage() .
                " on line " .
                $e->getLine();
        }


    }

    /**
    * Initializing DynamicAd
    *
    * @param array $config initilizing params.
    * @return void
    */
    public static function config($config)
    {

        if (isset($config['token'])) {
            self::$token = $config['token'];
        }

    }

    /**
    * Select products function
    *
    * @return object
    */
    public static function product()
    {

        return new Client('product');

    }

    /**
    * Select logo function
    *
    * @return object
    */
    public static function logo()
    {

        return new Client('logo');

    }

    /**
    * Limit the API result to the id
    *
    * @param string $id product or logo id
    * @return object
    */
    public function id($id)
    {

        $this->url = $this->url . '&id=' . $id;

        return $this;

    }

    /**
    * Limit the API result with limit and offset
    *
    * @param integer $limit Count of objects in every request
    * @param integer $offset Count's pages
    * @return obejct
    */
    public function limit($limit = 999, $offset = 0)
    {

        $this->url = $this->url . '&limit=' . $limit . '&offset=' . $offset;

        return $this;

    }

    /**
    * Finalize and return all results
    *
    * @return json
    */
    public function get()
    {

        $client = new Guzzle();

        $res = $client->request('GET', $this->url);

        return json_decode($res->getBody());

    }

    /**
    * Post data to the SoapServer
    *
    * @return json
    */
    public function post($data)
    {

        $client = new Guzzle();

        $res = $client->request(
            'POST',
            $this->url,
            [
            'form_params' => $data
            ]
        );

        return json_decode($res->getBody());

    }

    /**
    * Send PUT request to SoapServer
    *
    * @param array $data input parameters
    * @return json
    */
    public function update($data)
    {

        $client = new Guzzle();

        $data['_METHOD'] = 'PUT';

        $res = $client->request(
            'POST',
            $this->url,
            [
            'form_params' => $data
            ]
        );

        return json_decode($res->getBody());

    }

    /**
    * Send delete request to the server
    *
    * @param string $id the product or logo id
    * @return json
    */
    public function delete($id)
    {

        $client = new Guzzle();

        $data = [ '_METHOD' => 'DELETE',
              'id' => $id,
            ];

        $res = $client->request(
            'POST',
            $this->url,
            [
            'form_params' => $data
            ]
        );

        return json_decode($res->getBody());

    }
}
