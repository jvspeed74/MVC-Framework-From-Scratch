<?php

/*
File: Home.php
Created By: diffi
Date: 4/4/2024
Description: 
*/

class Home extends Controller {
    public function index($optional = '') {
        $this->view('home/main', ['name' => 'Test']);
    }
}
