<?php
session_start();
require_once '../conn.php';
require_once '../constants.php';
$class = "reg";
?>
<?php
$cur_page = 'signup';
include 'includes/inc-header.php';
include 'includes/inc-nav.php';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $file = 'file';
    $address = $_POST['address'];
    $cpassword = $_POST['cpassword'];
    $password = $_POST['password'];
    if (!isset($name, $address, $phone, $email, $password, $cpassword) || ($password != $cpassword)) { ?>
<script>
alert("Ensure you fill the form properly.");
</script>
<?php
    } else {
        //Check if email exists
        $check_email = $conn->prepare("SELECT * FROM passenger WHERE email = ? OR phone = ?");
        $check_email->bind_param("ss", $email, $phone);
        $check_email->execute();
        $res = $check_email->store_result();
        $res = $check_email->num_rows();
        if ($res) {
        ?>
<script>
alert("Passenger Details already exists!");
</script>
<?php

        } elseif ($cpassword != $password) { ?>
<script>
alert("Password does not match.");
</script>
<?php
        } else {
            //Insert
            $password = md5($password);
            $can = 1;
            $loc = uploadFile('file');
            if ($loc == -1) {
                echo "<script>alert('We could not complete your registration, try again later!')</script>";
                exit;
            }
            $stmt = $conn->prepare("INSERT INTO passenger (name, email, password, phone, address, loc) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $name, $email, $password, $phone, $address, $loc);
            if ($stmt->execute()) {
            ?>
<script>
alert("Congratulations.\nYou are now registered.");
window.location = 'signin.php';
</script>
<?php
            } else {
            ?>
<script>
alert("We could not register you!.");
</script>
<?php
            }
        }
    }
}
?>
<div class="signup-page">
    <div class="form">
        <h2>Create Account </h2>
        <br>
        <p class="alert alert-info">
            <marquee behavior="" scrollamount="2" direction="">You need to create an account to book and track bus! </marquee>
        </p>
        <form style="text-align:left;" class="login-form" method="post" role="form" enctype="multipart/form-data" id="signup-form"
            autocomplete="off">
            <!-- json response will be here -->
            <div id="errorDiv"></div>
            <!-- json response will be here -->
            <div class="col-md-12">
                <div class="form-group">
                    <label>Full Name <span class="text-danger">*</span></label>
                    <input type="text" required minlength="10" name="name">
                </div>
            </div>

              <div class="col-md-12">
                <div class="form-group">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="email" required name="email">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact Number <span class="text-danger">*</span></label>
                    <input type="text" minlength="11"  maxlength="11" pattern="[0-9]{11}" required name="phone">
                </div>
            </div>
          

            <div class="col-md-6">
                <div class="form-group">
                    <label> Profile Image <span class="text-danger">*</span></label>
                    <input type="file" name='file' required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Address <span class="text-danger">*</span></label>
                    <input type='text' name="address" class="form-group" required>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password">
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="cpassword" id="cpassword">
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" id="btn-signup">
                        CREATE ACCOUNT
                    </button>
                </div>
            </div>
            <p class="message">
                <a href="#">.</a><br>
            </p>
        </form>
    </div>
</div>
</div>
<script src="assets/js/jquery-1.12.4-jquery.min.js"></script>

</body>

</html>