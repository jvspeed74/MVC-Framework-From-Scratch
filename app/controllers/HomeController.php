<?php

namespace PhpWebFramework\controllers;

use PhpWebFramework\views\home\HomeIndexView;

class HomeController
{
    public function index(): void
    {
        HomeIndexView::render();
    }
}
