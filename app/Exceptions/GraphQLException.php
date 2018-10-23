<?php

declare(strict_types = 1);

namespace App\Exceptions;

use Folklore\GraphQL\Error\ValidationError;
use GraphQL\Error\Error;
use Folklore\GraphQL\GraphQL;

class GraphQLException extends GraphQL
{
    public static function formatError(Error $e)
    {
        $error = parent::formatError($e);

        // Logging
        logger()->error($error);
        logger()->error(request()->all());
        logger()->error($e);

        return $error;
    }
}
