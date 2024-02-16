<?php
include_once "includes/header.php";

?>

<?php
//include database connection//
require_once "includes/config.php";

///==== get data for Update purchase module====///
if(isset($_GET["pur_return_id"])){
    $pur_ret_id = $_GET["pur_return_id"];

    $up_query = $con->prepare("SELECT * FROM purchase_return LEFT JOIN suppliers ON purchase_return.supp_id=suppliers.supplier_id LEFT JOIN purchase ON purchase_return.pur_id=purchase.purchase_id WHERE pur_return_id=:pur_return_id");
    $up_query->execute([
        "pur_return_id"=>$pur_ret_id
    ]);

    $row = $up_query->fetch(PDO::FETCH_ASSOC);

    $pur_data["supp_name"] = $row["company"];
    $pur_data["supp_id"] = $row["supplier_id"];

    $pur_data["pur_id"] = $row["pur_id"];
    $pur_data["pur_date"] = $row["pur_date"];
    $pur_data["pur_ret_date"] = $row["pur_ret_date"];
    $pur_data["ret_detail"] = $row["ret_detail"];
    $pur_data["sub_total"] = $row["subtotal"];
    $pur_data["ded_per"] = $row["deduction_per"];
    $pur_data["ded_amt"] = $row["deduction_amt"];
    $pur_data["g_total"] = $row["grand_total"];
    $pur_data["paid_amount"] = $row["paid_amt"];
    $pur_data["due_amount"] = $row["due_amt"];

    $pur_data["dis_per"] = $row["discount_percent"];
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
            Purchase Return
            <small>Update Purchase Return</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update Purchase Return</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <form class="" id="purchase_Form" autocomplete="off">
            <div class="row">
                <div class="col-md-9" style="padding-right:0px">
                    <div class="box box-danger" style="padding-top:4px;">
                        <div class="box-header with-border" style="padding-bottom:10px;">
                            <h3 class="box-title text-primary text-bold">Product Detail:</h3>
                            <div class="box-tools pull-right">
                                <input type="hidden" value="<?php echo $pur_data["pur_date"] ?>" name="pur_date">
                                <label for=""> <span class="text-primary">Purchase Date:</span>&nbsp; <small><?php echo date('D/d-F,Y',strtotime($pur_data["pur_date"])) ?></small></label>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="padding-top:15px;">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Supplier:</label>
                                    <input type="text" value="<?php echo $pur_data["supp_name"] ?>" class="form-control pull-right" style="width:80%;" readonly>
                                    <input type="hidden" value="<?php echo $pur_data["supp_id"] ?>" name="supp_id">
                                    <input type="hidden" value="<?php echo $pur_data["pur_id"] ?>" name="id_purchase">
                                    <input type="hidden" value="<?php echo $pur_ret_id ?>" name="id_purchase_ret">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <button class="btn btn-info" type="button"><i class="fa fa-user-o" aria-hidden="true"></i></button>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Date:</label>
                                    <input type="date" value="<?php echo $pur_data["pur_ret_date"] ?>"
                                    class="form-control pull-right" style="width:87%;" name="ret_date">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-12" style="padding-top:8px;">
                                <table class="table text-center" id="pur_table">
                                    <thead style="background-color:lightgray; color:blue;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Pur Price</th>
                                            <th>Old Stock</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $upd_query = $con->prepare("SELECT * FROM all_stock LEFT JOIN products ON all_stock.product_id=products.pro_id WHERE purchase_ret_id=:purchase_ret_id");
                                            $upd_query->execute([
                                                "purchase_ret_id"=>$pur_ret_id
                                            ]);
                                            $rows = $upd_query->fetchAll(PDO::FETCH_ASSOC);
                                            $num=1;
                                            foreach ($rows as $rows) {
                                        ?>

                                        <tr>
                                            <td><?php echo $num?>
                                            </td>
                                            <td style="width:30%;">
                                                <input type="text" value="<?php echo $rows["pro_name"]; ?>" class="form-control" name="pro_name[]" readonly>
                                                <input type="hidden" value="<?php echo $rows["product_id"]; ?>" class="form-control" name="pro_id[]">
                                            </td>
                                            <td><input type="text" class="form-control" name="pur_price[]"
                                                    id="pur_price" value="<?php echo ($rows["purchase_price"]); ?>" readonly>
                                            </td>
                                            <td><input type="text" class="form-control" name="old_stock[]"
                                                    id="old_stock">
                                            </td>
                                            <td><input type="text" class="form-control" name="qty[]" id="qty" value="<?php echo ($rows["stock_out_qty"]); ?>"></td>
                                            <td><input type="text" class="form-control" placeholder="Total(Rs)"
                                                name="total[]" id="total" value="<?php echo ($rows["total_pur_ret_price"]); ?>" readonly>
                                            </td>
                                            <td><button class="btn btn-danger" type="button" id="remove_row_btn"><i
                                                        class="fa fa-minus" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                            <?php 
                                             $num++;
                                            } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12" style="padding-bottom:20px;">
                                <label class="text-primary" style="padding-left:20px;padding-top:5px;">Detail:</label>
                                <textarea name="detail" id="detail" cols="" rows="" class="pull-right form-control"
                                    style="width:90%;"><?php echo $pur_data["ret_detail"] ?></textarea>
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
                                <div class="form-group">
                                    <label class="text-primary">Discount %:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">%</i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Dis in Percent"
                                        id="tax_percent" name="tax_percent" value="<?php echo $pur_data["dis_per"]?>" readonly>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <div class="form-group">
                                    <!-- <label class="text-primary">Discount Amount:</label> -->
                                    <input type="hidden" class="form-control" placeholder="Dis in Rupees"
                                    id="tax_rupees" name="tax_rupees">    
                                </div><!-- /.form group -->
                                <!-- Sub total -->
                                <div class="form-group">
                                    <label class="text-primary">Sub Total:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">Rs.</i>
                                        </div>
                                        <input type="text" class="form-control" id="rsub_total" name="rsub_total"
                                        placeholder="Subtotal" readonly>
                                        <input type="hidden" class="form-control" id="sub_total" name="sub_total"
                                        placeholder="Subtotal">
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <div class="form-group">
                                    <label class="text-primary">Ded %:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">%</i>
                                        </div>
                                        <input type="text" class="form-control" value="<?php echo $pur_data["ded_per"] ?>"
                                        id="ded_percent" name="ded_percent">
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <div class="form-group" style="margin-bottom:0px;">
                                    <label class="text-primary">Ded Amount:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">Rs.</i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ded in Rupees"
                                            id="ded_rupees" name="ded_rupees">
                                    </div><!-- /.input group -->
                                    <p class="text-center text-primary"
                                    style="font-weight:800; font-size:30px; margin-bottom: 0px;" id="final_amount"
                                    name="final_amount">0.00</p>
                                    <input type="hidden" id="f_amount" name="f_amount">
                                </div><!-- /.form group -->
                                <div class="form-group">
                                    <label class="text-primary">Paid Amount:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">Rs.</i>
                                        </div>
                                        <input type="text" class="form-control" value="<?php echo $pur_data["paid_amount"] ?>"
                                        id="paid_amount" name="paid_amount">
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <div class="form-group">
                                    <label class="text-primary">Due Amount:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">Rs.</i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Due Amount" id="due_amount"
                                            name="due_amount">
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <div class="form-group">
                                    <button class="btn btn-primary" type="button" id="return_invoice_btn"
                                        style="width:100%;">Update Return Invoice</button>
                                </div><!-- /.form group -->



                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row -->
        </form>



        <!----------------- Main Table Row ------------>




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
        calculate();
        ///===========Delete row from table============///
        $(document).on("click", "#remove_row_btn", function (e) {
            e.preventDefault;
            $(this).closest("tr").remove();

            calculate();
        });

        ///===change qty====///
        $(document).on("keyup", "#qty", function () {

            var tr = $(this).parent().parent();
            var pur_price = tr.find("#pur_price").val();
            var qty = tr.find("#qty").val();

            tr.find("#total").val(pur_price * qty);

            calculate();

        });

        ///===ded===///
        $(document).on("keyup", "#ded_percent", function () {
            calculate();

        });

        ///===paid amount===///
        $(document).on("keyup", "#paid_amount", function () {
            calculate();

        });

        ///======Function======///
        function calculate() {
            ///===sub-total===///
            var subtotal = 0;
            var total = $("#pur_table > tbody > tr #total");
            total.each(function () {
                subtotal = subtotal + ($(this).val() * 1);
            });
            $("#sub_total").val(subtotal);

            ///===tax===///
            var sub_total = $("#sub_total").val();
            var tax_percent = $("#tax_percent").val();
            var amount = (sub_total) * (tax_percent / 100);
            $("#tax_rupees").val(amount.toFixed(2));
            var tax_rupees = $("#tax_rupees").val();
            var final=(sub_total) * 1 - (tax_rupees) * 1;
            $("#rsub_total").val(final);
            //===ded===///
            var ded_percent = $("#ded_percent").val();
            var amt = (final) * (ded_percent / 100);
            $("#ded_rupees").val(amt.toFixed(2));
            var ded_rupees = $("#ded_rupees").val();
           
            $("#final_amount").text(final-ded_rupees);
            $("#f_amount").val(final-ded_rupees);

            ///===paid amount===///
            var final_amount = $("#final_amount").text();
            var paid_amount = $("#paid_amount").val();

            $("#due_amount").val((final_amount - paid_amount).toFixed(2));

        }


    });
</script>

<!-- update return purchase invoice ajax request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#return_invoice_btn", function (e) {
            e.preventDefault();

            if ($("#pur_table > tbody > tr").length > 0) {

            if ($("#purchase_Form").valid()) {

            var form_data = new FormData($("#purchase_Form")[0]);
            form_data.append("action", "up_return_invoice");

            $.ajax({
                url: "includes/purchase_module.php",
                type: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function (invoice) {
                    console.log(invoice);
                    if ($.trim(invoice) === 'return_updated') {
                        Swal.fire({
                            title: "Success!",
                            text: "Purchase Return Invoice Updated Successfully!",
                            type: "success",
                            customClass: "sweet-alert",
                        }).then(function () {
                            // location.reload(true);
                            window.location = 'purchase_returns.php';
                        });
                    }
                    else if ($.trim(invoice) === 'return_not_updated') {
                        Swal.fire({
                            title: "Error!",
                            text: "Update Purchase Return Error!",
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

        }

        } else {

        Swal.fire({
            title: "Error!",
            text: "Please select something!",
            type: "error",
            customClass: "sweet-alert",
        });

        }

        });

    });
</script>



</body>

</html>