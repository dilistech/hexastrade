<?php 

if (isset($_GET['otp']) && isset($_GET['id'])) {
    $otp = $_GET['otp'];
    $id = $_GET['id'];
    include_once 'inc/database.php';
    $query = 'SELECT otp_code,verified_status FROM user WHERE id = :id LIMIT 1';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $row = $stmt->fetch();    
    if ($row) {
        if ($row->otp_code == $otp) {
        $sql = 'UPDATE user SET verified_status = 1 Where id = :id LIMIT 1';
        $update = $pdo->prepare($sql);        
        $update->bindParam(':id',$id);
        $update->execute();

        $date = date("Y-m-d H:i:s");
        $tid = md5(time());
        $insert_sql = 'INSERT INTO account (tid,user_id, package_id, amount) VALUES (:tid,:user_id,:package_id,:amount)';
        $insert_stmt = $pdo->prepare($insert_sql);
        $insert_stmt->execute(['tid' => $tid,'user_id' => $id,'package_id' => 15,'amount' => 25]);
        $aid = $pdo->lastInsertId();
        
            
            
         $sql_t = 'INSERT INTO transaction ( user_id, package_id,amount,type,aid)
             VALUES (:user_id,:package_id,:amount,:type,:aid)';
        $stmt_t = $pdo->prepare($sql_t);
        $stmt_t->execute([ 'user_id' => $id,'package_id'=> 15,
         'amount' => 25,'type'=> 'bonus','aid'=> $tid]);

        header('location: sign-in.php');
        }
        else{
            die('something went wrong');
        }     
        
    }    
}
else{
    die('something went wrong');
}

?>