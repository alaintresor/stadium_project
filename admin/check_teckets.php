<?php
require('top.inc.php');


if (isset($_POST['submit'])) {
    $date = get_safe_value($con, $_POST['date']);
}

?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>CHECK TECKETS</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="date" class=" form-control-label">Tecket Id</label>
                                        <input type="number" placeholder="Enter ticket Id to check" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <br>
                                    <button class="btn">Check</button>
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
require('footer.inc.php');
?>