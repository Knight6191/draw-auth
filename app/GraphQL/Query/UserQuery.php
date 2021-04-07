<?php

namespace App\GraphQL\Query;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Illuminate\Support\Facades\Auth;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user',
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'auth' => [
                'name' => 'auth',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id',$args['id']);
            }
            if (isset($args['email'])) {
                $query->where('email',$args['email']);
            }
            if (isset($args['auth'])) {
                $query->where('auth',$args['auth']);
            }
        };
        return  User::where($where)->first();
    }
}