<?php
  include_once "includes/header.php";

?>

<?php
  //include database connection//
  require_once "includes/config.php";
  function get_cat() {
      global $con;
      $data = "";
      $query = $con->prepare("SELECT * FROM catagory");
      $query->execute();
      $row = $query->fetchAll(PDO::FETCH_ASSOC);
      foreach ($row as $row) {
          $data .= '<option value="' . $row["cat_name"] . '">' . $row["cat_name"] . '</option>';
      }
      return $data;
  }

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
<div class="content-wrapper" style="padding-top:10px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Products
      <small>Manage Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
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
              <table id="usertable" class="table table-custom spacing5 text-center">
                <thead>
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
    <!---------- Insert New Product Modal ------------>
    <div class="modal fade" id="insertUser">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-aqua">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Insert New Product</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="user_Form" autocomplete="off" enctype="multipart/form-data">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="pro_name" placeholder=" ">
                      <label class="textboxlabel">Product Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <select class="form-control textbox" name="pro_catagory" id="">
                        <option value="">Select:</option>
                        <?php echo get_cat(); ?>
                      </select>
                      <!-- <input type="text" class="form-control textbox" name="pro_catagory"> -->
                      <label class="textboxlabel">Product Catagory:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="serial" placeholder=" " id="pass">
                      <label class="textboxlabel">Product Serial:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                        <input type="file" name="pro_photo" id="pro_photo" data-allowed-file-extensions="jpeg png jpg" data-height="100">                   
                        <label class="textboxlabel">Product Photo:</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="bar_code" placeholder=" ">
                      <label class="textboxlabel">Bar Code:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="purchase" placeholder=" ">
                      <label class="textboxlabel">Purchase Price:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="sale_price" placeholder=" ">
                      <label class="textboxlabel">Sale Price:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="detail" placeholder=" ">
                      <label class="textboxlabel">Detail:</label>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="adduser" name="adduser">Add Product</button>
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
            <h4 class="modal-title">Update Product:</h4>
          </div>
          <div class="modal-body">
            <!-- form start -->
            <form class="form-horizontal" id="update_form" autocomplete="off">
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="u_pro_name" placeholder=" " id="u_pro_name">
                      <input type="hidden" class="form-control textbox" name="uuid" placeholder=" " id="uid">
                      <label class="textboxlabel">Product Name:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control textbox" name="u_catagory" placeholder=" " id="u_catagory">
                        <label class="textboxlabel">Product Catagory:</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="u_purchase" placeholder=" " id="u_purchase">
                      <label class="textboxlabel">Purchase Price:</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control textbox" name="u_sale" placeholder=" " id="u_sale">
                      <label class="textboxlabel">Sale Price:</label>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pull-left" id="update_user_btn" name="update_user">Update
              Product</button>
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



<!-- page script -->
<script>
  $(document).ready(function () {

    $("#pro_photo").dropify();

  });
</script>

<!-- Add/Update user modue -->
<script>
  $(document).ready(function () {


    /// Add User Ajax Request///
    $("#adduser").click(function (e) {
      e.preventDefault();


        var form_data=new FormData($("#user_Form")[0]);
        form_data.append("action", "insert_user");

        $.ajax({
          url: 'includes/product_module.php',
          method: 'post',
          data: form_data,
          contentType: false,
          processData: false,
          success: function (response) {
            // console.log(response);


            if ($.trim(response) === 'inserted') {
              toastr.success("Product has been added successfully!", "Successful!");
              $("#user_Form")[0].reset();
              $('#insertUser').modal('hide');
              // call function here to refresh page
              load_user();
            }
            else if ($.trim(response) === 'not_inserted') {
              Swal.fire({
                title: "Error!",
                text: "Insert Product Error!",
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




    /// Load user from database///
    load_user();
    function load_user() {
      var loaduser = "";
      //load user ajax request//
      $.ajax({
        url: "includes/product_module.php",
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
                text: '<i class="ion ion-person-add"></i>&nbsp; Add Product',
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




    /// Show update product modal ///
    $(document).on("click", "#edit_btn", function (e) {
      e.preventDefault();
      $("#updateUser").modal("show");

      var uid = $(this).data("uid");
      // $("#upname").val(uid);
      // fetch product data for update request//
      $.ajax({
        url: "includes/product_module.php",
        type: "POST",
        data: { uid: uid },
        dataType: "JSON",
        success: function (data) {
        //   console.log(data);

          $("#uid").val(data["uid"]);
          $("#u_pro_name").val(data["pro_name"]);
          $("#u_catagory").val(data["pro_catagory"]);
          $("#u_purchase").val(data["pro_purchase_price"]);
          $("#u_sale").val(data["pro_sale_price"]);

        }
      });
    });



    /// Update User Ajax Request ///
    $("#update_user_btn").click(function (e) {
      e.preventDefault();

        $.ajax({
          url: 'includes/product_module.php',
          method: 'post',
          data: $("#update_form").serialize() + "&action=update_user",
          success: function (response) {
            // console.log(response);


            if ($.trim(response) === 'updated') {
              toastr.info("Product has been updated successfully!", "Successful!");
              $("#update_form")[0].reset();
              $('#updateUser').modal('hide');
              // call function here to refresh page
              load_user();
            }
            else if ($.trim(response) === 'not_updated') {
              Swal.fire({
                title: "Error!",
                text: "Update Product Error!",
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




    /// Delete product module ///
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
            url: "includes/product_module.php",
            type: "POST",
            data: { DeleteId: DeleteId },
            success: function (data) {
              // console.log(data);
              if ($.trim(data) === 'deleted') {
                toastr.warning('Product Has Been Deleted Seccussfully!', 'Successfull!');
                // call function here to refresh page
                load_user();
              } else if ($.trim(data) === 'not_deleted') {
                Swal.fire({
                  title: "Not Deleted!",
                  text: "Product not Deleted Please Try Again!",
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