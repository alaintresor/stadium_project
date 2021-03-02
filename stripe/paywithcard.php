<?php require_once('config.php'); 
?>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">You are about to pay <?php echo $_GET['amount'] ?></h3>
                    </div>
                    <div class="panel-body">

                        <fieldset>
                            <div class="form-group">
                                Fixtures: <?php echo "<b>" . $result2[0] . "</b>"; ?>
                            </div>
                            <div class="form-group">
                                Date: <?php echo "<b>" . $result2[1] . "</b>"; ?>
                            </div>
                          
                            <form action="charge.php" method="POST" enctype='multipart/form-data'>

                              

                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="form-group">

                                        <script src="https://checkout.stripe.com/checkout.js"
   class="stripe-button" data-key="<?php echo $stripe['publishable_key']; ?>"
    data-description="Access for a year" data-amount="<?php echo '2'; ?>" data-locale="auto"></script>
                                        </div>
                                    </div>
                                    <div class="col-lg-6"><a href="" class="btn btn-warning btn-block">clancel</a>
                                    </div>
                                </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
