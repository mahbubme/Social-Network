<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>S.N</th>
				<th>Title</th>
				<th>Category</th>
				<th>Author</th>
				<th>Date</th>
				<th>Delete</th>
				<th>Edit</th>
			</tr>
		</thead>

		<tbody>
			<?php 

				$sel_posts = "SELECT * from posts order by 1 DESC";
				$run_posts = mysqli_query( $connection, $sel_posts );

				$i = 0;

				while ( $row_post = mysqli_fetch_array( $run_posts ) ) {

					$post_id = $row_post['post_id'];
					$user_id = $row_post['user_id'];
					$topic_id = $row_post['topic_id'];
					$post_title = $row_post['post_title'];
					$post_date = $row_post['post_date'];

					$i++;

					// getting username of the post
					$sel_user = "SELECT * from users where user_id='$user_id'";
					$run_user = mysqli_query( $connection, $sel_user );
					$row_user = mysqli_fetch_array( $run_user );

					$user_name = $row_user['user_name'];

					// getting category title
					$topic_query = "SELECT * from topics where topic_id='$topic_id'";
					$run_topic_query = mysqli_query( $connection, $topic_query );
					$row_topic = mysqli_fetch_array( $run_topic_query );

					$cat_name = $row_topic['topic_title']; 

					$output  = "<tr class='active'>";
					$output .= "<td>$i</td>";
					$output .= "<td>$post_title</td>";
					$output .= "<td>$cat_name</td>";
					$output .= "<td>$user_name</td>";
					$output .= "<td>$post_date</td>";
					$output .= "<td><a href='delete_post.php?post_id=$post_id'>Delete</a></td>";
					$output .= "<td><a href='edit_post.php?post_id=$post_id'>Edit</a></td>";
					$output .= "</tr>";

					echo $output;

				}

			?>
		</tbody>

	</table>
</div>