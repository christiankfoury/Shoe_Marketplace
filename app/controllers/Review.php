<?php

namespace app\controllers;

class Review extends \app\core\Controller
{
    #[\app\filters\Login]
    public function editReview($listing_id, $review_id) {
        $review = new \app\models\Review();
        $review = $review->get($review_id);
        if ($review->username != $_SESSION['username']) {
            header("Location:/Listing/viewListing/$listing_id");
            return;
        }

        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else if (isset($_POST['searchBrandButton'])) {
            header("Location:/User/searchBrand/{$_POST['searchBrand']}");
        } else if (isset($_POST['actionReview'])) {
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

    #[\app\filters\Login]
    public function deleteReview($listing_id, $review_id) {
        $review = new \app\models\Review();
        $reviewDelete = $review->get($review_id);

        if ($_SESSION['username'] != $reviewDelete->username) {
            header("Location:/Listing/viewListing/$listing_id");
            return;
        }

        $review->deleteReview($review_id);

        header("Location:/Listing/viewListing/$listing_id");
    }
}
