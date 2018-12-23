<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * GraphQL POST request.
     *
     * @param  string $query
     * @param  array  $variables
     * @param  array  $data
     * @param  array  $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function graphql(string $query, array $variables = [], array $data = [], array $headers = []): TestResponse
    {
        $data = [
            'query' => $query,
            'variables' => json_encode($variables),
        ] + $data;

        return $this->post('/graphql', $data, $headers);
    }
}
