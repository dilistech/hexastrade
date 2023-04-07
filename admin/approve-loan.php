 <?php
 include_once '../inc/database.php';
 include_once '../inc/methods.php';
 
 session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: ../admin-sign-in.php');
}

require '../phpmailer/vendor/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

 $mail = new PHPMailer(true);
 $b_sql = 'SELECT * FROM `wallet` WHERE id = :id';
        $b_stmt = $pdo->prepare($b_sql);
        $b_stmt->execute(['id' => 2]);
        $btc = $b_stmt->fetch();


  if (isset($_POST['approve'])) {
            $id = $_POST['tid'];
            $amount = $_POST['amount'];
            $user_id = $_POST['user_id'];
            $date_time  = date('Y-m-d H:i:s');
            $timestamp = date('Y-m-d H:i:s',time());            
            $sql = 'SELECT * FROM user  WHERE id = :id LIMIT 1';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $user_id]);
            $row = $stmt->fetch();
        $sql = 'UPDATE account SET status = 2,verified_date = :verified_date,balance = :balance
         Where tid = :id LIMIT 1';
        $update = $pdo->prepare($sql);     
        $update->execute(['verified_date' => $timestamp,'balance' => $amount,'id' => $id]);

        $ip_address = get_client_ip();
          logs($user_id,$ip_address,'loan request approved');

          
           $body= '<div style="background:black;color:white;padding:15px">'; 
          $body .= '<p style="margin:10px 0"><img style="height:50px" src="https://hexastrade.com/assets/imgs/logo.png" alt=""></p>';
          $body .= '<p style="margin:10px 0;">Hi investor, <span style="text-transform: capitalize">'.$row -> first_name.' '.$row -> last_name.'</span></p>';
        $body .= '<p style="margin:10px 0;">Your request to take loan from Hexas Trade was approved successfully.</p>';
        $body .= '<p style="margin:10px 0;">Kindly make your insurance deposit so we can use it to process your funds
         and make it available for you to withdraw to your bitcoin wallet.</p>';
        $body .= '<p style="margin:10px 0;">Note: Insurance fee is 10% of the loan amount you requested</p>';
        $body .= '<p style="margin:10px 0;">If your loan did not reflect in your bitcoin wallet 45 minutes after paying your insurance
        fee please contact customer care so that it can be resolved immediately.</p>';
        $body .= '<p style="margin:10px 0;">Transaction id  :' .$id.'</p>';
        $body .= '<p style="margin:10px 0;>Bitcoin Address :'.$btc -> crypto_address.'</p>';
        $body .= '<p style="margin:10px 0;">Amount : ' .$amount.'</p> <span style="color:green">USD</span>';
        $body .= '<p style="margin:10px 0;">Insurance Fee :<span style="color:green">' .$amount * 0.1 .' USD</span></p>';
        $body .= '<p style="margin:10px 0;">Date : ' .$date_time.'</p>';
        $body .= '</div>';     
        send_email($row -> email,'Loan Request Approved',$row -> first_name, $row -> last_name,$body,$mail);
             
             echo '<script>
                setTimeout(function() {
                window.location.href = "transaction-history.php?r=successful";
                }, 200);
                </script>';
        }

 

    $sql = 'SELECT * FROM `account` INNER JOIN packages ON account.package_id = packages.id INNER JOIN user ON account.user_id = user.id WHERE packages.type = 3 && account.status = 0 ';
       
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        
 
?>
 <?php require_once 'inc/header.php'; ?>
 <div class="container">
     <?php require_once 'inc/head.php'; ?>


     <div class="table-responsive">
         <table id="dtVerticalScrollExample" class="table table-dark table-bordered table-sm" cellspacing="0"
             width="100%">
             <thead>
                 <tr>
                     <td>##</td>
                     <td>Ref.Id</td>
                     <td>First Name</td>
                     <td>Last Name</td>
                     <td>Email</td>
                     <td>Status</td>
                     <td>Plan</td>
                     <td>Amount</td>
                     <td>Reg. Date</td>
                     <td>Approve</td>
                     <td>Delete</td>
                 </tr>
             </thead>
             <tbody>
                 <?php 
                                    $i = 1;
                                    if (!empty($rows)):;
                                     ?>
                 <?php
                                     foreach ($rows as $row):
                                       
                                        $timestamp = strtotime($row -> registeration_date);
                                        $read_date = date(' jS  F Y ', $timestamp);
                                        if ($row -> status == 0) {
                                            $status = 'pending';
                                        }
                                    ?>
                 <tr>
                     <td><?php echo $i ?></td>
                     <td><?php echo $row -> tid ?></td>
                     <td><?php echo $row -> first_name ?></td>
                     <td><?php echo $row -> last_name ?></td>
                     <td><?php echo $row -> email ?></td>
                     <td><?php echo $status ?></td>
                     <td><?php echo $row -> name ?></td>
                     <td><?php echo $row -> amount ?></td>
                     <td><?php echo $read_date ?></td>
                     <td>
                         <form action="" method="post">
                             <input type="hidden" value="<?php echo $row -> tid ?>" name="tid">
                             <input type="hidden" value="<?php echo $row -> amount ?>" name="amount">
                             <input type="hidden" value="<?php echo $row -> user_id ?>" name="user_id">
                             <button type="submit" name="approve" class="btn btn-success">Approve</button>
                         </form>
                     </td>
                     <td>
                         <form action="">
                             <button class="btn btn-danger">Delete</button>
                         </form>
                     </td>

                 </tr>
                 <?php 
                                $i++;
                                endforeach
                                 ?>
                 <?php else: ?>
                 <tr>
                     <td>No transaction found</td>
                 </tr>
                 <?php endif ?>
             </tbody>

         </table>
     </div>


 </div>
 <?php require_once 'inc/footer.php'; ?>