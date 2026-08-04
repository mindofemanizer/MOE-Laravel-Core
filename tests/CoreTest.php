<?php

use Moe\Core\Base\BaseService;

it('can instantiate base service', function () {
    $service = new class extends BaseService {};

    expect($service)->toBeInstanceOf(BaseService::class);
});
