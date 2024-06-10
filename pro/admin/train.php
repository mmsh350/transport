<?php
if (!isset($file_access)) die("Direct File Access Denied");
$source = 'train';
$me = "?page=$source";
?>

<div class="content">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-header bg-dark">
                            <h3 class="card-title">
                                All Vehicles</h3>
                            <div class='float-right'>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    Add New Vehicle &#x1F68C;
                                </button></div>
                        </div>

                        <div class="card-body">

                            <table id="example1" style="align-items: stretch;"
                                class="table table-hover w-100 table-bordered table-striped<?php //
                                                                                                                                            ?>">
                                <thead>
                                    <tr>
                                        <th width="2%">#</th>
                                        <th>Vehicle Name</th>
                                        <th width="15%">Capacity</th>
                                        <th style="width: 25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row = $conn->query("SELECT * FROM train");
                                    if ($row->num_rows < 1) echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['id'];
                                    ?>

                                    <tr>
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo $fullname = $fetch['name']; ?></td>
                                        <td><center><?php echo $fetch['first_seat']; ?></center></td>
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
                                                    <h4 class="modal-title">Editing <?php echo $fullname; ?>&#x1F68C;</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $id ?>" required id="">
                                                        <p>Vehicle Name : <input type="text" class="form-control"
                                                                name="name" value="<?php echo $fetch['name'] ?>"
                                                                required minlength="3" id=""></p>
                                                        <p>Capacity : <input type="number" min='0'
                                                                class="form-control"
                                                                value="<?php echo $fetch['first_seat'] ?>"
                                                                name="first_seat" required id="">
                                                        </p>
                                                        <p hidden> Class Capacity : <input type="number" min='0'
                                                                class="form-control"
                                                                value="<?php echo $fetch['second_seat'] ?>"
                                                                name="second_seat" required id="">
                                                        </p>
                                                        <p>

                                                            <input class="btn" style='background-color:#f8198d; color:white;'type="submit" value="Edit Vehicle"
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
                <h4 class="modal-title">Add New Vehicle &#x1F68C;
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <form action="" method="post">

                    <table class="table table-bordered">
                        <tr>
                            <th>Vehicle Name</th>
                            <td><input type="text" class="form-control" name="name" required minlength="3" id=""></td>
                        </tr>
                        <tr>
                            <th>Capacity</th>
                            <td><input type="number" min='0' class="form-control" name="first_seat" required id=""></td>
                        </tr>
                        <tr hidden>
                            <th>Second Class Capacity</th>
                            <td><input type="number" min='0' value="0" class="form-control" name="second_seat" required id="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">

                                <input class="btn" type="submit" style='background-color:#f8198d; color:white;' value="Add Vechile" name='submit'>
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
    $name = $_POST['name'];
    $first_seat = $_POST['first_seat'];
    $second_seat = $_POST['second_seat'];
    if (!isset($name, $first_seat, $second_seat)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        //Check if train exists
        $check = $conn->query("SELECT * FROM train WHERE name = '$name' ")->num_rows;
        if ($check) {
            alert("Vehicle exists");
        } else {
            $ins = $conn->prepare("INSERT INTO train (name, first_seat, second_seat) VALUES (?,?,?)");
            $ins->bind_param("sss", $name, $first_seat, $second_seat);
            $ins->execute();
            alert("Vehicle Added!");
            load($_SERVER['PHP_SELF'] . "$me");
        }
    }
}

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $first_seat = $_POST['first_seat'];
    $second_seat = $_POST['second_seat'];
    $id = $_POST['id'];
    if (!isset($name, $first_seat, $second_seat)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        //Check if train exists
        $check = $conn->query("SELECT * FROM train WHERE name = '$name' ")->num_rows;
        if ($check == 2) {
            alert("Vehicle name exists");
        } else {
            $ins = $conn->prepare("UPDATE train SET name = ?, first_seat = ?, second_seat = ? WHERE id = ?");
            $ins->bind_param("sssi", $name, $first_seat, $second_seat, $id);
            $ins->execute();
            alert("Vehicle Modified!");
            load($_SERVER['PHP_SELF'] . "$me");
        }
    }
}

if (isset($_POST['del_train'])) {
    $con = connect();
    try{
    $conn = $con->query("DELETE FROM train WHERE id = '" . $_POST['del_train'] . "'");
    }
     catch(mysqli_sql_exception $e){
         alert("Vehicle Could Not Be Deleted. This Vehicle Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    }

    if ($con->affected_rows < 1) {
        alert("Vehicle Could Not Be Deleted. This Train Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("Vehicle Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>