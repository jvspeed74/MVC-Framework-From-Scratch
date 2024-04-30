<?php

/**
 * Class View
 *
 * Abstract class containing the foundation for the header and footer methods.
 *
 */
abstract class View {
    
    /**
     * Outputs the HTML header for the webpage.
     *
     * This method outputs the standard HTML header including the doctype declaration,
     * meta tags, and title tag. It also includes some basic CSS styling.
     *
     * @param string $pageTitle The title to be displayed on the browser tab.
     * @return void
     */
    static public function header(string $pageTitle): void {
        // Start session
        $session = SessionManager::getInstance();
        $session->startSession();
        
        // Get current page URL
        $currentUrl = $_SERVER['REQUEST_URI'];
        
        // Logic for active navigation links
        $navLinks = [
            'Shop' => BASE_URL . '/product/index',
            'Courses' => BASE_URL . '/course/index'
        ];
        
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
            <meta name="description" content=""/>
            <meta name="author" content=""/>
            <title>FitFlex: <?= $pageTitle ?></title>
            <!-- Favicon-->
            <link rel="icon" type="image/x-icon" href="<?= IMG_URL ?>/assets/favicon.ico"/>
            <!-- Bootstrap icons-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
            <!-- Core theme CSS (includes Bootstrap)-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                  crossorigin="anonymous">
        </head>
        <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="<?= BASE_URL ?>">FitFlex</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
                </button>
                <!--  Dynamically set navigation links and active link style-->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <?php foreach ($navLinks as $label => $url): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($currentUrl === $url) ? 'active' : ''; ?>"
                                   href="<?php echo $url; ?>"><?php echo $label; ?></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                    <div class="container">
                        <!-- Navbar or similar container for alignment -->
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <!-- Form for search and buttons -->
                            <form class="d-flex flex-grow-1 me-3" method="get" action="<?= BASE_URL ?>/product/search/">
                                <!-- Search input -->
                                <input class="form-control me-2" type="search" name="search-terms" placeholder="Search"
                                       aria-label="Search">
                                <!-- Search button -->
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                            <!-- Login and Register Links -->
                            <div class="d-flex">
                                <?php
                                if ($session->get('login-status')) {
                                    // Display logout button if user is logged in ?>
                                    <button class="btn btn-outline-primary me-2" type="button"
                                            onclick="location.href='<?= BASE_URL ?>/user/logout'">Logout
                                    </button>
                                    <?php
                                } else {
                                    // Display login/register buttons if user is not logged in ?>
                                    <button class="btn btn-outline-primary me-2" type="button"
                                            onclick="location.href='<?= BASE_URL ?>/user/login'">Login
                                    </button>
                                    <button class="btn btn-outline-secondary me-2" type="button"
                                            onclick="location.href='<?= BASE_URL ?>/user/signup'">Register
                                    </button>
                                <?php } ?>
                                <!-- Cart button -->
                                <button class="btn btn-outline-dark" type="button"
                                        onclick="location.href='<?= BASE_URL ?>/cart/index'">
                                    <i class="bi-cart-fill me-1"></i>
                                    Cart
                                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                                </button>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </nav>
        <?php
    }
    
    /**
     * Outputs the HTML footer for the webpage.
     *
     * This method is intended to be implemented to output the HTML footer
     * content for the webpage. It can be used to include scripts, closing
     * tags, or any other content needed for the footer.
     *
     * @return void
     */
    static public function footer(): void {
        ?>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
}

