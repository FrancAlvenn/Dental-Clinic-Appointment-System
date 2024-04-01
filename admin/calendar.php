<?php 
  include_once "../php/config.php";
  include_once "header.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
?>


    <div class="container">
            <div class="row ">
                <div class="pt-5 ">
                    <div class="box p-5 " style="height:auto;">
                        <div id="calendar">
                            <!-- Calendar Area -->

                        </div>
                    </div>
                </div>
            </div>
    </div>

    

    <div class="modal" id="appointmentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Appointment View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateAppointment">

            </form>
            </div>
        </div>
    </div>

  <script src="javascript/calendar.js"></script>
  <script src="javascript/schedule-crud.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
