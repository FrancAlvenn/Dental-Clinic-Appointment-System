<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

  <header>
    <h2>Chat with Admin</h2>
    <span class="close-btn material-symbols-outlined">close</span>
  </header>
  <section class="form signup">
    <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off" class="signup-form">
    <div class="error-text"></div>
    <div class="name-details">
        <div class="field input">
        <label>First Name</label>
        <input type="text" name="fname" placeholder="First name" required>
        </div>
        <div class="field input">
        <label>Last Name</label>
        <input type="text" name="lname" placeholder="Last name" required>
        </div>
    </div>
    <div class="field input">
        <label>Email Address</label>
        <input type="text" name="email" placeholder="Enter your email" required>
    </div>
    <div class="field input">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter new password" required>
        <i class="fas fa-eye"></i>
    </div>
    <div class="field button">
        <input type="submit" name="submit" value="Continue to Chat">
    </div>
    </form>
    <div class="link">Already signed up? <a href="#" class="content-link-login">Login now</a>  </div>
  </section>

  <script src="javascript/load-content.js"></script>
  <script src="javascript/toggle.js"></script>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

