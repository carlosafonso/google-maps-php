<?php

namespace Afonso\GoogleMaps;

use Afonso\GoogleMaps\GoogleMaps;
use Afonso\GoogleMaps\UrlSignerInterface;
use Mockery as m;

class GoogleMapsTest extends \PHPUnit_Framework_TestCase
{
    public function testStaticMapUrl()
    {
        $signer = m::mock(UrlSignerInterface::class);
        $signer->shouldReceive('sign')
            ->once()
            ->with(
                'https://maps.googleapis.com',
                '/maps/api/staticmap',
                ['center' => '10,20', 'size' => '200x300', 'maptype' => 'hybrid', 'format' => 'png', 'zoom' => 18]
            )
            ->andReturn(['foo' => 'bar', 'baz' => 'quux']);
        $maps = new GoogleMaps($signer);

        $url = $maps->getStaticMapUrl(10, 20, 200, 300, 'hybrid', 'png');

        $this->assertEquals(
            'https://maps.googleapis.com/maps/api/staticmap?center=10%2C20&size=200x300&maptype=hybrid&format=png&zoom=18&foo=bar&baz=quux',
            $url
        );
    }
}
