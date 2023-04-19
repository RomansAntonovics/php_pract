<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>My Blog</title>

    <link rel='stylesheet' href='style.css'>


    <?php
    if (!empty($head)) {
        echo $head;
    }
    ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <?php
    if (!empty($styles)) {
        echo $styles;
    }
    ?>


</head>

<body>

<div class="header" style="margin-top: 30px;">

    <div class="headerTop">

        <div class="container">

            <div class="row d-flex justify-content-between">

                <div class="logo md-3 mb-4">
                    <a class="navbar-brand" href="/">
                        <img src="/images/mail-logo.png" height="40" style="margin-bottom: 0" alt="logo">
                    </a>
                </div>

                <?php if (!empty($_SESSION['user'])) : ?>

                    <div class="userInfo">
                        <p>Welcome, <?php echo $_SESSION['user']['login']; ?></p>
                        <a href="/logout">Logout</a>
                    </div>

                <?php else: ?>

                    <div class="loginForm">

                        <form class="form-inline" method="post" action="/login">

                            <div class="form-group mb-2">
                                <label class="sr-only" for="login">Login</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="login" name="login"
                                       placeholder="login">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label class="sr-only" for="password">Password</label>
                                <input type="password" class="form-control mb-2 mr-sm-2" id="password" name="password"
                                       placeholder="password">
                            </div>

                            <button type="submit" class="btn btn-primary mb-2">Login</button>
                        </form>

                        <?php if (!empty($errors['login'])) : ?>

                            <div class="text-danger">
                                <?php echo $errors['login']; ?>
                            </div>

                        <?php endif; ?>

                    </div>

                <?php endif; ?>
            </div>

        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/articles">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container" style="margin-top: 40px;">
    <?php
    if (!empty($content)) {
        echo $content;
    }
    ?>
</div>

<!-- jQuery and Bootstrap Bundle  -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

<script src="/js/app.js"></script>

<?php
if (!empty($scripts)) {
    echo $scripts;
}
?>


</body>
</html>
