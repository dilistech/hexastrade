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
$id = '';
$user_name = '';
$email = '';
$first_name = '';
$last_name = '';    
$phone = '';
$pass = '';
$confirm_pass = '';
$wallet_address = '';


if (isset($_POST['submit']) && $_POST['g-recaptcha-response'] != '') {   
    $secret = '6Lc9jMAfAAAAAOG4Yru8QnxC1D4tm0SaoLebquAp';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='. $secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData  = json_decode($verifyResponse);  
    if ($responseData -> success) {
        $email = trim($_POST['email']);
    $id = md5(time().$email);
    $user_name = trim($_POST['username']);    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];    
    $phone = $_POST['phone'];
    $pass = trim($_POST['pass']);    
    $confirm_pass = trim($_POST['comfirm_pass']);
    $wallet_address = $_POST['wallet_address'];
    $otp = rand(10000, 99999);

    $query = 'SELECT COUNT(*) FROM user WHERE email = :email  LIMIT 1';
    $stmtCheck = $pdo->prepare($query);
    $stmtCheck->bindParam(':email',$email);
    $stmtCheck->execute();
    $row = $stmtCheck->fetchColumn();   
    
    $query = 'SELECT COUNT(*) FROM user WHERE user_name = :user_name  LIMIT 1';
    $stmtUser = $pdo->prepare($query);
    $stmtUser->bindParam(':user_name',$user_name);
    $stmtUser->execute();
    $rowUser = $stmtUser->fetchColumn(); 
    if ($row > 0 ) {
        $error = 'Email already exist';
    }
    elseif ($rowUser > 0 ) {
       $error = 'Username already exist';
    }
     elseif ($pass != $confirm_pass) {
       $error = 'Password do not match';
    }
    elseif (empty($email)) {
       $error = 'Email field cannot be empty';
    }
    else{  
        
        $sql = 'INSERT INTO user (id, first_name, user_name, last_name, email,phone, pass, wallet_address, otp_code) VALUES (:id, :first_name,:user_name,:last_name,:email,:phone,:pass,:wallet_address,:otp)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id,'first_name' => $first_name,'user_name' => $user_name,'last_name' => $last_name,'email' => $email,'phone' => $phone,'pass' => $pass,'wallet_address' => $wallet_address,'otp'=> $otp]);
        
        
        $to1 = $email;
        $subject_1 = 'Registeration successful';
        $first_name_1 = $first_name;
        $last_name_1 = $last_name;
        $body_1= '<div style="background:black;color:white;padding:15px">'; 
        $body_1 .= '<p style="margin:10px 0"><img style="height:50px" src="https://hexastrade.com/assets/imgs/logo.png" alt=""></p>';
       
        $body_1 .= '<h2 style="margin:10px 0">Hi investor,'.' '.$first_name_1.'</h2>';
        $body_1 .= '<p style="margin:10px 0;line-height:2;">Thanks you for creating an account
        on our website. Click the activate link below to activate your account</p><br/>';
        $body_1 .= '<p style="margin:10px 0;">Thank you for choosing Hexas Trade</p>';
        $body_1 .= '<div style="margin:30px 0">
        <a style="padding:15px 30px;border-radius:10px;background-color:gold;border-color:gold;color:black"
         href="'.SITE_NAME.'/verify.php?otp='.$otp.'&id='.$id.'">Activate Account</a></div>';
        
       
        $body_1 .= '</div>'; 
        send_email($to1,$subject_1,$first_name_1, $last_name_1,$body_1,new PHPMailer()); 

                $ip_address = get_client_ip();
            $activity = 'new user registeration';
            logs($id,$ip_address,$activity);
                    

            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $id;
           
                        
        if ($ref_id != '') {
        $query = 'SELECT * FROM user WHERE user_name = :user_name LIMIT 1';
        $stmtCheck = $pdo->prepare($query);
        $stmtCheck->bindParam(':user_name',$ref_id);
        $stmtCheck->execute();
        $row_r = $stmtCheck->fetch();  

        if ($row_r) {
         $sql = 'INSERT INTO referral ( user_id, ref_id) VALUES (:user_id,:ref_id)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $id,'ref_id'=> $row_r -> id]);

        
        $to2 = $row_r -> email;
        $subject_2 = 'You have new referral';
        $first_name_2 = $row_r -> first_name;
        $last_name_2 = $row_r -> last_name;
        $body_2 = '<div style="background:black;color:white;padding:15px">'; 
        $body_2 .= '<p style="margin:10px 0"><img style="height:50px" src="https://hexastrade.com/assets/imgs/logo.png" alt=""></p>';
        $body_2 .= '<h2>You have a new investor</h2>';  
        $body_2 .= '<p> First Name : '.$first_name_1.'</p>'; 
        $body_2 .= '<p>Last Name : '.$last_name_1.'</p>'; 
        $body_2 .= '<p>Email : '.$email.'</p>';    
        $body_1 .= '</div>';   
        send_email($to2,$subject_2,$first_name_2, $last_name_2,$body_2,new PHPMailer());      

            }               
            
            
            
            }
        

                    echo '<script>
                            setTimeout(function() {
                            window.location.href = "thank-you.php";
                            }, 200);
                            </script>';

               


    
    }

    }  
    

         

  
    
   
    
}
?>
<?php
$title = 'Hexastrade - Register';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/faq.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" type="image/png" href="favicon.png">

    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
    <div id="pre-loader" class="pre-loader">
        <div class="loader">

            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

    </div>
    <section id="section-id" style="background: black;" class="content display-none">

        <div id="header-id" class="display-none">
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php"><img style="height:50px" src="assets/imgs/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#investments">Investment Plan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                    <div class="form-inline my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="sign-up.php">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sign-in.php">Login</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>

        <div style="padding-top:100px" class="head-content">
            <div class="container">
                <h2>Register</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><span class="fa fa-home"></span>
                                Home</a></li>
                        <li class=" breadcrumb-item active" aria-current="page">Register</li>
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
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Username:</label>
                                            <div class="col-sm-9">
                                                <input id="username" class="form-control" name="username" type="text"
                                                    placeholder="Username" value="<?php echo $user_name;?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Email:</label>
                                            <div class="col-sm-9">
                                                <input id="email" class="form-control" name="email" type="email"
                                                    placeholder="Email" value="<?php echo $email; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">First
                                                Name:</label>
                                            <div class="col-sm-9">
                                                <input id="first-name" class="form-control" name="first_name"
                                                    type="text" placeholder="First Name"
                                                    value="<?php echo $first_name;?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Last
                                                Name:</label>
                                            <div class="col-sm-9">
                                                <input id="last-name" class="form-control" name="last_name" type="text"
                                                    placeholder="Last Name" value="<?php echo $last_name ;?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Password:</label>
                                            <div class="col-sm-9">
                                                <input id="pass" class="form-control" name="pass" type="password"
                                                    placeholder="Password" value="<?php echo $pass;?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Confirm
                                                Password:</label>
                                            <div class="col-sm-9">
                                                <input id="comfirm-pass" class="form-control" name="comfirm_pass"
                                                    type="password" placeholder="Comfirm Password"
                                                    value="<?php echo $confirm_pass; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Phone
                                                Number:</label>
                                            <div class="col-sm-9">
                                                <input id="phone" class="form-control" name="phone" type="tel"
                                                    placeholder="Phone 124-456-678" value="<?php echo $phone; ?>"
                                                    required minlength="9" maxlength="16">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Bitcoin Wallet
                                                Address</label>
                                            <div class="col-sm-9">
                                                <input id="wallet-address" class="form-control" name="wallet_address"
                                                    type="text" placeholder="Wallet Address"
                                                    value="<?php echo $wallet_address;?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Upline:
                                            </label>
                                            <div class="col-sm-9">
                                                <input id="ref-id" class="form-control" name="wallet_address"
                                                    type="text" placeholder="Referral Link"
                                                    value="<?php echo $ref_id;?>" disabled>
                                            </div>
                                        </div>
                                        <div class="g-recaptcha"
                                            data-sitekey="6Lc9jMAfAAAAAEo6RLFBra8vLmUONYsv4LKlP8IV"></div>
                                        <div style="margin: 20px 0;" class="row justify-content-center ">
                                            <input id="submit" class="btn btn-secondary" type="submit" name="submit"
                                                value="Register">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="form-footer">Already have account?
                                                    <a style="color:white" href="sign-in.php">Login here</a>
                                                </p>
                                            </div>

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