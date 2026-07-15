<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Bindings
    |--------------------------------------------------------------------------
    |
    | Override these to use your own models instead of the defaults.
    |
    */

    'models' => [

        'wallet' => App\Models\Wallet::class,

        'order' => App\Models\Order::class,

        'inventory' => App\Models\Inventory::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Table Names
    |--------------------------------------------------------------------------
    |
    | Override table names per module. If not set, uses the model's default.
    |
    */

    'tables' => [

        // 'wallets' => 'wallets',
        // 'orders' => 'orders',
        // 'inventories' => 'inventories',

    ],

];
