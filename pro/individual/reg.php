<?php
if (!isset($file_access)) die("Direct File Access Denied");
?>
<?php

$me = $_SESSION['user_id'];

?>

<div class="content">



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-success ">
                <div class="card-header bg-dark text-dark">
                    <h3 class="card-title "><b>Book Tickets</b></h3>
                </div>
                <div class="card-body text-dark">

                    <table id="example1" style="align-items: stretch;"
                        class="table table-hover w-100 table-bordered text-darktable-striped<?php //
                                                                                                                                    ?>">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Status</th>
                                <th>Date/Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row = querySchedule('future');
                            if ($row->num_rows < 1) echo "<div class='alert alert-danger' role='alert'>
                            Sorry, There are no schedules at the moment! Please visit after some time.
                          </div>";
                            $sn = 0;
                            while ($fetch = $row->fetch_assoc()) {
                                //Check if the current date is same with Database scheduled date
                                $db_date = $fetch['date'];
                                if ($db_date == date('d-m-Y')) {
                                    //Oh yes, so what should happen?
                                    //Check for the time. If there is still about an hour left, proceed else, skip this data
                                    $db_time = $fetch['time'];
                                    $current_time = date('H:i');
                                    if ($current_time >= $db_time) {
                                        continue;
                                    }
                                }
                                $id = $fetch['id']; ?><tr>
                                <td><?php echo ++$sn; ?></td>
                                <td><?php echo $fullname =  getRoutePath($fetch['route_id']);
                                        ?></td>
                                <td>
                                    <?php $array = getTotalBookByType($id);
                                        $max_first = ($array['first'] - $array['first_booked']);// " Seat(s) Available";
                                       if($max_first < 1 )
                                           echo "No Seat(s) Available";
                                       else if($max_first == 1 )
                                            echo $array['first'] - $array['first_booked'], " Seat Available";
                                        else
                                            echo $array['first'] - $array['first_booked'], " Seat(s) Available";
                                        ?>
                                </td>

                                        <!-- . "<hr/>" . ($max_second = ($array['second'] - $array['second_booked'])) . " Seat(s) Available for Second Class" -->
                                <td><?php echo $fetch['date'], " / ", formatTime($fetch['time']); ?></td>

                                <td>
                                    <?php
                                    if(!$max_first == 0 ){
                                    ?>
                                    <button type="button" class="btn" style="background-color:#f8198d; color:white;" data-toggle="modal"
                                        data-target="#book<?php echo $id ?>">
                                        Book
                                    </button>
                                    <?php
                                     }
                                    ?>
                                </td>
                            </tr>

                            <div class="modal fade" id="book<?php echo $id ?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Book For <?php echo $fullname;


                                                                                    ?> &#x1F68C;</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">


                                            <form action="<?php echo $_SERVER['PHP_SELF'] . "?loc=$id" ?>"
                                                method="post">
                                                <input type="hidden" class="form-control" name="id"
                                                    value="<?php echo $id ?>" required id="">

                                                <p>Number of Tickets (If you are the only one, leave as it is) :
                                                    <input type="number" min='1' value="1"
                                                        max='<?php echo $max_first; ?>'
                                                        name="number" class="form-control" id="">
                                                </p>
                                                <p>
                                                <select name="class" hidden required class="form-control" id="">
                                                        <option value="">-- Select Class --</option>
                                                        <option selected value="first">First Class (₦
                                                            <?php echo ($fetch['first_fee']); ?>)</option>
                                                        <!-- <option value="second">Second Class (₦
                                                            <?php //echo ($fetch['second_fee']); ?>)</option> -->
                                                    </select>
                                                </p>
                                                <input type="submit" name="submit" style="background-color:#f8198d; color:white;" class="btn "
                                                    value="Proceed">

                                            </form>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <?php
                            }
                                ?>

                        </tbody>
                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>

    </form>

</div>