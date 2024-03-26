<?php
  include_once "../php/config.php";
  include_once "header.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: admin-login.php");
  }
?>
    <div class="container">
            <div class="row ">
                <div class="pt-5 ">

                    <div class="box p-5 " style="height:90vh;">
                        <div class="">
                            <!-- SMS Sender Area-->
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Send SMS</h5>
                            </div>
                            <form id="smsForm">
                                <div class="modal-body">
                                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                                        <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">
                                            <div class="col-7">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="number" placeholder="Recipient" required="" style="margin-right: 10px;" id="number">
                                                    <label for="text">Recipient</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <textarea type="text" class="form-control" name="message" placeholder="Message" required="" id="message" style="height: 50vh;"></textarea>
                                                    <label for="text">Message</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script src="javascript/message-sender.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
