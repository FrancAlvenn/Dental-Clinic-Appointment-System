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
            $status = "";
            if ($row["comment_status"] == 1){
                $status = "viewed";
            }
            $notification_class = "";
            if ($row["comment_subject"] == "Appointment Request" || $row["comment_subject"] == "Appointment Added" || $row["comment_subject"] == "Appointment Updated"){
              $notification_class = "editAppointments";
            }

            $notification_timestamp = $row["notification_timestamp"];
            $output .= '
            <li class="notifications-list">
              <div class="subject-comment">
                <a href="#"  value="'. $row["request_id"]  .'" class="'. $notification_class  .'" data-comment-id="' . $row["comment_id"] . '">
                  <strong>'.$row["comment_subject"].'</strong><br />
                  <small>'.$row["comment_text"].'</small>
                  <p class="timestamp '. $status .'" id="timestamp">'.getRelativeTime($notification_timestamp).'</p>
                </a>
              </div>
              <div class="notification-dot '. $status .'"><i class="fas fa-circle"></i></div>
            </li>
            ';
        }
    }
    else {
        $output .= '<li><a href="#" class="no-notification">No new notification!</a></li>';
    }

    $status_query = "SELECT * FROM comments WHERE comment_status=0";
    $result_query = mysqli_query($conn, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
       'notification' => $output,
       'unseen_notification'  => $count
    );
    echo json_encode($data);

    if($_POST["view"] == 'yes')
    {
        $id = mysqli_real_escape_string($conn, $_POST['comment_id']);
        $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_id =" .$id;
        mysqli_query($conn, $update_query);
    }

    if($_POST["view"] == 'yes-all')
    {
      $update_query = "UPDATE comments SET comment_status = 1";
      mysqli_query($conn, $update_query);
    }
}

function getRelativeTime($timestamp) {
  // Set the timezone for current datetime
  $now = new DateTime('now', new DateTimeZone('Asia/Manila'));

  // Set the timezone for the notification datetime
  $date = new DateTime($timestamp, new DateTimeZone('Asia/Manila'));

  // Calculate the interval between the current datetime and the notification datetime
  $interval = $now->diff($date);

  // Extract the interval components
  $years = $interval->y;
  $months = $interval->m;
  $days = $interval->d;
  $hours = $interval->h;
  $minutes = $interval->i;
  $seconds = $interval->s;

  // Determine the appropriate relative time string based on the interval components
  if ($years > 0) {
      return $years . " year" . ($years > 1 ? "s" : "") . " ago";
  } elseif ($months > 0) {
      return $months . " month" . ($months > 1 ? "s" : "") . " ago";
  } elseif ($days > 0) {
      return $days . " day" . ($days > 1 ? "s" : "") . " ago";
  } elseif ($hours > 0) {
      return $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
  } elseif ($minutes > 0) {
      return $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
  } else if($seconds > 30){
    return "30 seconds ago";
  }else{
    return "just now";
  }
}


?>
