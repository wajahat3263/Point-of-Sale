<?php
include_once "includes/header.php";

?>

<?php
//include database connection//
require_once "includes/config.php";

function get_expense_data()
{
    global $con;
    $data = "";
    $query = $con->prepare("SELECT * FROM expense_cat");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $row) {
        $data .= '<option value="' . $row["expense_cat_id"] . '">' . $row["expense_cat_name"] . '</option>';
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
            Expense
            <small>Add Expense</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Expense</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <form class="" id="expense_Form" autocomplete="off">
            <div class="row">
                <div class="col-md-9" style="padding-right:0px">
                    <div class="box box-danger" style="padding-top:4px;">
                        <div class="box-header with-border" style="padding-bottom:15px;">
                            <h3 class="box-title text-primary text-bold">Expense Detail:</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="padding-top:15px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Select Expense:</label>
                                    <select class="form-control pull-right" style="width:72%;" id="exp_name"
                                        name="cus_name">
                                        <option value="">Select Expense</option>
                                        <?php echo get_expense_data(); ?>
                                    </select>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-1">
                                <div class="form-group text-center">
                                    <button class="btn btn-info" type="button" id="exp_modal_btn"><i
                                            class="fa fa-user-o" aria-hidden="true"></i></button>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-primary"
                                        style="padding-top:4px; padding-left:20px;">Date:</label>
                                    <input type="date" value="<?php echo date("Y-m-d"); ?>"
                                        class="form-control pull-right" style="width:80%;" name="inv_date"
                                        id="sale_date">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-12" style="">
                                <table class="table text-center" id="pur_table">
                                    <thead style="background-color:lightgray; color:blue;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Expense</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12" style="padding-bottom:20px;">
                                <label class="text-primary" style="padding-left:20px;padding-top:10px;">Detail:</label>
                                <textarea name="detail" id="detail" cols="" rows="" class="pull-right form-control"
                                    style="width:91%;"></textarea>
                            </div>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                </div>
                <div class="col-md-3">
                    <div class="box box-danger">
                        <div class="box-header with-border" style="padding-top:16px; padding-bottom:16px;">
                            <h3 class="box-title text-primary text-bold">Billing Detail</h3>
                        </div>
                        <div class="box-body" style="padding-top:10px;">
                            <div class="col-md-12">
                                <!-- Sub total -->
                                <div class="form-group">
                                    <label class="text-primary">Sub Total:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">Rs.</i>
                                        </div>
                                        <input type="text" class="form-control" id="sub_total" name="sub_total"
                                            placeholder="Subtotal">
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <div class="form-group">
                                    <button class="btn btn-primary" type="button" id="save_invoice_btn"
                                        style="width:100%;">Save Invoice</button>
                                </div><!-- /.form group -->



                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row -->
        </form>


        <!---------- Insert New Exp.Catagory Modal ------------>
        <div class="modal fade" id="insertcat">
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
        ///=============Append row in table=============///
        $(document).on("change", "#exp_name", function (e) {
            e.preventDefault();
            var exp_cat_id = $(this).val();

            //select prevent//
            var id_tr = $("#pur_table > tbody > tr #id");
            id_tr.each(function () {
                item_id = $(this).val();

                if (exp_cat_id == item_id) {
                    Swal.fire({
                        title: "Error!",
                        text: "Expense already selected!",
                        type: "error",
                        customClass: "sweet-alert",
                    });

                }

            });
            //select end// 

            var count = $("#pur_table > tbody > tr").length + 1;
            var html = "<tr>";
            html += '<td>' + count + '<input type="hidden" id="id" name="id[]"></td>';
            html += '<td style="width:35%;"><input type="text" class="form-control" id="name" readonly></td>';
            html += '<td style="width:30%;"><input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="date[]" id="date"></td>';
            html += '<td><input type="text" class="form-control" name="total[]" id="total"></td>';
            html += '<td><button class="btn btn-danger" type="button" id="remove_row_btn"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';
            html += "</tr>";
            $("#pur_table > tbody:last-child").append(html);

            var tr = $("#pur_table > tbody > tr:last-child");
                $.ajax({
                    url: "includes/expense_module.php",
                    type: "POST",
                    data: { exp_cat_id: exp_cat_id },
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response);

                        var id = response["id"];
                        var name = response["name"];
                        tr.find("#id").val(id);
                        tr.find("#name").val(name);
                        
                        $("#exp_name").val("");
                        calculate();
 
                    }
                    
                });
 

        });

        ///===========Delete row from table============///
        $(document).on("click", "#remove_row_btn", function (e) {
            e.preventDefault;
            $(this).closest("tr").remove();
            calculate();
        });

        ///===========Total Keyup============///
        $(document).on("keyup", "#total", function (e) {
            calculate();
        });


        //////===================Function=================/////
        function calculate() {
            ///===sub-total===///
            var subtotal = 0;
            var total = $("#pur_table > tbody > tr #total");
            total.each(function () {
                subtotal = subtotal + ($(this).val() * 1);
            });
            $("#sub_total").val(subtotal);
            
        }


    });
</script>

<!-- Save invoice ajax request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#save_invoice_btn", function (e) {
            e.preventDefault();

            // if ($("#purchase_Form").valid()) {
            if ($("#pur_table > tbody > tr").length > 0) {


                var form_data = new FormData($("#expense_Form")[0]);
                form_data.append("action", "save_invoice");

                $.ajax({
                    url: "includes/expense_module.php",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (invoice) {
                        console.log(invoice);
                        if ($.trim(invoice) === 'expense_added') {
                            Swal.fire({
                                title: "Success!",
                                text: "Expense Invoice saved Successfully!",
                                type: "success",
                                customClass: "sweet-alert",
                            }).then(function () {
                                location.reload(true);
                            });
                        }
                        else if ($.trim(invoice) === 'expense_not_added') {
                            Swal.fire({
                                title: "Error!",
                                text: "Insert Expense Error!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong!",
                                type: "error",
                                customClass: "sweet-alert",
                            });
                        }
                    }
                });

            } else {

                Swal.fire({
                    title: "Error!",
                    text: "Please select item!",
                    type: "error",
                    customClass: "sweet-alert",
                });

            }

            // }

        });

    });
</script>

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
<!--Insert expense-catagory AJAX Request-->
<script>
    $(document).ready(function(){

        $(document).on("click","#exp_modal_btn", function(e){
            e.preventDefault();
            $("#insertcat").modal("show");

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
                                $('#insertcat').modal('hide');
                                // call function here to refresh page
                                // get_expense_data();
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

        });

    });
</script>






</body>

</html>