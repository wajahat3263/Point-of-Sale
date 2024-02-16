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
      Banks
      <small>Manage Banks</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Banks</li>
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
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->

    <!-- Insert New Bank Modal -->
    <div class="modal fade" id="insert_customer_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Insert New Bank:</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="add_customer_form" autocomplete="off">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="name" placeholder=" ">
                      <label class="textboxlabel">Bank Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="account_no" placeholder=" ">
                      <label class="textboxlabel">Account No:</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="account_tit" placeholder=" ">
                      <label class="textboxlabel">Account Title:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="b_code" placeholder=" ">
                      <label class="textboxlabel">Branch Code:</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea name="address" placeholder="Enter your address" class="form-control textbox" rows="2"></textarea>
                            <label class="textboxlabel">Address:</label>
                        </div>
                    </div>
                </div>
              </div><!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="add_customer_btn" name="add_customer">Add
              Bank</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Update Bank Modal -->
    <div class="modal fade" id="update_customer_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Bank:</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="update_customer_form" autocomplete="off">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="u_name" id="u_name" placeholder=" ">
                      <label class="textboxlabel">Bank Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="uaccount_no" id="uaccount_no" placeholder=" ">
                      <input type="hidden" class="form-control textbox" name="update" id="update">
                      <label class="textboxlabel">Account No:</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="uaccount_tit" id="uaccount_tit" placeholder=" ">
                      <label class="textboxlabel">Account Title:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="ub_code" id="ub_code" placeholder=" ">
                      <label class="textboxlabel">Branch Code:</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea name="u_address" id="u_address" placeholder="Enter your address" class="form-control textbox" rows="2"></textarea>
                      <label class="textboxlabel">Address:</label>
                    </div>
                </div>
                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="update_customer_btn" name="update_customer">Update
              Bank</button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

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

<!-- Jquery Insert bank Form Validation -->
<script>
  $(document).ready(function () {


    $("#add_customer_form").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        account_no: {
          required: true,
          number: true,
          minlength: 12,
          maxlength: 16
        },
        account_tit: {
          required: true,
          minlength: 3
        },
        b_code: {
          required: true,
          number: true,
          minlength: 4,
          maxlength: 6

        },
        address: {
          required: true,
          minlength: 5
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

<!-- Jquery Update bank Form Validation -->
<script>
  $(document).ready(function () {


    $("#update_customer_form").validate({
      rules: {
        u_name: {
          required: true,
          minlength: 3
        },
        uaccount_no: {
          required: true,
          number: true,
          minlength: 12,
          maxlength: 16
        },
        uaccount_tit: {
          required: true,
          minlength: 3

        },
        ub_code: {
          required: true,
          number: true,
          minlength: 4,
          maxlength: 6
        },
        u_address: {
          required: true,
          minlength: 5
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


<!-- Add/Update bank modue -->
<script>
  $(document).ready(function () {

    ///Send customer-data in database///
    $("#add_customer_btn").click(function (e) {

      e.preventDefault();

      //call velidation//
      if ($("#add_customer_form").valid()) {

        ///Add customer-data ajax request///
        $.ajax({

          url: "includes/bank_module.php",
          type: "POST",
          data: $("#add_customer_form").serialize() + "&action=insert_bank",
          success: function (one) {
            // console.log(one);

            if ($.trim(one) === "inserted") {
              toastr.success("Bank has been added successfuly!", "Successful!");
              $("#add_customer_form")[0].reset();
              $("#insert_customer_modal").modal("hide");
              //call function here to refresh//
              load_customer();
            }
            else if ($.trim(one) === "not_inserted") {
              Swal.fire({
                title: "Error",
                text: "Insert Bank Error!",
                type: "error",
                customClass: "sweet-alert",
              });
            }
            else if ($.trim(one) === "account_already_exist") {
              Swal.fire({
                title: "Error",
                text: "Account Already Exist!",
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


    ///Load bank-data from database///
    load_customer();
    function load_customer() {
      var loadcustomer = "";

      ///Load customer ajax request///
      $.ajax({

        url: "includes/bank_module.php",
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
                text: '<i class="ion ion-person-add"></i>&nbsp; Add Bank',
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
        url: "includes/bank_module.php",
        type: "POST",
        data: { cid: id },
        dataType: "JSON",
        success: function (three) {
          // console.log(three);

          $("#update").val(three["bank_id"]);
          $("#u_name").val(three["bank_name"]);
          $("#uaccount_tit").val(three["account_title"]);
          $("#uaccount_no").val(three["account_no"]);
          $("#ub_code").val(three["branch_code"]);
          $("#u_address").val(three["address"]);

        }
      });

    });



    ///Update customer ajax request///
    $("#update_customer_btn").click(function (e) {
      e.preventDefault();

      //call velidation//
      if ($("#update_customer_form").valid()) {

        $.ajax({
          url: "includes/bank_module.php",
          type: "POST",
          data: $("#update_customer_form").serialize() + "&action=update_bank",
          success: function (four) {
            // console.log(four);

            if ($.trim(four) === "updated") {
              toastr.info("Bank has been updated successfully!", "Successful!");
              $("#update_customer_form")[0].reset();
              $("#update_customer_modal").modal("hide");
              //refresh page//
              load_customer();

            } 
            else if ($.trim(four) === "not_updated") {
              Swal.fire({
                title: "Error",
                text: "Update Bank Error!",
                type: "error",
                customClass: "sweet-alert",
              });

            }
            else if ($.trim(four) === "account_exist") {
              Swal.fire({
                title: "Error",
                text: "Account Already exist!",
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

            url: "includes/bank_module.php",
            type: "POST",
            data: { delete: d_id },
            success: function (five) {
              // console.log(five);
              if ($.trim(five) === "deleted") {
                toastr.warning("Bank has been deleted successfully!", "Successful!");
                //refresh page//
                load_customer();
              }
              else if ($.trim(five) === "not_deleted") {
                Swal.fire({
                  title: "Error",
                  text: "Delete Bank Error!",
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