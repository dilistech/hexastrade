<?php
$timestamp = strtotime($row ->reg_date);
$read_date = date('l jS \of F Y h:i:s A ', $timestamp);

$cr_sql = 'SELECT * FROM crypto ';
    $cr_stmt = $pdo->prepare($cr_sql);
    $cr_stmt->execute(['id' => $user_id]);
    $cr_rows = $cr_stmt->fetchAll();

    
?>
<div class="dash-head">
    <div style="background: #343a40;" class="container">
        <h1><a href="index.php" class="logo avatar"><img src="<?php echo $path?>" alt=""></a></h1>
        <h3>Hello Investor, <span style="text-transform: capitalize;"><?php echo $row -> first_name; ?></span></h3>

        <p style="font-size:1.2em" class="badge badge-warning"> Referred Investors (<?php echo $r_count; ?>)</p>


    </div>