<?php


/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: HomeController.php
 * Description:
 */


class HomeController {
    public function index(): void {
        $view = new HomeIndexView();
        $view->displayHeader();
        $view->display();
        $view->displayFooter();
    }
}
