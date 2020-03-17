<?php

namespace App\Models\Exceptions;

class ReviewNotFoundErrorException extends \Exception
{
    public function render($request)
    {
         return response()->json([
              'error' => 'Review_not_found',
              'message' => $this->getMessage()
          ],404);
    }
}
