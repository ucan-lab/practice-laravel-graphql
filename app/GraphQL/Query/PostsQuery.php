<?php

declare(strict_types = 1);

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ListOfType;
use GraphQL;
use Illuminate\Database\Eloquent\Collection;
use App\Post;

/**
 * Postsクエリの定義
 */
class PostsQuery extends Query
{
    /**
     * クエリ名の定義と概要
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'posts',
        'description' => 'A query'
    ];

    /**
     * クエリが扱う型を定義
     *
     * @return ListOfType
     */
    public function type() : ListOfType
    {
        return Type::listOf(GraphQL::type('PostType'));
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
            'ids' => [
                'name' => 'ids',
                'type' => Type::listOf(Type::id()),
            ],
        ];
    }

    /**
     * クエリに対する実処理
     *
     * @param array $root
     * @param array $args
     * @return Collection
     */
    public function resolve($root, $args, $context, ResolveInfo $info) : Collection
    {
        $query = Post::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        if (isset($args['ids'])) {
            $query->whereIn('id', $args['ids']);
        }

        return $query->get();
    }
}
