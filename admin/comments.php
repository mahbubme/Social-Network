<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>S.N</th>
				<th>Comment</th>
				<th>Author</th>
				<th>Date</th>
				<th>Delete</th>
				<th>Edit</th>
			</tr>
		</thead>

		<tbody>
			<?php 

				$sel_comments = "SELECT * from comments order by 1 DESC";
				$run_comments = mysqli_query( $connection, $sel_comments );

				$i = 0;

				while ( $row_comment = mysqli_fetch_array( $run_comments ) ) {

					$comment_id = $row_comment['comment_id'];
					$user_id = $row_comment['user_id'];
					$comment = $row_comment['comment'];
					$date = $row_comment['date'];

					$i++;

					// getting username of the comment
					$sel_user = "SELECT * from users where user_id='$user_id'";
					$run_user = mysqli_query( $connection, $sel_user );
					$row_user = mysqli_fetch_array( $run_user );

					$comment_user_name = $row_user['user_name'];

					$output  = "<tr class='active'>";
					$output .= "<td>$i</td>";
					$output .= "<td>$comment</td>";
					$output .= "<td>$comment_user_name</td>";
					$output .= "<td>$date</td>";
					$output .= "<td><a href='delete_comment.php?comment_id=$comment_id'>Delete</a></td>";
					$output .= "<td><a href='edit_comment.php?comment_id=$comment_id'>Edit</a></td>";
					$output .= "</tr>";

					echo $output;

				}

			?>
		</tbody>

	</table>
</div>