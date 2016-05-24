<?php

namespace Afonso\GoogleMaps;

interface UrlSignerInterface
{
    public function sign($endpoint, $uri, array $params = []);
}
