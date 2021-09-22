<?php
header('Content-type: application/json');
header('Acess-control-Allow-Origin:*');
 
include('conn.php');


$profile = "SELECT id,first_name,city,email,mobile_no,gender,join_date,bitly_link,promoter_code FROM btl_promoter_login WHERE promoter_code= 57";

if ($run = mysqli_query($conn, $profile))
{
	
	while ($row = mysqli_fetch_assoc($run)) {

		echo json_encode(array('Profile' => $row));		
	}
	
}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}


?>