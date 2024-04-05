<?php
include('config.php');
if(isset($_POST['view'])){
$query = "SELECT * FROM comments  ORDER BY comment_id DESC";
$result = mysqli_query($conn, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
    $status="";
    if ($row["comment_status"] == 1){
        $status="viewed";
    }
    $output .= '
    <li class="notifications-list">
      <div class="subject-comment">
        <a href="calendar.php"  value="'. $row["comment_id"]  .'">
          <strong>'.$row["comment_subject"].'</strong><br />
          <small>'.$row["comment_text"].'</small>
        </a>
      </div>
      <div class="notification-dot '. $status .'"><i class="fas fa-circle"></i></div>
    </li>
  ';
}
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No new notification!</a></li>';
}
$status_query = "SELECT * FROM comments WHERE comment_status=0";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);


if($_POST["view"] != '')
{
  $id = mysqli_real_escape_string($conn, $_POST['comment_id']);
   $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_id =" .$id;
   mysqli_query($conn, $update_query);
}
}
?>