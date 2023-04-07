<?php

 $sql = 'SELECT * FROM user  WHERE id = :id LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $user_id]);
    $row = $stmt->fetch();

    if ($row -> display_picture != '') {
                            $path = 'profile-pictures/'.$row -> display_picture;
    }
    else {
        $path = 'profile-pictures/avatar.png';
    }

    $user_id = $row -> id;
    $count = '';

    $user_sql = 'SELECT COUNT(*) FROM `notifications` WHERE user_id = :user_id && status = 0';  
        $user_stmt = $pdo->prepare($user_sql);
        $user_stmt->execute([':user_id' => $user_id]);
        $user_count = $user_stmt->fetchColumn();
        if ($user_count) {
                $count = $user_count;
            }
            else{
                $count = '';
            }

    $r_count = 0;
       $ref_sql = 'SELECT COUNT(*) FROM `referral` WHERE ref_id = :user_id'; 
        $ref_stmt = $pdo->prepare($ref_sql);
        $ref_stmt->execute([':user_id' => $user_id]);
        $ref_count = $ref_stmt->fetchColumn();
        if ($ref_count) {
                $r_count = $ref_count;
            }
            else{
                $r_count = 0;
            }
?>
<!doctype html>
<html lang="en">

<head>
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/dash-css/style.css">
    <link rel="stylesheet" href="../assets/css/dash.css">
    <link rel="shortcut icon" type="image/jpg" href="../favicon.jpg">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../assets/js/clipboard.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="../favicon.png">


    <style>
    body {
        background: black;
    }

    @media only screen and (min-width: 200px) and (max-width: 991.98px) {
        #sidebar.active {
            min-width: 150px !important;
            max-width: 150px !important;
        }
    }
    </style>

</head>



<body style="overflow-x:hidden !important">

    <div class="wrapper d-flex align-items-stretch">
        <nav style="background: #343a40" id="sidebar" class="active">

            <ul style="padding-top: 50px;" class="list-unstyled components mb-5 dash-ul">
                <li class="active">
                    <a href="index.php"><span class="fa fa-desktop"></span> Dashboard</a>
                </li>
                <li>
                    <a href="deposit.php">
                        <span class="fa fa-send"></span> Invest
                    </a>
                </li>
                <li>
                    <a href="request-loan.php"><span class="fa fa-money"></span> Request Loan</a>
                </li>

                <li>
                    <a href="payback-loan.php"><span class="fa fa-dollar"></span> Pay Back (Loan)</a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#withdraw" role="button" aria-expanded="false"
                        aria-controls="withdraw">
                        <span class="fa fa-btc"></span> Withdraw
                    </a>
                </li>
                <ul class="collapse" id="withdraw">
                    <li>
                        <a href="withdraw.php"> Investment</a>
                    </li>
                    <li>
                        <a href="withdraw-loan.php">Loan</a>
                    </li>
                </ul>
                <li>
                    <a href="transaction-history.php"><span class="fa fa-history"></span> Transactions </a>
                </li>
                <li>
                    <a href="referral.php"><span class="fa fa-users"></span> Referrals</a>
                </li>
                <li>
                    <a href="account-settings.php"><span class="fa fa-gear"></span> Acoount Settings</a>
                </li>

            </ul>


        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">

                    <button style="background: gold; border-color: gold;" type="button" id="sidebarCollapse"
                        class="btn btn-pri">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="notifications.php">Notifications <span
                                        style="color: white;background-color: #e90e0e;"
                                        class="badge "><?php echo $count; ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../sign-out.php">Sign out</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>