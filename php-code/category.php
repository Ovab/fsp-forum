<?php
//category.php
include 'connect.php';
include '../header.php';
echo '</div></div> <link rel="stylesheet" href="../css/css.css" type="text/css">';

//first select the category based on $_POST['cat_id']
$id = ($_GET['id']);
/*
$sql = "SELECT cat_id, cat_name FROM catagory
		WHERE cat_id = ". mysqli_real_escape_string($conn,$id);
*/
$stmt = mysqli_prepare($conn,"SELECT cat_id, cat_name FROM catagory WHERE cat_id =?");
$stmt->bind_param("s", $id);
$stmt->execute();

$result = $stmt->get_result();

if(!$result)
{
	echo 'The category could not be displayed, please try again later. <br>' . mysqli_error($conn);
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
			echo '<h2>Topics in ' . $row['cat_name'] . ' category</h2><br />';
		}
	
		//do a query for the topics
		$sql = "SELECT	
                    Topic_id,
					users_userID,
					Topic_subject,
					topic_date,
					Catagory_cat_id
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
							echo '<h3><a href="topic.php?id=' . $row['Topic_id'] . '">' . $row['Topic_subject'] .'</a><br /><h3>';
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

