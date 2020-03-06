<?php

namespace ImageKit\Tests\ImageKit\GuzzleHttpWrapper;

use PHPUnit\Framework\TestCase;
use ImageKit\Resource\GuzzleHttpWrapper;
use GuzzleHttp\Client;

final class GuzzleHttpWrapperTest extends TestCase
{
  public function testSetDataWhenNullAndEmptyValuesAreSuppliedToSetDatas()
  {
    $data = array(
      "param1" => "Test",
      "param2" => "",
      "param3" => null,
      "param4" => [],
      "param5" => array(),
      "param6" => true,
      "param7" => false,
      "param8" => 0
    );

    $stub = $this->createMock(Client::class);

    $resource = new GuzzleHttpWrapper($stub);
    $resource->setDatas($data);

    $this->assertEquals(array("param1" => "Test",  "param6" => true, "param7" => false,  "param8" => 0), $resource->getDatas());
  }
}
