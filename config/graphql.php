<?php

use App\GraphQL\Query\UserQuery;
use App\GraphQL\Type\UserType;

return [
    'schemas' => [
        'default' => [
            'query' => [
                'user' => App\GraphQL\Query\UserQuery::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
    ],
    'types' => [
        'User' => App\GraphQL\Type\UserType::class,
    ],
];