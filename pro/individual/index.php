<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>

<div class="content">
    <div class="container-fluid">
        <?php
        if (!isset($_POST['submit'])) {
        ?>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header alert-dark">
                        <h5 class="m-0">Quick Tips</h5>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                       <center> <img src="../images/home.jpg" width="500px" style="margin-bottom:5px;"></center>
                    </div>
                    <div class="card-body text-dark col-md-6">
                        <span class="badge badge-info">Use the links at the left.</span>
                        <br />
                          <span class="badge badge-warning text-justify">
                        You can see list of schedules by clicking on "New Booking".<br/>The system will display list
                        of available <br/> schedules for you which you can view and make bookings from. </span>
                        <span class="badge badge-success text-justify">Before your
                        bookings are saved, you are redirected to make payment.</span>
                         <span class="badge badge-secondary text-justify">After a successful payment, system
                        generates your ticket ID <br/>for you which you are required to bring to the station. </span>
                         <span class="badge badge-danger text-justify">You are
                        allowed to view all your booking history by clicking on "View Bookings".</span>
                         <img src="../images/big1.jpg" width="500px;"  height="197px;" style="margin-bottom:5px;">

                    </div>
                    </div>
                </div>
            </div><?php
                    } else {
                        $class = $_POST['class'];
                        $number = $_POST['number'];
                        $schedule_id = $_POST['id'];
                        if ($number < 1) die("Invalid Number");
                        ?>

            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header alert-success bg-dark">
                            <h5 class="m-0">Booking Preview</h5>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info-circle"></i> Booking Summary<?php //echo ucwords($class), " Class" ?>:</h5>
                                You are about to book
                                <?php echo $number, " Ticket", $number > 1 ? 's' : '', ' for ', getRouteFromSchedule($schedule_id); ?>
                                <br />

                                <?php

                                    $fee = ($_SESSION['amount'] = getFee($schedule_id, $class));
                                    echo $number, " x &#8358;", $fee, " = &#8358;", ($fee * $number), "<hr/>";
                                    $fee = $fee * $number;
                                    $amount = intval($fee);
                                    $vat = ceil($fee * 0.075);
                                    echo "V.A.T Charges = &#8358;$vat<br/><hr/>";
                                    echo "Total = &#8358;", $total = $amount + $vat;
                                    $fee =  intval($total) . "00";
                                    $_SESSION['amount'] =  $total;
                                    $_SESSION['original'] =  $fee;
                                    $_SESSION['schedule'] =  $schedule_id;
                                    $_SESSION['no'] =  $number;
                                    $_SESSION['class'] =  $class;
                                    ?>
                            </div>
                            <a href="pay.php"><button
                                    onclick="return confirm('You will be directed to make your payment.\nPayment finalizes your booking!')"
                                    class="btn text-light" style="background-color:#f8198d;">Pay Now</button></a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>