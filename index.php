<?php
$title = 'Hexastrade - Home';

?>
<?php
require_once 'inc/database.php';

$crypto_sql = 'SELECT * FROM `packages` WHERE type = 1  ';
        $crypto_stmt = $pdo->prepare($crypto_sql);
        $crypto_stmt->execute();
        $crypto_rows = $crypto_stmt->fetchAll();

       
$loan_sql = 'SELECT * FROM `packages`  WHERE type = 3 ';
        $loan_stmt = $pdo->prepare($loan_sql);
        $loan_stmt->execute();
        $loan_rows = $loan_stmt->fetchAll();
        



require_once 'inc/header.php';

?>

<div class="banner">
    <img src="assets/imgs/bg-1.jpg" alt="">
    <div style="overflow: visible !important;" class="intro-title">
        <h2>
            Invest with us and become financially independent
        </h2>
        <p>
            Multiply your bitcoin with <span>Hexas Trade</span>
        </p>

        <a class="btn btn-warning" href="/sign-up.php">Sign up</a>
    </div>


</div>


<section>
    <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script>
    <div id="coinmarketcap-widget-marquee" coins="1,1027,825,4687,3408,52,1958,4195,5805,74,3890,1831,2010,6892,4030"
        currency="USD" theme="dark" transparent="false" show-symbol-logo="true"></div>
</section>



<div class="container">

    <div style="padding-bottom: 20px;" class=" intro">
        <h2 style="text-align:center;padding:20px 0">WHO WE ARE?</h2>
        <div class="row">
            <div class="col-sm-6">
                <img style="padding-bottom:20px;height:500px;" class="cert img-fluid" src="assets/imgs/cert.png"
                    alt="intro image">
            </div>
            <div class="col-sm-6 detail">
                <p><span>Hexas Trade</span> is an investment company, whose team is
                    working on making money from the volatility of cryptocurrencies and offer great returns to our
                    investors.</p>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="assets/imgs/fast.png" alt="">
                    </div>
                    <div class="col-sm-9">
                        <h3>
                            Fast Withdrawals
                        </h3>
                        <p>
                            Quick money withdrawals for users
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="assets/imgs/secure.png" alt="">
                    </div>
                    <div class="col-sm-9">
                        <h3>
                            Secure & Reliable
                        </h3>
                        <p>Secure assets fund for users</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="assets/imgs/fast.png" alt="">
                    </div>
                    <div class="col-sm-9">
                        <h3>
                            Guaranteed
                        </h3>
                        <p>Your return on investment is guaranteed</p>
                    </div>
                </div>
                <a class="btn btn-secondary" href="sign-up.php">Sign up</a>
            </div>

        </div>


    </div>

</div>

<div class="how-it-works">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <h3>
                    How <span>Hexas Trade</span> Works
                </h3>
                <h4 class="mb-5">
                    Get involved in our tremendous platform and Invest. We will utilize your money and give you profit
                    in
                    your
                    wallet automatically.
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="stages">
                    <img src="assets/imgs/1.png" alt="">
                    <p>Create an Account</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="stages">
                    <img src="assets/imgs/2.jpg" alt="">
                    <p>Invest in a Plan</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="stages">
                    <img src="assets/imgs/3.png" alt="">
                    <p>Withdraw Earnings</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="why-choose-us">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <h3>Why Choose <span>Hexas Trade</span></h3>
                <h4 class="mb-5">
                    Our goal is to provide our investors with a reliable source of high income, while minimizing any
                    possible
                    risks and offering a high-quality service.
                </h4>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4 back">
                <h4><span class=""></span>Quick Withdrawal</h4>
                <p>
                    Our all retreats are treated spontaneously once requested. There are high maximum limits. The
                    minimum
                    withdrawal amount is only $100 .
                </p>
            </div>
            <div class="col-sm-4 back">
                <h4><span class=""></span>24/7 Support</h4>
                <p>We provide 24/7 customer support through e-mail and telegram. Our support representatives are
                    periodically available to elucidate any difficulty.</p>
            </div>
            <div class="col-sm-4 back">
                <h4><span class=""></span>
                    DDOS Protection</h4>
                <p>
                    We are using one of the most experienced, professional, and trusted DDoS Protection and mitigation
                    provider.
                </p>
            </div>
            <div class="col-sm-4 back">
                <h4><span class=""></span>
                    SSL Secured</h4>
                <p>
                    Comodo Essential-SSL Security encryption confirms that the presented content is genuine and
                    legitimate.
                </p>
            </div>
            <div class="col-sm-4 back">
                <h4><span class=""></span>
                    High reliability</h4>
                <p>
                    We are trusted by a huge number of people. We are working hard constantly to improve the level of
                    our
                    security system and minimize possible risks.
                </p>
            </div>
            <div class="col-sm-4 back">
                <h4><span class=""></span>Dedicated Server</h4>
                <p>
                    We are using a dedicated server for the website which allows us exclusive use of the resources of
                    the
                    entire server.
                </p>
            </div>
        </div>


    </div>


