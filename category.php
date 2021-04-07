<?php
//category.php
include 'connect.php';
include 'header.php';

//first select the category based on $_GET['cat_id']
$sql = "SELECT fsp_forum.catagory.cat_id, fsp_forum.catagory.cat_name FROM fsp_forum.catagory WHERE cat_id = " . mysqli_real_escape_string($conn,$_GET['id']);

$result = mysqli_query($conn,$sql);

if(!$result)
{
	echo 'The category could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		//display category data
		while($row = mysqli_fetch_assoc($result))
		{
			echo '<h2>Topics in &prime;' . $row['cat_name'] . '&prime; category</h2><br />';
		}
	
		//do a query for the topics
		$sql = "SELECT	
					topics.users_userID,
					topics.Topic_subject,
					topics.topic_date,
					topics.Catagory_cat_id
				FROM
					topics
				WHERE
					Catagory_cat_id = " . mysqli_real_escape_string($conn,$_GET['id']);
		
		$result = mysqli_query($conn, $sql);
		
		if(!$result)
		{
			echo 'The topics could not be displayed, please try again later.';
		}
		else
		{
			if(mysqli_num_rows($result) == 0)
			{
				echo 'There are no topics in this category yet.';
			}
			else
			{
				//prepare the table
				echo '<table border="1">
					  <tr>
						<th>Topic</th>
						<th>Created at</th>
					  </tr>';	
					
				while($row = mysqli_fetch_assoc($result))
				{				
					echo '<tr>';
						echo '<td class="leftpart">';
							echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo date('d-m-Y', strtotime($row['topic_date']));
						echo '</td>';
					echo '</tr>';
				}
			}
		}
	}
}

include 'footer.php';
?>
