<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function 記事を登録するテスト()
    {
        $query = file_get_contents(__DIR__ . '/CreatePostMutation.gql');

        $user = factory(User::class)->create();

        $variables = [
            'user_id' => $user->id,
            'title' => 'テストタイトル',
            'content' => 'テスト内容',
        ];

        $json = [
            'data' => [
                'CreatePost' => $variables
            ],
        ];

        $response = $this->graphql($query, $variables);
        $response->assertStatus(200)->assertJson($json);
    }
}
