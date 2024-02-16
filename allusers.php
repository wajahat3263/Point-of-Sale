<?php
include_once "includes/header.php";

?>

<style type="text/css">
    label.error {
        color: red!important;
        font-size: 14px !important;
        font-weight: 100;
    }
    .sweet-alert
      {
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

      <!-- Main Table Row -->
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
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Address</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Asif Naeem</td>
                    <td>Asif Naeem</td>
                    <td>Asif Naeem</td>
                    <td>Asif Naeem</td>
                  </tr>
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

      <!-- Insert New User Modal -->
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
                <form class="form-horizontal" method="post" id="user_Form" autocomplete="off">
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                      <div class="col-sm-12">
                        <input type="text" class="form-control textbox" name="name" placeholder=" ">
                        <label class="control-label textboxlabel">Name:</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="password" class="form-control textbox" name="password" placeholder=" " id="password">
                        <label class="control-label textboxlabel">Password:</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <!-- <label class="control-label">Role:</label> -->
                        <select class="form-control textbox" name="role" id="role" required>
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
                        <input type="email" class="form-control textbox" name="email" placeholder=" " id="email">
                        <label class="control-label textboxlabel">Email:</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="password" class="form-control textbox" name="cpassword" placeholder=" ">
                        <label class="control-label textboxlabel">Confirm Password:</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <select class="form-control textbox" name="status" id="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                      </select>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="file" class="dropify" data-allowed-file-extensions="jpg png" data-height="150" name="photo">
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
              <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update User</h4>
              </div>
              <div class="modal-body">
                <!-- form start -->
                <form class="form-horizontal" method="post" id="update_user_Form" autocomplete="off">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Name:</label>
                      <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="uid" id="uid">
                        <input type="text" class="form-control" name="uname" placeholder="User Name" id="uname">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Email:</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="uemail" placeholder="User Email" id="uemail">
                        <div id="check_email"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Role:</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="urole" id="urole">
                          <option value="Admin">Admin</option>
                          <option value="CEO">CEO</option>
                          <option value="Manager">Manager</option>
                          <option value="Supervisor">Supervisor</option>
                          <option value="Operator">Operator</option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Status:</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="ustatus" id="ustatus">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                      </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Photo:</label>
                      <div class="col-sm-5">
                        <img src="" width="210" height="160" style="border: 0.2px solid #f5f5f5;" id="oldphoto">
                      </div>
                      <div class="col-sm-5">
                        <input type="file" class="dropify" data-allowed-file-extensions="jpg png" data-height="150" name="uphoto" id="uphoto">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info pull-left" id="uuser" name="uuser">Update User</button>
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
                        <input type="password" class="form-control" name="npassword" placeholder="New Password" id="npassword">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password:</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" name="cnpassword" placeholder="Confirm New Password" id="cnpassword">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info pull-left" id="changpassbtn" name="changpassbtn">Change Pasword</button>
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



<!-- page script -->
<script>
  $(document).ready(function(){

    loadUsers();
    TotalUsers();
    ActiveUsers();
    InActiveUsers();
    tOperators();

    //Image Box To show Image Instanly with Dropify
        $('.dropify').dropify({
                // default file for the file input
                //defaultFile:'assets/images/oriento_Logo.png',
                // custom messages
                messages: {
                    'default':'<div class="text-center">Drag Image here or click</div>',
                    'replace':'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error':  'Sorry, this file is too large'
                },
        });




  //Jquery Form Validation
        $("#user_Form").validate({
            rules: {
                // username: "required",
                // lastname: "required",
                name: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    // minlength: 5
                },
                cpassword: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                
                role: {
                  required: true,
                  minlength: 1

                },
                
                
            },
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                name: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Password must be 5 characters"
                },
                cpassword: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                email: "Please enter a valid email address",
            },

            //Called when the element is invalid:
            highlight: function(element) {
                // $(element).css('background', '#ffdddd');
                $(element).css('border', '1px solid red');
                $(element).css('background-image', 'url(plugins/jquery-validation/delete.png)');
                $(element).css('background-repeat', 'no-repeat');
                $(element).css('background-position', '230px');
            },

            // Called when the element is valid:
            unhighlight: function(element) {
                // $(element).css('background', '#ffffff');
                $(element).css('border', '1px solid green');
                $(element).css('background-image', 'url(plugins/jquery-validation/apply.png)');
                $(element).css('background-repeat', 'no-repeat');
                $(element).css('background-position', '230px');
            }


            });



  //Add User Ajax Request
        $("#adduser").click(function(e){
          e.preventDefault();
            if($("#user_Form").valid()){
                
                

                    //Get Data From Modal Form On Click Save Button
                    var form = $('#user_Form')[0];
                    var formData = new FormData(form);

                    $.ajax({
                        url: 'functions/user_module.php',
                        method: 'post',
                        data : formData,
                        contentType : false,
                        processData : false,
                        success:function(response){
                          console.log(response);
                            if($.trim(response) === 'inserted'){
                              Swal.fire({
                                        title: "Successfull",
                                        text: "New User Created Successfully!", 
                                        type: "success",
                                        customClass: "sweet-alert",
                                    });
                                $(".dropify-clear").trigger("click");
                                $("#user_Form")[0].reset();
                                $('#insertUser').modal('hide');
                                loadUsers();
                                TotalUsers();
                                ActiveUsers();
                                InActiveUsers();
                            }else if($.trim(response) === 'not_inserted'){
                              Swal.fire({
                                        title: "Error!",
                                        text: "Insert User Error!", 
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                            }else if($.trim(response) === 'emailExist'){
                              Swal.fire({
                                        title: "Email Exist!",
                                        text: "This Email Already Exist!", 
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                            }else if($.trim(response) === 'File_Upload_Error'){
                              Swal.fire({
                                        title: "Wrong Image!",
                                        text: "Please Upload Jpg, Png, Gif only!",
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                            }else{
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


  //Show Modal Box For Update
        $(document).on("click", '#edit-btn', function(event){
            event.preventDefault();
          $("#updateUser").modal('show');


          var updateId = $(this).data("uid");

          $.ajax({
            url: "functions/user_module.php",
            type: 'post',
            data: { updateId: updateId },
            dataType: 'json',
            success: function(data)
            {
                console.log(data);
                $('#uid').val(data["user_id"]);
                $('#uname').val(data["user_name"]);
                $('#uemail').val(data["user_email"]);
                $('#ustatus').val(data["user_status"]);
                $('#urole').val(data["user_role"]);

                // var role = data["user_role"];
                // $("#urole, select option").each(function(){
                //   if ($(this).text() == role)
                //     $(this).attr("selected","selected");
                // });

                if (data["user_photo"] != "") {
                    var photo = "uploads/user_images/" + data["user_photo"];
                    $("#oldphoto").attr("src", photo);
                }else{
                    var photo = "uploads/user_images/default.png";
                    $("#oldphoto").attr("src", photo);
                }
                
                
            
            }
          });
        });


  //Save Update Modal Ajax Request
        $("#update_user_Form").on("submit",function(e)
        {
            //Stop Type Submit Functionalty
            e.preventDefault();

            //Get Data From Modal Form On Click Save Button
            var form = $('#update_user_Form')[0];
            var formData = new FormData(form);

            //Send Data to Php file with Ajax For Saving
            $.ajax({
                url : "functions/user_module.php",
                type : "POST",
                data : formData,
                contentType : false,
                processData : false,
                 success: function(data) {
                    if($.trim(data) === 'updated')
                    {
                        console.log(data);
                        var drEvent = $('#uphoto').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        // $('#Update_Form').trigger("reset");
                        $("#updateUser").modal('hide');
                        toastr.success('New User Created Seccussfully!', 'Successfull!');
                        loadUsers();
                        TotalUsers();
                        ActiveUsers();
                        InActiveUsers();
                    }else if($.trim(data) === 'not_updated'){
                        console.log(data);
                        Swal.fire({
                                        title: "Not Updated!",
                                        text: "User not Update Please Try Again!",
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                    }else
                    {
                        Swal.fire({
                                        title: "Somthing Wrong!",
                                        text: "Somthing Went Wrong Try Again!",
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                    }
                 }
            })
        });


  //View User In Modal
        $(document).on("click", '#view-btn', function(event){
            event.preventDefault();
          $("#viewUserModal").modal('show');


          var updateId = $(this).data("vid");

          $.ajax({
            url: "functions/user_module.php",
            type: 'post',
            data: { updateId: updateId },
            dataType: 'json',
            success: function(data)
            {
                console.log(data);
                $('#vid').text(data["user_id"]);
                $('#vname').text(data["user_name"]);
                $('#vemail').text(data["user_email"]);
                
                $('#vrole').text(data["user_role"]);

                if (data["user_status"] == 1) {
                  $('#vstatus').text("Active");
                }else{
                  $('#vstatus').text("In Active");
                }

                if (data["user_photo"] != "") {
                    var photo = "uploads/user_images/" + data["user_photo"];
                    $("#vphoto").attr("src", photo);
                }else{
                    var photo = "uploads/user_images/default.png";
                    $("#vphoto").attr("src", photo);
                }
                
                
            
            }
          });
        });


  //Show Change Pass Modal And Get User ID
        $(document).on("click", '#change-pass-btn', function(){
            $('#changePass').modal('show');

            var cpId = $(this).data("cpid");
            $('#cpid').val(cpId);

        });


  //Change User Password Request
        $("#changpassbtn").click(function(e){
                if($("#change_pass_Form")[0].checkValidity()){
                    e.preventDefault();
                    if($("#npassword").val() != $("#cnpassword").val()){

                      Swal.fire({
                                  title: "Password Error!",
                                  text: "Password & Confirm Password Not Matched!",
                                  type: "error",
                                  customClass: "sweet-alert",
                                });
                        
                    }else{

                        
                        $.ajax({
                            url: 'functions/user_module.php',
                            method: 'post',
                            data: $("#change_pass_Form").serialize()+'&action=cpass',
                            success:function(response){
                              console.log(response);
                                if($.trim(response) === 'passchanged'){
                                    toastr.success('Your Password has been Changed Seccussfully!', 'Successfull!');
                                    $("#change_pass_Form")[0].reset();
                                    $('#changePass').modal('toggle');
                                }else if($.trim(response) === 'notchanged'){
                                    Swal.fire({
                                              title: "Password Error!",
                                              text: "Password Not Changed Please Try Again!",
                                              type: "error",
                                              customClass: "sweet-alert",
                                            });
                                }else{
                                    Swal.fire({
                                              title: "Something Wrong!",
                                              text: "Something Went Wrong Try Again!",
                                              type: "error",
                                              customClass: "sweet-alert",
                                            });
                                }
                            }
                        });
                    }
                }

        });



    //load Users From Database
        function loadUsers()
        {
            var loaduser = "";
            $.ajax({
                url : "functions/user_module.php",
                type : "POST",
                data: { loaduser: loaduser },
                success : function(data)
                {
                    // console.log(data);
                    //Returning Data From action.php Showing in Table via ID
                    $("#usertable").html(data);
                    $("#usertable").dataTable({
                      "bDestroy": true,
                      searching: true,
                dom: 'lfBrtip',
                dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f><'col-sm-12 col-md-5 text-right'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-7'i><'col-sm-12 col-md-5 text-right'p>>",
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                buttons: [
                // {
                //     extend: 'csvHtml5',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
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
                    title: '<?php echo $company["com_name"]?>',
                    text    : '<img class="format_3_excel_export_button" >Excel',
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
                    title: '<?php echo $company["com_name"]?>',
                    text    : '<img class="format_3_excel_export_button">Pdf',
                    exportOptions: {
                        columns: ':visible',
                        stripHtml : false,
                        columns: [0, 1, 2, 3, 4, 5],
                    }
                },
                {
                    extend: 'print', 
                    className: 'btn-default', 
                    title: '<h1><?php echo $company["com_name"]?></h1>',
                    autoPrint: false,
                    // customize: function ( win ) {
                    // $(win.document.body)
                    //     .css( 'font-size', '10pt' )
                    //     .prepend(
                    //         '<img src="<?php echo $url.$company["com_logo"];?>" style="position:absolute; top:10px; left:10px; width: 50px;" />'
                    //     );
                    // },
                    exportOptions: {
                        columns: ':visible',
                        stripHtml : false,
                        columns: [0, 1, 2, 3, 4, 5],
                        // columns: [ 0, 1, 2, 5 ],
                    }
                },
                {
                    extend: 'colvis',
                    className: 'btn-default',
                    text    : 'Show/Hide',
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


    //Delete Records
        $(document).on("click",".delete-btn", function(){
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
                    var DeleteUserId = $(this).data("did");
                    var element = this;
                    $.ajax({
                        url: "functions/user_module.php",
                        type : "POST",
                        data : {DeleteUid : DeleteUserId},
                     success : function(data){
                        if($.trim(data) === 'deleted')
                        {
                            $(element).closest("tr").fadeOut();
                            toastr.success('User Has Been Deleted Seccussfully!', 'Successfull!');
                            loadUsers();
                            TotalUsers();
                        }else if($.trim(data) === 'not_deleted')
                        {
                            Swal.fire({
                                        title: "Not Deleted!",
                                        text: "User not Deleted Please Try Again!",
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                        }else
                        {
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



    //Total Users From Database
        function TotalUsers()
        {
            var totaluser = "";
            $.ajax({
                url : "functions/user_module.php",
                type : "POST",
                data: { totaluser: totaluser },
                success : function(data)
                {
                  $("#totaluser").text(data);
                    
                }
            });
        }

    //Active Users From Database
        function tOperators()
        {
            var tOperators = "";
            $.ajax({
                url : "functions/user_module.php",
                type : "POST",
                data: { tOperators: tOperators },
                success : function(data)
                {
                  $("#Operators").text(data);
                    
                }
            });
        }


    //Active Users From Database
        function ActiveUsers()
        {
            var activeusers = "";
            $.ajax({
                url : "functions/user_module.php",
                type : "POST",
                data: { activeusers: activeusers },
                success : function(data)
                {
                  $("#activeusers").text(data);
                    
                }
            });
        }



    //In Active Users From Database
        function InActiveUsers()
        {
            var inactiveusers = "";
            $.ajax({
                url : "functions/user_module.php",
                type : "POST",
                data: { inactiveusers: inactiveusers },
                success : function(data)
                {
                  if ($.trim(data) > 0) {
                    $("#inactiveusers").text(data);
                  }else{
                    $("#inactiveusers").text("0");
                  }
                  
                    
                }
            });
        }




  });
</script>
</body>
</html>