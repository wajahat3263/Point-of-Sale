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
<!-- Dropify -->
<link rel="stylesheet" href="plugins/dropify/css/dropify.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Users
      <small>Manage Users</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">users</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 id="totaluser">0</h3>

            <p>Total Users</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3 id="Operators">0</h3>

            <p>Operators</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3 id="activeusers">0</h3>

            <p>Active Users</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3 id="inactiveusers">0</h3>

            <p>Inactive Users</p>
          </div>
          <div class="icon">
            <i class="fa fa-user-times"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <!----------------- Main Table Row ------------>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">All Users</h3> -->
            <!-- <button class="btn btn-success pull-right">Add User</button> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="usertable" class="table table-custom spacing5">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
    <!---------- Insert New User Modal ------------>
    <div class="modal fade" id="insertUser">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Insert New User</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="user_Form" autocomplete="off" enctype="multipart/form-data">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="name" placeholder=" ">
                      <label class="textboxlabel">Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="email" placeholder=" ">
                      <label class="textboxlabel">Email:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="password" class="form-control textbox" name="password" placeholder=" " id="pass">
                      <label class="textboxlabel">Password:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <select class="form-control textbox" name="role" id="role" required>
                        <option value="Admin">Admin</option>
                        <option value="CEO">CEO</option>
                        <option value="Manager">Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Operator">Operator</option>
                      </select>
                      <label class="textboxlabel">Role:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="file" name="user_photo" id="user_photo" data-allowed-file-extensions="jpeg png jpg" data-height="100">
                      <label class="textboxlabel">User Photo:</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="user_name" placeholder=" ">
                      <label class="textboxlabel">User Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <select class="form-control textbox" name="gender" id="status">
                        <option value="Male" selected>Male</option>
                        <option value="Female">Female</option>
                      </select>
                      <label class="textboxlabel">Gender:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="password" class="form-control textbox" name="cpassword" placeholder=" ">
                      <label class="textboxlabel">Confirm Password:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <select class="form-control textbox" name="status" id="status">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                      </select>
                      <label class="textboxlabel">Status:</label>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="adduser" name="adduser">Add User</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Update User Modal -->
    <div class="modal fade" id="updateUser">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update User</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="update_form" autocomplete="off">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="uname" placeholder=" " id="upname">
                      <input type="hidden" class="form-control textbox" name="uuid" placeholder=" " id="uid">
                      <label class="textboxlabel">Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <!-- <label class="control-label">Role:</label> -->
                      <select class="form-control textbox" name="urole" id="uprole" required>
                        <option value="Admin">Admin</option>
                        <option value="CEO">CEO</option>
                        <option value="Manager">Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Operator">Operator</option>

                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="uuser_name" placeholder=" " id="upusername">
                      <label class="textboxlabel">User Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <select class="form-control textbox" name="ustatus" id="upstatus">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="update_user_btn" name="update_user">Update
              User</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->





    <!-- View User Modal -->
    <div class="modal fade" id="viewUserModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-green">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">User Detail</h4>
          </div>
          <div class="modal-body">

            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username text-center" id="vname"></h3>
                <h5 class="widget-user-desc text-center" id="vemail"></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="" id="vphoto">
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Role</h5>
                      <span class="description-text" id="vrole"></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">User Id</h5>
                      <span class="description-text" id="vid"></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">Status</h5>
                      <span class="description-text" id="vstatus"></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <!-- Change Password Modal -->
    <div class="modal fade" id="changePass">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-green">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Change Password</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" method="post" id="change_pass_Form" autocomplete="off">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">New Password:</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="cpid" id="cpid">
                    <input type="password" class="form-control" name="npassword" placeholder="New Password"
                      id="npassword">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password:</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="cnpassword" placeholder="Confirm New Password"
                      id="cnpassword">
                  </div>
                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info pull-left" id="changpassbtn" name="changpassbtn">Change
              Pasword</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->




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



<!-- Dropify script -->
<script>
  $(document).ready(function () {

    $("#user_photo").dropify();

  });
</script>




