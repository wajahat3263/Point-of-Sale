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
<div class="content-wrapper" style="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase Report
            <small>Manage Purchase Report</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Purchase Report</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <form class="" id="purchase_Form" autocomplete="off">
            <div class="row">
                <div class="col-md-12" style="">
                    <div class="box box-danger" style="padding-top:4px;">
                        <div class="box-header with-border" style="padding-bottom:15px;">
                            <h3 class="box-title text-primary text-bold">Please Select Date Range:</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="padding-top:10px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px; padding-left:5px;">From
                                        Date:</label>
                                    <input type="date" value="" class="form-control pull-right" style="width:65%;"
                                        name="from_date" id="from_date">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px; padding-left:0px;">To
                                        Date:</label>
                                    <input type="date" value="" class="form-control pull-right" style="width:70%;"
                                        name="to_date" id="to_date">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-6">
                                <button class="btn btn-danger pull-right" style="margin-right: 5px; width:15%;"
                                    type="button" id="reset">Reset</button>
                                <button style="margin-right: 10px; width:15%;" type="button"
                                    class="btn btn-primary pull-right" id="search">Search</button>
                            </div>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                </div>

            </div><!-- /.row -->
        </form>


        <!-- Main Table Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="report_table" class="table table-custom spacing5 text-center">
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
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


<script>
    $(document).ready(function () {

        function table() {

            //Data table apply//
            $("#report_table").dataTable({
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
                        // action: function () {
                        //   $("#insert_customer_modal").modal('show');

                        // }
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



        // load();
        function load() {
            var load_table = "";
            ///Load ajax request///
            $.ajax({

                url: "includes/pur_report_module.php",
                type: "POST",
                data: { load: load_table },
                success: function (two) {
                    // console.log(two);

                    //Fetch data in table//
                    $("#report_table").html(two);

                    // table();

                }

            });

        }


        $(document).on("click", "#search", function (e) {
            e.preventDefault();

            // var form_data = new FormData($("#purchase_Form")[0]);
            // form_data.append("action", "load_data");

            $.ajax({
                url: "includes/pur_report_module.php",
                type: "POST",
                data: $("#purchase_Form").serialize() + "&action=load_data",
                // contentType: false,
                // processData: false,
                success: function (invoice) {
                    // console.log(invoice);

                    $("#report_table").html(invoice);

                    table();

                }
            });


        });





    });
</script>

<!--Search ajax request -->
<script>
    $(document).ready(function () {



    });
</script>








</body>

</html>