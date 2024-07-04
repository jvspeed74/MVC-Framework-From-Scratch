# MVC Framework Guide

## Table of Contents

1. [Project Overview](#project-overview)
2. [Installation](#installation)
3. [Folder Structure](#folder-structure)
4. [Controllers](#controllers)
5. [Models](#models)
6. [Views](#views)

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

## Installation

### Prerequisites

- **XAMPP**
    - Free and open-source cross-platform web server solution stack package.
        - Minimum Version: 8.0
        - [XAMPP Download Page](https://www.apachefriends.org/download.html)

1. **Clone the repository:**
    ```
    git clone https://github.com/jvspeed74/PHP-Web-Framework.git
    ```
2. **Copy the repository files to XAMPP's htdocs directory:**
    - Your directory structure should look like `xampp/htdocs/PHP-Web-Framework`

3. **Start XAMPP:**
    - Enable `Apache Web Server` and `MySQL Database` from the XAMPP Control Panel.

4. **Import the Database:**
    - Open phpMyAdmin by heading to `http://localhost/phpmyadmin/` in a web browser (Google, Edge, ect)
    - From the navigation bar, click on the `Import` tab
    - In the topmost section, click choose file and import `fitnesss_db.sql` from the repository.
    - Scroll to the bottom of the page and click `Import`

5. **Run the application:**
    - Open a web browser and navigate to `http://localhost/PHP-Web-Framework/`
    - A fitness themed application should be displayed.

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

1. Create a new PHP file in the `app/controllers/` directory.
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
// app/core/Controller.php

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
// app/core/SessionManager.php

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

1. Create a new PHP file in the `app/models/` directory.
2. Define a class extending the base model class.
3. Implement methods for CRUD operations and data retrieval.
4. Use hard exception handling for lower-level operations.

Example:

```php
// app/models/ProductModel.php

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
// app/core/Model.php

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

Views are the client-oriented layer that provide an interface for interaction. They are the result of the backend work
done by the heavy lifting of Models and Controllers. The View layer contain action elements that directly call
controllers in order to complete the events the user requests.

### Declaration

To declare a view:

1. Create a new PHP file in the `views/` directory.
2. Define a class extending the base View class.
3. Implement static methods that orchestrate HTML elements.

Example:

```php
    // app/views/error/ErrorView.php

class ErrorView extends View {
    /**
     * Renders the error view.
     *
     * This method outputs the HTML content for displaying an error message.
     * It includes the error message within a styled container.
     *
     * @param string $message The error message to display.
     * @return void
     */
    public static function render(string $message): void {
        // HTML for error page
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Favicon-->
            <link rel="icon" type="image/x-icon" href="<?=IMG_URL?>/assets/favicon.ico"/>
            <title>FitFlex: <?= $message ?></title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }

                .container {
                    max-width: 600px;
                    margin: 50px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }

                h1 {
                    color: #e74c3c;
                }
            </style>
        </head>
        <body>
        <div class="container">
            <h1>Error</h1>
            <p><?php echo htmlspecialchars($message); ?></p>
            <p><a href="<?= BASE_URL ?>">Back to Home</a></p>
        </div>
        </body>
        </html>
        <?php
    }
}
```

Our example represents a view that displays an error message to the user. The static method `render` contains HTML/CSS
code formatting the page.

We also see PHP logic also incorporated into the method. The View layer is unique in that there should be minimal
business logic on each view. The model layer handles data processes and the controller layer handles actions and data
organization.

#### How does that implementation work?

```php
    public static function render(string $message): void {
        // HTML for error page
        ?>
```

In our instance, the `render` method accepts one argument:

- `$message` - a string representing an error message that is displayed on the page.

```php
        <div class="container">
            <h1>Error</h1>
            <p><?php echo htmlspecialchars($message); ?></p>
            <p><a href="<?= BASE_URL ?>">Back to Home</a></p>
        </div>
```

Deeper into the method declaration, the `$message` variable is echoed out onto the web page, providing the user with the
error information.

#### Where is the render method called from?

View methods can be called from anywhere; however, they are primarily called from the controller layer.

This example has a dedicated controller that handles errors.

```php
    // app/controllers/ErrorController.php

/**
 * Controller responsible for displaying error messages.
 */
class ErrorController {
    public function display(): void {
        // Render the error page
        ErrorView::render($message);
    }
}
```

Due to the static nature of the `ErrorView` class, its `render` method can be called from anywhere without instantiation
of an `ErrorView` object. This allows flexibility in the specific use cases that the view provides. Any controller can
display an error page to the user without jumping through extra hoops.


