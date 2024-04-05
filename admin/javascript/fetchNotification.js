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
 }, 500);

// Viewed Notification
$(document).on('click', '.subject-comment a', function(e) {
  e.preventDefault();
  let id = $(this).attr('value'); // Get value attribute of the clicked <a> tag
  $.ajax({
      url: "php/fetchNotification.php", // PHP file to update comment status
      method: "POST",
      data: { view: 'yes', comment_id: id }, // Send necessary data including comment_id
      success: function(response) {
          console.log("Comment status updated successfully");
          $('.count').html('');
          load_unseen_notification();
      }
  });
});


function load_unseen_notification(view = '')
    {
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
       }
      }
     });
    }
