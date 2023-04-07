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

 

      $sql_a = 'SELECT *, transaction.type AS a_type, transaction.amount AS a_amount FROM `transaction` INNER JOIN packages ON transaction.package_id = packages.id
   INNER JOIN user ON transaction.user_id = user.id INNER JOIN account ON transaction.aid = account.tid WHERE 
   transaction.user_id = :user_id && NOT transaction.type = :profit && account.package_id < 15';
        $stmt_a = $pdo->prepare($sql_a);
        $stmt_a->execute([':user_id' => $user_id,':profit' => 'profit']);
        $rows = $stmt_a->fetchAll();
        
 
?>
 <?php
$title = 'Hexastrade - Dashboard - Transaction History';

?>
 <?php require_once 'inc/header.php'; ?>
 <style>
td {

    text-transform: capitalize;

}
 </style>
 <div class="container">
     <?php require_once 'inc/head.php'; ?>


     <div class="table-responsive">
         <table id="dtVerticalScrollExample" class="table table-dark  table-bordered table-sm" cellspacing="0"
             width="100%">
             <thead>
                 <tr>
                     <td>##</td>
                     <td>Plan</td>
                     <td>Amount</td>
                     <td>Type</td>
                     <td>Status</td>
                     <td>Reg. Date</td>
                 </tr>
             </thead>
             <tbody>
                 <?php 
                                    $i = 1;
                                    if (!empty($rows)):;
                                     ?>
                 <?php
                                $status =  '';
                                     foreach ($rows as $row):
                                        
                                        if ($row -> status == 0) {
                                        $status =  'Pending'; 
                                        $color =  'gold';                                        
                                    }
                                        elseif ($row -> status > 0  ) {
                                           $status =  'Approved'; 
                                           $color =  'green'; 
                                        }
                                       
                                        $timestamp = strtotime($row -> reg_date);
                                        $read_date = date(' jS  F Y ', $timestamp);
                                    ?>
                 <tr>
                     <td><?php echo $i ?></td>
                     <td><?php echo $row -> name ?></td>
                     <td>$<?php echo $row -> a_amount ?></td>
                     <td><?php echo $row -> a_type ?></td>
                     <td style="color:<?php echo $color ?>"><?php echo $status ?></td>
                     <td><?php echo $read_date ?></td>

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