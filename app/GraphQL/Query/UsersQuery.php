<?php

declare(strict_types = 1);

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ListOfType;
use GraphQL;
use Illuminate\Database\Eloquent\Collection;
use App\User;

/**
 * Usersクエリの定義
 */
class UsersQuery extends Query
{
    /**
     * クエリ名の定義と概要
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'users',
        'description' => 'users query'
    ];

    /**
     * クエリが扱う型を定義
     *
     * @return ObjectType
     */
    public function type() : ListOfType
    {
        return Type::listOf(GraphQL::type('UserType'));
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
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ]
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
        $query = User::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        if (isset($args['ids'])) {
            $query->whereIn('id', $args['ids']);
        }

        if (isset($args['email'])) {
            $query->where('email', $args['email']);
        }

        return $query->get();
    }
}
