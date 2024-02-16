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
            Expense
            <small>Expense Catagory</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Expense Catagories</li>
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
                            <table id="unittable" class="table table-custom spacing5 text-center">
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
        <!---------- Insert New Exp.Catagory Modal ------------>
        <div class="modal fade" id="insertUnit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-aqua">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Insert New Catagory:</h4>
                    </div>
                    <div class="modal-body">
                        <!-- form start -->
                        <form class="form-horizontal" id="unit_Form" autocomplete="off">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="unit" placeholder="" id="unit">
                                            <label class="textboxlabel">Exp Catagory:</label>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pull-left" id="addunit_btn" name="addunit_btn">Add
                            Catagory</button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Update cat Modal -->
        <div class="modal fade" id="updateUnit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-aqua">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Catagory:</h4>
                    </div>
                    <div class="modal-body">
                        <!-- form start -->
                        <form class="form-horizontal" id="update_unit_Form" autocomplete="off">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="up_unit" placeholder="" id="up_unit">
                                            <label class="textboxlabel">Catagory:</label>
                                            <input type="hidden" name="hid" id="hid">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pull-left" id="update_unit_btn" name="update_unit_btn">Update
                            Catagory</button>
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




<!-- Jquery Insert exp-catagory Form Validation -->
<script>
  $(document).ready(function () {


    $("#unit_Form").validate({
      rules: {
        unit: {
          required: true,
          minlength: 3
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

<!-- Jquery update exp-catagory Form Validation -->
<script>
  $(document).ready(function () {

    $("#update_unit_Form").validate({
      rules: {
        up_unit: {
          required: true,
          minlength: 3
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

<!-- Add/Update Exp-Catagory modue -->
<script>
    $(document).ready(function () {


        /// Add Exp-Catagory Ajax Request///
        $("#addunit_btn").click(function (e) {
            e.preventDefault();

            if ($("#unit_Form").valid()) {

            var form_data = new FormData($("#unit_Form")[0]);
            form_data.append("action", "insert_expense_cat");

            $.ajax({
                url: 'includes/expense_module.php',
                method: 'post',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);

                    if ($.trim(response) === 'inserted') {
                        toastr.success("Expense Catagory Added successfully!", "Successful!");
                        $("#unit_Form")[0].reset();
                        $('#insertUnit').modal('hide');
                        // call function here to refresh page
                        load_unit();
                    }
                    else if ($.trim(response) === 'not_inserted') {
                        Swal.fire({
                            title: "Error!",
                            text: "Insert Catagory Error!",
                            type: "error",
                            customClass: "sweet-alert",
                        });
                    }
                    else if ($.trim(response) === 'cat_exist') {
                        Swal.fire({
                            title: "Error!",
                            text: "Catagory Already Exist!",
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




        /// Load Exp-Cat from database///
        load_unit();
        function load_unit() {
            var loadcat = "";
            //load exp-cat ajax request//
            $.ajax({
                url: "includes/expense_module.php",
                type: "POST",
                data: { loadcat: loadcat },
                success: function (data) {
                    // console.log(data);
                    /// Fetch data in table ///
                    $("#unittable").html(data);

                    ///data table apply ///
                    $("#unittable").dataTable({
                        "bDestroy": true,
                        searching: true,
                        dom: 'lfBrtip',
                        dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f><'col-sm-12 col-md-5 text-right'B>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-7'i><'col-sm-12 col-md-5 text-right'p>>",
                        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        buttons: [
                            {
                                text: '<i class="ion ion-person-add"></i>&nbsp; Add Catagory',
                                className: 'btn-success',
                                action: function () {
                                    $("#insertUnit").modal('show');

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




        /// Show update Exp-Cat modal ///
        $(document).on("click", "#edit_btn", function (e) {
            e.preventDefault();
            $("#updateUnit").modal("show");

            var uid = $(this).data("uid");
            // $("#hid").val(uid);
            // fetch unit data for update request//
            $.ajax({
                url: "includes/expense_module.php",
                type: "POST",
                data: { uid: uid },
                dataType: "JSON",
                success: function (data) {
                    // console.log(data);

                    $("#hid").val(data["uid"]);
                    $("#up_unit").val(data["name"]);

                }
            });
        });



        /// Update Unit Ajax Request ///
        $("#update_unit_btn").click(function (e) {
            e.preventDefault();
            if ($("#update_unit_Form").valid()) {

                $.ajax({
                    url: 'includes/expense_module.php',
                    method: 'post',
                    data: $("#update_unit_Form").serialize() + "&action=update_cat",
                    success: function (response) {
                        // console.log(response);

                        if ($.trim(response) === 'updated') {
                            toastr.info("Catagory has been updated successfully!", "Successful!");
                            $("#update_unit_Form")[0].reset();
                            $('#updateUnit').modal('hide');
                            // call function here to refresh page
                            load_unit();
                        }
                        else if ($.trim(response) === 'not_updated') {
                            Swal.fire({
                                title: "Error!",
                                text: "Update Catagory Error!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                        else if ($.trim(response) === 'up_cat_exist') {
                        Swal.fire({
                            title: "Error!",
                            text: "Catagory Already Exist!",
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




        /// Delete exp-cat module ///
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
                    // Delete cat data Ajax request// 
                    $.ajax({
                        url: "includes/expense_module.php",
                        type: "POST",
                        data: { DeleteId: DeleteId },
                        success: function (data) {
                            if ($.trim(data) === 'deleted') {
                                toastr.warning('Catagory Has Been Deleted Seccussfully!', 'Successfull!');
                                // call function here to refresh page
                                load_unit();
                            } else if ($.trim(data) === 'not_deleted') {
                                Swal.fire({
                                    title: "Not Deleted!",
                                    text: "Catagory not Deleted Please Try Again!",
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