<?php
  session_start();
  if(isset($_SESSION['unique_id'])){
    include_once "php/config.php";
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql) > 0){
      $row = mysqli_fetch_assoc($sql);
    }
    $id = $row['unique_id'];
    header("location: chat-user.php?user_id=1285204382");
  }
?>
    <header>
      <h2>Chat with Admin</h2>
      <span class="close-btn material-symbols-outlined">close</span>
    </header>
    <section class="form login">
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="#" class="content-link-signup">Signup now</a></div>
    </section>

  <script src="javascript/load-content.js"></script>
  <script src="javascript/toggle.js"></script>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
