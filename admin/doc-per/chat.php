<?php 
  include_once "../php/config.php";
  include_once "header.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
?>

        <div class="container">
            <div class="row ">
            
                <div>
                    <div class="box p-2" style="height:90vh;">
                        <div class="center-div chat-space-admin d-flex flex-column align-items-center justify-content-top ">
                        <!-- Chat Area -->
                            <section class="chat-area ">
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

                        <script src="javascript/load-content.js"></script>
                        <script src="javascript/users.js"></script>
                    </div>
                </div>
            </div>
    </div>
</div>
<script src="javascript/chat.js"></script>



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
