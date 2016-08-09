<?php 

if ( isset( $_POST['addtopic'] ) ) {

	$topic_title = $_POST['topic_title'];

	$query = "INSERT INTO topics(topic_title) VALUES('$topic_title')";
	$run_query = mysqli_query( $connection, $query );

	if ( $run_query ) {
		echo "<script>alert('Topic has been added!')</script>";
		echo "<script>window.open( 'index.php?page=topics', '_self')</script>";
	}
}

?>

<div class="clearfix">
<br>	
<form action="" method="post" class="form-horizontal">
<div class="form-group">
	<div class="col-sm-6">
		<input type="text" name="topic_title" class="form-control" placeholder="Topic title" required>
	</div>
	<div class="col-sm-6">
		<input type="submit" name="addtopic" class="btn btn-success" value="Save">
	</div>
</div>
</form>
</div>