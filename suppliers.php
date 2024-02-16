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
      Suppliers
      <small>Manage Suppliers</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Suppliers</li>
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
              <table id="supplier_table" class="table table-custom spacing5 text-center">
                <!-- <thead>
                  <tr>
                    <th colspan="7" class="text-info">Company Details:</th>
                  </tr>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Website</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                </tbody> -->
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->

    <!-- Insert New Supplier Modal -->
    <div class="modal fade" id="insert_supplier_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Insert New Supplier:</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="add_supplier_form" autocomplete="off">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <h4 class="text-info text-bold">Company Details:</h4>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="name" placeholder=" ">
                      <label class="textboxlabel">Company Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="phone" placeholder=" ">
                      <label class="textboxlabel">Phone:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="email" id="Email" placeholder=" ">
                      <label class="textboxlabel">Email(Optional):</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="address" placeholder=" ">
                      <label class="textboxlabel">Address(Optional):</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="website" placeholder=" ">
                      <label class="textboxlabel">Website(Optional):</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <h4 class="text-info text-bold">Contact Person Details:</h4>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="cname" placeholder=" ">
                      <label class="textboxlabel">Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <select class="form-control textbox" name="designation" id="designation" required>
                        <option value="CEO">CEO</option>
                        <option value="Manager">Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Operator">Worker</option>
                      </select>
                      <label class="textboxlabel">Designation:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="cphone" placeholder=" ">
                      <label class="textboxlabel">Phone:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="cemail" placeholder=" ">
                      <label class="textboxlabel">Email(Optional):</label>
                    </div>
                  </div>

                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="add_supplier_btn" name="add_customer">Add
              Supplier</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <!-- View supplier modal -->
    <div class="modal fade" id="view_supplier_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Contact Person Info:</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="view_supplier_form" autocomplete="off">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="vname" id="vname" placeholder=" ">
                      <label class="textboxlabel">Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="vemail" id="vemail" placeholder=" ">
                      <label class="textboxlabel">Email:</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <select class="form-control textbox" name="vdesignation" id="vdesignation" required>
                        <option value="CEO">CEO</option>
                        <option value="Manager">Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Operator">Worker</option>
                      </select>
                      <label class="textboxlabel">Designation:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="vphone" id="vphone" placeholder=" ">
                      <label class="textboxlabel">Phone:</label>
                    </div>
                  </div>

                </div>
              </div><!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button style="width:100%;" type="button" class="btn btn-info" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <!-- Update Supplier Modal -->
    <div class="modal fade" id="update_supplier_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Contact Person Info:</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="update_supplier_form" autocomplete="off">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="uname" id="uname" placeholder=" ">
                      <label class="textboxlabel">Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="uemail" id="uemail">
                      <input type="hidden" class="form-control textbox" name="update" id="update">
                      <label class="textboxlabel">Email(Optional):</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <select class="form-control textbox" name="udesignation" id="udesignation" required>
                        <option value="CEO">CEO</option>
                        <option value="Manager">Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Operator">Worker</option>
                      </select>
                      <label class="textboxlabel">Designation:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="uphone" id="uphone" placeholder=" ">
                      <label class="textboxlabel">Phone:</label>
                    </div>
                  </div>

                </div>
              </div><!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="update_supplier_btn"
              name="add_customer">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          </form>
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



<!-- Data Table script -->


