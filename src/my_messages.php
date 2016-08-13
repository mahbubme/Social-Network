<?php 

	session_start(); 
	include ( "includes/connection.php" );
	include ( "functions/functions.php" );

	if ( !isset( $_SESSION['user_email'] ) ) {
		header( "location: index.php" );
	}else {

		include ( "header.php" );
		include ( "user_sidebar.php" );
?>
		<div class="col-sm-9">
			<h2>See your messages:</h2>

			<div class="clearfix btn-group text-center">
				<a href="my_messages.php?inbox&u_id=<?php echo $user_id; ?>" class="btn btn-success">My Inbox</a>
				<a href="my_messages.php?sent&u_id=<?php echo $user_id; ?>" class="btn btn-primary">Sent Items</a>
			</div>
			<?php
				if ( isset( $_GET['sent'] ) ) {

					include( "sent.php" );

				} 
			?>

			<?php if ( isset( $_GET['inbox'] ) ) {?>
				<div class="table-responsive">
					<table class="table">

						<thead>
							<tr>
								<th>Sender</th>
								<th>Subject</th>
								<th>Date</th>
								<th>Reply</th>
							</tr>
						</thead>
						<tbody>
							<?php 

								$sel_msg = "SELECT * from messages where receiver='$user_id' AND msg_type='parent' order by 1 DESC";
								$run_msg = mysqli_query( $connection, $sel_msg );

								$count_msg = mysqli_num_rows( $run_msg );

								while ( $row_msg = mysqli_fetch_array( $run_msg ) ) {

									$msg_id = $row_msg['msg_id'];
									$msg_receiver = $row_msg['receiver'];
									$msg_sender = $row_msg['sender'];
									$msg_sub = $row_msg['msg_sub'];
									$msg_topic = $row_msg['msg_topic'];
									$msg_date = $row_msg['msg_date'];
									$msg_status = $row_msg['status'];

									$get_sender = "SELECT * from users where user_id='$msg_sender'";
									$run_sender = mysqli_query( $connection, $get_sender );
									$row = mysqli_fetch_array( $run_sender );

									$sender_name = $row['user_name'];

									if ( $msg_status == 'unread' ) {
										$output = "<tr class='success'>";
									}else {
										$output = "<tr class='active'>";
									}

									$output .= "<td><a href='user_profile.php?u_id=$msg_sender'>$sender_name</a></td>";
									$output .= "<td><a href='my_messages.php?msg_id=$msg_id'>$msg_sub</a></td>";
									$output .= "<td>$msg_date</td>";
									$output .= "<td><a href='my_messages.php?msg_id=$msg_id'>Reply</a></td>";
									$output .= "</tr>";

									echo $output; 

								}

							?>
						</tbody>
					</table>
				<?php } ?>

				<?php

					if ( isset( $_POST['submit_msg'] ) ) {

						$get_id = $_GET['msg_id'];

						$select_parrent_msg = "SELECT * from messages where msg_id='$get_id'";
						$run_parrent_msg = mysqli_query( $connection, $select_parrent_msg );
						$row_parrent_msg = mysqli_fetch_array( $run_parrent_msg );

						$parrent_msg_receiver = $row_parrent_msg['receiver'];
						$parrent_msg_sender = $row_parrent_msg['sender'];

						$reply_sender = $user_id;

						if ( $parrent_msg_receiver == $user_id ) {
							$reply_receiver = $parrent_msg_sender;
						}else {
							$reply_receiver = $parrent_msg_receiver;
						}

						$user_reply = $_POST['msg_reply'];
						$reply_status = "read";
						$reply_msg_type = "reply";

						$insert_reply_msg = "INSERT into messages(parrent_msg_id,sender,receiver,reply,status,msg_type,msg_date) values('$get_id','$reply_sender','$reply_receiver','$user_reply','read','reply',NOW())";
						$run_update = mysqli_query( $connection, $insert_reply_msg);

					}

					if ( isset( $_GET['msg_id'] ) ) {

						$get_id = $_GET['msg_id'];
						
						$select_msg = "SELECT * from messages where msg_id='$get_id'";
						$run_message = mysqli_query( $connection, $select_msg );

						$row_message = mysqli_fetch_array( $run_message );

						$msg_subject = $row_message['msg_sub'];
						$msg_topic = $row_message['msg_topic'];
						$msg_receiver = $row_message['receiver'];
						$msg_sender = $row_message['sender'];

						// get receiver name
						$get_receiver   = "SELECT * from users where user_id='$msg_receiver'";
						$run_receiver   = mysqli_query( $connection, $get_receiver );
						$row_receiver	= mysqli_fetch_array( $run_receiver );

						$receiver_name = $row_receiver['user_name'];
						$receiver_image = $row_receiver['user_image'];

						// get sender name
						$get_sender   = "SELECT * from users where user_id='$msg_sender'";
						$run_sender  = mysqli_query( $connection, $get_sender );
						$row_sender	= mysqli_fetch_array( $run_sender );

						$sender_name = $row_sender['user_name'];
						$sender_image = $row_sender['user_image'];

						// updating the unread message to read
						$update_unread = "UPDATE messages set status='read' where msg_id='$get_id'";
						$run_unread = mysqli_query( $connection, $update_unread );

						$output   = "<div class='well clearfix'>";
						$output  .= "<div class='message parent'>";
						$output  .= "<h4><img src='user/user_images/$sender_image'><strong> $sender_name</strong></h4>";
						$output  .= "<p><strong>Subject:</strong> $msg_subject</p>";
						$output  .= "<p><strong>Message:</strong> $msg_topic</p><br>";
						$output  .= "</div>";

						// get all replies to this message 
						$get_msg_reply = "SELECT * from messages where parrent_msg_id='$get_id' AND msg_type='reply'  order by msg_date ASC";
						$msg_reply_query = mysqli_query( $connection, $get_msg_reply );
						
						while ( $row_msg_reply = mysqli_fetch_array( $msg_reply_query ) ) {

							$reply_sender = $row_msg_reply['sender'];
							$reply_receiver = $row_msg_reply['receiver'];

							$reply_content = $row_msg_reply['reply'];

							if ( $reply_sender == $msg_sender ) {

								$output  .= "<div class='message reply sender clearfix'>";
								$output  .= "<img src='user/user_images/$sender_image'>";
								$output  .= "<p class='text-right'>$reply_content</p>";
								$output  .= "</div>";

							}else {

								$output  .= "<div class='message reply receiver clearfix'>";
								$output  .= "<img src='user/user_images/$receiver_image'>";
								$output  .= "<p class='text-right'>$reply_content</p>";
								$output  .= "</div>";

							}

						}

						$output  .= "<div class='reply-to-message clearfix'>";
						$output  .= "<form action='my_messages.php?msg_id=$get_id' method='POST' class='form-horizontal'>";
						$output  .= "<textarea name='msg_reply' class='form-control' rows='10' placeholder='Reply to this message...' required></textarea><br>";
						$output  .= "<input type='submit' name='submit_msg' class='btn btn-success pull-right' value='Reply to This Message'>";
						$output  .= "</form>";	 
						$output  .= "</div>";
						$output  .= "</div>";	

						echo $output;
					
					}

					
				?>
			</div>
		</div>


<?php 

	include( "footer.php" );

} ?>