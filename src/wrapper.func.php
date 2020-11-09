<?php

namespace wng;

private $endpoints = array(
  'api-eu' => 'https://api-eu.whyno.group/3.0',
  'api-us' => 'https://api-us.whyno.group/3.0',
  'api-ca' => 'https://api-ca.whyno.group/3.0',
  'api-beta' => 'https://api-beta.whyno.group/3.0',
);
private $endpoint = null;
private $application_key = null;
private $application_secret = null;
private $consumer_key = null;
private $time_delta = null;

class wng{
  public function __construct($application_key, $application_secret, $endpoint = null, $consumer_key = null){
    if(!isset($endpoint))
      throw new \Exception\InvalidParameterException("Endpoint parameter isn't defined");

    if(preg_match("/^https?:\/\/..*/", $endpoint))
      $this->endpoint = $endpoint;
    else {
      if(!array_key_exists($endpoint, $this->endpoints))
        throw new Exceptions\InvalidParameterException("Unknown provided endpoint");
      else
        $this->endpoint = $this->endpoints[$endpoint];
    }

    $this->application_key    = $application_key;
    $this->application_secret = $application_secret;
    $this->consumer_key       = $consumer_key;
    $this->time_delta         = null;
  }

  private function timeDrift(){
    if(!isset($this->time_delta))
      $this->time_delta = $this->rawCall('GET', "/auth/time", null, false)["return"] - time();

    return $this->time_delta;
  }

  protected function rawCall($method, $path, $content = null, $is_authenticated = true, $headers = null){
    if($is_authenticated){
      if(!isset($this->application_key))
        throw new \Exception\InvalidParameterException("Application key parameter is undefined");
      if(!isset($this->application_secret))
        throw new \Exception\InvalidParameterException("Application secret parameter is undefined");
    }

    $this->http_client = curl_init();

    if(isset($content))
      $body = json_encode($content, JSON_UNESCAPED_SLASHES);
    else
      $body = "";

    if(!is_array($headers))
        $headers = [];

    $headers['Content-Type'] = 'application/json; charset=utf-8';

    if($is_authenticated){
        if(!isset($this->time_delta))
            $this->timeDrift();

        $headers['X-Wng-Application']                      = $this->application_key;
        $headers['X-Wng-Timestamp']                        = time() + $this->time_delta;
        $headers['X-Wng-Endpoint']                         = $this->endpoint;

        if(isset($this->consumer_key)){
          $headers['X-Wng-Consumer']                       = $this->consumer_key;
          $headers['X-Wng-Signature']                      = '$1$' . sha1(
                                                                           $this->application_secret . '+' .
                                                                           $this->consumer_key . '+' .
                                                                           $method. '+' .
                                                                           $url . '+' .
                                                                           $body . '+' .
                                                                           $now
                                                                         );
        }
      }

      curl_setopt($this->http_client, array(
        CURLOPT_URL             => $this->endpoint.$path,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_ENCODING        => "UTF-8",
        CURLOPT_MAXREDIRS       => 10,
        CURLOPT_TIMEOUT         => 30,
        CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST   => $method,
        CURLOPT_POSTFIELDS      => $body,
        CURLOPT_HTTPHEADER      => $headers
      )

      $o                       = curl_exec($this->http_client);
      $e                       = curl_error($this->http_client);

      curl_close($this->http_client);

      return ($e) ? $e : json_decode($o, true) ;
  }

  public function requestCredentials($accessRules, $redirection = null){
      $parameters              = new \StdClass();
      $parameters->accessRules = $accessRules;
      $parameters->redirection = $redirection;

      $res = $this->rawCall("POST", "/auth/credential", "$parameters", true);
      $this->consumer_key = $res['consumer_key'];

      return $res;

  }


}

?>
