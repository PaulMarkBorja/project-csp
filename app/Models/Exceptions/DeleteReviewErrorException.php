<?php

namespace App\Models\Exceptions;

class DeleteReviewErrorException extends \Exception
{

  public function render($request)
  {
       return response()->json([
            'error' => 'delete_review_query_exception',
            'message' => $this->getMessage()
        ],500);
  }

}
