<?php
session_start();
header('Content-type: application/json');
header('Acess-control-Allow-Origin:*');

include('conn.php');

//$data=json_decode(file_get_contents("php://input"),true);
$email=$_POST['email'];
$password=$_POST['password'];
$password=base64_encode($password);
$loginToken = md5("akshayakalpa@milkpromoter"); 

$qery="SELECT * FROM btl_promoter_login WHERE email = '$email' AND password = '$password'";
$run=mysqli_query($conn, $qery);


if (mysqli_num_rows($run) > 0)
{
	 if ($loginToken == md5("akshayakalpa@milkpromoter")) {

	 	$output=mysqli_fetch_all($run, MYSQLI_ASSOC);
		echo json_encode(array('success' => $output,
			'token' => $loginToken,
			'status' => true
)
		);
    }
    else{

    	 echo json_encode(array(
               	'status' => false,
               	'message' => "Invalid Token"
                ));
    }    
}
else
{
    echo json_encode(array('messege' => 'Invalid Login Credantial', 'status' => false ));
}

?>