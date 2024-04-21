<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: View.php
 * Description: Abstract class containing the foundation for the header and footer methods.
 * todo different header depending on user login status
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
            <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
            <!-- Bootstrap icons-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
            <!-- Core theme CSS (includes Bootstrap)-->
            <link href="/I211-Team-Project/public/css/styles.css" rel="stylesheet"/>
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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <!-- todo handle active page on specific views -->
                        <!-- todo not implemented -->
                        <li class="nav-item"><a class="nav-link active" aria-current="page"
                                                href="<?= BASE_URL ?>/course/index">Classes</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Analytics</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- todo not implemented-->
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li>
                                    <hr class="dropdown-divider"/>
                                </li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
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
                            <!-- todo not implemented -->
                            <div class="d-flex">
                                <button class="btn btn-outline-primary me-2" type="button"
                                        onclick="location.href='<?=BASE_URL?>/user/index'">Login
                                </button>
                                <button class="btn btn-outline-secondary me-2" type="button"
                                        onclick="location.href='register.html'">Register
                                </button>
                                <!-- Cart button -->
                                <!-- todo not implemented -->
                                <button class="btn btn-outline-dark" type="button" onclick="location.href='cart.html'">
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
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With FitFlex</p>
                </div>
            </div>
        </header>
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
        <!-- Core theme JS-->
        <script src="/I211-Team-Project/public/js/scripts.js"></script>
        </body>
        </html>
        <?php
    }
}

