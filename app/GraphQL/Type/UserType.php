<?php

declare(strict_types = 1);

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

/**
 * User型の定義
 */
class UserType extends BaseType
{
    /**
     * 型名の定義と概要
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'UserType',
        'description' => 'user type'
    ];

    /**
     * フィールドに持たせる型と挙動を定義
     *
     * @return array
     */
    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user',
            ],
            'created_at' => [
                'type' => GraphQL::type('DateTimeType'),
                'description' => 'The created_at of user',
            ],
            'updated_at' => [
                'type' => GraphQL::type('DateTimeType'),
                'description' => 'The updated_at of user',
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('PostType')),
                'description' => 'The posts of user',
            ],
        ];
    }
}
