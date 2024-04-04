<?php

/*
File: Product.php
Created By: diffi
Date: 4/4/2024
Description: 
*/

class Shop extends Controller {
    public function index($optional = '') {
        // Require the model
        parent::model('Products');
        
        // Create an instance and query all products
        $productModel = Products::getInstance();
        $productData = $productModel->getAllProducts();
        
        // Check if any data was returned
        if (!$productData) {
            $this->view('shop/main');
            return;
        }
        
        // Layer the data into a dictionary
        $products = [];
        foreach ($productData as $product) {
            $products[] = [
                'ID' => $product->getProductID(),
                'Name' => $product->getName(),
                'Price' => $product->getPrice(),
                'Description' => $product->getDescription(),
            ];
        }
        
        // Render the page
        $this->view('shop/main', $products);
    }
    
    public function detail($id) {
        // Require the model
        parent::model('Products');
        
        // Create an instance and query all products
        $productModel = Products::getInstance();
        $productData = $productModel->getProduct($id);
        
        // Check if any data was returned
        if (!$productData) {
            $this->view('shop/main');
            return;
        }
        
        // Layer the data into a dictionary
        $products[] = [
            'ID' => $productData->getProductID(),
            'Name' => $productData->getName(),
            'Price' => $productData->getPrice(),
            'Description' => $productData->getDescription(),
        ];
        
        $this->view('shop/detail', $products);
    }
}
