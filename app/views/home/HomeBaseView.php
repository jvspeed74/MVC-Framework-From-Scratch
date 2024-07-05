<?php

namespace PhpWebFramework\views\home;

class HomeBaseView extends BaseView
{
    public static function header(string $pageTitle): void
    {
        parent::header($pageTitle);
        ?>
        <!-- Header-->
        <header class="bg-dark py-1">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Welcome to FitFlex!</h1>

                    <p class="lead fw-normal text-white-50 mb-0">Your one-stop shop for fitness gear and
                        supplements.</p>
                </div>
            </div>
        </header>


        <!-- Hero Section -->
        <div class="hero-section position-relative">
            <img src="<?= IMG_URL ?>/assets/supp-image.jpg" alt="Supplements" class="img-fluid">
            <div class="hero-content position-absolute w-100 h-100 top-0 d-flex align-items-center justify-content-center"
                 style="background-color: rgba(173, 216, 230, 0.5);"> <!-- semi-transparent overlay -->
                <div class="text-center">
                    <h1 class="text-white display-3">Start Your Fitness Journey</h1>
                    <p class="lead text-white">Check out our premium supplements and gear to boost your performance.</p>
                    <a href="<?= BASE_URL ?>/product/index" class="btn btn-primary btn-lg">Shop Now</a>
                </div>
            </div>
        </div>
        <?php
    }
}
