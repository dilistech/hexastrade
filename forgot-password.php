<?php
include_once 'inc/database.php';
include_once 'inc/methods.php';
include_once 'config/config.php';

$ref_id = '';
if (isset($_GET['ref'])) { 
$ref_id = $_GET['ref'];
}


//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$error = '';
$email = '';



if (isset($_POST['submit'])) {   
    
   $email = trim($_POST['email']);
   $pass = 'Xn?'.rand(10000, 99999);
       
    $sql = 'SELECT * FROM user  WHERE email = :email  LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        $id = $row -> id;
        if ($row) {
        $sql_1 = 'UPDATE user SET pass = :pass Where id = :id LIMIT 1';
        $update = $pdo->prepare($sql_1);        
        $update->execute([':pass' => $pass,':id' => $id]);
        
        $to1 = $email;
        $subject_1 = 'Hexas Trade Password Reset';
        $first_name_1 = $row -> first_name;
        $last_name_1 = $row -> last_name;
        $body_1 = '<p>Your password has been reset</p><br/>';
        $body_1 .= '<p>Your password is '.$pass.'</p>';
        $body_1 .= '<p>You can change this password from the account setting in your dashboard. </p>';
        send_email($to1,$subject_1,$first_name_1, $last_name_1,$body_1,new PHPMailer()); 

        echo '<script>
                setTimeout(function() {
                window.location.href = "forgot-password.php?r=successful";
                }, 200);
                </script>';
        }
        else{
             $error = 'Oops we cannot find your email !';
        }
        

            
         

  
    
   
    
}
?>
<?php
$title = 'Hexastrade - Forgot Password';

?>
<?php
require_once 'inc/header.php';
?>




<?php if (isset($_GET['r'])):?>
<script>
swal("Check your email !", "Password Reset succesfully!", "success");
</script>
<?php endif?>
<div style="padding-top:100px" class="head-content">
    <div class="container">
        <h2>Forgot Password</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><span class="fa fa-home"></span>
                        Home</a></li>
                <li class=" breadcrumb-item active" aria-current="page">Forgot Password</li>
            </ol>
        </nav>
    </div>
</div>

<div class="sign-up">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="back">
                <div class="container">
                    <p style="font-size:1.5em;color:red;text-align:center">
                        <?php 
                        echo $error;
                
                         ?></p>
                    <form id="sign-up-form" action="" method="post">
                        <div class="row justify-content-center">
                            <div class="col-sm-8">

                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input id="email" class="form-control" name="email" type="email"
                                            placeholder="Email" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>





                                <div class="row justify-content-center">
                                    <input id="submit" class="btn btn-secondary" type="submit" name="submit"
                                        value="Submit">
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <p style="text-align:center" class="form-footer">
                                        <a style="color:white" href="sign-in.php">Back to login</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

</div>
<?php
require_once 'inc/footer.php';
?>