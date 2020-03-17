<?php

namespace App\Models\Repositories;

use App\Models\Base\BaseRepository;
use App\Models\Review;
use App\Models\Exceptions\ReviewNotFoundErrorException;
use App\Models\Exceptions\CreateReviewErrorException;
use App\Models\Exceptions\UpdateReviewErrorException;
use App\Models\Exceptions\DeleteReviewErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    /**
     * ReviewRepository constructor.
     *
     * @param Review $review
     */
    public function __construct(Review $review)
    {
        parent::__construct($review);
        $this->model = $review;
    }

    /**
     * @param array $data
     *
     * @return Review
     * @throws CreateReviewErrorException
     */
    public function createReview(array $data): Review
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new CreateReviewErrorException($e);
        }
    }

    /**
     * @param int $id
     *
     * @return Review
     * @throws ReviewNotFoundErrorException
     */
    public function findReviewById(int $id): Review
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ReviewNotFoundErrorException($e);
        }
    }

    /**
     * @param array $data
     * @param int $id
     *
     * @return bool
     * @throws UpdateReviewErrorException
     */
    public function updateReview(array $data): bool
    {
        try {
            return $this->update($data);
        } catch (QueryException $e) {
            throw new UpdateReviewErrorException($e);
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteReview(): bool
    {

        try {
            return $this->delete();
        } catch (QueryException $e) {
            throw new DeleteReviewErrorException($e);
        }
    }
}
