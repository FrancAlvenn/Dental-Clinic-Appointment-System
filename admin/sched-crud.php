    <!-- Add Appointment -->

    <div class="modal fade" id="add_appointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveAppointment">
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
                                    <input type="text" class="form-control" name="lastname" placeholder="First Name" required="">
                                    <label for="text">Last Name*</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Enter you email here:" required="">
                                    <label for="email">Email*</label>
                                    <div class="invalid-feedback">Invalid Email</div>
                                    <div class="valid-feedback">Valid Email</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number_format" class="form-control" name="phone_number" placeholder="Enter you phone number here" required="">
                                    <label for="number">Phone Number*</label>
                                    <div class="invalid-feedback">Invalid Phone Number</div>
                                    <div class="valid-feedback">Valid Phone Number</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="text" class="form-control" name="service" placeholder="Enter service here">
                            <label for="other_service">Service</label>
                        </div>

                                            
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="date" class="form-control" name="preferred_date" placeholder="Enter your preferred date" required="">
                            <label for="date">Preferred Date*</label>
                            <div class="invalid-feedback">Invalid Date</div>
                            <div class="valid-feedback">Valid Date</div>
                        </div>
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="time" class="form-control" name="preferred_time" placeholder="Enter your preferred time" required="">
                            <label for="time">Preferred Time*</label>
                            <div class="invalid-feedback">Invalid Time</div>
                            <div class="valid-feedback">Valid Time</div>
                        </div>
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <textarea class="form-control" id="textarea" rows="4" name="comments" placeholder="Comments/Concerns" style="height: 200px; resize: none;"></textarea>
                            <label for="textarea">Comments/Concerns</label>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Appointment</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Update/Edit Appointment -->

    <div class="modal fade" id="appointmentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateAppointment">
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
                                    <input type="text" class="form-control" name="lastname" placeholder="First Name" required="">
                                    <label for="text">Last Name*</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Enter you email here:" required="">
                                    <label for="email">Email*</label>
                                    <div class="invalid-feedback">Invalid Email</div>
                                    <div class="valid-feedback">Valid Email</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number_format" class="form-control" name="phone_number" placeholder="Enter you phone number here" required="">
                                    <label for="number">Phone Number*</label>
                                    <div class="invalid-feedback">Invalid Phone Number</div>
                                    <div class="valid-feedback">Valid Phone Number</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col-7">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="service" placeholder="Enter service here">
                                <label for="other_service">Service</label>
                            </div>
                            </div>
                            <div class="col-5">
                            <div class="form-floating">
                                <select class="form-select" name="status" id="status">
                                    <option value="confirmed">Confirmed</option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                                <label for="status">Status</label>
                            </div>
                            </div>
                        </div>


                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="date" class="form-control" name="preferred_date" placeholder="Enter your preferred date" required="">
                            <label for="date">Preferred Date*</label>
                            <div class="invalid-feedback">Invalid Date</div>
                            <div class="valid-feedback">Valid Date</div>
                        </div>
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="time" class="form-control" name="preferred_time" placeholder="Enter your preferred time" required="">
                            <label for="time">Preferred Time*</label>
                            <div class="invalid-feedback">Invalid Time</div>
                            <div class="valid-feedback">Valid Time</div>
                        </div>
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <textarea class="form-control" id="textarea" rows="4" name="comments" placeholder="Comments/Concerns" style="height: 200px; resize: none;"></textarea>
                            <label for="textarea">Comments/Concerns</label>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" value="" class="deleteButton btn btn-danger">Delete</button>
                    <button type="submit" value="" class="btn btn-primary updateButton">Update Appointment</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    


    <script src="javascript/schedule-crud.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
