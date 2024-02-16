<?php
include_once "includes/header.php";

?>

<?php
//include database connection//
require_once "includes/config.php";

///==== get data for return sale module====///
if (isset($_GET["sale_id"])) {
    $sale_id = $_GET["sale_id"];

    $up_query = $con->prepare("SELECT * FROM sale LEFT JOIN customers ON sale.cust_id=customers.customer_id WHERE sale_id=:sale_id");
    $up_query->execute([
        "sale_id" => $sale_id
    ]);

    $row = $up_query->fetch(PDO::FETCH_ASSOC);

    $pur_data["cus_name"] = $row["name"];
    $pur_data["cus_id"] = $row["cust_id"];

    $pur_data["sale_date"] = $row["sale_date"];
    $pur_data["sale_detail"] = $row["sale_detail"];
    $pur_data["sub_total"] = $row["subtotal"];
    $pur_data["dis_percent"] = $row["dis_percent"];
    $pur_data["dis_amount"] = $row["dis_amount"];
    $pur_data["g_total"] = $row["total"];
    $pur_data["paid_amount"] = $row["paid_amount"];
    $pur_data["due_amount"] = $row["due_amount"];
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
            Sale
            <small>Sale Return</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sale Return</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <form class="" id="purchase_Form" autocomplete="off">
            <div class="row">
                <div class="col-md-9" style="padding-right:0px">
                    <div class="box box-danger" style="padding-top:4px;">
                        <div class="box-header with-border" style="padding-bottom:15px;">
                            <h3 class="box-title text-primary text-bold">Product Detail:</h3>
                            <div class="box-tools pull-right">
                                <input type="hidden" value="<?php echo $pur_data["sale_date"] ?>" name="sale_date">
                                <label for=""> <span class="text-primary">Sale Date:</span>&nbsp; <small><?php echo date('D/d-F,Y',strtotime($pur_data["sale_date"])) ?></small></label>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="padding-top:15px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Select Customer:</label>
                                    <input type="text" class="form-control pull-right" style="width:72%;" value="<?php echo $pur_data["cus_name"]; ?>" readonly>
                                    <input type="hidden" value="<?php echo $pur_data["cus_id"]; ?>" name="cust_id">
                                    <input type="hidden" value="<?php echo $sale_id; ?>" name="sale_id">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-1">
                                <div class="form-group text-center">
                                    <button class="btn btn-info" type="button" id="customer_modal_btn"><i
                                            class="fa fa-user-o" aria-hidden="true"></i></button>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-primary"
                                        style="padding-top:4px; padding-left:20px;">Date:</label>
                                    <input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control pull-right" style="width:80%;" name="ret_date">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-12" style="">
                                <table class="table text-center" id="pur_table">
                                    <thead style="background-color:lightgray; color:blue;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Stock</th>
                                            <th>Sale Price</th>
                                            <th>Qty</th>
                                            <th>Dis %</th>
                                            <th>Dis Amt</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $upd_query = $con->prepare("SELECT * FROM all_stock LEFT jOIN products ON all_stock.product_id=products.pro_id WHERE sale_id=:sale_id");
                                        $upd_query->execute([
                                            "sale_id" => $sale_id
                                        ]);
                                        $rows = $upd_query->fetchAll(PDO::FETCH_ASSOC);
                                        $num = 1;
                                        foreach ($rows as $rows) {

                                        $product_id = $rows["product_id"];
                                        $stock = $con->prepare("SELECT SUM(stock_in_qty-stock_out_qty) FROM all_stock WHERE product_id=:product_id");
                                        $stock->execute([
                                            "product_id"=>$product_id
                                        ]);
                                        $stk = $stock->fetch(PDO::FETCH_ASSOC);

                                            ?>

                                            <tr>
                                                <td>
                                                    <?php echo $num ?>
                                                    <input type="hidden" id="pro_id" name="pro_id[]"
                                                        value="<?php echo ($rows["pro_id"]); ?>">
                                                </td>
                                                <td style="width:20%;">
                                                    <input type="text" class="form-control" name="product[]" id="product"
                                                    value="<?php echo ($rows["pro_name"]); ?>" readonly>
                                                </td>
                                                <td><input type="text" class="form-control" name="stock[]" id="stock" value="<?php echo ($stk["SUM(stock_in_qty-stock_out_qty)"]); ?>" readonly></td>
                                                <td>
                                                    <input type="text" class="form-control" name="sale_price[]"
                                                    id="sale_price" value="<?php echo ($rows["sale_price"]); ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="qty[]" id="qty"
                                                        value="<?php echo ($rows["stock_out_qty"]); ?>">
                                                    <input type="hidden" id="cqty" value="<?php echo ($rows["stock_out_qty"]); ?>">    
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="dis_per[]" id="dis_per"
                                                        value="<?php echo ($rows["dis_per"]); ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="dis_amt[]" id="dis_amt"
                                                        value="<?php echo ($rows["dis_amt"]); ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="total[]" id="total"
                                                        value="<?php echo ($rows["total_sale_price"]); ?>" readonly>
                                                    <input type="hidden" class="form-control" name="tot[]" id="tot"
                                                        value="<?php echo ($rows["total_sale_price"]); ?>">
                                                </td>
                                                <td><button class="btn btn-danger" type="button" id="remove_row_btn"><i
                                                class="fa fa-minus" aria-hidden="true"></i></button></td>
                                            </tr>
                                            <?php
                                            $num++;
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12" style="padding-bottom:20px;">
                                <label class="text-primary" style="padding-left:20px;padding-top:10px;">Detail:</label>
                                <textarea name="detail" id="detail" cols="" rows="" class="pull-right form-control"
                                    style="width:91%;"><?php echo $pur_data["sale_detail"] ?></textarea>
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
                                
                                <input type="hidden" class="form-control" id="sub_total"> 
                                <div class="form-group">
                                    <label class="text-primary">Dis %:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">%</i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Dis in Percent"
                                        id="tax_percent" name="tax_percent"
                                        value="<?php echo $pur_data["dis_percent"] ?>" readonly>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <input type="hidden" class="form-control" id="tax_rupees">

                                <!-- Sub total -->
                                <div class="form-group">
                                    <label class="text-primary">Sub Total:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">Rs.</i>
                                        </div>
                                        <input type="text" class="form-control" id="rsub_total" name="rsub_total"
                                            placeholder="Subtotal" readonly>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <div class="form-group">
                                    <label class="text-primary">Ded %:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">%</i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ded in Percent"
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
                                        <input type="text" class="form-control" placeholder="Paid Amount"
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
                                    <button class="btn btn-primary" type="button" id="save_invoice_btn"
                                        style="width:100%;">Return Invoice</button>
                                </div><!-- /.form group -->



                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row -->
        </form>







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

        ///===Change qty====///
        $(document).on("keyup", "#qty", function () {

            var tr = $(this).parent().parent();
            var pur_price = tr.find("#sale_price").val();
            var qty =parseFloat (tr.find("#qty").val());
            var cqty =parseFloat (tr.find("#cqty").val());
            if (qty > cqty) {
                Swal.fire({
                    title: "Error",
                    text: "Stock Out!",
                    type: "error",
                    customClass: "sweet-alert",
                });
                tr.find("#qty").val(cqty);
                tr.find("#tot").val(pur_price * cqty);
                tr.find("#total").val(pur_price * cqty);

                var dis_p = tr.find("#dis_per").val();
                var tot = tr.find("#tot").val();
                tr.find("#dis_amt").val(tot * (dis_p / 100));
                var dis_amt = tr.find("#dis_amt").val();
                tr.find("#total").val(tot - dis_amt);
            } else {

                tr.find("#tot").val(pur_price * qty);
                tr.find("#total").val(pur_price * qty);

                var dis_p = tr.find("#dis_per").val();
                var tot = tr.find("#tot").val();
                tr.find("#dis_amt").val(tot * (dis_p / 100));
                var dis_amt = tr.find("#dis_amt").val();
                tr.find("#total").val(tot - dis_amt);
            }

            calculate();

        });

        ///====Sale price change===///
        $(document).on("keyup", "#sale_price", function () {

            var tr = $(this).parent().parent();
            var pur_price = tr.find("#sale_price").val();
            var qty = tr.find("#qty").val();

            tr.find("#tot").val(pur_price * qty);
            tr.find("#total").val(pur_price * qty);

            var dis_p = tr.find("#dis_per").val();
            var tot = tr.find("#tot").val();
            tr.find("#dis_amt").val(tot * (dis_p / 100));
            var dis_amt = tr.find("#dis_amt").val();
            tr.find("#total").val(tot - dis_amt);
            calculate();
        });

        ///===tax===///
        $(document).on("keyup", "#ded_percent", function () {
            calculate();

        });

        ///===paid amount===///
        $(document).on("keyup", "#paid_amount", function () {
            calculate();

        });



        //////===================Functions=================/////
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

<!-- return invoice ajax request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#save_invoice_btn", function (e) {
            e.preventDefault();

            // if ($("#purchase_Form").valid()) {
            if ($("#pur_table > tbody > tr").length > 0) {

            var form_data = new FormData($("#purchase_Form")[0]);
            form_data.append("action", "return_invoice");

            $.ajax({
                url: "includes/sale_module.php",
                type: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function (invoice) {
                    console.log(invoice);
                    if ($.trim(invoice) === 'return_added') {
                        Swal.fire({
                            title: "Success!",
                            text: "Sale Return Invoice saved Successfully!",
                            type: "success",
                            customClass: "sweet-alert",
                        }).then(function () {
                            window.location = 'sale_returns.php';
                        });
                    }
                    else if ($.trim(invoice) === 'return_not_added') {
                        Swal.fire({
                            title: "Error!",
                            text: "Insert Return Error!",
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







</body>

</html>