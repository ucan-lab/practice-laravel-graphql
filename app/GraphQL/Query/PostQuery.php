<?php

declare(strict_types = 1);

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL;
use App\Post;

/**
 * Postクエリの定義
 */
class PostQuery extends Query
{
    /**
     * クエリ名の定義と概要
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'post',
        'description' => 'post query'
    ];

    /**
     * クエリが扱う型を定義
     *
     * @return ObjectType
     */
    public function type() : ObjectType
    {
        return GraphQL::type('PostType');
    }

    /**
     * クエリが取り得る引数を定義
     *
     * @return array
     */
    public function args() : array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::id(),
            ],
        ];
    }

    /**
     * クエリに対する実処理
     *
     * @param array $root
     * @param array $args
     * @return Post
     */
    public function resolve($root, $args, $context, ResolveInfo $info) : Post
    {
        $query = Post::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        return $query->first();
    }
}