<!-- Jquery insert user Form Validation -->
<script>
  $(document).ready(function () {


    $("#user_Form").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        user_name: {
          required: true,
          minlength: 5
        },
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 3
        },
        cpassword: {
          required: true,
          minlength: 3,
          equalTo: "#pass"
        },
        gender: {
          required: true,
          minlength: 1
        },
        role: {
          required: true,
          minlength: 1
        },


      },
      messages: {
        name: {
          required: "Please enter your name",
          minlength: "Your name must consist of at least 3 characters"
        },
        user_name: {
          required: "Please enter user name",
          minlength: "Your user name must consist of at least 5 characters"
        },
        password: {
          required: "Please provide a password",
          minlength: "Password must be 3 characters"
        },
        cpassword: {
          required: "Please provide a password",
          minlength: "Your password must be at least 3 characters long"
        },
        email: {
          required: "Please enter your email address",
          email: "Please enter a valid email address"
        },
        gender: "Please select gender",
        role: "Please select role",

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
<!-- Jquery update user Form Validation -->
<script>
  $(document).ready(function () {


    $("#update_form").validate({
      rules: {
        uname: {
          required: true,
          minlength: 3
        },
        uuser_name: {
          required: true,
          minlength: 5
        },
        urole: {
          required: true,
          minlength: 1
        },


      },
      messages: {
        uname: {
          required: "Please enter your name",
          minlength: "Your name must consist of at least 3 characters"
        },
        uuser_name: {
          required: "Please enter user name",
          minlength: "Your user name must consist of at least 5 characters"
        },
        urole: "Please select role",

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
<!-- Add/Update user modue -->
<script>
  $(document).ready(function () {


    /// Add User Ajax Request///
    $("#adduser").click(function (e) {
      e.preventDefault();

      if ($("#user_Form").valid()) {

        var form_data=new FormData($("#user_Form")[0]);
        form_data.append("action", "insert_user");

        $.ajax({
          url: 'includes/user_module.php',
          method: 'post',
          data: form_data,
          contentType: false,
          processData: false,
          success: function (response) {
            // console.log(response);


            if ($.trim(response) === 'inserted') {
              toastr.success("User has been created successfully!", "Successful!");
              $("#user_Form")[0].reset();
              $('#insertUser').modal('hide');
              // call function here to refresh page
              load_user();
            }
            else if ($.trim(response) === 'not_inserted') {
              Swal.fire({
                title: "Error!",
                text: "Insert User Error!",
                type: "error",
                customClass: "sweet-alert",
              });
            }
            else if ($.trim(response) === 'email_exist') {
              Swal.fire({
                title: "Email exist!",
                text: "This email already exist!",
                type: "error",
                customClass: "sweet-alert",
              });
            }
            else if ($.trim(response) === 'username_exist') {
              Swal.fire({
                title: "Username exist!",
                text: "This username already exist!",
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




    /// Load user from database///
    load_user();
    function load_user() {
      var loaduser = "";
      //load user ajax request//
      $.ajax({
        url: "includes/user_module.php",
        type: "POST",
        data: { loaduser: loaduser },
        success: function (data) {
          // console.log(data);
          /// Fetch data in table ///
          $("#usertable").html(data);

          ///data table apply ///
          $("#usertable").dataTable({
            "bDestroy": true,
            searching: true,
            dom: 'lfBrtip',
            dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f><'col-sm-12 col-md-5 text-right'B>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-7'i><'col-sm-12 col-md-5 text-right'p>>",
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            buttons: [
              {
                text: '<i class="ion ion-person-add"></i>&nbsp; Add User',
                className: 'btn-success',
                action: function () {
                  $("#insertUser").modal('show');

                }
              },
              {
                extend: 'excelHtml5',
                className: 'btn-default',
                filename: 'Data export',
                title: 'User Report',
                text: '<img class="format_3_excel_export_button" >Excel',
                exportOptions: {
                  columns: ':visible'
                }
              },
              // {
              //     extend: 'excelHtml5', className: 'btn-default', filename: 'Data export', 
              //     text    : '<img class="format_3_excel_export_button" src="assets/images/excellogo.png" title="Excel"> Excel',
              //     exportOptions: {
              //         columns: ':visible'
              //     }
              // },
              {
                extend: 'pdfHtml5',
                className: 'btn-default',
                filename: 'Data export',
                title: 'User Report',
                text: '<img class="format_3_excel_export_button">Pdf',
                exportOptions: {
                  columns: ':visible',
                  stripHtml: false,
                  columns: [0, 1, 2, 3, 4, 5],
                }
              },
              {
                extend: 'print',
                className: 'btn-default',
                title: '<h1>User Report</h1>',
                autoPrint: false,
                // customize: function ( win ) {
                // $(win.document.body)
                //     .css( 'font-size', '10pt' )
                //     .prepend(
                //         '<img src="logo" style="position:absolute; top:10px; left:10px; width: 50px;" />'
                //     );
                // },
                exportOptions: {
                  columns: ':visible',
                  stripHtml: false,
                  columns: [0, 1, 2, 3, 4, 5],
                  // columns: [ 0, 1, 2, 5 ],
                }
              },
              {
                extend: 'colvis',
                className: 'btn-default',
                text: 'Show/Hide',
                exportOptions: {
                  columns: ':visible',
                }
              },

            ],
            //Change Next Previus Button Text
            // "language": {
            //     "paginate": {
            //       "previous": "<",
            //       "next": ">"
            //     }
            //   },


          });

        }

      });



    }




    /// Show update user modal ///
    $(document).on("click", "#edit_btn", function (e) {
      e.preventDefault();
      $("#updateUser").modal("show");

      var uid = $(this).data("uid");
      // $("#upname").val(uid);
      // fetch user data for update request//
      $.ajax({
        url: "includes/user_module.php",
        type: "POST",
        data: { uid: uid },
        dataType: "JSON",
        success: function (data) {
          console.log(data);

          $("#uid").val(data["uid"]);
          $("#upname").val(data["name"]);
          $("#upusername").val(data["uname"]);
          $("#uprole").val(data["role"]);
          $("#upstatus").val(data["status"]);

        }
      });
    });



    /// Update User Ajax Request ///
    $("#update_user_btn").click(function (e) {
      e.preventDefault();

      if ($("#update_form").valid()) {

        $.ajax({
          url: 'includes/user_module.php',
          method: 'post',
          data: $("#update_form").serialize() + "&action=update_user",
          success: function (response) {
            console.log(response);


            if ($.trim(response) === 'updated') {
              toastr.info("User has been updated successfully!", "Successful!");
              $("#update_form")[0].reset();
              $('#updateUser').modal('hide');
              // call function here to refresh page
              load_user();
            }
            else if ($.trim(response) === 'not_updated') {
              Swal.fire({
                title: "Error!",
                text: "Update User Error!",
                type: "error",
                customClass: "sweet-alert",
              });
            }
            else if ($.trim(response) === 'username_exist') {
              Swal.fire({
                title: "Username exist!",
                text: "This username already exist!",
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




    /// Delete user module ///
    $(document).on("click", "#delete_btn", function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Delete',
        customClass: "sweet-alert"
      }).then((result) => {
        if (result.value) {
          var DeleteId = $(this).data("did");
          // Delete user data Ajax request// 
          $.ajax({
            url: "includes/user_module.php",
            type: "POST",
            data: { DeleteId: DeleteId },
            success: function (data) {
              if ($.trim(data) === 'deleted') {
                toastr.warning('User Has Been Deleted Seccussfully!', 'Successfull!');
                // call function here to refresh page
                load_user();
              } else if ($.trim(data) === 'not_deleted') {
                Swal.fire({
                  title: "Not Deleted!",
                  text: "User not Deleted Please Try Again!",
                  type: "error",
                  customClass: "sweet-alert",
                });
              } else {
                Swal.fire({
                  title: "Somthing Wrong!",
                  text: "Sonthing Went Wrong Please Try Again!",
                  type: "error",
                  customClass: "sweet-alert",
                });
              }
            }
          });
        }

      })


    });





  });
</script>




</body>

</html>