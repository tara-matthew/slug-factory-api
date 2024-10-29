<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemNotFavouritedException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'Item has not been added to favourites',
            code: Response::HTTP_UNPROCESSABLE_ENTITY,
        );
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}