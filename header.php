<?php

include_once("Utilities/SessionManager.php");

//include_once("DAL/Blog.php");



?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index">OpenDevTools</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="about">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                        <a class="dropdown-item" href="dalgen">DALGen</a>
                        <a class="dropdown-item" href="tasktracker">TaskTracker</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                        <a class="dropdown-item" href="bloghome">Blog Home</a>

                        <?php

                        $blogs = Blog::loadall();

                        //$blogs = SessionManager::getBlogNavItems();

                        foreach ($blogs as $blog) {

                            ?>
                            <a class="dropdown-item" href="blog?id=<?php echo $blog->getId(); ?>"><?php echo $blog->getTitle();?></a>
                            <?php
                        }//end foreach

                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact">Contact</a>
                </li>
                <li class="nav-item">
                    <?php
                    $loggedIn = SessionManager::getUserId() > 0;
                    if (!$loggedIn) {
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"register\">Register</a></li>";
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"login\">Login</a></li>";
                    } else {
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"account\">Account</a></li>";
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"logout\">Logout</a></li>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>