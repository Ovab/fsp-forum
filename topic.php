<?php
//create_cat.php
include 'connect.php';
include 'header.php';

$sql = "SELECT
			fsp_forum.topics.Topic_id,
			fsp_forum.topics.Topic_subject
		FROM
			fsp_forum.topics
		WHERE
			Topic_id = " . mysqli_real_escape_string($conn,$_GET['id']);
			
$result = mysqli_query($conn, $sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
			//display post data

			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['Topic_subject'] . '</th>
					</tr>';

		
			//fetch the posts from the database
            $order = " ORDER BY post_date";
			$posts_sql = "SELECT
						post_topic,
						post_content,
						post_date,
						post_by,
						userID,
						username
					FROM
						posts
					LEFT JOIN
						users
					ON
						post_by = users.userID
					WHERE
						post_topic = " . mysqli_real_escape_string($conn,$_GET['id']). $order
            ;
						
			$posts_result = mysqli_query($conn, $posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{

				while($posts_row = mysqli_fetch_assoc($posts_result))
				{
                    echo '<tr class="topic-post">
							<td class="user-post">' . $posts_row['username'] . '<br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td>
							<td class="post-content">' . htmlentities(stripslashes($posts_row['post_content'])) . '</td>
						  </tr>';
				}
			}

			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				//show reply box
				echo '<tr><td colspan="2"><h2>Reply:</h2><br />
					<form method="post" action="reply.php?id=' . $row['Topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					</form></td></tr>';
			}
			
			//finish the table
			echo '</table>';
		}
	}
}

include 'footer.php';
?>