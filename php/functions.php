
<?php
function authenticated(){
	if(isset($_SESSION['nickname'])){
		return true ;
	}
}

function not_auth_redirect(){
	if(!authenticated()) {
  header("location:signin.php");
	}
}


function auth_redirect(){
	if(authenticated()) {
  header("location:profile.php");
	}
}
?>