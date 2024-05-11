# MVC Framework Guide

## Table of Contents

1. [Project Overview](#project-overview)
2. [Folder Structure](#folder-structure)
3. [Controllers](#controllers)
4. [Models](#models)
5. [Views](#views)
6. [Exception Handling](#exception-handling)

## Project Overview

- **Objective:** Design and develop a data-driven, interactive web application using PHP and MariaDB.
- **Focus:** Implement the MVC (Model-View-Controller) software design pattern to ensure a well-structured and
  maintainable codebase.
- **Functionality:** Provide users with several interactive features that increase engagement.
- **User Experience:** Prioritize usability and interactivity to create a seamless experience for users of all levels.

### Features

#### 1. User Authentication

- Allow users to register accounts and securely log in.
- Implement authentication measures to protect user data.

#### 2. E-commerce Store

- The site will host shopping cart functionality tied to a user account.
- Users can add, remove, update, and checkout products in their cart.

## Folder Structure

The project follows the following folder structure:

```
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
│ └─── assets/    
│ └─── css/    
│ └─── js/    
│ └─── index.php    
│  
├── vendor/  
│ └─── autoloader.php
```

## Controllers

Controllers handle incoming requests, process data, and return responses. They reside in the `app/controllers/`
directory. The files themselves follow a two word `PascalCase` naming convention. The last word must be `Controller` in
order for the class to be recognized by the router/dispatcher.

To declare a controller:

1. Create a new PHP file in the `controllers/` directory.
2. Define a class extending the base controller class.
3. Add methods corresponding to different routes or actions.
4. Use soft exception handling for higher-level operations.

Example:

```php
// app/controllers/ProductController.php

class ProductController extends Controller {

    // Point the model property to the model representing the object (i.e. ProductModel)
    public function __construct() {
        $this->model = ProductModel::getInstance();
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

The base `Controller` class declares two properties. One for the instance of the model and another for the session
manager instance.

```php
abstract class Controller {
    /**
     * @var object|null The model instance associated with the controller.
     */
    protected ?object $model = null;
    protected ?SessionManager $session = null;
    
}
```

The `SessionManager` class is the endpoint for all $_SESSION variable interactions. Let's take a look at the class.

```php
class SessionManager {
    private static SessionManager $_instance;
    
    private function __construct() {
        // Prevent instantiation
    }
    
    // Get the singleton instance of the SessionManager class.
    public static function getInstance(): SessionManager {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    // Start a session if not already started.
    public function startSession(): void {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Set session variables.
    public function set(array $data): void {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
    
    // Get the value of a session variable.
    public function get(string $key): mixed {
        return $_SESSION[$key] ?? null;
    }
    
    // Destroy the session.
    public function destroy(): void {
        session_destroy();
    }
    
    // Check if a session is active.
    public function isActive(): bool {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}
```

The purpose of the `SessionManager` class is to prevent direct use of session variables. The class provides a clean
interface of session interactions. Overall it aims to reduce code duplication and the potential of errors if a
session variable doesn't exist.

## Models

Models handle data manipulation and interaction with the database. They reside in the `app/models/` directory.

### Declaration

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
copies of the class being declared. It would be far from optimal to connect to the database more times than necessary.
See below:

```php
abstract class Model {

    protected Database $db;  // The database connection instance.
    
    /**
     * Model constructor.
     * Initializes the database connection.
     */
    protected function __construct() {
        $this->db = Database::getInstance();
    }
    
    // Static instance of the class that inherits this method.
    abstract static public function getInstance();
}
```

### Database

This framework utilizes MariaDB powered through XAMPP. The SQL syntax is fairly similar to MySQL with a few minor
deviations. All direct database operations are handled through the `Database` class. Models should obtain an instance of
the `Database` class once extending from the `Model` class.

Here is an example of how `ProductModel` uses the `Database` methods.

```php
    // app/models/ProductModel.php

    /**
     * Fetches all products from the database.
     *
     * Retrieves all product data from the specified database table,
     * ordered by productID in descending order.
     *
     * @return array An array containing Product objects representing all products in the database.
     */
    public function fetchAll(): array {
        // Declare SQL
        $sql = "SELECT * FROM $this->table ORDER BY productID DESC";
        
        // Query DB for data
        $query = $this->db->query($sql);
        
        // Create product obj from result
        $results = [];
        while ($row = $query->fetch_object(Product::class)) {
            $results[] = $row;
        }
        
        // Return list of Product objects
        return $results;
    }
```

In this example, the `db` property, which contains the `Database` instance, calls the `query` method with a prepared SQL
statement.

Let's see exactly how the `Database` object handles that request:

```php
    // app/core/Database.php

    /**
     * Send a query to the database.
     *
     * @param string $sql The SQL query to execute.
     * @return bool|mysqli_result The result of the query.
     * @throws mysqli_sql_exception if unable to execute the query.
     */
    public function query(string $sql): mysqli_result|bool {
        try {
            // Execute the query
            return $this->connection->query($sql);
        } catch (mysqli_sql_exception $e) {
            // Handle query execution errors
            ExceptionHandler::handleException($e, "Unable to process the query made to our data services.");
        }
    }
```

The `Database` object will attempt to run the SQL query and return the results. PHP's `mysqli` object is used to connect
to the database. It has a built-in exception named `mysqli_sql_exception`. Any errors or exceptions in database
operations will throw this exception. This is an example of a low-level exception and is handled abruptly with the user
created class `ExceptionHandler`.  

We'll dive into exception handling in a later chapter! For now, let's move onto how views work within the framework.

## Views

## Exception Handling
