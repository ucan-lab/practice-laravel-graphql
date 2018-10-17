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
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of post',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'The content of post',
            ],
        ];
    }
}
