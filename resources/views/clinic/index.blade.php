@extends('clinic.partials.master')

@section('section')
@section('we care')
 <!-- banner section start -->
         <div class="banner_section layout_padding">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <h1 class="banner_taital">We care Of You</h1>
                     <p class="banner_text">When looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to </p>
                     <div class="read_bt"><a href="#">Read More</a></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- banner section end -->
@endsection
<!-- appointment section start -->
      <div class="appointment_section">
         <div class="container">
            <div class="appointment_box">
               <div class="row">
                  <div class="col-md-12">
                     <h1 class="appointment_taital">Book <span style="color: #0cb7d6;">Appointment</span></h1>
                  </div>
               </div>
               <form action="{{ route('appointment.store') }}" method="POST">
                @csrf
                <div class="appointment_section_2">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="doctorname_text">Patient Name</p>
                            <input type="text" class="form-control" placeholder="" value="{{ auth()->user()?->name }}" name="user_id" readonly>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <p class="doctorname_text">Clinic Name</p>
                                <select class="form-control" id="clinicselect" name="clinic_id">
                                    <option disabled selected>Select Clinic</option>
                                    @foreach (App\Models\Clinic::all() as $clinic)
                                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <p class="doctorname_text">Doctor's Name</p>
                                <select class="form-control" id="subSelect" name="doctor_id">
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <p class="doctorname_text">Appointments</p>
                                <select class="form-control" id="appointments" name="appointment_id">
                                </select>
                            </div>
                        </div>
                    </div>
                    @auth
                        <input type="submit" value="Submit">
                    @endauth
                </div>
            </form>

            </div>
         </div>
      </div>
      <!-- appointment section end -->
      <!-- about section start -->
      <div class="about_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <h1 class="about_taital">About Hospital</h1>
                  <p class="about_text"> has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors  has a more-or-less normal distribution of letters, as o</p>
                  <div class="about_bt"><a href="#">Read More</a></div>
               </div>
               <div class="col-md-6">
                  <div class="about_img"><img src="images/about-img.png"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
      <!-- treatment section start -->
      <div class="treatment_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="treatment_taital">Hospital Treatment</h1>
               </div>
            </div>
            <div class="treatment_section_2">
            <div class="row">
               <div class="col-lg-3 col-sm-6">
                  <h1 class="number_text">01</h1>
                  <h2 class="care_text">Nephrologist Care</h2>
                  <p class="treatment_text">alteration in some form, by injected humour, or randomised words which don't look even slightly e sure there isn't anything</p>
                  <div class="readmore_bt active"><a href="#">Read More</a></div>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <h1 class="number_text">02</h1>
                  <h2 class="care_text">Eye Care</h2>
                  <p class="treatment_text_1">alteration in some form, by injected humour, or randomised words which don't look even </p>
                  <div class="readmore_bt"><a href="#">Read More</a></div>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <h1 class="number_text">03</h1>
                  <h2 class="care_text">Pediatrician Clinic</h2>
                  <p class="treatment_text_1">alteration in some form, by injected humour, or randomised words which don't look even</p>
                  <div class="readmore_bt"><a href="#">Read More</a></div>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <h1 class="number_text">04</h1>
                  <h2 class="care_text">Prenatal Care</h2>
                  <p class="treatment_text_1">alteration in some form, by injected humour, or randomised words which don't look even</p>
                  <div class="readmore_bt"><a href="#">Read More</a></div>
               </div>
            </div>
         </div>
         </div>
      </div>
      <!-- treatment section end -->
      <!-- doctores section start -->
      <div class="doctores_section">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="doctores_taital">Our doctors</h1>
               </div>
            </div>
            <div class="doctores_section_2">
               <div id="my_slider" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-1.png"></div>
                                 <h4 class="humour_text">Humour <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-2.png"></div>
                                 <h4 class="humour_text">Jenni <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-3.png"></div>
                                 <h4 class="humour_text">Morco <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-1.png"></div>
                                 <h4 class="humour_text">Humour <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-2.png"></div>
                                 <h4 class="humour_text">Jenni <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-3.png"></div>
                                 <h4 class="humour_text">Morco <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-1.png"></div>
                                 <h4 class="humour_text">Humour <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-2.png"></div>
                                 <h4 class="humour_text">Jenni <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="doctores_box">
                                 <div class="image_1"><img src="images/img-3.png"></div>
                                 <h4 class="humour_text">Morco <br><span class="mbbs_text">MBBS</span></h4>
                                 <div class="social_icon">
                                    <ul>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                  <i class="fa fa-angle-right"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <!-- doctores section end -->
      <!-- testimonial section start -->
      <div class="testimonial_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="testimonial_taital">Our Testimonial</h1>
               </div>
            </div>
            <div class="customer_section_2">
               <div class="row">
                  <div class="col-md-12">
                      <div class="box_main">
                        <div id="main_slider" class="carousel slide" data-ride="carousel">
                           <div class="carousel-inner">
                              <div class="carousel-item active">
                                 <div class="customer_main">
                                    <div class="customer_right">
                                       <h3 class="customer_name">Morijorch <span class="quick_icon"><img src="images/quick-icon.png"></span></h3>
                                       <p class="default_text">Default model text,</p>
                                       <p class="enim_text">editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="carousel-item">
                                 <div class="customer_main">
                                    <div class="customer_right">
                                       <h3 class="customer_name">Morijorch <span class="quick_icon"><img src="images/quick-icon.png"></span></h3>
                                       <p class="default_text">Default model text,</p>
                                       <p class="enim_text">editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="carousel-item">
                                 <div class="customer_main">
                                    <div class="customer_right">
                                       <h3 class="customer_name">Morijorch <span class="quick_icon"><img src="images/quick-icon.png"></span></h3>
                                       <p class="default_text">Default model text,</p>
                                       <p class="enim_text">editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                           <i class="fa fa-angle-left"></i>
                           </a>
                           <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                           <i class="fa fa-angle-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                </div>
            </div>
         </div>
      </div>
      <!-- testimonial section end -->
      <!-- contact section start -->
      <div class="contact_section layout_padding">
         <div class="container-fluid">
            <div class="contact_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <h1 class="contact_taital">Get In Touch</h1>
                     <form action="">
                        <div class="mail_section_1">
                           <input type="text" class="mail_text" placeholder="Name" name="Name">
                           <input type="text" class="mail_text" placeholder="Phone Number" name="Phone Number">
                           <input type="text" class="mail_text" placeholder="Email" name="Email">
                           <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                           <div class="send_bt"><a href="#">SEND</a></div>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-6 padding_left_15">
                     <div class="map_main">
                        <div class="map-responsive">
                           <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="600" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->
