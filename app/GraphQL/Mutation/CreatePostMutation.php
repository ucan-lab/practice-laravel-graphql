<?php

declare(strict_types = 1);

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL;
use App\User;
use App\Post;

/**
 * 記事を登録するミューテーション
 */
class CreatePostMutation extends Mutation
{
    /**
     * ミューテーション名の定義と概要
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'CreatePost',
        'description' => 'CreatePost mutation'
    ];

    /**
     * ミューテーションが扱う型を定義
     *
     * @return ObjectType
     */
    public function type() : ObjectType
    {
        return GraphQL::type('PostType');
    }

    /**
     * ミューテーションが取り得る引数を定義
     *
     * @return array
     */
    public function args() : array
    {
        return [
            'user_id' => [
                'type' => Type::id(),
                'rules' => ['required'],
            ],
            'title' => [
                'type' => Type::string(),
                'rules' => ['required', 'string'],
            ],
            'content' => [
                'type' => Type::string(),
                'rules' => ['required', 'string'],
            ],
        ];
    }

    /**
     * ミューテーションに対する実処理
     *
     * @param array $root
     * @param array $args
     * @return Post
     */
    public function resolve($root, $args, $context, ResolveInfo $info) : Post
    {
        $user = User::findOrfail($args['user_id']);

        $post = $user->posts()->create([
            'title' => $args['title'],
            'content' => $args['content'],
        ]);

        return $post;
    }
}
