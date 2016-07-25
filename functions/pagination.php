<?php 
	
	$query = "SELECT * from posts";
	$result = mysqli_query( $connection, $query );

	// Count the total records
	$total_posts = mysqli_num_rows( $result );

	// Using ceil function to divide the total records on per page
	$total_pages = ceil( $total_posts / $per_page );

	// Goint to first page
	echo "
	<center>
	<div id='pagination'>
	<a href='home.php?page=1'>First Page</a>
	";

	for ( $i = 1; $i <= $total_pages; $i++ ) {
		echo "<a href='home.php?page=$i'>$i</a>";
	}

	// Going to last page
	echo "<a href='home.php?page=$total_pages'>Last Page</a></div></center>";

?>