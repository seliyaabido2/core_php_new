<?php
header('Content-type: application/json');
header('Acess-control-Allow-Origin:*');
 
include('conn.php');
 
//ActiveEvent
$todayDate = date('Y-m-d');
$promoter_code = 57;
$ActiveEvent = "SELECT start_date,end_date,event_status,city,type_of_event,apartment_name,apartment_code,apartment_adress,event_organiser,apartment_google_link FROM btl_event WHERE start_date = '$todayDate' AND promoter_code = '$promoter_code'";
 

if ($run = mysqli_query($conn, $ActiveEvent))
{
	if (mysqli_num_rows($run)==0)
	{
	     echo json_encode(array('ActiveEvent' => 0));	
	}
	else{
		while ($row = mysqli_fetch_assoc($run)) {

			echo json_encode(array('ActiveEvent' => $row));		
		}
	}
	
}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}

// panding Event
// aajni date moti che end date krta and event_status complated nthi..

$PandingEvent = "SELECT start_date,end_date,event_status,city,type_of_event,apartment_name,apartment_code,apartment_adress,event_organiser,apartment_google_link FROM btl_event WHERE end_date < '$todayDate' AND event_status != 'Completed' AND promoter_code = '$promoter_code'";

if ($run1 = mysqli_query($conn, $PandingEvent))
{

	if (mysqli_num_rows($run1)==0)
	{
	     echo json_encode(array('PandingEvent' => 0));	
	}
	else{

		while ($row1 = mysqli_fetch_assoc($run1)) {

			echo json_encode(array('PandingEvent' => $row1));		
		}
	}
    
}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}


// Upcoming Event
$UpcomingEvent = "SELECT start_date,end_date,event_status,city,type_of_event,apartment_name,apartment_code,apartment_adress,event_organiser,apartment_google_link FROM btl_event WHERE start_date > '$todayDate' AND promoter_code = '$promoter_code'";

if ($run2 = mysqli_query($conn, $UpcomingEvent))
{
	if (mysqli_num_rows($run2)==0)
	{
	     echo json_encode(array('UpcomingEvent' => 0));	
	}
	else{

		while ($row2 = mysqli_fetch_assoc($run2)) {

			echo json_encode(array('UpcomingEvent' => $row2));		
		}
	}
   
}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}

// Complate Event

$complateEvent = "SELECT start_date,end_date,event_status,city,type_of_event,apartment_name,apartment_code,apartment_adress,event_organiser,apartment_google_link FROM btl_event WHERE event_status = 'Completed' AND promoter_code = '$promoter_code'";


if ($run3 = mysqli_query($conn, $complateEvent))
{
	if (mysqli_num_rows($run3)==0)
	{
	     echo json_encode(array('complateEvent' => 0));	
	}
	else{

		while ($row3 = mysqli_fetch_assoc($run3)) {

			echo json_encode(array('complateEvent' => $row3 ));		
		}
	}	

}
else
{
    echo json_encode(array('messege' => 'no recode found', 'status' => false ));
}
?>