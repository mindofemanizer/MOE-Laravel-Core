<?php

namespace Moe\Core\Tests;

use Moe\Core\Base\BaseService;

class CoreTest extends TestCase
{
    public function test_base_service_can_be_instantiated()
    {
        $service = new class extends BaseService {};
        $this->assertInstanceOf(BaseService::class, $service);
    }
}
