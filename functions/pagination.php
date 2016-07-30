<?php 
	
	$query = "SELECT * from posts";
	$result = mysqli_query( $connection, $query );

	// Count the total records
	$total_posts = mysqli_num_rows( $result );

	// Using ceil function to divide the total records on per page
	$total_pages = ceil( $total_posts / $per_page );

	$output  = "<div class='clearfix'>";
	$output .= "<ul class='pagination'>";

	// Goint to first page
	$output .= "<li><a href='home.php?page=1'>First Page</a></li>";

	for ( $i = 1; $i <= $total_pages; $i++ ) {
		if ( $page == $i ) {
			$output .= "<li class='active'><a href='home.php?page=$i'>$i</a></li>";
		}else{
			$output .= "<li><a href='home.php?page=$i'>$i</a></li>";
		}
	}

	// Going to last page
	$output .= "<li><a href='home.php?page=$total_pages'>Last Page</a></li>";
	$output .= "</ul>";
	$output .= "</div>";

	echo $output;

?>