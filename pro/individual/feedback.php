<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>
<?php


?>
<!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Feedback</h1>
            </div>

        </div>
    </div>
</section> -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info text-dark ">
                    <h5><i class="fas fa-info"></i> Info:</h5>
                    We always want to hear from you!
                    Replied to within 24-hours.
                </div>



                <div class="card text-dark">
                    <div class="card-header bg-dark alert-success">
                        <h5 class="card-title"><b>List of all Feedbacks</b></h5>
                        <div class='float-right'>
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#add">
                                Send New Feedback
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id='example1'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Your Comment</th>
                                    <th>Response</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn = 0;
                                $query = getFeedbacks();
                                while ($row = $query->fetch_assoc()) {
                                    $sn++;
                                    echo "<tr>
                                    <td>$sn</td>
                                    <td>" . $row['message'] . "</td>
                                    <td>" . ($row['response'] == NULL ? '-- No Response Yet --' : $row['response']) . "</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>


                    </div>

                    <br />
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<div class="modal fade " id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header text-dark">
                <h4 class="modal-title">Send New Feedback </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group text-dark">
                                Type Message : <textarea name="message" required minlength="10" id="" cols="30"
                                    rows="10" class="form-control"></textarea>
                            </div>

                        </div>


                        <hr>
                        <input type="submit" name="sendFeedback" class="btn btn-success" style="background-color:#f8198d; border-color:#f8198d;" value="Send"></p>
                </form>


            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php

if (isset($_POST['sendFeedback'])) {
    $msg = $_POST['message'];
    $send = sendFeedback($msg);
    echo $send;
    if ($send) {
        echo "<script>alert('Feedback sent! We will get back to you');window.location='individual.php'</script>";
    } else {
        echo "<script>alert('Feedback could not be sent! Try again!');window.location='individual.php'</script>";
    }
}

?>