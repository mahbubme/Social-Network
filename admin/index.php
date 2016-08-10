<?php 

	session_start(); 
	include ( "../includes/connection.php" );
	include ( "../functions/functions.php" );

	if ( !isset( $_SESSION['admin_email'] ) ) {
		header( "location: login.php" );
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
        	
            case 'posts':
                include "posts.php";
            break;

            case 'comments':
                include "comments.php";
            break;

            case 'topics':
                include "topics.php";
            break;

        	default:
        		include "users.php";
        	break;
        } 

	?>

<?php include( "footer.php" ); ?>

<?php } ?>