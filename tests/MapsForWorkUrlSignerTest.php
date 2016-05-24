<?php

namespace Afonso\GoogleMaps;

use Afonso\GoogleMaps\MapsForWorkUrlSigner;

class MapsForWorkUrlSignerTest extends \PHPUnit_Framework_TestCase
{
    public function testSign()
    {
        $signer = new MapsForWorkUrlSigner('foo', 'YmFy');

        $params = $signer->sign('http://example.com', '/foo/bar', ['baz' => 'quux', 'abc' => 'def']);

        $this->assertEquals(
            ['client' => 'foo', 'signature' => '0-NE2DB6bRHvWyxqoYj-ErREZLA,'],
            $params
        );
    }
}
