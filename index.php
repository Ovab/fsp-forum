<?php
//create_cat.php
include 'connect.php';
include 'header.php';
session_start();
$sql = "SELECT
			fsp_forum.catagory.cat_id,
			fsp_forum.catagory.cat_name,
			COUNT(fsp_forum.topics.idtopics) AS topics
		FROM
			fsp_forum.catagory
		LEFT JOIN
			fsp_forum.topics
		ON
			topics.idtopics = catagory.cat_id
		GROUP BY
			catagory.cat_name, catagory.cat_id";

$result = mysqli_query($conn, $sql);

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		//prepare the table
		echo '<table border="1">
			  <tr>
				<th>Category</th>
				<th>Last topic</th>
			  </tr>';	
			
		while($row = mysqli_fetch_assoc($result))
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>';
				echo '</td>';
				echo '<td class="rightpart">';
				
				//fetch last topic for each cat
					$topicsql = "SELECT
									fsp_forum.topics.idtopics,
									fsp_forum.topics.Topic_subject,
									fsp_forum.topics.topic_date,
									fsp_forum.topics.Catagory_cat_id
								FROM
									fsp_forum.topics
								WHERE
									fsp_forum.topics.Catagory_cat_id = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
								
					$topicsresult = mysqli_query($conn, $topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysqli_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($topicrow = mysqli_fetch_assoc($topicsresult))
							echo '<a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a> at ' . date('d-m-Y', strtotime($topicrow['topic_date']));
						}
					}
				echo '</td>';
			echo '</tr>';
		}
	}
}

include 'footer.php';
?>
