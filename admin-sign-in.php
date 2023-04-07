<?php
require_once 'inc/database.php';

    $error = '';
    $email = '';
    $pass = '';
 if (isset($_POST['submit'])) {
     $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_md5= md5($pass);
    $sql = 'SELECT id, email, pass FROM admin  WHERE email = :email && pass =:pass LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email,'pass' => $pass_md5]);
        $row = $stmt->fetch();
        if ($row) {
        
        
            session_start();            
            $_SESSION['admin_id'] = $row->id;

            echo '<script>
                setTimeout(function() {
                window.location.href = "admin/index.php";
                }, 100);
                </script>';
            
                
        
                 
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
    <div class="container-fli">
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