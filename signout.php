<?php
//signout.php
include 'connect.php';
include 'header.php';
echo '<h2>Sign out</h2>';

session_destroy();

include 'footer.php';