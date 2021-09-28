<?php

namespace ImageKit\Tests\ImageKit\GuzzleHttpWrapper;

use GuzzleHttp\Client;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;

/**
 *
 */

/**
 *
 */
final class GuzzleHttpWrapperTest extends TestCase
{
    /**
     *
     */
    public function testSetDataWhenNullAndEmptyValuesAreSuppliedToSetDatas()
    {
        $data = [
            'param1' => 'Test',
            'param2' => '',
            'param3' => null,
            'param4' => [],
            'param5' => [],
            'param6' => true,
            'param7' => false,
            'param8' => 0
        ];

        $stub = $this->createMock(Client::class);

        $resource = new GuzzleHttpWrapper($stub);
        $resource->setDatas($data);

        GuzzleHttpWrapperTest::assertEquals(['param1' => 'Test', 'param6' => true, 'param7' => false, 'param8' => 0], $resource->getDatas());
    }
}
