<?php

namespace App\GraphQL\Type;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'Collection of user and details of Author',
        'model' => User::class
    ];


    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular user',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of the user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Email of the user',
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'Phone of user',
            ],
            'gender' => [
                'type' => Type::int(),
                'description' => 'Gender of user',
            ],
            'birthday' => [
                'type' => Type::string(),
                'description' => 'Birthday of user',
            ],
            'about' => [
                'type' => Type::string(),
                'description' => 'About of user',
            ],
            'avatar' => [
                'type' => Type::string(),
                'description' => 'Avatar of user',
            ],
            'auth' => [
                'type' => Type::string(),
                'description' => 'Auth of user',
            ]
        ];
    }
}