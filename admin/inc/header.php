<?php



$r_count = 0;
       $ref_sql = 'SELECT COUNT(*) FROM `referral`'; 
        $ref_stmt = $pdo->prepare($ref_sql);
        $ref_stmt->execute();
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
    <title>Hexas Trade</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/dash.css">
    <link rel="stylesheet" href="../assets/dash-css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

    .dash-details {
        color: gold;
    }
    </style>
</head>



<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav style="background: #343a40" id="sidebar" class="active">

            <ul style="padding-top: 50px;" class="list-unstyled components mb-5">
                <li class="active">
                    <a href="index.php"><span class="fa fa-dashboard"></span> Dashboard</a>
                </li>
                <li>
                    <a href="deposit-crypto.php"><span class="fa fa-money"></span>Approve Deposit</a>
                </li>

                <li>
                    <a href="approve-loan.php"><span class="fa fa-money"></span> Approve Loan</a>
                </li>

                <li>
                    <a data-toggle="collapse" href="#withdraw" role="button" aria-expanded="false"
                        aria-controls="withdraw">
                        <span class="fa fa-btc"></span> Withdraw
                    </a>
                </li>
                <ul class="collapse" id="withdraw">
                    <li>
                        <a href="withdraw-investment.php"> Investment</a>
                    </li>
                    <li>
                        <a href="withdraw-loan.php">Loan</a>
                    </li>
                </ul>
                <li>
                    <a href="transaction-history.php"><span class="fa fa-recycle"></span> Transaction History</a>
                </li>
                <li>
                    <a href="users.php"><span class="fa fa-users"></span> User(s)</a>
                </li>
                <li>
                    <a href="packages.php"><span class="fa fa-certificate"></span> Select Plans</a>
                </li>
                <li>
                    <a href="email-users.php"><span class="fa fa-envelope-o"></span> Send Email</a>
                </li>
                <li>
                    <a href="alter-investments.php"><span class="fa fa-exchange"></span> Alter (Investment)</a>
                </li>
                <li>
                    <a href="logs.php"><span class="fa fa-star"></span> Logs</a>
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

                    <button style="background: #343a40; border-color: #343a40;" type="button" id="sidebarCollapse"
                        class="btn btn-primary">
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
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="notifications.php">Notifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin-sign-out.php">Sign Out</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>