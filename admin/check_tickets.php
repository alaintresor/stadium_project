<?php
require('top.inc.php');
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>CHECK TICKETS</strong><small> </small></div>

                    <div class="card-body card-block">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="date" class=" form-control-label">Ticket Id</label>
                                    <input type="text" placeholder="Enter ticket Id to check" name="id" class="form-control" id="ticketId" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <br>
                                <button type="button" class="btn" onclick="checkTicket()" style="margin-top: 5px;margin-left: -0.5cm;">Check</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8" id="result">
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                    <div id="ok"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const checkTicket = () => {
        let ticketId = $("#ticketId").val();
        $.ajax({
            url: "checkTicket.php",
            type: "POST",
            data: {
                ticketId
            },
            success: function(data) {

                $("#result").html(data);

            }

        })
    }
    const markAsUsed = id => {
        $.ajax({
            url: "markTicketAsUsed.php",
            type: "POST",
            data: {
                id
            },
            success: function(data) {

                $("#ok").html(data);

            }

        })
    }
</script>


<?php
require('footer.inc.php');
?>