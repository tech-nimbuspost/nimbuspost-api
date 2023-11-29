<?php

namespace Nimbuspackage\Nimbuspost\ServerCall;

use Nimbuspackage\Nimbuspost\ServerCall\Client;

/**
* @author  Kishan taretiya
*/
class NimbuspostClient implements Client
{
    protected $url = 'https://api.nimbuspost.com/v1/';

    protected $endpoint;

    protected $headers=[];

    protected $returnResponseType;
    protected $oldapi=false;

    
    /**
     * set the endpoint
     *
     * @param string $endpoint
     * @return object $this
     */
    public function setEndpoint(string $endpoint): object
    {
        $this->endpoint = $this->url .$endpoint;
        return $this;
    }
    
    /**
     * set the response type
     *
     * @param string $type
     * @return null
     */
    function responseType(string $type) { 
        if ($type == 'array') {
            $this->returnResponseType=$type;
        }
    }

    /**
     * set the header
     *
     * @param string $token
     * @return object
     */
    public function setHeaders(string $token): object
    {
        $this->headers = [ "Content-Type: application/json" ];
        if ($token != 'login') {
            array_push($this->headers, "Authorization: Bearer {$token}");
        }
        return $this;
    }

    public function setOldHeaders(string $token): object
    {
        $this->url = 'https://ship.nimbuspost.com/api/';
        $this->headers = ["NP-API-KEY:{$token}"];
        $this->oldapi=true;
        return $this;
    }

    /**
     * Send the data using post request
     *
     * @param array $data
     * @return object/array
     */
    public function post(array $data, $type = "POST")
    {
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_POSTFIELDS => (empty($this->oldapi) ? json_encode($data) : ($data)),
            CURLOPT_HTTPHEADER => $this->headers
        ]);

        $response = curl_exec($curl);
        if (! $this->isValid($response)) {
            $response = json_encode([ 'curl_error' => curl_error($curl) ]);
        }

        curl_close($curl);

        return $this->returnResponseType($response);
    }

    /**
     * get the requested data using get request
     *
     * @return object/array
     */
    public function get()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $this->headers,
        ]);

        $response = curl_exec($curl);

        if (! $this->isValid($response)) {
            $response = json_encode(['curl_error' => curl_error($curl)]);
        }

        curl_close($curl);

        return $this->returnResponseType($response);
    }

    /**
     * Check the return data is valid json
     *
     * @param mixed $string
     * @return bool
     */
    private function isValid($string): bool
    {
        if (! $string) {
            return false;
        }

        return json_decode($string) ? true : false;
    }

    /**
     * Return the response type based on returnResponseType set and default object
     *
     * @param $response
     * @return object/array
     */
    private function returnResponseType($response)
    {
        if ($this->returnResponseType == 'array') {
            return json_decode($response,true);
        }

        return json_decode($response);
    }
}