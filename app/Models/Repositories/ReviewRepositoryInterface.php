<?php

namespace App\Models\Repositories;

use App\Models\Base\BaseRepositoryInterface;
use App\Models\Review;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

interface ReviewRepositoryInterface extends BaseRepositoryInterface
{
    public function createReview(array $data): Review;

    public function findReviewById(int $id) : Review;

    public function updateReview(array $data) : bool;

    public function deleteReview() : bool;
}
