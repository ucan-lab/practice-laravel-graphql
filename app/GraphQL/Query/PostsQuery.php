<?php

declare(strict_types = 1);

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use Folklore\GraphQL\Support\PaginationType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Illuminate\Pagination\LengthAwarePaginator;
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
     * @return PaginationType
     */
    public function type() : PaginationType
    {
        return GraphQL::pagination(GraphQL::type('PostType'));
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
            'take' => [
                'type' => Type::int(),
            ],
            'page' => [
                'type' => Type::int(),
            ],
        ];
    }

    /**
     * クエリに対する実処理
     *
     * @param array $root
     * @param array $args
     * @return LengthAwarePaginator
     */
    public function resolve($root, $args, $context, ResolveInfo $info) : LengthAwarePaginator
    {
        $query = Post::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        if (isset($args['ids'])) {
            $query->whereIn('id', $args['ids']);
        }

        $perPage = $args['take'] ?? 20;
        $page = $args['page'] ?? 1;

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}
