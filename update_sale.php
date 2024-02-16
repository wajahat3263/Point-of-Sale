<?php
include_once "includes/header.php";

?>

<?php
//include database connection//
require_once "includes/config.php";
function get_product_detail()
{
    global $con;
    $data = "";
    $query = $con->prepare("SELECT * FROM products");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $row) {
        $data .= '<option value="' . $row["pro_id"] . '">' . $row["pro_name"] . '</option>';
    }
    return $data;
}

function get_customer_data($cus_id)
{
    global $con;
    $data = "";
    $query = $con->prepare("SELECT * FROM customers");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $row) {
        $data .= '<option value="' . $row["customer_id"] . '"';
        if ($cus_id == $row["customer_id"]) {
            $data .= "selected";
        }
        $data .= '>' . $row["name"] . '</option>';
    }
    return $data;
}


///==== get data for Update sale module====///
if (isset($_GET["sale_id"])) {
    $sale_id = $_GET["sale_id"];

    $up_query = $con->prepare("SELECT * FROM sale WHERE sale_id=:sale_id");
    $up_query->execute([
        "sale_id" => $sale_id
    ]);

    $row = $up_query->fetch(PDO::FETCH_ASSOC);

    $pur_data["sale_id"] = $row["sale_id"];
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
            <small>Update Sale</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update Sale</li>
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
                        </div><!-- /.box-header -->
                        <div class="box-body" style="padding-top:15px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Select Customer:</label>
                                    <select class="form-control pull-right" style="width:72%;" id="cus_name"
                                        name="cus_name">
                                        <?php echo get_customer_data($pur_data["cus_id"]); ?>
                                    </select>
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
                                    <input type="date" value="<?php echo $pur_data["sale_date"] ?>"
                                        class="form-control pull-right" style="width:80%;" name="sale_date"
                                        id="sale_date">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Select Product:</label>
                                    <select class="form-control pull-right" style="width:72%;" id="pro_name"
                                        name="pro_name">
                                        <option value="">Select Product</option>
                                        <?php echo get_product_detail(); ?>
                                    </select>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-1">
                                <div class="form-group text-center">
                                    <button class="btn btn-info">OR</button>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Barcode:</label>
                                    <input type="text" value="" class="form-control pull-right" style="width:80%;"
                                        name="pro_barcode" id="pro_barcode">
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
                                                        value="<?php echo ($rows["pro_name"]); ?>">
                                                </td>
                                                <td><input type="text" class="form-control" name="stock[]" id="stock" value="<?php echo ($stk["SUM(stock_in_qty-stock_out_qty)"])+($rows["stock_out_qty"]); ?>"></td>
                                                <td>
                                                    <input type="text" class="form-control" name="sale_price[]"
                                                        id="sale_price" value="<?php echo ($rows["sale_price"]); ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="qty[]" id="qty"
                                                        value="<?php echo ($rows["stock_out_qty"]); ?>">
                                                    <input type="hidden" id="cqty" value="<?php echo ($rows["stock_out_qty"]); ?>">    
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="dis_per[]" id="dis_per"
                                                        value="<?php echo ($rows["dis_per"]); ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="dis_amt[]" id="dis_amt"
                                                        value="<?php echo ($rows["dis_amt"]); ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="total[]" id="total"
                                                        value="<?php echo ($rows["total_sale_price"]); ?>">
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
                                    <label class="text-primary">Dis %:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">%</i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Dis in Percent"
                                            id="tax_percent" name="tax_percent"
                                            value="<?php echo $pur_data["dis_percent"] ?>">
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                <div class="form-group" style="margin-bottom:0px;">
                                    <label class="text-primary">Dis Amount:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="text-primary text-bold">Rs.</i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Dis in Rupees"
                                            id="tax_rupees" name="tax_rupees">
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
                                            id="paid_amount" name="paid_amount"
                                            value="<?php echo $pur_data["paid_amount"] ?>">
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
                                        style="width:100%;">Update Invoice</button>
                                    <input type="hidden" name="id_sale" value="<?php echo $sale_id; ?>">
                                </div><!-- /.form group -->



                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row -->
        </form>


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
                                            <input type="text" class="form-control textbox" name="email"
                                                placeholder=" ">
                                            <label class="textboxlabel">Email:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="phone"
                                                placeholder=" ">
                                            <label class="textboxlabel">Phone:</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea name="address" placeholder="Enter your address"
                                                class="form-control textbox" rows="1"></textarea>
                                            <!-- <input type="text" class="form-control textbox" name="address" placeholder=" "> -->
                                            <label class="textboxlabel">Address:</label>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pull-left" id="add_customer_btn"
                            name="add_customer">Add
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
        ///=============Append row in table=============///
        $(document).on("change", "#pro_name", function (e) {
            e.preventDefault();
            var product_id = $(this).val();

            var abc = check_item(product_id);

            if (abc != "") {
                calculate();
                $("#pro_name").val("");
            } else {

                var count = $("#pur_table > tbody > tr").length + 1;
                var html = "<tr>";
                html += '<td>' + count + '<input type="hidden" id="pro_id" name="pro_id[]"></td>';
                html += '<td style="width:20%;"><input type="text" class="form-control" name="product[]" id="product"></td>';
                html += '<td><input type="text" class="form-control" name="stock[]" id="stock"></td>';
                html += '<td><input type="text" class="form-control" name="sale_price[]" id="sale_price"></td>';
                html += '<td><input type="text" class="form-control" name="qty[]" id="qty"><input type="hidden" id="cqty" value="1"></td>';
                html += '<td><input type="text" class="form-control" name="dis_per[]" id="dis_per"></td>';
                html += '<td><input type="text" class="form-control" name="dis_amt[]" id="dis_amt"></td>';
                html += '<td><input type="text" class="form-control" name="total[]" id="total"><input type="hidden" class="form-control" name="tot[]" id="tot"></td>';
                html += '<td><button class="btn btn-danger" type="button" id="remove_row_btn"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';
                html += "</tr>";
                $("#pur_table > tbody:last-child").append(html);

                var tr = $("#pur_table > tbody > tr:last-child");
                $.ajax({
                    url: "includes/sale_module.php",
                    type: "POST",
                    data: { product_id: product_id },
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response);

                        var pro_name = response["pro_name"];
                        var pro_sale_price = response["pro_sale_price"];
                        var old_stock = response["old_stock"];
                        var pro_id = response["pro_id"];
                        tr.find("#product").val(pro_name);
                        tr.find("#sale_price").val(pro_sale_price);
                        tr.find("#stock").val(old_stock);
                        tr.find("#pro_id").val(pro_id);
                        tr.find("#qty").val(1);
                        var qty = tr.find("#qty").val();

                        tr.find("#tot").val(pro_sale_price * qty);
                        tr.find("#total").val(pro_sale_price * qty);
                        calculate();

                        $("#pro_name").val("");
                    }
                });

            }


        });

        $(document).on("keyup", "#pro_barcode", function (e) {
            var bar_code = $(this).val();

            $.ajax({
                url: "includes/sale_module.php",
                type: "POST",
                data: { bar_code: bar_code },
                dataType: "JSON",
                success: function (bar) {
                    console.log(bar);

                    var pro_name = bar["pro_name"];
                    var pro_sale_price = bar["pro_sale_price"];
                    var pro_id = bar["pro_id"];
                    var old_stock = bar["old_stock"];

                    if (pro_name != "") {

                        var def = check_item(pro_id);
                        if (def != "") {
                            calculate();
                            $("#pro_barcode").val("");
                        } else {

                            var count = $("#pur_table > tbody > tr").length + 1;

                            var html = "<tr>";
                            html += '<td>' + count + '<input type="hidden" id="pro_id"></td>';
                            html += '<td style="width:20%;"><input type="text" class="form-control" name="product[]" id="product"></td>';
                            html += '<td><input type="text" class="form-control" name="stock[]" id="stock"></td>';
                            html += '<td><input type="text" class="form-control" name="sale_price[]" id="sale_price"></td>';
                            html += '<td><input type="text" class="form-control" name="qty[]" id="qty"><input type="hidden" id="cqty" value="1"></td>';
                            html += '<td><input type="text" class="form-control" name="dis_per[]" id="dis_per"></td>';
                            html += '<td><input type="text" class="form-control" name="dis_amt[]" id="dis_amt"></td>';
                            html += '<td><input type="text" class="form-control" name="total[]" id="total"><input type="hidden" class="form-control" name="tot[]" id="tot"></td>';
                            html += '<td><button class="btn btn-danger" type="button" id="remove_row_btn"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';
                            html += "</tr>";
                            $("#pur_table > tbody:last-child").append(html);

                            var tr = $("#pur_table > tbody > tr:last-child");
                            tr.find("#product").val(pro_name);
                            tr.find("#sale_price").val(pro_sale_price);
                            tr.find("#pro_id").val(pro_id);
                            tr.find("#stock").val(old_stock);
                            tr.find("#qty").val(1);

                            tr.find("#tot").val(pro_sale_price);
                            tr.find("#total").val(pro_sale_price);

                            $('#pro_barcode').val("");
                            calculate();

                        }

                    }
                }
            });


        });
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
            var stk=parseFloat(tr.find("#stock").val());
            var qty =parseFloat (tr.find("#qty").val());
            var cqty =parseFloat (tr.find("#cqty").val());

            if (qty > stk) {
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

        ///====Discount % change===///
        $(document).on("keyup", "#dis_per", function () {

            var tr = $(this).parent().parent();
            var dis_p = tr.find("#dis_per").val();
            var tot = tr.find("#tot").val();

            tr.find("#dis_amt").val(tot * (dis_p / 100));
            var dis_amt = tr.find("#dis_amt").val();
            tr.find("#total").val(tot - dis_amt);
            calculate();
        });


        ///===tax===///
        $(document).on("keyup", "#tax_percent", function () {
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
            $("#final_amount").text((sub_total) * 1 - (tax_rupees) * 1);
            $("#f_amount").val((sub_total) * 1 - (tax_rupees) * 1);


            ///===paid amount===///
            var final_amount = $("#final_amount").text();
            var paid_amount = $("#paid_amount").val();

            $("#due_amount").val((final_amount - paid_amount).toFixed(2));

        }

        function check_item(id) {
            var table = $("#pur_table > tbody > tr");
            var ch_id = "";
            table.each(function () {
                var check_id = $(this).find("#pro_id").val();
                var check_qty = parseFloat($(this).find("#qty").val());
                var check_sale = parseFloat($(this).find("#sale_price").val());

                if (id == check_id) {
                    $(this).find("#qty").val(check_qty + 1);
                    var new_qty = parseFloat($(this).find("#qty").val());
                    $(this).find("#total").val(parseFloat(new_qty * check_sale));
                    $(this).find("#tot").val(parseFloat(new_qty * check_sale));
                    ch_id = check_id;
                    //dis%
                    var dis_p = $(this).find("#dis_per").val();
                    var tot = $(this).find("#tot").val();
                    $(this).find("#dis_amt").val(tot * (dis_p / 100));
                    var dis_amt = $(this).find("#dis_amt").val();
                    $(this).find("#total").val(tot - dis_amt);

                }


            });

            return ch_id;

        }


    });
</script>

<!-- update invoice ajax request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#save_invoice_btn", function (e) {
            e.preventDefault();

            // if ($("#purchase_Form").valid()) {
            if ($("#pur_table > tbody > tr").length > 0) {

            var form_data = new FormData($("#purchase_Form")[0]);
            form_data.append("action", "update_invoice");

            $.ajax({
                url: "includes/sale_module.php",
                type: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function (invoice) {
                    console.log(invoice);
                    if ($.trim(invoice) === 'sale_updated') {
                        Swal.fire({
                            title: "Success!",
                            text: "Sale Invoice updated Successfully!",
                            type: "success",
                            customClass: "sweet-alert",
                        }).then(function () {
                            window.location = 'allsale.php';
                        });
                    }
                    else if ($.trim(invoice) === 'sale_not_updated') {
                        Swal.fire({
                            title: "Error!",
                            text: "Insert Sale Error!",
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

<!-- insert customer ajax request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#customer_modal_btn", function (e) {
            $("#insert_customer_modal").modal("show");

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

        });

    });
</script>







</body>

</html>