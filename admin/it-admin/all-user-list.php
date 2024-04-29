<?php 
  include_once "../php/config.php";
  include_once "header.php";
  echo "<script>const uniqueId = '{$_SESSION['unique_id']}';</script>";
  if(!isset($_SESSION['unique_id'])){
    header("location: admin/admin-login.php");
    
  }
?>
    <div class="container">
            <div class="row ">
                <div class="pt-5 ">
                    <div class="">
                        <div class="center-div chat-space-admin d-flex flex-column align-items-center justify-content-center ">
                            <!-- User List Area -->
                            <section class="schedule">
                                <div class="d-flex justify-content-between mb-3 ">
                                    <h6 style="margin-bottom:15px!important;">User List</h6>
                                    <button type="button" class="btn float-end pt-2 pb-2 pe-5 ps-5 " data-bs-toggle="modal" data-bs-target="#add_User">
                                        Add User
                                    </button>
                                </div>
                                
                                <header style="display: flex; justify-content: end;margin-bottom: 0px; border: 0px !important">
                                <div class="search" style="margin: 5px 0;">
                                    <span class="text" ></span>
                                    <input type="text" placeholder="Enter name to search..." id="searchInput">
                                    <button><i class="fas fa-search" id="searchButton"></i></button>
                                </div>
                                </header>
                                <div class="schedule-list">
                                <div class="row mb-5 User-list-area">
                                    <!-- User List Area -->
                                    <div class="">
                                    
                                    <table class="table table-hover text-center" id="userTable">
                                        <thead class="">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Auth</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <!-- Table Data Here -->
                                            </tr>
                                        </tbody>
                                    </table>

                                    </div>
                                </div>
                                </div>

                            </section>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="javascript/all-user-list.js"></script>
    
    
    <!-- Add User -->

    <div class="modal fade" id="add_User" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveUser">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required="" style="margin-right: 10px;">
                                    <label for="text">First Name*</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="">
                                    <label for="text">Last Name*</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="email"  class="form-control" name="email" placeholder="Enter you email here:" required="">
                                    <label for="email">Email*</label>
                                    <div class="invalid-feedback">Invalid Email</div>
                                    <div class="valid-feedback">Valid Email</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text"  class="form-control" name="password" placeholder="Enter your password here:" required="">
                                    <label for="password">Password*</label>
                                    <div class="invalid-feedback">Invalid Password</div>
                                    <div class="valid-feedback">Valid Password</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col-5">
                                <div class="form-floating">
                                    <select class="form-select" name="status" id="status">
                                        <option value="Offline now">Offline</option>
                                        <option value="Active now">Active</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-floating">
                                    <select class="form-select" name="auth" id="auth">
                                        <option value="User">User</option>
                                        <option value="Receptionist">Receptionist</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="IT Admin">IT Admin</option>
                                    </select>
                                    <label for="auth">Auth</label>
                                </div>
                            </div>
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User Record</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Update/Edit Appointment -->

    <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUser">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required="" style="margin-right: 10px;">
                                    <label for="text">First Name*</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="">
                                    <label for="text">Last Name*</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="email"  class="form-control" name="email" placeholder="Enter you email here:" required="">
                                    <label for="email">Email*</label>
                                    <div class="invalid-feedback">Invalid Email</div>
                                    <div class="valid-feedback">Valid Email</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text"  class="form-control" name="password" placeholder="Enter your password here:" required="">
                                    <label for="password">Password*</label>
                                    <div class="invalid-feedback">Invalid Password</div>
                                    <div class="valid-feedback">Valid Password</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col-5">
                                <div class="form-floating">
                                    <select class="form-select" name="status" id="status">
                                        <option value="Offline now">Offline</option>
                                        <option value="Active now">Active</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-floating">
                                    <select class="form-select" name="auth" id="auth">
                                        <option value="User">User</option>
                                        <option value="Receptionist">Receptionist</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="IT Admin">IT Admin</option>
                                    </select>
                                    <label for="auth">Auth</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" value="" class="deleteButton btn btn-danger">Delete</button>
                    <button type="submit" value="" class="btn btn-primary updateButton">Update Details</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script src="javascript/all-user-list-crud.js"></script>
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
