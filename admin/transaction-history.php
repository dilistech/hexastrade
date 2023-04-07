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

 

    $sql = 'SELECT *,transaction.type AS t_type FROM `account` INNER JOIN packages ON account.package_id = packages.id 
    INNER JOIN user ON account.user_id = user.id INNER JOIN transaction ON transaction.user_id = user.id ';
       
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
                     <td>Type</td>
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
                                       
                                        $timestamp = strtotime($row -> reg_date);
                                        $read_date = date(' jS  F Y ', $timestamp);

                                        if ($row -> status == 0) {
                                            $status = 'Pending';
                                        } elseif ($row -> status > 0) {
                                            $status = 'Approved';
                                        }
                                        
                                        
                                        
                                    ?>
                 <tr>
                     <td><?php echo $i ?></td>
                     <td><?php echo $row -> tid ?></td>
                     <td><?php echo $row -> first_name ?></td>
                     <td><?php echo $row -> last_name ?></td>
                     <td><?php echo $row -> email ?></td>
                     <td><?php echo $status ?></td>
                     <td><?php echo $row -> t_type ?></td>
                     <td><?php echo $row -> name ?></td>
                     <td><?php echo $row -> amount ?></td>
                     <td><?php echo $read_date ?></td>
                     <td>
                         <form action="">
                             <button class="btn btn-success">Approve</button>
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