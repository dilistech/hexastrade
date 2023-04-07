 <?php
  include_once '../inc/database.php';
 include_once '../inc/methods.php';
 include_once 'interest-calc.php';
 
 session_start();
 if (!isset($_SESSION['id'])) {
header('location: ../sign-in.php');
} 
 $user_id = $_SESSION['id'];

 $sql_ab = 'SELECT SUM(balance) FROM `account` INNER JOIN packages ON account.package_id = packages.id    
         WHERE account.user_id = :user_id  && account.status > 0';
        $stmt_ab = $pdo->prepare($sql_ab);
        $stmt_ab->execute([':user_id' => $user_id]);
        $total_ab = $stmt_ab->fetch(PDO::FETCH_NUM);
        
         if ($total_ab[0]) {
                $total_ab_earned = number_format($total_ab[0],2);
            }
            else{
                $total_ab_earned = '0.00';
            }
$sql_ad = 'SELECT SUM(transaction.amount) FROM `transaction` 
        INNER JOIN account ON transaction.aid = account.tid
         WHERE transaction.user_id = :user_id  &&  transaction.type = :type && account.status = :status';
        $stmt_ad = $pdo->prepare($sql_ad);
        $stmt_ad->execute([':user_id' => $user_id,':type' => 'deposit',':status' => 1]);
       
        $total_ad = $stmt_ad->fetch(PDO::FETCH_NUM);
        
         if ($total_ad[0]) {
                $total_ad_earned = number_format($total_ad[0],2);
            }
            else{
                $total_ad_earned = "0.00";
            }



$sql_adt = 'SELECT SUM(transaction.amount) FROM `transaction` 
        INNER JOIN account ON transaction.aid = account.tid
         WHERE transaction.user_id = :user_id  &&  transaction.type = :type ';
        $stmt_adt = $pdo->prepare($sql_adt);
        $stmt_adt->execute([':user_id' => $user_id,':type' => 'deposit']);
       
        $total_adt = $stmt_adt->fetch(PDO::FETCH_NUM);
        
         if ($total_adt[0]) {
                $total_ad_earnedt = number_format($total_adt[0],2);
            }
            else{
                $total_ad_earnedt = "0.00";
            }


            $sql_adw = 'SELECT SUM(transaction.amount) FROM `transaction` 
        INNER JOIN account ON transaction.aid = account.tid
         WHERE transaction.user_id = :user_id  &&  transaction.type = :type ';
        $stmt_adw = $pdo->prepare($sql_adw);
        $stmt_adw->execute([':user_id' => $user_id,':type' => 'withdraw']);
       
        $total_adw = $stmt_adw->fetch(PDO::FETCH_NUM);
        
         if ($total_adw[0]) {
                $total_ad_earnedw = number_format($total_adw[0],2);
            }
            else{
                $total_ad_earnedw = "0.00";
            }

    $total_ac_earned = 0;
    $total_aw_earned = 0;
    $total_at_earned = 0;        
$sql_ap = 'SELECT SUM(profit) FROM `account` INNER JOIN packages ON account.package_id = packages.id      
         WHERE account.user_id = :user_id && packages.type= :type ';
        $stmt_ap = $pdo->prepare($sql_ap);
        $stmt_ap->execute([':user_id' => $user_id,':type' => 1]);
        $total_ap = $stmt_ap->fetch(PDO::FETCH_NUM);
        
         if ($total_ap[0]) {
                $total_ac_earned = $total_ap[0];
                $total_ap_earned = number_format($total_ap[0],2);
            }
           
