<?php 

	session_start(); 
	include ( "../includes/connection.php" );
	include ( "../functions/functions.php" );

	if ( !isset( $_SESSION['user_email'] ) ) {
		header( "location: ../index.php" );
	}else {

?>

<?php include( "header.php" ); ?>

	<?php 

        if ( isset( $_GET['page'] ) ) {
			$page = $_GET['page'];
        }else {
        	$page = '';
        }

        switch ( $page ) {
        	case 'users':
        			include "users.php";
        		break;
        	
        	default:
        			include "users.php";
        		break;
        } 

	?>

<?php include( "footer.php" ); ?>

<?php } ?>