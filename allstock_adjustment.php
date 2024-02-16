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
            All Stock Adjustment
            <small>Manage Stock Adjustment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Stock Adjustment</li>
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
                            <table id="purchase_table" class="table table-custom spacing5 text-center">
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->



        <!-- View modal -->
        <div class="modal fade" id="show_allpurchase_modal" style="">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-aqua" style="padding-bottom:10px;padding-top:10px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="">Expense Invoice Detail:</h4>
                    </div>
                    <div class="modal-body" style="padding-top:0px;">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="page-header text-primary">
                                    <i class="fa fa-shopping-cart"></i> Expense Invoice.
                                    <small class="pull-right">Date: <?php echo date('d-m-y'); ?></small>
                                </h3>
                            </div><!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info text-center">
                            <div class="col-sm-6 invoice-col">
                                <strong class="text-primary">Invoice Date:</strong>
                                <address id="date">
                                    <!-- <?php echo date('d-m-y'); ?> -->
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-6 invoice-col">
                                <strong class="text-primary">Detail:</strong>
                                <address id="details">
                                    <!-- Rise Computer College Muridwala -->
                                </address>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped text-center" id="prod_detail_table">
                                    <thead style="color: blue; background-color: lightgray;">
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive" style="">
                                    <table class="table text-center" style="width: 35%;margin:auto;">
                                        <tr>
                                            <th class="text-primary">Grand total:</th>
                                            <td id="grand_total">0</td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>
                    <div class="modal-footer" style="padding-bottom:10px;padding-top:10px;">
                        <a href="invoice-print.html" target="_blank" class="btn btn-default pull-left"><i class="fa fa-print"></i>
                            Print
                        </a>
                        <button style="" type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>

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




<!-- Get stock-adj data Ajax request -->
<script>
    $(document).ready(function () {

        load_stock();
        function load_stock() {
            var loadstock = "";

            $.ajax({
                url: "includes/stock_adjustment_module.php",
                type: "POST",
                data: { load: loadstock },
                success: function (data) {
                    // console.log(data);
                    $("#purchase_table").html(data);

                    //Data table apply//
                    $("#purchase_table").dataTable({
                        "bDestroy": true,
                        searching: true,
                        dom: 'lfBrtip',
                        dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f><'col-sm-12 col-md-5 text-right'B>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-7'i><'col-sm-12 col-md-5 text-right'p>>",
                        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        buttons: [
                            {
                                text: 'Add/Stk Adjustment',
                                className: 'btn-success',
                                action: function () {
                                    // $("#").modal('show');
                                    window.location='stock_adjustment.php';

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


        // Delete purchase AJAX request
        $(document).on("click", "#delete_btn", function (e) {
            e.preventDefault();

            var did = $(this).data("did");

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

                    $.ajax({
                        url: "includes/stock_adjustment_module.php",
                        type: "POST",
                        data: { did: did },
                        success: function (del) {
                            console.log(del);

                            if ($.trim(del) === 'deleted') {
                            toastr.warning('Stock Has Been Deleted Seccussfully!', 'Successfull!');
                            // call function here to refresh page
                            load_stock();
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
<!-- Get all purchase AJAX request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#view_btn", function (e) {
            e.preventDefault();

            $("#show_allpurchase_modal").modal("show");

            var vid = $(this).data("vid");
            $.ajax({
                url: "includes/stock_adjustment_module.php",
                type: "POST",
                data: { vid: vid },
                dataType: "JSON",
                success: function (view) {
                    // console.log(view);

                    $("#date").text(view["expense_date"]);
                    $("#details").text(view["exp_detail"]);
                    $("#grand_total").text(view["grand_total"]);
                   

                }

            });

        });


        $(document).on("click", "#view_btn", function (e) {
            e.preventDefault();

            $("#show_allpurchase_modal").modal("show");

            var tid = $(this).data("vid");
            $.ajax({
                url: "includes/stock_adjustment_module.php",
                type: "POST",
                data: { tid: tid },
                success: function (table) {
                    // console.log(table);

                    $("#prod_detail_table").html(table);

                }

            });

        });



    });
</script>



</body>

</html>