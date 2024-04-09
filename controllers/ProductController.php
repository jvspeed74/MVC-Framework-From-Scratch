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
        $products = $productModel->getProducts();
        
        // Render view
        $view = new ProductIndexView();
        $view->display($products);
    }
    
    public function show($id): void {
        // todo model does not have method for singular product
        // Create an instance and query all products
        $productModel = ProductModel::getInstance();
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
