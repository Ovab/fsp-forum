<?php
//create_cat.php
$servername = "localhost";
$username = "root";
$password = "";
$database= 'fsp_forum';

// Create connection
$conn = new mysqli($servername, $username, $password, $database, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    //the form hasn't been posted yet, display it
    echo '<form method="post" action="">
			Category name: <input type="text" name="cat_name" /><br />
			<input type="submit" value="Add category" />
		 </form>';
}
else
{
	//the form has been posted, so save it
	$sql = "INSERT INTO catagory(catagory.cat_name) 
    VALUES(" . mysqli_real_escape_string($conn, $_POST['cat_name']) . ")";
    $result = mysqli_query($conn, $sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo mysqli_error($conn);
    }
    else
    {
        echo 'New category successfully added.';
    }
}
