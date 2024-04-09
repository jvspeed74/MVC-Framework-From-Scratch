<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ProductController.php
 * Description:
 */

class ProductController {
    public function index(): void {
        // Get all products from DB
        $productModel = ProductModel::getInstance();
        $products = $productModel->getAllProducts();
        
        // Render view
        $view = new ProductIndexView();
        $view->display($products);
    }
    
    public function show($id): void {
        // todo model does not have method for singular product
        // Create an instance and query all products
        $productModel = ProductModel::getInstance();
        $productData = $productModel->getProduct($id);
        
        // Render view
        $view = new ProductShowView();
        
        // Check if any data was returned
        if (!$productData) {
            exit();
            
        } else
        
        $view->display($productData);
    }
}
