<?php

include_once("Utilities/SessionManager.php");
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">OpenDevTools</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                        <a class="dropdown-item" href="dalgen.php">DALGen</a>
                        <a class="dropdown-item" href="tasktracker.php">TaskTracker</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                        <a class="dropdown-item" href="blog-home-1.php">Blog Home 1</a>
                        <a class="dropdown-item" href="blog-home-2.php">Blog Home 2</a>
                        <a class="dropdown-item" href="blog-post.php">Blog Sample</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <?php
                    $loggedIn = SessionManager::getUserId() > 0;
                    if (!$loggedIn) {
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"register.php\">Register</a></li>";
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\">Login</a></li>";
                    } else {
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"account.php\">Account</a></li>";
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"logout\">Logout</a></li>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>