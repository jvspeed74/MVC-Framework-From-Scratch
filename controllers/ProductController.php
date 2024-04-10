<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ProductController.php
 * Description:
 */

class ProductController extends Controller {
    protected function loadModel(): ProductModel {
        return ProductModel::getInstance();
    }
    
    public function index(): void {
        // Get all products from DB
        $products = $this->model->fetchAll();
        
        // Render view
        ProductIndexView::render($products);
    }
    
    public function show($id): void {
        // Query product from DB
        $product = $this->model->fetchByID($id);
        
        // Render view
        ProductShowView::render($product);
    }
    
    
}
