# MVC Framework Guide

## Introduction

Welcome! This README will guide you through the architecture and conventions used in this project.

## Table of Contents

1. [Project Overview](#project-overview)
2. [Folder Structure](#folder-structure)
3. [Controllers](#controllers)
4. [Models](#models)
5. [Views](#views)
6. [Exception Handling](#exception-handling)

## Folder Structure

The project follows the following folder structure:

project-root/  
│  
├── app/  
│ ├─── controllers/  
│ ├─── core/  
│ ├─── models/  
│ ├─── exceptions/  
│ └─── views/  
│  
├── public/  
│ └─── index.php    
│  
├── vendor/  
│ └─── autoloader.php

## Controllers

Controllers handle incoming requests, process data, and return responses. They reside in the `app/controllers/`
directory.

To declare a controller:

1. Create a new PHP file in the `controllers/` directory.
2. Define a class extending the base controller class.
3. Add methods corresponding to different routes or actions.
4. Use soft exception handling for higher-level operations.

Example:

```php
// app/Controllers/ProductController.php

class ProductController extends Controller {
    protected function loadModel() {
        // Sets the property `model` to an instance of the Product Model
        ProductModel::getInstance()
}

    public function index() {
        // Controller logic for the index route
    }
    
    public function show($id) {
        // Controller logic for showing a single product
    }
    
    // Other controller methods...
}
```

When extending the Controller class, each controller should implement a `loadModel()` method that instantiates and
returns
the model associated with the controller.

```php
// app/core/Controller.php

abstract class Controller {
    /**
    * @var object The model instance associated with the controller.
    */
    protected object $model;
    
    /**
    * Constructor.
    * 
    * Upon creation of the controller, the loadModel method is called
    * to set the model property to an instance of the object the controller is responsible for.
    */
    public function __construct() {
        $this->model = $this->loadModel();
    }
```

This ensures that each controller has access to its corresponding model for
data manipulation and retrieval.

In the ProductController example, `loadModel()` returns an instance of `ProductModel` using
the `getInstance()` method, ensuring that the controller has access to the product-related functionality provided by the
model.

## Models

Models handle data manipulation and interaction with the database. They reside in the `app/models/` directory.

To declare a model:

1. Create a new PHP file in the `models/` directory.
2. Define a class extending the base model class.
3. Implement methods for CRUD operations and data retrieval.
4. Use hard exception handling for lower-level operations.

Example:

```php
<?php

// Represents a model for product.
class ProductModel extends Model {
    
    // Fetches all products from the database.
    public function fetchAll(): array {
        // ...
    } 
    
    // Fetching the products that match search terms
    public function fetchBySearch($terms){
        // ..
    }
    
    // Other class related methods
}

```

The `Database` class is instantiated in the base model class as the `db` property. There is no intervention required in
this process. The `getInstance()` method ensures that the controller can communicate with the model without multiple
copies of the class being declared.