</div>
<div class="invest-plans">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h3>Investment <span>Plans</span></h3>
            <h4 class="mb-5">
                To make a solid investment, you have to know where you are investing.
                Find a plan which is best for you.
            </h4>
        </div>
    </div>
    <div id="investments" class="wrapper">
        <div class="investments">
            <h2 style="color:gold">OUR CRYPTO INVESTMENT PLANS</h2>
            <div class="investment">
                <?php foreach ($crypto_rows as $row): ?>
                <div class="pricing-plans">
                    <div class="plans">
                        <ul>
                            <li class="items items-1"><?php echo $row -> name  ?></li>
                            <li class="items"><?php echo $row -> interest_rate  ?>% Profit</li>
                            <li class="items"> Every <?php echo $row -> interest_rate_duration  ?> Days</li>
                            <li class="items">$ <?php echo number_format($row ->min,2)  ?> - $
                                <?php echo number_format($row ->max,2)  ?></li>
                            <li><?php echo $row -> referral_bonus  ?>% Referral Bonus</li>
                            <li><?php echo $row -> interest_rate  ?>% + <span class="badge badge-success">Capital</span>
                            </li>
                            <li class="anchor-list">
                                <a href="/sign-up.php">Invest Now</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="investments">
            <h2 style="color:gold">LOANS WE OFFER</h2>
            <div class="investment">
                <?php foreach ($loan_rows as $row): ?>
                <div class="pricing-plans">
                    <div class="plans">
                        <ul>
                            <li class="items items-1"><?php echo $row -> name  ?></li>
                            <li class="">Minimum:</li>
                            <li class="items">$ <?php echo number_format($row ->min,2)  ?></li>
                            <li class="">Maximum:</li>
                            <li class="items">$ <?php echo number_format($row ->max,2)  ?></li>
                            <li class="">Interest Rate:</li>
                            <li class="items"><?php echo $row -> interest_rate  ?>%</li>
                            <li>Pay back after 6 months</li>

                            <li class="anchor-list">
                                <a href="/sign-up.php">Request Loan</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>


    </div>
</div>