$sql_ap_t = 'SELECT SUM(amount) FROM `transaction`     
         WHERE user_id = :user_id && type= :type ';
        $stmt_ap_t = $pdo->prepare($sql_ap_t);
        $stmt_ap_t->execute([':user_id' => $user_id,':type' => 'profit']);
        $total_ap_t = $stmt_ap_t->fetch(PDO::FETCH_NUM);
        
         if ($total_ap_t[0]) {
                $total_at_earned = number_format($total_ap_t[0],2);
            }
      
            
            $total_earning = $total_ac_earned + $total_at_earned;  
       
       $total_earning =  number_format($total_earning,2);

       

       $sql_td = 'SELECT SUM(amount) FROM `transaction`     
         WHERE user_id = :user_id && type= :type ';
        $stmt_td = $pdo->prepare($sql_td);
        $stmt_td->execute([':user_id' => $user_id,':type' => 'withdraw']);
        $total_td = $stmt_td->fetch(PDO::FETCH_NUM);
        
         if ($total_td[0]) {
                $total_td_earned = number_format($total_td[0],2);
            }
      else{
                $total_td_earned = "0.00";
            }
       



   $sql_dd = 'SELECT *,transaction.type AS a_type,transaction.reg_date AS a_date FROM `transaction` 
 INNER JOIN user ON transaction.user_id = user.id WHERE user.id = :user_id &&  transaction.type = :type ORDER BY transaction.reg_date
  DESC  LIMIT 1';
        $stmt_dd = $pdo->prepare($sql_dd);
        $stmt_dd->execute(['type' => 'deposit','user_id' => $user_id]);
        $w_row_d = $stmt_dd->fetch();
        $last_deposit = '';

        
        if (is_null($w_row_d -> amount)) {
            $last_deposit = '0.00';
        }
        else {
            $last_deposit = $w_row_d -> amount;
        }

       $sql_ld = 'SELECT SUM(balance) FROM `account` INNER JOIN packages ON account.package_id = packages.id      
         WHERE account.user_id = :user_id && packages.type= :type';
        $stmt_ld = $pdo->prepare($sql_ld);
        $stmt_ld->execute([':user_id' => $user_id,':type' => 3]);
        $total_ld = $stmt_ld->fetch(PDO::FETCH_NUM);
        
         if ($total_ld[0]) {
                $total_ld_earned = number_format($total_ld[0],2);
            }
            else{
                $total_ld_earned = 0.00;
            }



  $sql_dw = 'SELECT *,transaction.type AS a_type,transaction.reg_date AS a_date FROM `transaction` 
 INNER JOIN user ON transaction.user_id = user.id WHERE user.id = :user_id &&   transaction.type = :type ORDER BY transaction.reg_date
  DESC  LIMIT 1';
        $stmt_dw = $pdo->prepare($sql_dw);
        $stmt_dw->execute(['type' => 'withdraw','user_id' => $user_id]);
        $w_row_dw = $stmt_dw->fetch();
        $last_withdraw = '';        
        
        if (is_null($w_row_dw -> amount)) {
            $last_withdraw = '0.00';
        }
        else {
            $last_withdraw = $w_row_dw -> amount;
        }
        
        $sql_ddd = 'SELECT *,transaction.type AS a_type,transaction.reg_date AS a_date FROM `transaction` 
 INNER JOIN user ON transaction.user_id = user.id WHERE user.id = :user_id &&   transaction.type = :type ORDER BY transaction.reg_date
  DESC  LIMIT 1';
        $stmt_ddd = $pdo->prepare($sql_ddd);
        $stmt_ddd->execute(['type' => 'deposit','user_id' => $user_id]);
        $w_row_ddd = $stmt_ddd->fetch();
        $last_deposit = '';        
        
        if (is_null($w_row_ddd -> amount)) {
            $last_deposit = '0.00';
        }
        else {
            $last_deposit = $w_row_ddd -> amount;
        }

 $sql_tdp = 'SELECT SUM(withdraw_amount) FROM `withdraw`     
         WHERE investor_id = :user_id && withdraw_status = :status';
        $stmt_tdp = $pdo->prepare($sql_tdp);
        $stmt_tdp->execute([':user_id' => $user_id,':status' => 0]);
        $total_tdp = $stmt_tdp->fetch(PDO::FETCH_NUM);
        
         if ($total_tdp[0]) {
                $total_td_earnedp = number_format($total_tdp[0],2);
            }
      else{
                $total_td_earnedp = "0.00";
            }


 $sql_bonus = 'SELECT * FROM `transaction` WHERE user_id = :user_id && type = :type LIMIT 1';
    $stmt_bonus = $pdo->prepare($sql_bonus);
    $stmt_bonus->execute(['type' => 'bonus','user_id' => $user_id]);
    $row_bonus = $stmt_bonus->fetch();


    $sql_l = 'SELECT SUM(balance) FROM `account` INNER JOIN packages ON account.package_id = packages.id      
         WHERE account.user_id = :user_id && packages.type= :type';
        $stmt_l = $pdo->prepare($sql_l);
        $stmt_l->execute([':user_id' => $user_id,':type' => 3]);
        $total_l = $stmt_l->fetch(PDO::FETCH_NUM);
        
         if ($total_l[0]) {
                $total_ll = number_format($total_l[0],2);
            }
            else{
                $total_ll = 0.00;
            }
    

     
        
            
   
 
 
 ?>
 <?php
$title = 'Hexastrade - Dashboard - Home';

?>

 <?php require_once 'inc/header.php'; ?>
 <style>
td {
    white-space: nowrap;
}
 </style>

 <div class="container">

     <nav aria-label="breadcrumb">
         <ol style="background:#343a40;" class="breadcrumb">
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
                         <p>Wallet Balance </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-bitcoin"></span>
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
                         <span class="fa fa-bitcoin"></span>
                         <span class="span">$<?php echo $total_earning; ?></span>
                     </div>


                 </div>
             </div>
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Total Deposit</p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-bitcoin"></span>
                         <span class="span">$<?php echo $total_ad_earned; ?></span>
                     </div>


                 </div>
             </div>
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Total Withdraw </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-bitcoin"></span>
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
                         <span class="fa fa-bitcoin"></span>
                         <span class="span">$<?php echo $last_deposit;?></span>
                     </div>


                 </div>
             </div>
             <div class="col-sm-4">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>Last Withdraw </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-bitcoin"></span>
                         <span class="span">$<?php echo $last_withdraw ?></span>
                     </div>



                 </div>

             </div>




         </div>
         <div class="row">
             <div class="col-sm-12">
                 <div class="round-edge bg-site-color my-custom">
                     <div>
                         <p>LOAN WALLET </p>
                     </div>
                     <div class="dash-details">
                         <span class="fa fa-bitcoin"></span>
                         <span class="span">$<?php echo $total_ld_earned; ?></span>
                     </div>

                 </div>
             </div>
         </div>
     </div>






 </div>


 <?php require_once 'inc/footer.php'; ?>