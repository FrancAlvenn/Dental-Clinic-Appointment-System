<?php
  include_once "../php/config.php";
  include_once "header.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: admin-login.php");
  }
?>

<div class="container">
    <div class="row">
        <div class="pt-5">
            <div class="box p-5" style="height:90vh;">
                <div class="">
                    <!-- SMS Sender Area-->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Appointment Notifications to Clients</h5>
                    </div>
                    <form id="smsForm">
                        <div class="modal-body">
                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                            <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">
                                <div class="col-7">
                                    <div class="form-floating">
                                        <textarea type="text" class="form-control" name="number" placeholder="Recipient" required="" style="margin-right: 10px;height: auto;max-height:130px;" id="number"></textarea>
                                        <label for="text">Recipient</label>
                                    </div>
                                </div>
                                <div class="col-1 icon-holder">
                                    <a href="#" id="openContactSelector" class="tooltip-container" data-bs-toggle="tooltip" data-bs-title="Contact List"><i class="fas fa-address-book"></i></a>
                                </div>

                            </div>

                            <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea type="text" class="form-control" name="message" placeholder="Message" required="" id="message" style="height: 50vh; max-height:50vh;"></textarea>
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

<!-- Contact Selector Modal -->
<div class="modal fade" id="contactSelectorModal" tabindex="-1" aria-labelledby="contactSelectorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" id="modal-contact-content">
            <div class="contact-header">
            <h5 class="modal-title" id="contactSelectorModalLabel">Select Recipient</h5>
                <div class="search" style="margin: 5px 0;">
                    <span class="text" ></span>
                    <input type="text" placeholder="Enter name to search..." id="searchInput">
                    <button><i class="fas fa-search" id="searchButton"></i></button>
                </div>
            </div>
            <div class="modal-header">
                <input type="checkbox" name="selectAllContact" id="selectAllContact">
                <label for="selectAllContact">Select All</label>
            </div>
            
            <div class="modal-body" id="modal-contact-body">
            <p class="numContact">0 contacts available!</p>
                <!-- Contacts list goes here -->
                <ul class="list-group list-group-flush">
                   
                </ul>
            </div>
            <div class="modal-footer modal-footer-contact">
            <div>
            <button type="button" class="btn-close unselectContact" aria-label="Close"></button>
            <span class="selected-info">0 selected!</span>
            </div>
            <div>
                <button type="button" class="btn  contact-btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button type="button" class="btn selectContact contact-btn">Select</button>
            </div>
            </div>
        </div>
    </div>
</div>


<script src="javascript/message-sender.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