@endsection

@section('js')
      <script>
        $(document).ready(function () {
    $('#clinicselect').change(function () {
        var clinicId = $(this).val();

        $('#subSelect').empty()
            .append('<option selected disabled>Select Doctor</option>')
            .prop('disabled', true);

        if (clinicId) {
            $.ajax({
                url: '/select/' + clinicId + '/doctors',
                method: 'GET',
                success: function (data) {
                    $.each(data, function (index, doctor) {
                        $('#subSelect').append('<option value="' + doctor.id + '">' + doctor.first_name + ' ' + doctor.specialization + '</option>');
                    });

                    // Enable and refresh the nice-select UI
                    $('#subSelect').prop('disabled', false).niceSelect('update');
                },
                error: function () {
                    alert('Failed to load doctors.');
                }
            });
        }
    });
});

</script>
      <script>
        $(document).ready(function () {
    $('#clinicselect').change(function () {
        var clinicId = $(this).val();

        $('#appointments').empty()
            .append('<option selected disabled>Select appointment</option>')
            .prop('disabled', true);

        if (clinicId) {
            $.ajax({
                url: '/select/' + clinicId + '/appointment',
                method: 'GET',
                success: function (data) {
                    $.each(data, function (index, appointment) {
                        $('#appointments').append('<option value="' + appointment.id + '">' + appointment.start_time + ' to ' + appointment.end_time + '</option>');
                    });

                    // Enable and refresh the nice-select UI
                    $('#appointments').prop('disabled', false).niceSelect('update');
                },
                error: function () {
                    alert('Failed to load doctors.');
                }
            });
        }
    });
});

</script>

@endsection
