<?php

declare(strict_types = 1);

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL;
use Illuminate\Support\Facades\Hash;
use App\User;

/**
 * ユーザーを登録するミューテーション
 */
class CreateUserMutation extends Mutation
{
    /**
     * ミューテーション名の定義と概要
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'CreateUser',
        'description' => 'CreateUser mutation'
    ];

    /**
     * ミューテーションが扱う型を定義
     *
     * @return ObjectType
     */
    public function type() : ObjectType
    {
        return GraphQL::type('UserType');
    }

    /**
     * ミューテーションが取り得る引数を定義
     *
     * @return array
     */
    public function args() : array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'rules' => ['required', 'string', 'max:255'],
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
                'rules' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
                'rules' => ['required', 'string', 'min:6'],
            ],
        ];
    }

    /**
     * ミューテーションに対する実処理
     *
     * @param array $root
     * @param array $args
     * @return User
     */
    public function resolve($root, $args, $context, ResolveInfo $info) : User
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => Hash::make($args['password']),
        ]);

        return $user;
    }
}
