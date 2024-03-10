<?php
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: index.php");
  }
?>
    <section class="chat-area">
      <header>
        <?php
          // $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: index.php");
          }
        ?>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <div class="details">
          <h5>Administrator</h5>
          <h6><?php echo $row['status']; ?></h6>
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

</body>
</html>
