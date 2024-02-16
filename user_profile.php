<?php
include_once "includes/header.php";

?>

<style type="text/css">
    label.error {
        color: red !important;
        font-size: 14px !important;
        font-weight: 100;
    }

    .sweet-alert {
        /*width: 500px !important;*/
        font-size: 18px;
    }
</style>

<!-- Table Style -->
<link rel="stylesheet" href="assets/css/tablestyle.css">
<!-- Table Style -->
<link rel="stylesheet" href="plugins/dropify/css/dropify.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
            <small>Manage Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" id="user_img" src=""
                            alt="User profile picture" style="width:100px; height:100px;">

                        <h3 class="profile-username text-center" id="name"></h3>

                        <p class="text-muted text-center" id="user_role"></p>

                        <ul class="list-group list-group-unbordered" style="padding-left:10px; padding-right:10px;">
                            <li class="list-group-item">
                                <b>User Name:</b> <a class="pull-right" id="user_name"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender:</b> <a class="pull-right" id="user_gender"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone:</b> <a class="pull-right" id="user_phone"></a>
                            </li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile_tab" data-toggle="tab">User Profile</a></li>
                        <li><a href="#update_profile_tab" data-toggle="tab">Update Profile</a></li>
                        <li><a href="#update_password_tab" data-toggle="tab">Update Password</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="profile_tab">
                            <div style="width:55%;">
                                <ul class="list-group list-group-bordered">
                                    <li class="list-group-item">
                                        <b>Name:</b> <a class="pull-right" id="t_name"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>User Name:</b> <a class="pull-right" id="t_username"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender:</b> <a class="pull-right" id="t_gender"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Role:</b> <a class="pull-right" id="t_role"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone:</b> <a class="pull-right" id="t_phone"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Status:</b> <a class="pull-right" id="t_status"></a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="update_profile_tab">
                            <form class="form-horizontal" id="update_profile_form">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Full Name:</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input_Name" name="input_Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputUsername" class="col-sm-2 control-label">User Name:</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input_Username"
                                            name="input_Username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email:</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="input_Email" name="input_Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRole" class="col-sm-2 control-label">Role:</label>

                                    <div class="col-sm-10">
                                        <select class="form-control" name="input_Role" id="input_Role" required>
                                            <option value="Admin">Admin</option>
                                            <option value="CEO">CEO</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Operator">Operator</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-sm-2 control-label">Phone:</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input_Phone" name="input_Phone">

                                        <input type="hidden" class="form-control" id="profile_id" name="profile_id">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms and
                                                    conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger" id="update_profile_btn">Update
                                            Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="update_password_tab">
                            <form class="form-horizontal" id="update_password_form">
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-2 control-label">Old Password:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="input_old_pass"
                                            name="input_old_pass" placeholder="Old Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-2 control-label">New Password:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="input_new_pass"
                                            name="input_new_pass" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-2 control-label">Confirm New
                                        Password:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="input_confirm_pass"
                                            name="input_confirm_pass" placeholder="Confirm New Password">
                                        <input type="hidden" class="form-control" id="get_id" name="get_id"
                                            placeholder="id">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger" id="update_password_btn">Update
                                            Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include_once "includes/sidebar.php";
include_once "includes/footer.php";

?>

<!-- DataTables -->
<script src="plugins/datatables.net/js/jquery.dataTables.js"></script>
<script src="plugins/datatables.net/custom/custom-datatable.js"></script>
<script src="plugins/datatables.net/custom/datatable-basic.init.js"></script>


<script src="plugins/datatables.net/buttons/dataTables.buttons.min.js"></script>
<script src="plugins/datatables.net/buttons/buttons.bootstrap4.min.js"></script>
<script src="plugins/datatables.net/buttons/buttons.colVis.min.js"></script>
<script src="plugins/datatables.net/buttons/buttons.html5.min.js"></script>
<script src="plugins/datatables.net/buttons/buttons.print.min.js"></script>
<script src="plugins/datatables.net/buttons/pdfmake.min.js"></script>
<script src="plugins/datatables.net/buttons/buttons.flash.min.js"></script>
<script src="plugins/datatables.net/buttons/jszip.min.js"></script>
<script src="plugins/datatables.net/buttons/vfs_fonts.js"></script>

<!-- Dropify -->
<script src="plugins/dropify/js/dropify.js"></script>

<!-- Jquery Validation -->
<script src="plugins/jquery-validation/jquery.validate.js"></script>






