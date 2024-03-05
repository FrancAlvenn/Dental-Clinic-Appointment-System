<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Chat Feature</title>
</head>
<body>
    <div class="container pt-5 ">
            <div class="row ">
                <div class="col-3 pt-5 ">
                    <div class="box d-flex flex-column align-items-between justify-content-between ">
                        <div class="header">
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-auto "><i class="fa-solid fa-user-tie"></i></div>
                                <div class="col-auto"><h5 style="margin:0;">Administrator</h5></div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-gauge-high"></i></div>
                                <div class="col-5"><h6 style="margin:0;">Dashboard</h6></div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-clipboard-list"></i></div>
                                <div class="col-5"><h6 style="margin:0;">Schedule</h6></div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-calendar-days"></i></div>
                                <div class="col-5"><h6 style="margin:0;">Calendar</h6></div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-envelope"></i></div>
                                <div class="col-5"><h6 style="margin:0;">Messages</h6></div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-hospital-user"></i></div>
                                <div class="col-5"><h6 style="margin:0;">Patients</h6></div>
                            </div>
                        </div>
                        <div class="footer">
                            <div class="row d-flex align-items-center justify-content-center pt-5 pb-5 ">
                                <div class="col-3"><i class="fa-solid fa-right-from-bracket"></i></div>
                                <div class="col-4"><h6 style="margin:0;">Logout</h6></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 pt-5 ">
                    <div class="box d-flex align-content-center justify-content-center p-5 " >
                        <div class="center-div chat-space-admin d-flex flex-column align-items-center justify-content-center ">
                        <!-- Chat Area -->
                        <section class="chat-area">
                          <header>
                            <?php 
                              $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                              $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                              if(mysqli_num_rows($sql) > 0){
                                $row = mysqli_fetch_assoc($sql);
                              }else{
                                header("location: users.php");
                              }
                            ?>
                            <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                            <div class="details">
                              <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                              <p><?php echo $row['status']; ?></p>
                            </div>
                            
                          </header>
                          <div class="chat-box">

                          </div>
                          <form action="#" class="typing-area">
                            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                            <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                            <button><i class="fab fa-telegram-plane"></i></button>
                          </form>
                      </section>

  <script src="javascript/chat.js"></script>
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>


    <script>
        $(document).ready(function() {
            // Define the AJAX function using a variable
            const fetchContent = function(url) {
                // AJAX request to load content from PHP file
                $.ajax({
                url: url, // URL of the PHP file
                type: 'GET',
                success: function(response) {
                    $('.chat-space-admin').html(response); // Insert content into container div
                },
                error: function() {
                    console.error('Error loading content from ' + url);
                }
                });
            };

            window.onload = function() {
                // fetchContent('../login.php');
                console.log("Page loaded");
            };
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
