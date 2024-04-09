$(document).ready(function(){
    // updating the view with notifications using ajax
    load_unseen_notification();
    // load new notifications
});

$(document).on('click', '.dropdown-toggle', function(){
  load_unseen_notification();
 });

 //set Interval
 setInterval(function(){
  load_unseen_notification();;
 }, 1000);

// Viewed Notification
$(document).on('click', '.subject-comment a', function(e) {
  e.preventDefault();
  let id = $(this).data('comment-id');
  $.ajax({
      url: "php/fetchNotification.php", // PHP file to update comment status
      method: "POST",
      data: { view: 'yes', comment_id: id }, // Send necessary data including comment_id
      success: function(response) {
          console.log("Comment status updated successfully");
          $('.count').html('');
          new_notif -= 1;
          console.log("New_Notif After View: " , new_notif);
          load_unseen_notification();
      }
  });
});

let new_notif;
let notificationsLoaded = false;
function load_unseen_notification(view = '')
    {
        console.log("New Notif = " + new_notif);
     $.ajax({
      url:"php/fetchNotification.php",
      method:"POST",
      data:{view:view},
      dataType:"json",
      success:function(data)
      {
       $('.notifications-items').html(data.notification);
       if(data.unseen_notification > 0)
       {
        $('.count').html(data.unseen_notification);


        if(new_notif == undefined || 0){
            new_notif = data.unseen_notification;
        }
        if (data.unseen_notification > new_notif) {
            new_notif = data.unseen_notification;
            let audio = new Audio("../resources/system-notification-199277.mp3")
            audio.play();
        }

       }
      }
     });
    }

    