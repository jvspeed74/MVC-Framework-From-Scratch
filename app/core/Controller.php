<?php

/*
File: Controller.php
Created By: diffi
Date: 4/4/2024
Description: 
*/

class Controller {
    protected function model($model) {
        require_once '../app/models/' . ucfirst($model) . '.php';
    }
    
    protected function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }
}
