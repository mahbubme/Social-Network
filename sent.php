<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Receiver</th>
				<th>Subject</th>
				<th>Date</th>
				<th>Reply</th>
			</tr>
		</thead>
		<tbody>
			<?php 

				$sel_msg = "SELECT * from messages where sender='$user_id' AND msg_type='parent' order by 1 DESC";
				$run_msg = mysqli_query( $connection, $sel_msg );

				$count_msg = mysqli_num_rows( $run_msg );

				while ( $row_msg = mysqli_fetch_array( $run_msg ) ) {

					$msg_id = $row_msg['msg_id'];
					$msg_receiver = $row_msg['receiver'];
					$msg_sender = $row_msg['sender'];
					$msg_sub = $row_msg['msg_sub'];
					$msg_topic = $row_msg['msg_topic'];
					$msg_date = $row_msg['msg_date'];

					$get_receiver = "SELECT * from users where user_id='$msg_receiver'";
					$run_receiver = mysqli_query( $connection, $get_receiver );
					$row = mysqli_fetch_array( $run_receiver );

					$receiver_name = $row['user_name'];

					$output  = "<tr class='active'>";
					$output .= "<td><a href='user_profile.php?u_id=$msg_receiver'>$receiver_name</a></td>";
					$output .= "<td><a href='my_messages.php?msg_id=$msg_id'>$msg_sub</a></td>";
					$output .= "<td>$msg_date</td>";
					$output .= "<td><a href='my_messages.php?msg_id=$msg_id'>View Reply</a></td>";
					$output .= "</tr>";

					echo $output; 

				}

			?>
		</tbody>
	</table>
</div>