<!-- Jquery update user profile Validation -->
<script>
    $(document).ready(function () {


        $("#update_profile_form").validate({
            rules: {
                input_Name: {
                    required: true,
                    minlength: 3
                },
                input_Username: {
                    required: true,
                    minlength: 5
                },
                input_Email: {
                    required: true,
                    email: true
                },
                input_Phone: {
                    required: true,
                    digits: true,
                    minlength: 11,
                    maxlength: 11
                },

            },

            messages: {


            },

            //Called when the element is invalid:
            highlight: function (element) {
                // $(element).css('background', '#ffdddd');
                $(element).css('border', '1px solid red');
                $(element).css('background-image', 'url(plugins/jquery-validation/delete.png)');
                $(element).css('background-repeat', 'no-repeat');
                $(element).css('background-position', '95%');
            },

            // Called when the element is valid:
            unhighlight: function (element) {
                // $(element).css('background', '#ffffff');
                $(element).css('border', '1px solid green');
                $(element).css('background-image', 'url(plugins/jquery-validation/apply.png)');
                $(element).css('background-repeat', 'no-repeat');
                $(element).css('background-position', '95%');
            }



        });




    });
</script>

<!-- Add/Update user-profile-module -->
<script>
    $(document).ready(function () {
        ///===Load user-profile data from database===///
        load_user_profile();
        function load_user_profile() {
            var profile_id = "<?php echo $_SESSION["id"]; ?>";
            $.ajax({
                url: "includes/user_module.php",
                type: "POST",
                data: { user_id: profile_id },
                dataType: "JSON",
                success: function (data) {
                    // console.log(data);

                    $("#name").text(data["full_name"]);
                    $("#user_role").text(data["role"]);
                    $("#user_name").text(data["user_name"]);
                    $("#user_gender").text(data["gender"]);
                    $("#user_phone").text(data["phone"]);

                    if (data["photo"] != null) {
                        var user_image = "uploads/user_images/" + data["photo"];
                    } else {
                        var user_image = "uploads/default.png";
                    }

                    $("#user_img").attr("src", user_image);

                    ///=====Show data in profile-tab=====///
                    $("#t_name").text(data["full_name"]);
                    $("#t_username").text(data["user_name"]);
                    $("#t_gender").text(data["gender"]);
                    $("#t_role").text(data["role"]);
                    $("#t_phone").text(data["phone"]);
                    $("#t_status").text(data["status"]);

                    ///===Show data in update-profile-tab===///
                    $("#input_Name").val(data["full_name"]);
                    $("#input_Username").val(data["user_name"]);
                    $("#input_Email").val(data["email"]);
                    $("#input_Role").val(data["role"]);
                    $("#input_Phone").val(data["phone"]);
                    $("#profile_id").val(data["id"]);

                    ///===Show data in update-password-tab===///
                    $("#get_id").val(data["id"]);



                }
            });

        }



        ///========Update user-profile-data Ajax Request========///
        $("#update_profile_btn").click(function (e) {
            e.preventDefault();

            if ($("#update_profile_form").valid()) {

                $.ajax({
                    url: "includes/user_module.php",
                    type: "POST",
                    data: $("#update_profile_form").serialize() + "&action=update_profile",
                    success: function (update) {
                        // console.log(update);

                        if ($.trim(update) === 'profile_updated') {
                            toastr.info("User profile has been updated successfully!", "Successful!");
                            // call function here to refresh page
                            load_user_profile();
                        }
                        else if ($.trim(update) === 'profile_not_updated') {
                            Swal.fire({
                                title: "Error!",
                                text: "Update User Profile Error!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                        else if ($.trim(update) === 'profile_username_already_exist') {
                            Swal.fire({
                                title: "Username exist!",
                                text: "This username already exist!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                        else if ($.trim(update) === 'profile_email_already_exist') {
                            Swal.fire({
                                title: "Email exist!",
                                text: "This email already exist!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                        else {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                    }
                });

            }

        });



        ///========Update user-password Ajax Request========///
        $("#update_password_btn").click(function (e) {
            e.preventDefault();

                $.ajax({
                    url: "includes/user_module.php",
                    type: "POST",
                    data: $("#update_password_form").serialize() + "&action=update_password",
                    success: function (up_pass) {
                        console.log(up_pass);

                        if ($.trim(up_pass) === 'password_updated_successfully') {
                            toastr.info("User password has been updated successfully!", "Successful!");
                            // call function here to refresh page
                            // load_user_profile();
                        }
                        else if ($.trim(up_pass) === 'password_not_updated_successfully') {
                            Swal.fire({
                                title: "Error!",
                                text: "Update User Password Error!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                        else if ($.trim(up_pass) === 'wrong_old_pass') {
                            Swal.fire({
                                title: "Error!",
                                text: "Wrong Old Password!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                        else if ($.trim(up_pass) === 'pass_not_match') {
                            Swal.fire({
                                title: "Error!",
                                text: "New and confirm pass does not match!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                        else if ($.trim(up_pass) === 'less_password') {
                            Swal.fire({
                                title: "Error!",
                                text: "Password Must be at least Three Characters Long!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                        else {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                    }
                });

            

        });




    });
</script>




</body>

</html>