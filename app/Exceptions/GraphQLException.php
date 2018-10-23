<?php

declare(strict_types = 1);

namespace App\Exceptions;

use Folklore\GraphQL\Error\ValidationError;
use GraphQL\Error\Error;

class GraphQLException
{
    public static function formatError(Error $e)
    {
        $error = [
            'message' => $e->getMessage()
        ];

        $locations = $e->getLocations();
        if (!empty($locations)) {
            $error['locations'] = array_map(function ($loc) {
                return $loc->toArray();
            }, $locations);
        }

        $previous = $e->getPrevious();
        if ($previous && $previous instanceof ValidationError) {
            $error['validation'] = $previous->getValidatorMessages();
        }

        // Logging
        logger()->error($error);
        logger()->error(request()->all());
        logger()->error($e);

        return $error;
    }
}
