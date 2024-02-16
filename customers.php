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
      Customers
      <small>Manage Customers</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Customers</li>
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
              <table id="customer_table" class="table table-custom spacing5 text-center">
                <!-- <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
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

    <!-- Insert New Customer Modal -->
    <div class="modal fade" id="insert_customer_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Insert New Customer:</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="add_customer_form" autocomplete="off">
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
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="phone" placeholder=" ">
                      <label class="textboxlabel">Phone:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <textarea name="address" placeholder="Enter your address" class="form-control textbox" rows="1"></textarea>
                      <!-- <input type="text" class="form-control textbox" name="address" placeholder=" "> -->
                      <label class="textboxlabel">Address:</label>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="add_customer_btn" name="add_customer">Add
              Customer</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Update Customer Modal -->
    <div class="modal fade" id="update_customer_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Customer:</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="update_customer_form" autocomplete="off">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="u_name" id="u_name" placeholder=" ">
                      <label class="textboxlabel">Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="u_email" id="u_email" placeholder=" ">
                      <input type="hidden" class="form-control textbox" name="update" id="update">
                      <label class="textboxlabel">Email:</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="u_phone" id="u_phone" placeholder=" ">
                      <label class="textboxlabel">Phone:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="u_address" id="u_address" placeholder=" ">
                      <label class="textboxlabel">Address:</label>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="update_customer_btn" name="update_customer">Update
              Customer</button>
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



<!-- Data Table script -->
<script>
  $(document).ready(function () {


    ///data table apply ///


  });
</script>

<!-- Jquery Insert customer Form Validation -->
<script>
  $(document).ready(function () {


    $("#add_customer_form").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true,
          number: true,
          minlength: 11,
          maxlength: 11

        },
        address: {
          required: true,
          minlength: 5
        },


      },
      messages: {
        name: {
          required: "Please enter your name",
          minlength: "Your name must consist of at least 3 characters"
        },
        email: {
          required: "Please enter your email address",
        },
        phone: {
          required: "Please enter phone number",
          minlength: "Your phone must consist of at least 11 characters"
        },
        address: {
          required: "Please enter your address",
          minlength: "Your address must consist of at least 5 characters"
        },

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

<!-- Jquery Update Customer Form Validation -->
<script>
  $(document).ready(function () {


    $("#update_customer_form").validate({
      rules: {
        u_name: {
          required: true,
          minlength: 3
        },
        u_email: {
          required: true,
          email: true
        },
        u_phone: {
          required: true,
          number: true,
          minlength: 11,
          maxlength: 11

        },
        u_address: {
          required: true,
          minlength: 5
        },


      },
      messages: {
        u_name: {
          required: "Please enter your name",
          minlength: "Your name must consist of at least 3 characters"
        },
        u_email: {
          required: "Please enter your email address",
        },
        u_phone: {
          required: "Please enter phone number",
          minlength: "Your phone must consist of at least 11 characters",
          maxlength: "Maximum 11 numbers:"
        },
        u_address: {
          required: "Please enter your address",
          minlength: "Your address must consist of at least 5 characters"
        },

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


<!-- Add/Update Customer modue -->
<script>
  $(document).ready(function () {

    ///Send customer-data in database///
    $("#add_customer_btn").click(function (e) {

      e.preventDefault();

      //call velidation//
      if ($("#add_customer_form").valid()) {

        ///Add customer-data ajax request///
        $.ajax({

          url: "includes/customer_module.php",
          type: "POST",
          data: $("#add_customer_form").serialize() + "&action=insert_customer",
          success: function (one) {
            // console.log(one);

            if ($.trim(one) === "inserted") {
              toastr.success("Customer has been added successfuly!", "Successful!");
              $("#add_customer_form")[0].reset();
              $("#insert_customer_modal").modal("hide");
              //call function here to refresh//
              load_customer();
            }
            else if ($.trim(one) === "not_inserted") {
              Swal.fire({
                title: "Error",
                text: "Insert Customer Error!",
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


    ///Load costomer-data from database///
    load_customer();
    function load_customer() {
      var loadcustomer = "";

      ///Load customer ajax request///
      $.ajax({

        url: "includes/customer_module.php",
        type: "POST",
        data: { load: loadcustomer },
        success: function (two) {
          // console.log(two);

          //Fetch data in table//
          $("#customer_table").html(two);

          //Data table apply//
          $("#customer_table").dataTable({
            "bDestroy": true,
            searching: true,
            dom: 'lfBrtip',
            dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f><'col-sm-12 col-md-5 text-right'B>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-7'i><'col-sm-12 col-md-5 text-right'p>>",
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            buttons: [
              {
                text: '<i class="ion ion-person-add"></i>&nbsp; Add Customer',
                className: 'btn-success',
                action: function () {
                  $("#insert_customer_modal").modal('show');

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


    ///Show update-customer modal///
    $(document).on("click", "#update_btn", function (e) {
      e.preventDefault();
      $("#update_customer_modal").modal("show");

      var id = $(this).data("uid");
      // $("#update").val(id);

      ///Fetch customer-data for update ajax request///
      $.ajax({
        url: "includes/customer_module.php",
        type: "POST",
        data: { cid: id },
        dataType: "JSON",
        success: function (three) {
          // console.log(three);

          $("#update").val(three["c_id"]);
          $("#u_name").val(three["c_name"]);
          $("#u_phone").val(three["c_phone"]);
          $("#u_email").val(three["c_email"]);
          $("#u_address").val(three["c_address"]);

        }
      });

    });



    ///Update customer ajax request///
    $("#update_customer_btn").click(function (e) {
      e.preventDefault();

      //call velidation//
      if ($("#update_customer_form").valid()) {

        $.ajax({
          url: "includes/customer_module.php",
          type: "POST",
          data: $("#update_customer_form").serialize() + "&action=update_customer",
          success: function (four) {
            // console.log(four);

            if ($.trim(four) === "updated") {
              toastr.info("Customer has been updated successfully!", "Successful!");
              $("#update_customer_form")[0].reset();
              $("#update_customer_modal").modal("hide");
              //refresh page//
              load_customer();

            } 
            else if ($.trim(four) === "not_updated") {
              Swal.fire({
                title: "Error",
                text: "Update Customer Error!",
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


    ///Delete customer///
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

            url: "includes/customer_module.php",
            type: "POST",
            data: { delete: d_id },
            success: function (five) {
              // console.log(five);
              if ($.trim(five) === "deleted") {
                toastr.warning("Customer has been deleted successfully!", "Successful!");
                //refresh page//
                load_customer();
              }
              else if ($.trim(five) === "not_deleted") {
                Swal.fire({
                  title: "Error",
                  text: "Delete Customer Error!",
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