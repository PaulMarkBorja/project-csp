<?php

namespace App\ModelsExceptions;

class CreateReviewErrorException extends \Exception
{

    public function render($request)
    {
         return response()->json([
              'error' => 'create_review_query_exception',
              'message' => $this->getMessage()
          ],500);
    }

}