<!-- Jquery Insert Supplier Form Validation -->
<script>
  $(document).ready(function () {


    $("#add_supplier_form").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        phone: {
          required: true,
          digits: true,
          minlength: 11,
          maxlength: 11

        },
        email: {
          required: false,
          email: true
        },

        cname: {
          required: true,
          minlength: 3
        },
        cphone: {
          required: true,
          number: true,
          minlength: 11,
          maxlength: 11

        },
        cemail: {
          required: false,
          email: true
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


<!-- Jquery Update Supplier Form Validation -->
<script>
  $(document).ready(function () {


    $("#update_supplier_form").validate({
      rules: {
        uname: {
          required: true,
          minlength: 3
        },
        uphone: {
          required: true,
          number: true,
          minlength: 11,
          maxlength: 11
        },
        uemail: {
          required: false,
          email: true
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



<!-- Add/Update/Delete Supplier module -->
<script>
  $(document).ready(function () {

    ///Send supplier-data in database///
    $("#add_supplier_btn").click(function (e) {

      e.preventDefault();

      //call velidation//
      if ($("#add_supplier_form").valid()) {

      ///Add supplier-data ajax request///
      $.ajax({

        url: "includes/supplier_module.php",
        type: "POST",
        data: $("#add_supplier_form").serialize() + "&action=insert_supplier",
        success: function (one) {
          // console.log(one);

          if ($.trim(one) === "inserted") {
            toastr.success("Supplier has been added successfuly!", "Successful!");
            $("#add_supplier_form")[0].reset();
            $("#insert_supplier_modal").modal("hide");
            //call function here to refresh//
            load_supplier();
          }
          else if ($.trim(one) === "not_inserted") {
            Swal.fire({
              title: "Error",
              text: "Insert Supplier Error!",
              type: "error",
              customClass: "sweet-alert",
            });
          }
          else if ($.trim(one) === "Email_already_exist") {
            Swal.fire({
              title: "Error",
              text: "Email Already Exist!",
              type: "error",
              customClass: "sweet-alert",
            });
          }
          else if ($.trim(one) === "same_both_emails") {
            Swal.fire({
              title: "Error",
              text: "Enter Different Emails in both fields!",
              type: "error",
              customClass: "sweet-alert",
            });
          }
          else {
            Swal.fire({
              title: "Error",
              text: "Something went wrong!",
              type: "error",
              customClass: "sweet-alert",
            });
          }

        }



      });


      }



    });


    ///Load supplier-data from database///
    load_supplier();
    function load_supplier() {
      var loadsupplier = "";

      ///Load supplier ajax request///
      $.ajax({

        url: "includes/supplier_module.php",
        type: "POST",
        data: { load: loadsupplier },
        success: function (two) {
          // console.log(two);

          //Fetch data in table//
          $("#supplier_table").html(two);

          //Data table apply//
          $("#supplier_table").dataTable({
            "bDestroy": true,
            searching: true,
            dom: 'lfBrtip',
            dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f><'col-sm-12 col-md-5 text-right'B>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-7'i><'col-sm-12 col-md-5 text-right'p>>",
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            buttons: [
              {
                text: '<i class="ion ion-person-add"></i>&nbsp; Add Supplier',
                className: 'btn-success',
                action: function () {
                  $("#insert_supplier_modal").modal('show');

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




    ///Show view contact person info modal///
    $(document).on("click", "#view_btn", function (e) {
      e.preventDefault();

      $("#view_supplier_modal").modal("show");

      var view = $(this).data("vid");
      // $("#vname").val(view);

      ///view contact person info ajax request///
      $.ajax({
        url: "includes/supplier_module.php",
        type: "POST",
        data: { id: view },
        dataType: "JSON",
        success: function (view) {
          // console.log(view);

          $("#vname").val(view["v_name"]);
          $("#vdesignation").val(view["v_designation"]);
          $("#vphone").val(view["v_phone"]);
          $("#vemail").val(view["v_email"]);

        }

      });

    });




    ///Show update-customer modal///
    $(document).on("click", "#update_btn", function (e) {
      e.preventDefault();
      $("#update_supplier_modal").modal("show");

      var id = $(this).data("uid");
      // $("#update").val(id);

      ///Fetch customer-data for update ajax request///
      $.ajax({
        url: "includes/supplier_module.php",
        type: "POST",
        data: { cid: id },
        dataType: "JSON",
        success: function (three) {
          // console.log(three);

          $("#update").val(three["s_id"]);
          $("#uname").val(three["s_name"]);
          $("#udesignation").val(three["s_designation"]);
          $("#uphone").val(three["s_phone"]);
          $("#uemail").val(three["s_email"]);


        }
      });

    });




    ///Update supplier-ajax request///
    $("#update_supplier_btn").click(function (e) {
      e.preventDefault();

      //call velidation//
      if ($("#update_supplier_form").valid()) {

      $.ajax({
        url: "includes/supplier_module.php",
        type: "POST",
        data: $("#update_supplier_form").serialize() + "&action=update_supplier",
        success: function (four) {
          console.log(four);

          if ($.trim(four) === "updated") {
            toastr.info("Supplier has been updated successfully!", "Successful!");
            $("#update_supplier_form")[0].reset();
            $("#update_supplier_modal").modal("hide");
          }
          else if ($.trim(four) === "not_updated") {
            Swal.fire({
              title: "Error",
              text: "Update Supplier Error!",
              type: "error",
              customClass: "sweet-alert",
            });

          }
          else if ($.trim(four) === "email_exist") {
            Swal.fire({
              title: "Error",
              text: "Email Already exist!",
              type: "error",
              customClass: "sweet-alert",
            });
          }
          else {
            Swal.fire({
              title: "Error",
              text: "Something went wrong!",
              type: "error",
              customClass: "sweet-alert",
            });
          }


        }

      });


      }


    });



    ///Delete Supplier///
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

          var d_id = $(this).data("did");

          ///Delete customer data ajax request///
          $.ajax({

            url: "includes/supplier_module.php",
            type: "POST",
            data: { delete: d_id },
            success: function (five) {
              // console.log(five);
              if ($.trim(five) === "deleted") {
                toastr.warning("Supplier has been deleted successfully!", "Successful!");
                //refresh page//
                load_supplier();
              }
              else if ($.trim(five) === "not_deleted") {
                Swal.fire({
                  title: "Error",
                  text: "Delete supplier  Error!",
                  type: "error",
                  customClass: "sweet-alert",
                });
              }
              else {
                Swal.fire({
                  title: "Error",
                  text: "Something went wrong!",
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