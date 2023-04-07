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

      $b_sql = 'SELECT * FROM `wallet` WHERE id = :id';
        $b_stmt = $pdo->prepare($b_sql);
        $b_stmt->execute(['id' => 1]);
        $btc = $b_stmt->fetch();

    $c_sql = 'SELECT * FROM `wallet` WHERE id = :id';
        $c_stmt = $pdo->prepare($c_sql);
        $c_stmt->execute(['id' => 2]);
        $eth = $c_stmt->fetch();

     
        

  
 
?>
 <style>
.inv-act {
    background: white;
    color: black;
}
 </style>
 <?php require_once 'inc/header.php'; ?>
 <div class="container">
     <?php require_once 'inc/head.php'; ?>


     <div class="inv-act">
         <h3>Activate your investment</h3>
         <p>
             You created <?php echo $_SESSION['amount']?> USD investment
         </p>
         <p>
             Kindly deposit <b><?php echo $_SESSION['amount']?> USD</b> to the company
             bitcoin wallet address below.
         </p>
         <div class="row">
             <div class="col-sm-4"><b>Bicoin Address</b></div>
             <div class="col-sm-8"><?php echo $btc -> crypto_address?></div>
         </div>
         <div class="row">
             <div class="col-sm-4"><b>Amount</b></div>
             <div class="col-sm-8"><?php echo $_SESSION['amount']?> USD</div>
         </div>
         <P>
             Contact our customer care with proof of payment by clicking the message icon on your dasboard
             for your investment to be approved.



         </P>


     </div>




 </div>

 <?php require_once 'inc/footer.php'; ?>