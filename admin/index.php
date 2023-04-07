 <?php
  include_once '../inc/database.php';
 include_once '../inc/methods.php';
 include_once 'interest-calc.php';
 
 session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location: ../admin-sign-in.php');
}


 $sql_ab = 'SELECT SUM(balance) FROM `account` INNER JOIN packages ON account.package_id = packages.id    
         WHERE  account.status > 0';
        $stmt_ab = $pdo->prepare($sql_ab);
        $stmt_ab->execute();
        $total_ab = $stmt_ab->fetch(PDO::FETCH_NUM);
        
         if ($total_ab[0]) {
                $total_ab_earned = number_format($total_ab[0],2);
            }
            else{
                $total_ab_earned = '0.00';
            }
$sql_ad = 'SELECT SUM(amount) FROM `transaction` 
         WHERE  type = :type';
        $stmt_ad = $pdo->prepare($sql_ad);
        $stmt_ad->execute([':type' => 'deposit']);
       
        $total_ad = $stmt_ad->fetch(PDO::FETCH_NUM);
        
         if ($total_ad[0]) {
                $total_ad_earned = number_format($total_ad[0],2);
            }
            else{
                $total_ad_earned = "0.00";
            }

$sql_td = 'SELECT SUM(amount) FROM `transaction`     
         WHERE  type= :type ';
        $stmt_td = $pdo->prepare($sql_td);
        $stmt_td->execute([':type' => 'withdraw']);
        $total_td = $stmt_td->fetch(PDO::FETCH_NUM);
        
         if ($total_td[0]) {
                $total_td_earned = number_format($total_td[0],2);
            }
      else{
                $total_td_earned = "0.00";
            }
    $total_ap_earned = 0.00;
    $total_at_earned = 0.00;        
$sql_ap = 'SELECT SUM(profit) FROM `account` INNER JOIN packages ON account.package_id = packages.id      
         WHERE packages.type= :type ';
        $stmt_ap = $pdo->prepare($sql_ap);
        $stmt_ap->execute([':type' => 1]);
        $total_ap = $stmt_ap->fetch(PDO::FETCH_NUM);
        
         if ($total_ap[0]) {
                $total_ap_earned = number_format($total_ap[0],2);
            }
           
$sql_ap_t = 'SELECT SUM(amount) FROM `transaction`     
         WHERE  type= :type';
        $stmt_ap_t = $pdo->prepare($sql_ap_t);
        $stmt_ap_t->execute([':type' => 'profit']);
        $total_ap_t = $stmt_ap_t->fetch(PDO::FETCH_NUM);
        
         if ($total_ap_t[0]) {
                $total_at_earned = number_format($total_ap_t[0],2);
            }
       
       $total_earning = $total_ap_earned + $total_at_earned;    
       $total_earning =  number_format($total_earning,2);



  $sql_dd = 'SELECT *,transaction.type AS a_type,transaction.reg_date AS a_date FROM `transaction` 
 INNER JOIN user ON transaction.user_id = user.id WHERE  transaction.type = :type ORDER BY transaction.reg_date
  DESC  LIMIT 1';
        $stmt_dd = $pdo->prepare($sql_dd);
        $stmt_dd->execute(['type' => 'deposit']);
        $w_row_d = $stmt_dd->fetch();



  $sql_dw = 'SELECT *,transaction.type AS a_type,transaction.reg_date AS a_date FROM `transaction` 
 INNER JOIN user ON transaction.user_id = user.id WHERE  transaction.type = :type ORDER BY transaction.reg_date
  DESC  LIMIT 1';
        $stmt_dw = $pdo->prepare($sql_dw);
        $stmt_dw->execute(['type' => 'withdraw']);
        $w_row_dw = $stmt_dw->fetch();

 $sql_tdp = 'SELECT SUM(withdraw_amount) FROM `withdraw`     
         WHERE  withdraw_status = :status';
        $stmt_tdp = $pdo->prepare($sql_tdp);
        $stmt_tdp->execute([':status' => 0]);
        $total_tdp = $stmt_tdp->fetch(PDO::FETCH_NUM);
        
         if ($total_tdp[0]) {
                $total_td_earnedp = number_format($total_tdp[0],2);
            }
      else{
                $total_td_earnedp = "0.00";
            }

       


// $sql_a = 'SELECT *, account.status AS ast FROM `transaction` INNER JOIN account ON transaction.aid = account.id
//  where transaction.user_id = :user_id  ORDER BY transaction.reg_date ASC';
//         $stmt_a = $pdo->prepare($sql_a);
//         $stmt_a->execute([':user_id' => $user_id]);
//         $rows = $stmt_a->fetchAll();
        
        
            
   
 
 
 ?>

 <?php require_once 'inc/header.php'; ?>

 <div class="container">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a style="color:gold" href="index.php"><span class="fa fa-home"></span>
                     Dashboard</a></li>

         </ol>
     </nav>
     <?php require_once 'inc/head.php'; ?>

     <div class="round-edge color-ash dash-info">
         <div class="row">
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Current Balance </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-money"></span>
                         <span class="span">$<?php echo $total_ab_earned; ?></span>
                     </div>

                 </div>
             </div>
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Total Profit </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-money"></span>
                         <span class="span">$<?php echo $total_earning; ?></span>
                     </div>


                 </div>
             </div>
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Active Deposit</p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-money"></span>
                         <span class="span">$<?php echo $total_ad_earned; ?></span>
                     </div>


                 </div>
             </div>
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Total Withdrawal </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-money"></span>
                         <span class="span">$<?php echo $total_td_earned; ?></span>
                     </div>


                 </div>
             </div>
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Last Deposit </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-money"></span>
                         <span class="span">$<?php echo $w_row_d->amount ?></span>
                     </div>


                 </div>
             </div>
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Last Withdrawal </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-money"></span>
                         <span class="span">$<?php echo $w_row_dw->amount ?></span>
                     </div>



                 </div>

             </div>




         </div>
     </div>





 </div>









 <?php require_once 'inc/footer.php'; ?>