<?php
$title = 'Hexastrade - Contact - us';

?>
<?php
require_once 'inc/header.php';
?>
<div class="contact">
    <div class="head">

    </div>

    <div class="head-content">
        <div class="container">
            <h2>Contact</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><span class="fa fa-home"></span>
                            Home</a></li>
                    <li class=" breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <p>Phone Number</p>
                <p class="text-white">
                    +44(744)144‑1688
                </p>
            </div>
            <div class="col-sm-4">
                <p>Email Address</p>
                <p>
                    support@hexastrade.com
                </p>
            </div>
            <div class="col-sm-4">
                <p>Office Address</p>
                <p>
                    Cardiff Wales, Helsinki Finland
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="contact-back">
            <form action="inc/email-script.php" method="post">
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-2 col-form-label">First Name:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="first_name" placeholder="First Name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="last_name" placeholder="Last Name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="subject" type="text" placeholder="Subject" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message" class="col-sm-2 col-form-label">Message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="message" id="" cols="20" rows="10"
                                    placeholder="Message" required></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <input class="btn btn-secondary" name="sendMessage" type="submit" value="Send Message">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
require_once 'inc/footer.php';
?>