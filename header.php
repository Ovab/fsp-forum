<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Bavo's forum" />
    <title>Ovab's forum</title>
</head>
<body>
    <div id="menu">
        <a class="item" href="/fsp-forum/index.php">Home</a> -
        <a class="item" href="/fsp-forum/php-code/create_topic.php">Create a topic</a> -
        <!-- <a class="item" href="/fsp-forum/php-code/create_cat.php">Create a category</a>-->
        <?php
        error_reporting(E_ERROR | E_PARSE);
        session_start();
        if ($_SESSION['signed_in']==true){
            echo "<a class='item' href='/fsp-forum/php-code/signout.php'>Sign <span style='color: #79EC80; border: #414141;'>". $_SESSION['user_name'] ."</span> out</a>";
        }
        else {
            echo "<a class='item' href='/fsp-forum/php-code/signup.php'>Sign up</a> - ";
            echo "<a class='item' href='/fsp-forum/php-code/signin.php'>Sign in</a>";
        }
        ?>
        <div class="grid-container">