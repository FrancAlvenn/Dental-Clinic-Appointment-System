<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dental Clinic Appointment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Scroll Reveal -->
    <link rel="stylesheet" href="scrollreveal.min.js">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <!-- Alert Notification -->
    <div class="notification-container d-flex  justify-content-between ">
        <div class="alert">
            <span class="fas fa-exclamation-circle"></span>
            <p class="alert-msg" style="margin: 5px 0px!important"></p>
        </div>
    </div>
    
    <!-- Navigation Bar -->
    <nav class="navbar fixed-top navbar-expand-md bg-white shadow-lg  mb-5 bg-white rounded">
        <div class="container" id="nav-container">
            <a href="#headerCarousel">
                <img src="resources\brand_logo.jpg" alt="Brand Logo" class="img-fluid rounded-5 navbar-img" style="width: 65px !important;" >
            </a>
            <a href="#headerCarousel" class="navbar-brand collapse navbar-collapse px-3 " style="font-size: 16px;">Dr. Johnny Mar Cabugon Dental Clinic </a>
            <button class="navbar-toggler" data-bs-toggle="collapse"
            data-bs-target="#nav" aria-controls = "nav" aria-label="Expand Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav me-lg-4 " style="font-size: 13px;">
                    <li class="nav-item me-lg-2">
                        <a href="#headerCarousel" class="nav-link active" >Home</a>
                    </li>
                    <li class="nav-item me-lg-2">
                        <a href="#servicesSection" class="nav-link">Services</a>
                    </li>
                    <li class="nav-item me-lg-2">
                        <a href="#testimonialSection" class="nav-link">Testimonials</a>
                    </li>
                    <li class="nav-item me-lg-2">
                        <a href="#contactUsSection" class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <hr class="divider">
                    </li>

                </ul>
                <a href="#appointmentSection">
                <button class="btn rounded-5 px-4 nav-btn" ><i class="fa-solid fa-calendar"
                style="margin-right: 10px;"></i>Book an Appointment</button>
                </a>
                
            </div>
        </div>
    </nav>

    

    <!-- Header Carousel-->
    <div id="headerCarousel" class="carousel slide pt-2 pb-5  " data-bs-ride="carousel" style="margin-bottom: 20px;">
        <div class="carousel-inner">

            <div class="carousel-item active carousel-item">
                <div class="carousel-caption"
                style="position: absolute; top: 70%; left: 30%; transform: translate(-50%, -50%);">
                    <h3 class="text-black text-md">Discover Your Perfect Smile</h3>
                    <p class="text-black text-sm">Transforming smiles, transforming lives. Book an appointment today!</p>
                    <button class="btn rounded-5 px-4"><i class="fa-solid fa-calendar"
                    style="margin-right: 10px;"></i>Book an Appointment</button>
                </div>
                    <img src="resources\image_header1.jpg" class="d-block w-100 carousel-image" alt="..." >
            </div>

            <div class="carousel-item active carousel-item">
                <div class="carousel-caption"
                style="position: absolute; top: 70%; left: 25%; transform: translate(-50%, -50%);">
                    <h3 class="text-black    text-md">Your Smile, Our Passion</h3>
                    <p class="text-black    text-sm">Experience the magic of a healthy smile. <br>Schedule your appointment now!</p>
                    <button class="btn rounded-5 px-4"><i class="fa-solid fa-calendar"
                    style="margin-right: 10px;"></i>Book an Appointment</button>
                </div>
                    <img src="resources\image_header3.jpg" class="d-block w-100 carousel-image" alt="..." >
            </div>

            <div class="carousel-item active carousel-item">
                <div class="carousel-caption"
                style="position: absolute; top: 70%; left: 70%; transform: translate(-50%, -50%);">
                    <h3 class="text-black    text-md">Experience Exceptional Dental Care</h3>
                    <p class="text-black    text-sm">Nurturing your dental health, one visit at a time.</p>
                    <button class="btn rounded-5 px-4"><i class="fa-solid fa-calendar"
                    style="margin-right: 10px;"></i>Book an Appointment</button>
                </div>
                    <img src="resources\image_header2.jpg" class="d-block w-100 carousel-image" alt="..." >
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#headerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#headerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Image Text Container-->
    <div class="container pt-5 pb-5  image-header-text" >
        <div class="row">
            <div class="col-md-6">
                <div class="inner-div">
                    <img src="resources\dentist-cleaning-teeth.jpeg"
                    alt="..." class="img-fluid rounded">
                </div>
            </div>
            <div class="col-md-6" >
                <div class="inner-div centered-text">
                    <p>
                    Unlock the secret to a vibrant smile with regular dental check-ups.
                    Not only do they keep your teeth and gums healthy, but they also save
                    you valuable time and money down the road. Beyond oral health, these
                    check-ups are your shield against gum disease, tooth decay, and even
                    the silent threats like oral cancer. Take charge of your well-being
                    and schedule your appointment today!
                    <br><br>
                    Regular dental check-ups offer more than just a bright smile. They're
                    your passport to overall wellness, providing early detection of potential
                    issues while promoting long-term health. With every visit, you invest in a
                    future of confidence and vitality. Join us in prioritizing your oral and
                    overall well-being—because a healthier you starts with a simple appointment.

                    </p>
                </div>
            </div>
        </div>
    </div>


    <hr style="width: 75%; border: none; height: 1px; background-color: black; margin: 150px auto;" id="servicesSection" >

    <!-- Services Carousel(by 3)-->
    <div class="container ps-0" >
        
            <div class="title text-center  pb-5 mb-5 ">
                <h2>Services</h2>
            </div>
            
            <div class="row mb-5 services-container">
            <div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                <div class="card" style="background-image: url('resources/braces.jpeg');">
                    <h4 class="card-title text-center py-4">Braces</h4>
                    <div class="card-body flex-column d-flex justify-content-center align-items-center">
                        <h4 class="card-title text-center py-4">Braces</h4>
                        <p class="card-text">Dental braces offer the opportunity to enhance the aesthetics of your smile, address issues with your bite or misaligned teeth, and contribute to better oral health and overall wellness.</p>
                    </div>
                </div>
            </div>

            <div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                <div class="card" style="background-image: url('resources/whitening.jpg');">
                    <h4 class="card-title text-center py-4">Whitening</h4>
                    <div class="card-body flex-column d-flex justify-content-center align-items-center">
                        <h4 class="card-title text-center py-4">Whitening</h4>
                        <p class="card-text">Dental whitening can enhance the appearance of discolored or stained teeth, leading to a brighter, more youthful-looking smile and increased confidence.</p>
                    </div>
                </div>
            </div>

            <div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                <div class="card" style="background-image: url('resources/fillings.jpeg');">
                    <h4 class="card-title text-center py-4">Fillings</h4>
                    <div class="card-body flex-column d-flex justify-content-center align-items-center">
                        <h4 class="card-title text-center py-4">Fillings</h4>
                        <p class="card-text">Dental fillings can restore the structure and function of teeth damaged by decay or trauma, prevent further damage, and maintain oral health and hygiene.</p>
                    </div>
                </div>
            </div>

            <div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                <div class="card" style="background-image: url('resources/extraction.jpeg');">
                    <h4 class="card-title text-center py-4">Extractions</h4>
                    <div class="card-body flex-column d-flex justify-content-center align-items-center">
                        <h4 class="card-title text-center py-4">Extractions</h4>
                        <p class="card-text">Dental extractions can be necessary to remove damaged or infected teeth, alleviate pain or discomfort, prevent the spread of infection, and maintain the overall health of the mouth and surrounding teeth.</p>
                    </div>
                </div>
            </div>

            <div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                <div class="card" style="background-image: url('resources/crowns-bridges.jpeg');">
                    <h4 class="card-title text-center py-4">Crowns & Bridges</h4>
                    <div class="card-body flex-column d-flex justify-content-center align-items-center">
                        <h4 class="card-title text-center py-4">Crowns & Bridges</h4>
                        <p class="card-text">Dental crowns can provide structural support, enhance aesthetics, and restore function to damaged or weakened teeth, improving oral health and preventing further damage.</p>
                    </div>
                </div>
            </div>

            <div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                <div class="card" style="background-image: url('resources/dentures.jpeg');">
                    <h4 class="card-title text-center py-4">Dentures</h4>
                    <div class="card-body flex-column d-flex justify-content-center align-items-center">
                        <h4 class="card-title text-center py-4">Dentures</h4>
                        <p class="card-text">Dentures can replace missing teeth, improve speech, enhance oral function, and restore the aesthetics of a patient's smile, leading to increased confidence and overall quality of life.</p>
                    </div>
                </div>
            </div>


            </div>


    </div>


    <hr style="width: 75%; border: none; height: 1px; background-color: black; margin: 150px auto;" id="testimonialSection">

    <!-- Testimonials Section-->
    <div class="container" >
        <section id="testimonial-section">
            <div class="row d-flex justify-content-center pb-5 ">
                <div class="col-md-8 col-xl-8 text-center testimonials">
                <h3 class="mb-4">Testimonials</h3>
                <p class="mb-4 pb-2 mb-md-5 pb-md-0">
                "Discover Smiles Transformed: Hear What Our Patients Have to Say"
                </p>
                </div>
            </div>
    
            <div class="container pb-5">
                <div class="row d-flex justify-content-around ">
                    <div class="col mb-5 mb-md-0 p-5 m-3 testimonial-body " style="position: relative;">
                    <i class="fas fa-quote-left pe-3 fa-3x ps-3 " style="position: absolute; top: 0; left: 0;" ></i>
                    <p class="px-xl-3 pb-5 pt-3">
                    "I was always nervous about going to the dentist, but the team at this clinic made me feel comfortable from the moment I walked in the door. They took the time to explain everything to me and answer all of my questions, and my appointments are always quick and painless. I wouldn't trust anyone else with my dental care!"
                    </p>
                    <h5 class="mb-1 px-3">Franc, Japan</h5>
                    <h6 class=" mb-3 px-3 ">via Facebook</h6>
                    </div>
    
                    <div class="col mb-5 mb-md-0 p-5 m-3 testimonial-body" style="position: relative;">
                    <i class="fas fa-quote-left pe-3 fa-3x ps-3 " style="position: absolute; top: 0; left: 0;" ></i>
                    <p class="px-xl-3 pb-5 pt-3">
                    "I've been a patient at this dental clinic for years now, and I couldn't be happier with the care I've received. The staff is always friendly and professional, and my dentist is incredibly skilled and attentive. I highly recommend this clinic to anyone looking for top-notch dental care."
                    </p>
                    <h5 class="mb-1 px-3">Alexa, Philippines</h5>
                    <h6 class=" mb-3 px-3 ">via Facebook</h6>
                    </div>
    
                    <div class="col mb-5 mb-md-0 p-5 m-3 mt-md-4 testimonial-body" style="position: relative;">
                    <i class="fas fa-quote-left pe-3 fa-3x ps-3 " style="position: absolute; top: 0; left: 0;" ></i>
                    <p class="px-xl-3 pb-5 pt-3">
                    "As someone who struggles with dental anxiety, finding a dentist I feel comfortable with was incredibly important to me. The team at this clinic goes above and beyond to make sure I feel relaxed and at ease during my appointments, and I truly appreciate their efforts. I actually look forward to going to the dentist now!"
                    </p>
                    <h5 class="mb-1 px-3">Patricia, Norway</h5>
                    <h6 class=" mb-3 px-3 ">via Facebook</h6>
                    </div>
    
                </div>
            </div>
        </section>
    </div>
    

    <hr style="width: 75%; border: none; height: 1px; background-color: black; margin: 40px auto;" id="appointmentSection">


    <!-- Appointment Form Section-->
    <div class="container" style="margin-bottom: 200px;" >
        <div class="row d-flex justify-content-around  d-lg-flex justify-content-lg-start ">
            <!-- Form Column-->
            <div class="form-header mt-5 pt-5 mb-5 ps-lg-0 col-md-8 ps-lg-5 " >
                <h3>Get Appointment</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. <br>
                    Nam corrupti molestiae totam.Velit dignissimos soluta beatae.</p>
            </div>
            <div class="col-lg-6 p-lg-4 p-xl-5 col-md-8 col-10 p-4 mb-5  rounded-5 form-body" style="background-color: #9BE0FF;">

                <form action="" method="POST" enctype="multipart/form-data" novalidate id="appointmentForm" >
                    <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment" >
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="firstname" placeholder ="First Name" required style="margin-right: 10px;">
                                <label for="text">First Name*</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="lastname" placeholder ="First Name" required>
                                <label for="text">Last Name*</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" placeholder ="Enter you email here:" required>
                                <label for="email" >Email*</label>
                                <div class="invalid-feedback">Invalid Email</div>
                                <div class="valid-feedback">Valid Email</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="number_format" class="form-control" name="phone_number" placeholder ="Enter you phone number here" required>
                                <label for="number" >Phone Number*</label>
                                <div class="invalid-feedback">Invalid Phone Number</div>
                                <div class="valid-feedback">Valid Phone Number</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                        <input type="date" class="form-control" name="preferred_date" placeholder ="Enter your preferred date" required>
                        <label for="date" >Preferred Date*</label>
                        <div class="invalid-feedback">Invalid Date</div>
                        <div class="valid-feedback">Valid Date</div>
                    </div>
                    <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                        <input type="time" class="form-control" name="preferred_time" placeholder ="Enter your preferred time" required>
                        <label for="time" >Preferred Time*</label>
                        <div class="invalid-feedback">Invalid Time</div>
                        <div class="valid-feedback">Valid Time</div>
                    </div>
                    <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                        <textarea class="form-control" id="textarea" rows="4" name="comments" placeholder ="Comments/Concerns" style="height: 200px; resize: none;"></textarea>
                        <label for="textarea">Comments/Concerns</label>
                    </div>
                    <div class="container d-flex justify-content-end ">
                        <button class="btn mt-4 px-5 py-2 rounded-5 border-1 border-black sched-btn" id="submit-button" style="color: black;">Submit</button>
                    </div>
                </form>
            </div>

            <script src="javascript/submit-appointment.js"></script>

            <div class="col-lg-5 col-6 rounded-5 col-md-8 mt-md-5 col-10">
                
            </div>
        </div>
    </div>

    <hr style="width: 75%; border: none; height: 1px; background-color: black; margin: 100px auto;" id="contactUsSection">


    <!-- Contact Us Section -->
    <div class="container" style="margin-bottom: 200px;" >
        <div class="row d-flex justify-items-between align-items-center   d-lg-flex justify-content-lg-around">
            <div class="col-lg-5 col-6 rounded-5 col-md-8 mt-md-5 col-10">
                <!-- Clinic  Information -->
                <div class="container">
                    <h5 class="py-2"><div class="icon-container"><i class="fa-solid fa-location-dot"></i></div>Our Clinic</h5>
                    <p class="py-2 ">019 Gov. F Halili Ext Ave Binang 2nd , Bocaue, Philippines</p>
                    <hr>
                    <h5 class="py-2 "><div class="icon-container"><i class="fa-solid fa-clock"></i></div>Clinic Hours</h5>
                    <p>Monday - Friday: 09:00 AM - 06:00 PM</p>
                    <p>Thursday: 09:00 AM - 05:00 PM</p>
                    <p>Saturday: 12:00 PM - 06:00 PM</p>
                    <p>Sunday: CLOSED</p>
                    <hr>
                    <h5 class="py-2 "><div class="icon-container"><i class="fa-solid fa-phone"></i></div>Get in Touch</h5>
                    <p class="py-2">docjohnny2018@gmail.com</p>
                    <p class="py-2 ">0943 359 9161</p>
                </div>
            </div>
            <div class="col-lg-5 col-6 rounded-5 col-md-8 mt-md-5 col-10 align-content-center ">
                <!--Google map-->
                <div id="map-container-google-1" class="z-depth-1-half map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.3760947637345!2d120.92813962851038!3d14.796923995733389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ad6fb57f5813%3A0x2ba0a06c1d88eb1a!2s17%20Gov%20Fortunato%20Halili%20Ave%2C%20Bocaue%2C%20Bulacan!5e0!3m2!1sen!2sph!4v1708916664903!5m2!1sen!2sph"
                        width="600" height="600" style="border:0; " allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>


    


    <!--Footer-->
    <footer class="text-lg-start" style="background-color: #9BE0FF;">
        <div class="p-5 pb-0 ">
            <section class="">
                <div class="row">
                    <div class="col-1">
                        <img src="resources\brand_logo.jpg" alt="Brand Logo" class="img-fluid footer-img" style="width: 100%;">
                    </div>
                    <div class="col-md-3 col-lg-4 col-xl-4  mt-3 text-start ">

                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Dr. Johnny Mar Cabugon Dental Clinic
                        </h6>
                        <p class="">
                        We are dedicated to promoting overall health and well-being through exceptional dental care. Our team is committed to creating healthy smiles and improving oral health, one appointment at a time. With personalized treatments and compassionate service, we strive to empower our patients to achieve optimal dental health and overall wellness. Join us on the journey to a healthier, happier you."
                        </p>
                    </div>

                    <!--Contact Info-->
                    <div class="col-md-8 col-lg-7 col-xl-7 mt-3 text-end ">
                        <!--Icons-->
                        <a class="btn btn-floating m-1 rounded-5" style="background-color: #000000; color: #ffffff; " href="https://www.facebook.com/Dr.JohnnyMarCabugon" role="button"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-floating m-1 rounded-5" style="background-color: #000000; color: #ffffff; " href="#!" role="button"><i class="fab fa-twitter" ></i></a>
                        <a class="btn btn-floating m-1 rounded-5" style="background-color: #000000; color: #ffffff" href="#!" role="button"><i class="fab fa-google" ></i></a>
                        <div class="d-flex justify-content-end ">
                            <hr class="w-25">
                        </div>
                        <!--Details-->
                        <h6 class="text-uppercase mb-4 font-weight-bold">Contact Us</h6>
                        <p><i class="fas fa-home mr-3"></i> 019 Gov. F Halili Ext Ave Binang 2nd , Bocaue, Philippines</p>
                        <p><i class="fas fa-envelope mr-3"></i> docjohnny2018@gmail.com</p>
                        <p><i class="fas fa-phone mr-3"></i> 0943 359 9161</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2024 Copyright
        </div>
    </footer>

    <!-- Chat Feature -->
    <button class="chat_box-toggler">
    <span class="material-symbols-rounded">mode_comment</span>
    <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chat_box">
        <!-- Insert Chat code from other php file here -->
        <header>
            <h4>Need assistance?</h4>
            <p style="margin-bottom: 0!important;">We're here to help!</p>
            <span class="close-btn material-symbols-outlined">close</span>
        </header>
        <section class="form signup">
            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off" class="signup-form">
            <div class="error-text"></div>
            <div class="name-details">
                <div class="field input">
                <input type="text" name="fname" placeholder="First name" required>
                </div>
                <div class="field input">
                <input type="text" name="lname" placeholder="Last name" required>
                </div>
            </div>
            <div class="field input">
                <input type="text" name="email" placeholder="Enter your email" required>
            </div>
            <div class="field input">
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
    </div>
    
    <script src="javascript/load-content.js"></script>
    <script src="scrollreveal.js"></script>
    <script src="script.js"></script>
    <script>
        const form = document.querySelector("form")

        form.addEventListener('submit',e => {
            if(!form.checkValidity()){
                e.preventDefault()
            }
            form.classList.add('was-validated')
        })
    </script>

    <script>
         $('.close-btn').click(function(){
           $('.alert').removeClass("show");
           $('.alert').addClass("hide");
         });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>