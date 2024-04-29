<?php
include_once "header.php";
?>

<div class="container">
    <div class=" p-4">
        <div class="row box-header">
            <div class="center-div chat-space-admin d-flex align-items-center justify-content-between text-center ">
            <!-- Dashboard Header-->
                    <div class="col-3 dashboard-box" style="background-color: #2a84fa  ;">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="fa-solid fa-users" style="background-color: #2a84fa  ;"></i>
                            </div>
                            <div class="col-8 ">
                                <div class="row ">
                                    <div class="col mt-2 ">
                                        <h6 class="number_of_patients" style="font-size: 13px">Total Appointments <br>(This month)</h6>
                                    </div>
                                </div>
                                <div class="row mt-2 ">
                                    <div class="col ">
                                        <h3 id="total_appointments">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="col-3 dashboard-box" style="background-color: #2afa7d ;">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="fa-solid fa-calendar-check" style="background-color: #2afa7d ;"></i>
                            </div>
                            <div class="col-8 ">
                                <div class="row ">
                                    <div class="col mt-2 ">
                                        <h6 class="number_of_patients" style="font-size: 13px">Confirmed Appointments  <br>(This month)</h6>
                                    </div>
                                </div>
                                <div class="row mt-2 ">
                                    <div class="col ">
                                        <h3 id="confirmed_appointments">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="col-3 dashboard-box" style="background-color: #fd858f;">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                            <i class="fa-solid fa-spinner" style="background-color: #fd858f;"></i>
                            </div>
                            <div class="col-8 ">
                                <div class="row ">
                                    <div class="col mt-2 ">
                                        <h6 class="number_of_patients" style="font-size: 13px">Pending Appointments  <br>(This month)</h6>
                                    </div>
                                </div>
                                <div class="row mt-2 ">
                                    <div class="col ">
                                        <h3 id="pending_appointments">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="row box-body  pt-5 ">
            <h6 class="pb-4">Annual Appointment Chart</h6>
            <div class="center-div chat-space-admin d-flex flex-column align-items-center justify-content-center ">
            <!-- Dashboard -->
            <div class="chart-container d-flex justify-content-center align-content-center">
                <canvas id="mycanvas" >

                </canvas>
            </div>

            <!-- javascript -->
            <script type="text/javascript" src="javascript/jquery.min.js"></script>
            <script type="text/javascript" src="javascript/Chart.min.js"></script>
            <script type="text/javascript" src="javascript/linegraph.js"></script>
            </div>
        </div>

    </div>
        
</div>


<script src="javascript/schedule-crud.js"></script>
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
