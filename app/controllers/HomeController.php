<?php
namespace PhpWebFramework\controllers;
class HomeController
{
    public function index(): void
    {
        HomeIndexView::render();
    }
}
