<?php 
  include_once "php/config.php";
  include_once "header.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
    <div class="container">
            <div class="row ">
            
                <div class="pt-5 ">
                    <div class="box p-2" style="height:90vh;">
                        <div class="center-div chat-space-admin d-flex flex-column align-items-center justify-content-top ">
                        <!-- Chat Area -->
                          <section class="users">
                            <header>
                              <div class="content">
                                <?php 
                                  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = 1285204382");
                                  if(mysqli_num_rows($sql) > 0){
                                    $row = mysqli_fetch_assoc($sql);
                                  }
                                ?>
                                
                                <div class="details">
                                  <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                                  <p><?php echo $row['status']; ?></p>
                                </div>
                              </div>
                                <div class="search" style="width: 40%;">
                                    <span class="text"></span>
                                    <input type="text" placeholder="Enter name to search...">
                                    <button><i class="fas fa-search"></i></button>
                                </div>
                            </header>
                            <!-- add div.class here to show search container below header -->
                            <div class="users-list">
                        
                            </div>
                            <script src="javascript/load-content.js"></script>
                          </section>

                        <script src="javascript/load-content.js"></script>
                        <script src="javascript/users.js"></script>
                    </div>
                </div>
            </div>
    </div>
    <script src="javascript/load-content.js"></script>


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