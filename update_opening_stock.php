<?php
include_once "includes/header.php";

?>

<?php
//include database connection//
require_once "includes/config.php";
function get_product_detail() {
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

///==== get data for Update stock module====///
if(isset($_GET["opening_stock_id"])){
    $stock_id = $_GET["opening_stock_id"];

    $up_query = $con->prepare("SELECT * FROM opening_stock WHERE opening_stock_id=:opening_stock_id");
    $up_query->execute([
        "opening_stock_id"=>$stock_id
    ]);

    $row = $up_query->fetch(PDO::FETCH_ASSOC);

    $pur_data["os_date"] = $row["os_date"];
    $pur_data["os_detail"] = $row["os_detail"];
    
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
            Opening Stock
            <small>Update Opening Stock</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update Opening Stock</li>
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
                                    <button class="btn btn-info" type="button" id="customer_modal_btn"><i
                                            class="fa fa-user-o" aria-hidden="true"></i></button>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-primary"
                                        style="padding-top:4px; padding-left:20px;">Date:</label>
                                    <input type="date" value="<?php echo $pur_data["os_date"]; ?>"
                                    class="form-control pull-right" style="width:80%;" name="stock_date"
                                    id="stock_date">
                                    <input type="hidden" value="<?php echo $stock_id; ?>" name="ops_id"
                                    id="ops_id">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-12" style="">
                                <table class="table text-center" id="pur_table">
                                    <thead style="background-color:lightgray; color:blue;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Pur Price</th>
                                            <th>Sale Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = $con->prepare("SELECT * FROM all_stock LEFT JOIN products ON all_stock.product_id=products.pro_id WHERE opening_stk_id=:opening_stk_id");
                                            $query->execute([
                                                "opening_stk_id"=>$stock_id
                                            ]);
                                            $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                            $no = 1;
                                            foreach ($data as $data) {
                                        ?>
                                        
                                        <tr>
                                            <td><?php echo $no;?>
                                                <input type="hidden" id="pro_id" name="pro_id[]" value="<?php echo $data["product_id"];?>">
                                            </td>
                                            <td style="width:20%;">
                                                <input type="text" class="form-control" name="product[]" id="product" value="<?php echo $data["pro_name"];?>" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="pur_price[]" id="pur_price" value="<?php echo $data["purchase_price"];?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="sale_price[]" id="sale_price" value="<?php echo $data["sale_price"];?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="qty[]" id="qty" value="<?php echo $data["stock_in_qty"];?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="total[]" id="total" value="<?php echo $data["total_pur_price"];?>" readonly>
                                            </td>
                                            <td><button class="btn btn-danger" type="button" id="remove_row_btn"><i class="fa fa-minus" aria-hidden="true"></i></button></td>
                                        </tr>
                                        
                                        <?php
                                            $no++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12" style="padding-bottom:20px;">
                                <label class="text-primary" style="padding-left:20px;padding-top:10px;">Detail:</label>
                                <textarea name="detail" id="detail" cols="" rows="" class="pull-right form-control"
                                    style="width:91%;"><?php echo $pur_data["os_detail"]; ?></textarea>
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
                                            placeholder="Subtotal" readonly>
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


        <!-- Insert New Customer Modal -->





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
                html += '<td style="width:20%;"><input type="text" class="form-control" name="product[]" id="product" readonly></td>';
                html += '<td><input type="text" class="form-control" name="pur_price[]" id="pur_price"></td>';
                html += '<td><input type="text" class="form-control" name="sale_price[]" id="sale_price"></td>';
                html += '<td><input type="text" class="form-control" name="qty[]" id="qty"></td>';
                html += '<td><input type="text" class="form-control" name="total[]" id="total" readonly></td>';
                html += '<td><button class="btn btn-danger" type="button" id="remove_row_btn"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';
                html += "</tr>";
                $("#pur_table > tbody:last-child").append(html);

                var tr = $("#pur_table > tbody > tr:last-child");
                $.ajax({
                    url: "includes/opening_stock_module.php",
                    type: "POST",
                    data: { product_id: product_id },
                    dataType: "JSON",
                    success: function (response) {
                        // console.log(response);

                        var pro_id = response["pro_id"];
                        var pro_name = response["pro_name"];
                        var pro_pur_price = response["pro_purchase_price"];
                        var pro_sale_price = response["pro_sale_price"];
                        
                        tr.find("#pro_id").val(pro_id);
                        tr.find("#product").val(pro_name);
                        tr.find("#pur_price").val(pro_pur_price);
                        tr.find("#sale_price").val(pro_sale_price);
                        tr.find("#qty").val(1);

                        tr.find("#total").val(pro_pur_price);
                        calculate();

                        $("#pro_name").val("");
                    }
                });

            }


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
            var pur_price = tr.find("#pur_price").val();
            var qty = tr.find("#qty").val();

            tr.find("#total").val(pur_price * qty);
            calculate();  

        });

        ///====Pur price change===///
        $(document).on("keyup", "#pur_price", function () {

            var tr = $(this).parent().parent();
            var pur_price = tr.find("#pur_price").val();
            var qty = tr.find("#qty").val();

            tr.find("#total").val(pur_price * qty);
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

        }

        function check_item(id) {
            var table = $("#pur_table > tbody > tr");
            var ch_id = "";
            table.each(function () {
                var check_id = $(this).find("#pro_id").val();
                var check_qty = parseFloat($(this).find("#qty").val());
                var check_pur = parseFloat($(this).find("#pur_price").val());

                if (id == check_id) {
                    $(this).find("#qty").val(check_qty + 1);
                    var new_qty = parseFloat($(this).find("#qty").val());
                    $(this).find("#total").val(parseFloat(new_qty * check_pur));
                    ch_id = check_id;

                }


            });

            return ch_id;

        }


    });
</script>

<!-- Save invoice ajax request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#save_invoice_btn", function (e) {
            e.preventDefault();

            if ($("#pur_table > tbody > tr").length > 0) {


                var form_data = new FormData($("#purchase_Form")[0]);
                form_data.append("action", "update_invoice");

                $.ajax({
                    url: "includes/opening_stock_module.php",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (invoice) {
                        // console.log(invoice);
                        if ($.trim(invoice) === 'stock_updated') {
                            Swal.fire({
                                title: "Success!",
                                text: "Stock Invoice updated Successfully!",
                                type: "success",
                                customClass: "sweet-alert",
                            }).then(function () {
                                window.location="allopening_stock.php";
                            });
                        }
                        else if ($.trim(invoice) === 'stock_not_updated') {
                            Swal.fire({
                                title: "Error!",
                                text: "Update Stock Error!",
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


        });

    });
</script>








</body>

</html>