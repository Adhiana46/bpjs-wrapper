<?php

namespace Adhiana46\Bpjs;

use LZCompressor\LZString;
use GuzzleHttp\Client;

class BpjsService
{
    /**
     * Guzzle HTTP Client object
     * @var \GuzzleHttp\Client
     */
    private $clients;

    /**
     * Request headers
     * @var array
     */
    private $headers;

    /**
     * X-cons-id header value
     * @var int
     */
    private $cons_id;

    /**
     * X-Timestamp header value
     * @var string
     */
    private $timestamp;

    /**
     * X-Signature header value
     * @var string
     */
    private $signature;

    /**
     * @var string
     */
    private $secret_key;

    /**
     * @var string
     * user_key header value
     */
    private $user_key;

    /**
     * @var string
     */
    private $base_url;

    /**
     * @var string
     */
    private $service_name;

    /**
     * @var string
     */
    private $kode_ppk;

    /**
     * @var string
     */
    private $nama_ppk;

    public function __construct($configurations)
    {
        $this->clients = new Client([
            'verify' => false
        ]);

        foreach ($configurations as $key => $val){
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }

        //set X-Timestamp, X-Signature, and finally the headers
        $this->setTimestamp()->setSignature()->setHeaders();
    }

    protected function setHeaders()
    {
        $this->headers = [
            'X-cons-id' => $this->cons_id,
            'X-Timestamp' => $this->timestamp,
            'X-Signature' => $this->signature,
            'user_key' => $this->user_key,
        ];

        return $this;
    }

    protected function setTimestamp()
    {
        $this->timestamp = $this->getTimestamp();

        return $this;
    }

    protected function getTimestamp()
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('UTC'));
        $timestamp = (string)$dateTime->getTimestamp();

        return $timestamp;
    }

    protected function setSignature()
    {
        $signature = hash_hmac('sha256', $this->cons_id."&".$this->timestamp, $this->secret_key, true);
        $encodedSignature = base64_encode($signature);
        $this->signature = $encodedSignature;

        return $this;
    }

    protected function decrypt($string)
    {
        $encrypt_method = 'AES-256-CBC';
        $key = $this->cons_id.$this->secret_key.$this->timestamp;

        // hash
        $key_hash = hex2bin(hash('sha256', $key));
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        return json_decode(\LZCompressor\LZString::decompressFromEncodedURIComponent($output));
    }

    protected function parseResponse($response)
    {
        $responseObj = json_decode($response);

        if (isset($responseObj) && is_object($responseObj)) {
            if (property_exists($responseObj, 'response') && ! empty($responseObj->response)) {
                $responseObj->response = $this->decrypt($responseObj->response);
            }
        }

        return $responseObj;
    }

    public function get($feature, $headers = [])
    {
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';

        if (! empty($headers)) {
            $this->headers = array_merge($this->headers, $headers);
        }

        try {
            $response = $this->clients->request(
                'GET',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse()->getBody();
        }

        // return $response;
        return $this->parseResponse($response);
    }

    public function post($feature, $data = [], $headers = [])
    {
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';

        if (! empty($headers)) {
            $this->headers = array_merge($this->headers, $headers);
        }

        try {
            $response = $this->clients->request(
                'POST',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse()->getBody();
        }

        // return $response;
        return $this->parseResponse($response);
    }

    public function put($feature, $data = [], $headers = [])
    {
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';

        if (! empty($headers)) {
            $this->headers = array_merge($this->headers, $headers);
        }

        try {
            $response = $this->clients->request(
                'PUT',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse()->getBody();
        }

        // return $response;
        return $this->parseResponse($response);
    }

    public function delete($feature, $data = [], $headers = [])
    {
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';

        if (! empty($headers)) {
            $this->headers = array_merge($this->headers, $headers);
        }

        try {
            $response = $this->clients->request(
                'DELETE',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse()->getBody();
        }

        // return $response;
        return $this->parseResponse($response);
    }
}