<?php

namespace App\Models\Requests;

use App\Models\Base\BaseFormRequest;

class CreateReviewRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'review' => ['required']
        ];
    }
}
