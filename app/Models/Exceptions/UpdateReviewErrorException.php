<?php

namespace App\Models\Exceptions;

class UpdateReviewErrorException extends \Exception
{
    public function render($request)
    {
         return response()->json([
              'error' => 'update_review_query_exception',
              'message' => $this->getMessage()
          ],500);
    }

}
