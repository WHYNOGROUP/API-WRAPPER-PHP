<?php

# GNU LESSER GENERAL PUBLIC LICENSE
# Version 3, 29 June 2007
#
# Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
# Everyone is permitted to copy and distribute verbatim copies
# of this license document, but changing it is not allowed.
# WHYNOGROUP - WNG - WNL - WNA - WNH - WNR - WNC
# 2018-06-02 - https://api.whyno.group

/**
 * Wrapper to manage login and exchanges with Wng API.
 * Api wng queries, are done in curl php.
 *
 */
class wng
{
    /**
     * Endpoints of Wng Api
     *
     * @var array
     */
    private $endpoints = [
        'wng-eu'        => 'https://api-eu.whyno.group',
        'wng-ca'        => 'https://api-ca.whyno.group',
        'wng-us'        => 'https://api-us.whyno.group',
    ];

    /**
     * Contain endpoint selected, in a futur version,
     * we will implement a cdn that will automatically
     * choose the endpoint.
     *
     * @var string
     */
    private $endpoint = 'https://alpha.api-eu.whyno.group';

    /**
     * Contain consumer key of the current application
     *
     * @var string
     */
    private $consumer_key = null;

    /**
     * Contain curl client connection
     *
     * @var Client
     */
    private $curl_client = null;

    /**
     * Contain the data table ready to be sent to the API
     *
     * @var array
     */
    private $input = null;

    /**
     * Contains the path for the requested API
     *
     * @var URI
     */
    private $path = null;

    /**
     * Contains the method for the requested API
     *
     * @var URI
     */
    private $method = null;

    /**
     * Construct a new instance
     *
     * @param string $consumer_key If you don't have a consumer key, please go on https://cas.whyno.group/request_credential
     *
     * @throws \Exception if one parameter is missing or with bad value
     */
    public function __construct($consumer_key = null) {

      try {

        if(!isset($consumer_key) || empty($consumer_key)){
          throw new \Exception("InvalidParameterException: missing consumer_key");
        }

        $this->consumer_key         = $consumer_key;
        return true;

      } catch (\Exception $e) { return $e->getMessage(); }

    }

    /**
     * Wrap call to Wng APIs for GET requests
     *
     * @param string $path path ask inside api
     * @param array $input content to send inside body of request
     *
     * @return array
     */
      public function get($path, $input = null){

        $this->path                 = $path;
        $this->input                = $input;
        $this->method               = "GET";

               $this->callApi();
        return $this->output;

      }

    /**
     * Wrap call to Wng APIs for PUT requests
     *
     * @param string $path path ask inside api
     * @param array $input content to send inside body of request
     *
     * @return array
     */
      public function put($path, $input = null){

        $this->path                 = $path;
        $this->input                = $input;
        $this->method               = "PUT";

               $this->callApi();
        return $this->output;

      }

    /**
     * Wrap call to Wng APIs for POST requests
     *
     * @param string $path path ask inside api
     * @param array $input content to send inside body of request
     *
     * @return array
     */
      public function post($path, $input = null){

        $this->path                 = $path;
        $this->input                = $input;
        $this->method               = "POST";

               $this->callApi();
        return $this->output;

      }

    /**
     * Wrap call to Wng APIs for DELETE requests
     *
     * @param string $path path ask inside api
     * @param array $input content to send inside body of request
     *
     * @return array
     */
      public function delete($path, $input = null){

        $this->path                 = $path;
        $this->input                = $input;
        $this->method               = "DELETE";

               $this->callApi();
        return $this->output;

      }

      /**
       * Convert input data in php array format to json array format
       *
       * @return array json format
       */
        public function prepareData(){

          return json_encode($this->input);

        }

      /**
       * Prepare file to send api - BETA DON'T USE IT!
       *
       * @return object
       */
        public function prepareFile(){
         
         //We will add here a storage system in the temporary folder
            
         $file = 'whynogroup.jpg';
         return new CURLFile(
             getcwd().'/temp/'.$file,
             mime_content_type(getcwd().'/temp/'.$file),
             $file
         );

        }

      /**
       * Prepare header of curl client
       *
       * @return array
       */
        public function prepareHeaders(){

            return array(

              "cache-control: no-cache",

              "x-wng-consumer: {$this->consumer_key}",

              "x-wng-endpoint: {$this->endpoint}",

              "x-wng-method: {$this->method}"

            );

        }

      /**
       * Send request to Api
       *
       * @return array
       */
        public function callApi(){

          $this->curl_client          = curl_init();

          curl_setopt_array(

            $this->curl_client,

            array(
              CURLOPT_URL             => $this->endpoint . $this->path,
              CURLOPT_RETURNTRANSFER  => true,
              CURLOPT_ENCODING        => "",
              CURLOPT_MAXREDIRS       => 10,
              CURLOPT_TIMEOUT         => 30,
              CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST   => "{$this->method}",
              CURLOPT_POSTFIELDS      => array('userfile' =>  $this->prepareFile(), 'userdata' => $this->prepareData()),
              CURLOPT_HTTPHEADER      => $this->prepareHeaders(),
            )

          );

          $o                          = curl_exec($this->curl_client);
          $e                          = curl_error($this->curl_client);

          curl_close($this->curl_client);

          if ($e) {

            $this->output               = "WNG API-EU CLIENT: " . $e;

          } else {

            $this->output               = json_decode($o, true);

          }

        }

}
