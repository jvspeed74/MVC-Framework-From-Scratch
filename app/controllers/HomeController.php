<?php

class HomeController
{
    public function index(): void
    {
        HomeIndexView::render();
    }
}
