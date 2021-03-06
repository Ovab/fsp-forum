<?php
//create_topic.php
include 'connect.php';
include '../header.php';

echo '</div></div> <link rel="stylesheet" href="../css/css.css" type="text/css">';
echo '<h2>Create a topic</h2>';
if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="signin.php">signed in</a> to create a topic.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT
					cat_id,
					cat_name
				FROM
					catagory";

		$result = mysqli_query($conn, $sql);

		if(!$result) {
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
			else {

				echo '<form method="POST" action="">
					Subject: <input type="text" name="topic_subject" /><br />
					Category:';

				echo '<select name="topic_catagory">';
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
					}
				echo '</select><br />';

				echo 'Message: <br /><textarea name="post_content" /></textarea><br /><br />
					<input type="submit" value="Create topic" />
				 </form>';
			}
		}
    else{
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($conn, $query);
    }
	}
		if(!$result)
		{
			//the query failed, quit
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else
		{
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$sql = "INSERT INTO 
						topics(topic_subject,
							   topic_date,
							   Catagory_cat_id,
							   users_userID)
				   VALUES('" . mysqli_real_escape_string($conn, $_POST['topic_subject']) . "', NOW(),
							   " . mysqli_real_escape_string($conn, $_POST['topic_catagory']) . ",
							   " . $_SESSION['user_id'] . ")";

			$result = mysqli_query($conn, $sql);
			if(!$result)
			{
				//something went wrong, display the error
				//echo 'An error occured while inserting your data. Please try again later.<br /><br />';
				$sql = "ROLLBACK;";
				$result = mysqli_query($conn, $sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				$topicid = mysqli_insert_id($conn);

				$sql = "INSERT INTO
							posts(post_content,
								  post_date,
								  post_topic,
								  post_by)
						VALUES
							('" . mysqli_real_escape_string($conn, $_POST['post_content']) . "',
								  NOW(),
								  " . $topicid . ",
								  " . $_SESSION['user_id'] . "
							)";
				$result = mysqli_query($conn, $sql);

				if(!$result)
				{
					//something went wrong, display the error
					echo 'An error occured while inserting your post. Please try again later.<br /><br />' . mysqli_error($conn);
					$sql = "ROLLBACK;";
					$result = mysqli_query($conn, $sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysqli_query($conn, $sql);

					//after a lot of work, the query succeeded!
					echo 'You have succesfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
				}
			}
}

?>
