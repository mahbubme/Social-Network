 <div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>S.N</th>
				<th>User Id</th>
				<th>Name</th>
				<th>Country</th>
				<th>Gender</th>
				<th>Image</th>
				<th>Delete</th>
				<th>Edit</th>
			</tr>
		</thead>

		<tbody>
			<?php 

				$sel_users = "SELECT * from users order by 1 DESC";
				$run_users = mysqli_query( $connection, $sel_users );

				$i = 0;

				while ( $row_users = mysqli_fetch_array( $run_users ) ) {

					$user_id = $row_users['user_id'];
					$user_name = $row_users['user_name'];
					$user_country = $row_users['user_country'];
					$user_gender = $row_users['user_gender'];
					$user_image = $row_users['user_image'];
					$user_reg_date = $row_users['register_date'];

					$i++;

					$output  = "<tr class='active'>";
					$output .= "<td>$i</td>";
					$output .= "<td>$user_id</td>";
					$output .= "<td>$user_name</td>";
					$output .= "<td>$user_country</td>";
					$output .= "<td>$user_gender</td>";
					$output .= "<td><img src='../user/user_images/$user_image' class='user-thumb'></td>";
					$output .= "<td><a href='delete_user.php?delete=$user_id'>Delete</a></td>";
					$output .= "<td><a href='edit_user.php?edit=$user_id'>Edit</a></td>";
					$output .= "</tr>";

					echo $output;

				}

			?>
		</tbody>

	</table>
</div>