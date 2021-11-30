<?php

namespace app\controllers;

class Review extends \app\core\Controller
{
    public function viewReviews($shoe_id) {
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        $review = new \app\models\Review();
        $reviews = $review->getByShoeId($shoe_id);

        $this->view('Review/viewReviews', ['reviews' => $reviews]);
    }

    public function editReview($listing_id, $review_id) {
        if (isset($_POST['actionReview'])) {
            $review = new \app\models\Review();
            $review->review_id = $review_id;
            $review->message = $_POST['message'];
            $review->update();
            header("Location:/Listing/viewListing/$listing_id");
        } else {
            $review = new \app\models\Review();
            $review = $review->get($review_id);

            $this->view('Review/editReview', ['review' => $review]);
        }
    }

    public function deleteReview($listing_id, $review_id) {
        $review = new \app\models\Review();
        $review->deleteReview($review_id);

        header("Location:/Listing/viewListing/$listing_id");
    }
}
