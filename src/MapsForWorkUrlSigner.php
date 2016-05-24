<?php

namespace Afonso\GoogleMaps;

class MapsForWorkUrlSigner implements UrlSignerInterface
{
    /**
     * Google Maps API client ID.
     *
     * @var  string
     */
    protected $client;

    /**
     * Google Maps API secret key.
     *
     * @var  string
     */
    protected $key;

    public function __construct($client, $key)
    {
        $this->client = $client;
        $this->key = $key;
    }

    public function sign($endpoint, $uri, array $params = [])
    {
        $params['client'] = $this->client;
        $queryString = http_build_query($params);
        $signableString = "{$uri}?{$queryString}";
        $decodedKey = base64_decode($this->key);

        $rawSignature = hash_hmac('sha1', $signableString, $decodedKey, true);
        $signature = strtr(base64_encode($rawSignature), '+/=', '-_,');

        return ['client' => $this->client, 'signature' => $signature];
    }
}
