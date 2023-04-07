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

 
 if (isset($_POST['approve'])) {
            $id = $_POST['id'];
            $tid = $_POST['tid'];
            $email = $_POST['email'];
            $amount = $_POST['amount'];
           
                  

                             

        $sql = 'UPDATE withdraw SET withdraw_status = 1
         Where wid = :id LIMIT 1';
        $update = $pdo->prepare($sql);     
        $update->execute(['id' => $id]);

        $i_sql = 'SELECT * FROM `account` INNER JOIN user ON account.user_id = user.id 
        INNER JOIN packages ON account.package_id = packages.id WHERE account.tid = :id LIMIT 1';
     
            $stmt = $pdo->prepare($i_sql);
            $stmt->execute(['id' => $tid]);
            $row = $stmt->fetch();

            $name = $row->first_name . ' ' . $row -> last_name;      
                    
        $body = '<div style="background:black;color:white;padding:15px">'; 
        $body .= '<p style="margin:10px 0"><img style="height:50px" src="https://hexastrade.com/assets/imgs/logo.png" alt=""></p>';
        $body .= '<p style="line-height: 1.5em;margin:10px 0">Hi investor '.$name .'</p>';
        $body .= '<p style="line-height: 1.5em;margin:10px 0">Your withdraw request has been successfully
         processed and $'.number_format($amount, 2).' have been sent to your bitcoin wallet </p>';
        $body .= '<p style="line-height: 1.5em;margin:10px 0">Bitcoin wallet:'.$row -> wallet_address.'</p>';
        $body .= '<p style="line-height: 1.5em;margin:10px 0">Amount: USD'.number_format($amount, 2).'</p>';
        $body .= '<p style="line-height: 1.5em;margin:10px 0">Charge: <span style="color:green">0 USD</span></p>';
        $body .= '<p style="line-height: 1.5em;margin:10px 0">Thanks,</p>';
        $body .= '<p style="line-height: 1.5em;margin:10px 0">Hexas Trade Investment</p>';
        
        $body .= '</div>'; 
        

        

        send_email($row -> email,'Withdraw Successful',$row -> first_name, $row -> last_name,$body,new PHPMailer(true));
    
       
      
       echo '<script>
                setTimeout(function() {
                window.location.href = "withdraw-investment.php?r=successful";
                }, 200);
                </script>';
        

        // header('location:withdraw-investment.php?r=successful');
            
            
            


            
         
}

if (isset($_POST['reject'])) {
    $id = $_POST['id'];
    $wid = $_POST['wid'];    
    $amount = $_POST['withdraw_amount'];              

            
    $i_sql = 'SELECT * FROM `account` INNER JOIN user ON account.user_id = user.id 
        INNER JOIN packages ON account.package_id = packages.id WHERE account.tid = :id LIMIT 1';
     
            $stmt = $pdo->prepare($i_sql);
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch();
            
            $amount += $row -> amount;
            $balance = $amount + $row -> profit;
            
        $sql = 'UPDATE account SET amount = :amount,balance = :balance
         Where tid = :id LIMIT 1';
        $update = $pdo->prepare($sql);     
        $update->execute(['id' => $id,'amount' => $amount,'balance' => $balance]);

        
        $sql = 'DELETE FROM withdraw WHERE wid = :id ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $wid]);

        $sql = 'DELETE FROM transaction WHERE aid = :id && type = :type ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id,':type' => 'withdraw']);

        

            $name = $row->first_name . ' ' . $row -> last_name;
            $email = $row -> email;       
            


    
        $body = '<p style="line-height: 1.5em;">Hello '.$name .'</p>';
        $body .= '<p style="line-height: 1.5em;">Sorry your withdrawal request of. $'.number_format($amount, 2).' was declined </p>';
        $body .= '<p style="line-height: 1.5em;">Kindly contact support immediately</p>';
        $body .= '<p>Withdraw Id:'.$id.'</p>';
        $body .= '<p>Amount: $'.number_format($amount, 2).'</p>';
       
        $body .= '<p>Regards,</p>';        
        $body .= '<p><a href="https://hexastrade.com">Hexastrade</a></p>';
        

        

        send_email($row -> email,'Withdraw request declined',$row -> first_name, $row -> last_name,$body,new PHPMailer(true));
    
       

        

        // header('location:withdraw-investment.php?r=successful');
            
}

if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = 'DELETE FROM withdraw WHERE wid = :id ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $count = $stmt->rowCount();
         header('location:withdraw-investment.php?r=successful');
}

   

    $sql = 'SELECT * FROM `account` INNER JOIN withdraw ON withdraw.aid = account.tid 
INNER JOIN packages ON account.package_id = packages.id INNER JOIN user ON account.user_id = user.id
 WHERE withdraw.withdraw_status = 0  && packages.type < 3';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        
 
?>
 <?php require_once 'inc/header.php'; ?>
 <?php if (isset($_GET['r'])):?>
 <script>
swal("Good job!", "Done succesfully!", "success");
 </script>
 <?php endif?>
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
                     <td>Decline</td>
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
                                       
                                        $timestamp = strtotime($row -> reg_date);
                                        $read_date = date(' jS  F Y ', $timestamp);
                                    ?>
                 <tr>
                     <td><?php echo $i ?></td>
                     <td><?php echo $row -> tid ?></td>
                     <td><?php echo $row -> first_name ?></td>
                     <td><?php echo $row -> last_name ?></td>
                     <td><?php echo $row -> email ?></td>
                     <td style="color:gold">Awaiting confirmation</td>
                     <td><?php echo $row -> name ?></td>
                     <td><?php echo $row -> withdraw_amount ?></td>
                     <td><?php echo $read_date ?></td>
                     <td>
                         <form action="" method="post">
                             <input type="hidden" value="<?php echo $row -> wid ?>" name="id">
                             <input type="hidden" value="<?php echo $row -> tid ?>" name="tid">
                             <input type="hidden" value="<?php echo $row -> email ?>" name="email">
                             <input type="hidden" value="<?php echo $row -> withdraw_amount ?>" name="amount">
                             <button type="submit" name="approve" class="btn btn-success">Approve</button>
                         </form>
                     </td>
                     <td>
                         <form action="" method="post">
                             <input type="hidden" value="<?php echo $row -> tid ?>" name="id">
                             <input type="hidden" value="<?php echo $row -> wid ?>" name="wid">
                             <input type="hidden" value="<?php echo $row -> withdraw_amount ?>" name="withdraw_amount">

                             <button type="submit" name="reject" class="btn btn-secondary">Decline</button>
                         </form>
                     </td>
                     <td>
                         <form action="" method="post">
                             <input type="hidden" value="<?php echo $row -> wid ?>" name="id">
                             <button type="submit" name="delete" class="btn btn-danger">Delete</button>
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