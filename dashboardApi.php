<?php
header('Content-type: application/json');
header('Acess-control-Allow-Origin:*');
 
include('conn.php');
 
// Total Event
$data=json_decode(file_get_contents("php://input"),true);
$promoter_code=$_POST['promoter_code'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];


$TotalEvent = "SELECT * FROM btl_event WHERE start_date >= '$start_date' AND end_date <= '$end_date' AND promoter_code = '$promoter_code'";

if ($run = mysqli_query($conn,$TotalEvent))
{

    $output = mysqli_num_rows($run);
    echo json_encode(array('TOTALEVENT' => $output));
}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}

// TOTAL LEADS
 
$TotalLead = "SELECT * FROM lead WHERE utm_source IN('event','btl_event') AND created_at >= '$start_date' AND created_at <= '$end_date' AND utm_medium = '$promoter_code'";
 
if ($run2 = mysqli_query($conn, $TotalLead))
{
    $output2=mysqli_num_rows($run2);
    echo json_encode(array("TotalLead" => $output2));
}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}
 

// TOTAL RAGISTER
 
$TotalRagister = "SELECT * FROM lead AS l INNER JOIN lead_check AS lc ON l.id = lc.lead_id WHERE l.utm_source IN('event','btl_event') AND l.created_at >='$start_date' AND l.created_at >='$end_date' AND l.utm_medium = '$promoter_code' AND lc.register = 'yes'"; 

if ($run3 = mysqli_query($conn, $TotalRagister))
{
    $output3=mysqli_num_rows($run3);
    echo json_encode(array("TotalRagister " =>$output3 ));
}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}

// TOTAL RECHARGE
 
$TotalRagister = "SELECT * FROM lead AS l INNER JOIN lead_check AS lc ON l.id = lc.lead_id WHERE l.utm_source IN('event','btl_event') AND l.created_at >='$start_date' AND l.created_at >='$end_date' AND l.utm_medium = '$promoter_code' AND lc.recharge = 'yes'"; 

if ($run4 = mysqli_query($conn, $TotalRagister))
{
    $output4=mysqli_num_rows($run4);
    echo json_encode(array("TotalRecharge  " =>$output4 ));
}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}
?>