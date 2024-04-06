<?php 
  include_once "../php/config.php";
  include_once "header.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: admin/admin-login.php");
  }
  if (isset($_GET['comment_id'])) {
    $commentId = $_GET['comment_id'];
  }
?>


<div class="container p-2 ">
        <div class="row ">
            <div class="pt-5 ">
                <div class="row box-body p-3" style="height:90vh;">

                    <div class="center-div chat-space-admin d-flex justify-content-center">
                    
                    <!-- Schedule -->
                    <section class="schedule">
                        <div class="container d-flex justify-content-between mb-3 ">
                            <h6 style="margin-bottom:15px!important;">Appointment List</h6>
                            <button type="button" class="btn float-end" data-bs-toggle="modal" data-bs-target="#add_appointment">
                                Add Appointment
                            </button>
                        </div>
                        
                        <header style="display: flex; justify-content: space-between;margin-bottom: 10px;">
                        <div class="container outer d-flex align-items-center justify-content-start">
                        <div class="d-flex align-items-center ">
                        <div class="form-floating form-appointment form-check-inline">
                            <input type="date" class="form-control input-date" name="schedule_date" placeholder ="Enter a date" style="font-size:12px;" value="<?php echo date('Y-m-d'); ?>">
                            <label for="date">Date</label>
                            <div class="invalid-feedback">Invalid Date</div>
                            <div class="valid-feedback">Valid Date</div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="show-all-checkbox">
                            <label class="form-check-label" for="flexCheckDefault">
                                Display All Dates
                            </label>
                        </div>
                        </div>
                        <div class="vertical-line-schedule"></div>
                        <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="appointment-status" id="confirm-radio">
                            <label class="form-check-label custom-radio confirm-radio" for="confirm-radio">
                                Confirmed
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="appointment-status" id="pending-radio">
                            <label class="form-check-label custom-radio pending-radio" for="pending-radio">
                                Pending
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="appointment-status" id="rejected-radio">
                            <label class="form-check-label custom-radio rejected-radio" for="rejected-radio">
                                Rejected
                            </label>
                        </div>
                        </div>
                        </div>
                        
                        

                       

                        <div class="search" style="margin: 5px 0;">
                            <span class="text" ></span>
                            <input type="text" placeholder="Enter name to search...">
                            <button><i class="fas fa-search"></i></button>
                        </div>
                        </header>
                        <div class="schedule-list">
                        <div class="row mb-5 schedule-list-area">
                            <!-- Schedule List Area -->
                            
                        </div>
                        </div>

                        </section>

                    <script src="javascript/schedule.js"></script>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            
        </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
