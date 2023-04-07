<?php
require_once 'inc/database.php';

    $error = '';
    $email = '';
    $pass = '';
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);
       
    $sql = 'SELECT id, email, pass,first_name,last_name,verified_status FROM user  WHERE email = :email && pass =:pass LIMIT 1';
        
    $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email,'pass' => $pass]);
        $row = $stmt->fetch();
        if ($row) {
        
        if ($row->verified_status == 1) {
            session_start();            
        $_SESSION['id'] = $row->id;
        $_SESSION['email'] = $row->email;
        $_SESSION['name'] = $row->first_name . ' ' .$row->last_name ;
            header('location: dashboard/index.php');
        }
        elseif ($row->verified_status == 3) {
            $error = 'Account Suspended!'; 
        }
        else{
                $error = $email.' is not verified, go to your email inbox and click the activation link.';        
             }            
    }
        else {
            $error = 'Invalid credentials';
        }
 }


    
?>
<?php
$title = 'Hexastrade - Login';

?>
<?php
require_once 'inc/header.php';
?>

<div style="padding-top:100px" class="head-content">
    <div class="container">
        <h2>Login</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><span class="fa fa-home"></span>
                        Home</a></li>
                <li class=" breadcrumb-item active" aria-current="page">Login</li>
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
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input id="email" class="form-control" name="email" type="email"
                                            placeholder="Email" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="password" placeholder="Password" name="pass"
                                            value="<?php echo $pass?>" required>
                                    </div>
                                </div>



                                <div class="row justify-content-center">
                                    <input id="submit" class="btn btn-secondary" type="submit" name="submit"
                                        value="Login">
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <p style="text-align:center" class="form-footer">Don't have an account?
                                        <a style="color:white" href="sign-up.php">Register here</a>
                                    </p>
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <p style="text-align:center" class="form-footer">Forgot password?
                                        <a style="color:white" href="forgot-password.php">Reset now</a>
                                    </p>
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