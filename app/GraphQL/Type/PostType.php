<?php

declare(strict_types = 1);

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class PostType extends BaseType
{
    protected $attributes = [
        'name' => 'PostType',
        'description' => 'post type'
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the post'
            ],
            'user_id' => [
                'type' => Type::id(),
                'description' => 'The user_id of post',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of post',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'The content of post',
            ],
            'user' => [
                'type' => GraphQL::type('UserType'),
                'description' => 'The user of post',
            ],
        ];
    }
}
