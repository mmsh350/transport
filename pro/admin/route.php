<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'route';
$me = "?page=$source"
?>

<div class="content">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-header bg-dark text-dark">
                            <h3 class="card-title">
                                All Routes</h3>
                            <div class='float-right'>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    Add New Route &#x1F68C;
                                </button></div>
                        </div>

                        <div class="card-body">

                            <table id="example1" style="align-items: stretch;"
                                class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                            ?>">
                                <thead>
                                    <tr>
                                        <th width="2%">#</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row = $conn->query("SELECT * FROM route");
                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id'];
                                    ?>

                                    <tr>
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo $fetch['start']; ?></td>
                                        <td><?php echo $fetch['stop'];

                                                $fullname = $fetch['start'] . " to " . $fetch['stop']; ?></td>
                                        <td>
                                            <form method="POST">
                                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                    data-target="#edit<?php echo $id ?>">
                                                    Edit
                                                </button> -

                                                <input type="hidden" class="form-control" name="del_train"
                                                    value="<?php echo $id ?>" required id="">
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure about this?')"
                                                    class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit<?php echo $id ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editing <?php echo $fullname;


                                                                                        ?> &#x1F68C;</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $id ?>" required id="">
                                                        <p>From : <input type="text" class="form-control"
                                                                value="<?php echo $fetch['start'] ?>" name="start"
                                                                required id="">
                                                        </p>
                                                        <p> To : <input type="text" class="form-control"
                                                                value="<?php echo $fetch['stop'] ?>" name="stop"
                                                                required id="">
                                                        </p>
                                                        <p>

                                                            <input class="btn" style='background-color:#f8198d; color:white;' type="submit" value="Edit Route"
                                                                name='edit'>
                                                        </p>
                                                    </form>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
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
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</div>
</section>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header text-dark">
                <h4 class="modal-title">Add New Route &#x1F68C;
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <form action="" method="post">

                    <table class="table table-bordered">

                        <tr>
                            <th>From (Departure)</th>
                            <td><input type="text" class="form-control" name="start" required id=""></td>
                        </tr>
                        <tr>
                            <th>To (Arrivals)</th>
                            <td><input type="text" class="form-control" name="stop" required id="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">

                                <input class="btn" style='background-color:#f8198d; color:white;' type="submit" value="Add Route" name='submit'>
                            </td>
                        </tr>
                    </table>
                </form>



            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php

if (isset($_POST['submit'])) {
    $start = $_POST['start'];
    $stop = $_POST['stop'];
    if (!isset($stop, $start)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();

        $ins = $conn->prepare("INSERT INTO route (start,stop) VALUES (?,?)");
        $ins->bind_param("ss", $start, $stop);
        $ins->execute();
        alert("Route Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

if (isset($_POST['edit'])) {
    $start = $_POST['start'];
    $stop = $_POST['stop'];
    $id = $_POST['id'];
    if (!isset($start, $stop)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("UPDATE route SET start = ?, stop = ? WHERE id = ?");
        $ins->bind_param("ssi", $start, $stop, $id);
        $ins->execute();
        alert("Route Modified!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

if (isset($_POST['del_train'])) {
    $con = connect();
    try{
    $conn = $con->query("DELETE FROM route WHERE id = '" . $_POST['del_train'] . "'");
    }
    catch(mysqli_sql_exception $e){
        alert("Route Could Not Be Deleted. This Route Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    }

    if ($con->affected_rows < 1) {
        alert("Route Could Not Be Deleted. This Route Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("Route Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>