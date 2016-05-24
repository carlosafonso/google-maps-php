<?php

namespace Afonso\GoogleMaps;

class GoogleMaps
{
    const ENDPOINT = 'https://maps.googleapis.com';

    const STATIC_MAP_URI = '/maps/api/staticmap';

    protected $signer;

    public function __construct(UrlSignerInterface $signer)
    {
        $this->signer = $signer;
    }

    public function getStaticMapUrl($lat, $lng, $width, $height, $type, $format = 'png')
    {
        $params = [
            'center' => "{$lat},{$lng}",
            'size' => "{$width}x{$height}",
            'maptype' => $type,
            'format' => $format,
            'zoom' => 18
        ];
        $creds = $this->signer->sign(self::ENDPOINT, self::STATIC_MAP_URI, $params);
        $params = array_merge($params, $creds);

        return self::ENDPOINT . self::STATIC_MAP_URI . '?' . http_build_query($params);
    }
}
