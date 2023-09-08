<?php get_header(); ?>


<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                <h1 class="text-white">Old School Barbershop</h1>
                        <p>- The Barbershop That Will Bring You Good Service And A Great Haircut -</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->
<!--  Contact START  -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-12">
                <div class="mb-5">
                    <h2 class="mb-2">Send Feedback & Contact Us</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-sm-12">
                <form class="contact__form" method="post" action="mail.php">
                    <!-- form message -->
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success contact__msg" style="display: none" role="alert">
                               Message Sent
                            </div>
                        </div>
                    </div>
                    <!-- end message -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input name="name" type="text" class="form-control" placeholder="Name" required />
                        </div>
                        <div class="col-md-6 form-group">
                            <input name="email" type="email" class="form-control" placeholder="Email" required />
                        </div>
                        <div class="col-md-12 form-group">
                            <input name="phone" type="text" class="form-control" placeholder="Number" required />
                        </div>
                        <div class="col-12 form-group">
                            <textarea name="message" class="form-control" rows="6" placeholder="Message" required></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <input name="submit" type="submit" class="btn btn-hero btn-circled" value="Send" />
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5 pl-4 mt-4 mt-lg-0">
                <h4>Adress</h4>
                <p class="mb-3">Sollentuna Nackademin.se</p>
                <h4>Number</h4>
                <p class="mb-3">+4666666666</p>
                <h4>E-Mail</h4>
                <p class="mb-3">example@nackademin.com</p>
            </div>
        </div>
    </div>
</section>
<!--  CONTACT END  -->

<section id="counter" class="section-padding">
        <div class="overlay dark-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-6">
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                </div>
            </div>
        </div>
    </section>




<?php get_footer(); ?>
