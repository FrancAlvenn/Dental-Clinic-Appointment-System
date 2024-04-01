<?php                
require 'config.php'; 
$display_query = "select * from appointment_requests ORDER BY TIME(preferred_time)";             
$results = mysqli_query($conn,$display_query);
$count = mysqli_num_rows($results);
if($count>0) 
{
	$data_arr=array();
    $i=1;
	while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{
    
    $firstname = $data_row['firstname'];
    $lastname = $data_row['lastname'];
    $fullname = $firstname . " " . $lastname;


	$data_arr[$i]['request_id'] = $data_row['request_id'];
	$data_arr[$i]['title'] = $fullname;
	$data_arr[$i]['start'] = date("Y-m-d H:i:s", strtotime($data_row['preferred_date'] . ' ' . $data_row['preferred_time']));
    $data_arr[$i]['end'] = date("Y-m-d H:i:s", strtotime($data_row['preferred_date'] . ' ' . $data_row['preferred_time'] . ' +1 hour'));
    $data_arr[$i]['service'] = $data_row['service'];
    $data_arr[$i]['status'] = $data_row['status'];
    $data_arr[$i]['email'] = $data_row['email'];
    $data_arr[$i]['phone'] = $data_row['phone_number'];
    $data_arr[$i]['comments'] = $data_row['comments'];


    if ($data_row['status'] == 'confirmed') {
        $data_arr[$i]['color'] = '#98FB98';
    } elseif ($data_row['status'] == 'pending') {
        $data_arr[$i]['color'] = '#FFD700';
    } else {
        $data_arr[$i]['color'] = '#FF6347';
    }
    
	

	$i++;
	}

	$data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>