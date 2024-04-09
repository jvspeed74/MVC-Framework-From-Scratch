<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: HomeIndex.php
 * Description:
 */

class HomeIndexView extends View {
    public function display(): void {
        parent::displayHeader();
        ?>
        <body>
        <h1>Welcome to Group 4's Draft 1 submission!</h1>
        <p>This submission is not representative of the group project. Basic functionality is implemented that adheres
            to the
            project requirements. This build contains the following features:<br>MVC Organizational Structure<br>Display
            inventory items<br>
            Display inventory details</p>
        <ul>
            <li><a href="home">Home</a></li>
            <li><a href="shop">Shop</a></li>
        </ul>
        </body>
        </html>
        <?php
        parent::displayFooter();
    }
}
