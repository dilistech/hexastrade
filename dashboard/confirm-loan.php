 <?php
 include_once '../inc/database.php';
 include_once '../inc/methods.php';
 
 session_start();
 if (!isset($_SESSION['id'])) {
header('location: ../sign-in.php');
} 

require '../phpmailer/vendor/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


 $user_id = $_SESSION['id'];
 $mail = new PHPMailer(true);

 

    
  

    
 
?>
 <?php
$title = 'Hexastrade - Dashboard - Confirm Loan';

?>
 <?php require_once 'inc/header.php'; ?>
 <style>
li {
    list-style: none;
    font-size: 1.2em;
}
 </style>
 <div class="container">
     <?php require_once 'inc/head.php'; ?>
     <div style="background: #343a40;background: #343a40;margin: 20px 0;padding: 20px;">
         <ul>

             <li>
                 <b>Amount:</b>
                 <span>USD <?php echo $_SESSION['amount'] ;?></span>
             </li>
             <li>
                 <b>Loan Type:</b>
                 <span><?php echo $_SESSION['title'] ;?></span>
             </li>
         </ul>




         <h3>Your loan request is successful</h3>

     </div>




 </div>

 <?php require_once 'inc/footer.php'; ?>