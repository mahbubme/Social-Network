<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>S.N</th>
				<th>Topic Title</th>
				<th>Posts</th>
				<th>View</th>
				<th>Delete</th>
				<th>Edit</th>
			</tr>
		</thead>

		<tbody>
			<?php 

				$sel_topics = "SELECT * from topics order by 1 DESC";
				$run_topics = mysqli_query( $connection, $sel_topics );

				$i = 0;

				while ( $row_topic = mysqli_fetch_array( $run_topics ) ) {

					$topic_id = $row_topic['topic_id'];
					$topic_title = $row_topic['topic_title'];

					$i++;

					// getting total number of posts for the same topic
					$sel_posts = "SELECT * from posts where topic_id='$topic_id'";
					$run_posts = mysqli_query( $connection, $sel_posts );
					$total_posts = mysqli_num_rows( $run_posts );

					$output  = "<tr class='active'>";
					$output .= "<td>$i</td>";
					$output .= "<td>$topic_title</td>";
					$output .= "<td>$total_posts</td>";
					$output .= "<td><a href='../topic.php?topic=$topic_id' target='blank'>View</a></td>";
					$output .= "<td><a href='delete_topic.php?topic_id=$topic_id'>Delete</a></td>";
					$output .= "<td><a href='edit_topic.php?topic_id=$topic_id'>Edit</a></td>";
					$output .= "</tr>";

					echo $output;

				}

			?>
		</tbody>

	</table>
</div>

<div class="add-category">
	<div class="clearfix">
		<a href="index.php?page=topics&newtopic" class="btn btn-success">Add New Topic</a>
	</div>

	<?php 

		if ( isset( $_GET['newtopic'] ) ) {

			include ( 'add_topic.php' );

		}

	?>
</div>