<div class="faqs">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h3>Frequently Asked Questions</h3>
            <h4 class="mb-5">
                We answer some of your Frequently Asked Questions regarding our platform. If you have a query that is
                not
                answered here, Please contact us.
            </h4>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="faq">
                    <p>
                        <a class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#faq1" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span class="fa fa-question-circle-o"></span> When can I deposit/withdraw from my Investment
                            account?
                        </a>
                    </p>
                    <div class="collapse" id="faq1">
                        <div class="card card-body">
                            Deposit and withdrawal are available for at any time. Be sure, that your funds are not used
                            in any ongoing trade before the withdrawal. The available amount is shown in your dashboard
                            on the main page of Investing platform.


                        </div>
                    </div>
                </div>
                <div class="faq">
                    <p>
                        <a class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#faq2" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span class="fa fa-question-circle-o"></span> How do I check my account balance?
                        </a>
                    </p>
                    <div class="collapse" id="faq2">
                        <div class="card card-body">

                            You can see this anytime on your accounts dashboard. You can see this anytime on your
                            accounts dashboard.


                        </div>
                    </div>
                </div>
                <div class="faq">
                    <p>
                        <a class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#faq3" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span class="fa fa-question-circle-o"></span> I forgot my password, what should I do?
                        </a>
                    </p>
                    <div class="collapse" id="faq3">
                        <div class="card card-body">

                            Visit the password reset page, type in your email address and click the `Reset` button.

                            Visit the password reset page, type in your email address and click the `Reset` button.


                        </div>
                    </div>
                </div>
                <div class="faq">
                    <p>
                        <a class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#faq4" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span class="fa fa-question-circle-o"></span> How will I know that the withdrawal has been
                            successful?
                        </a>
                    </p>
                    <div class="collapse" id="faq4">
                        <div class="card card-body">

                            You will get an automatic notification once we send the funds and you can always check your
                            transactions or account balance. Your chosen payment system dictates how long it will take
                            for the funds to reach you.




                        </div>
                    </div>
                </div>
                <div class="faq">
                    <p>
                        <a class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#faq5" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span class="fa fa-question-circle-o"></span> How much can I withdraw?
                        </a>
                    </p>
                    <div class="collapse" id="faq5">
                        <div class="card card-body">

                            You can withdraw the full amount of your account balance minus the funds that are used
                            currently for supporting opened positions.






                        </div>
                    </div>
                </div>
                <div class="faq">
                    <p>
                        <a class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#faq6" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span class="fa fa-question-circle-o"></span> Why Do You Accepts Only E-Currency?
                        </a>
                    </p>
                    <div class="collapse" id="faq6">
                        <div class="card card-body">

                            Cryptocurrencies are decentralized, so they do not require a bank to process transactions.
                            This helps us eliminate bank transaction fees, saving us 2 to 5 percent on each transaction.






                        </div>
                    </div>
                </div>
                <div class="faq">
                    <p>
                        <a class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#faq8" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span class="fa fa-question-circle-o"></span> What E-Currency Do You Accept
                        </a>
                    </p>
                    <div class="collapse" id="faq8">
                        <div class="card card-body">

                            We accept only Bitcoin.






                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<div class="testimonials">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h3>What investors are saying about us</h3>
            <h4 class="mb-5">We are doing really good at this market and here are the words we loved to get from a few
                of our
                users.
            </h4>
        </div>


    </div>
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <img class="img-fluid img-thumbnail" src="assets/imgs/reviewer1.jpg" alt="First slide">
                            <div>
                                <h3 class="test-name">Elena Stancu</h3>
                                <p>With Hexas Trade I managed to work with my finance and found a great way to earn
                                    money
                                    all day long, not going at work! I began interested in investment and economy,
                                    therefore I can do some forecasts regarding Bitcoin.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <img class="img-fluid img-thumbnail" src="assets/imgs/reviewer2.jpg" alt="First slide">
                            <div>
                                <h3 class="test-name">Paul Azeem</h3>
                                <p>I have invested with this platform and gotten my money in my account. This is legit
                                    and safe. Great doing business with them</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <img class="img-fluid img-thumbnail" src="assets/imgs/reviewer3.jpg" alt="First slide">
                            <div>
                                <h3 class="test-name">Mike Frye</h3>
                                <p>I have invested with this platform and gotten my money in my account. This is legit
                                    and safe. Great doing business with them.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <img class="img-fluid img-thumbnail" src="assets/imgs/reviewer4.jpg" alt="First slide">
                            <div>
                                <h3 class="test-name">Nkosi Bandile</h3>
                                <p>Hexas Trade is legit and paying. Plus for good
                                    and patient support. I will always invest with Hexas Trade.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

</div>
<div class="team-members">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="team-back">
                <h3>Our Awesome <span>Team</span></h3>
                <h4 class="mb-5">The Team behind the scenes working hard to give you awesome results
                </h4>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="inner">
                    <img class="team-img" src="assets/imgs/team1.jpg" alt="">
                    <div class="backg">
                        <p class="title">
                            Herrera Quesada
                        </p>
                        <p>
                            CEO
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="inner">
                    <img class="team-img" src="assets/imgs/team2.jpg" alt="">
                    <div class="backg">
                        <p class="title">
                            Amber Oona
                        </p>
                        <p>
                            Marketing Head
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="inner">
                    <img class="team-img" src="assets/imgs/team3.jpg" alt="">
                    <div class="backg">
                        <p class="title">
                            Jiri Skrobanek
                        </p>
                        <p>
                            Projects Manager
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="inner">
                    <img class="team-img" src="assets/imgs/team4.jpg" alt="">
                    <div class="backg">
                        <p class="title">
                            Helen Davies
                        </p>
                        <p>
                            Processing Manager
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="inner">
                    <img class="team-img" src="assets/imgs/team5.jpg" alt="">
                    <div class="backg">
                        <p class="title">
                            Miroslav Havlovic
                        </p>
                        <p>
                            IT Supervisor
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="inner">
                    <img class="team-img" src="assets/imgs/team7.jpg" alt="">
                    <div class="backg">
                        <p class="title">
                            Judith Owens
                        </p>
                        <p>
                            HR Head
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>


<?php require_once 'inc/footer.php';?>