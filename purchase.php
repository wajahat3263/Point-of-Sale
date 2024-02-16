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

function get_supplier_data()
{
    global $con;
    $data = "";
    $query = $con->prepare("SELECT * FROM suppliers");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $row) {
        $data .= '<option value="' . $row["supplier_id"] . '">' . $row["company"] . '</option>';
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
            Purchase
            <small>Manage Purchase</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Purchase</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <form class="" id="purchase_Form" autocomplete="off">
            <div class="row">
                <div class="col-md-9" style="padding-right:0px">
                    <div class="box box-danger" style="padding-top:4px;">
                        <div class="box-header with-border" style="padding-bottom:20px;">
                            <h3 class="box-title text-primary text-bold">Product Detail:</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-primary" type="button"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; All
                                    Purchases</button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="padding-top:15px;">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Supplier:</label>
                                    <select class="form-control pull-right" style="width:80%;" id="sup_name"
                                        name="sup_name">
                                        <option value="">Select supplier</option>
                                        <?php echo get_supplier_data(); ?>
                                    </select>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <button class="btn btn-info" id="supplier_modal_btn"><i class="fa fa-user-o"
                                            aria-hidden="true"></i></button>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="text-primary" style="padding-top:4px;">Date:</label>
                                    <input type="date" value="<?php echo date('Y-m-d'); ?>"
                                        class="form-control pull-right" style="width:87%;" name="pur_date"
                                        id="pur_date">
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-12" style="padding-top:8px;">
                                <table class="table text-center" id="pur_table">
                                    <thead style="background-color:lightgray; color:blue;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Pur Price</th>
                                            <th>Sale Price</th>
                                            <th>Old Stock</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1
                                                <input type="hidden" id="check_id">
                                            </td>
                                            <td style="width:20%;">
                                                <select class="form-control" name="pro_name[]" id="pro_name">
                                                    <option value="">Select Product</option>
                                                    <?php echo get_product_detail(); ?>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="pur_price[]"
                                                    id="pur_price">
                                            </td>
                                            <td><input type="text" class="form-control" name="sale_price[]"
                                                    id="sale_price">
                                            </td>
                                            <td><input type="text" class="form-control" name="old_stock[]"
                                                    id="old_stock" readonly>
                                            </td>
                                            <td><input type="text" class="form-control" name="qty[]" id="qty"></td>
                                            <td><input type="text" class="form-control" placeholder="Total(Rs)"
                                                    name="total[]" id="total" readonly></td>
                                            <td><button class="btn btn-info" type="button" id="add_row_btn"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12" style="padding-bottom:20px;">
                                <label class="text-primary" style="padding-left:20px;padding-top:5px;">Detail:</label>
                                <textarea name="detail" id="detail" cols="" rows="" class="pull-right form-control"
                                    style="width:90%;"></textarea>
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
                                            id="tax_percent" name="tax_percent">
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
                                        style="width:100%;">Save Invoice</button>
                                </div><!-- /.form group -->



                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row -->
        </form>



        <!----------------- Main Table Row ------------>


        <!---- Insert New Supplier Modal ---->
        <div class="modal fade" id="insert_supplier_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-aqua">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Insert New Supplier:</h4>
                    </div>
                    <div class="modal-body">
                        <!-- form start -->
                        <form class="form-horizontal" id="add_supplier_form" autocomplete="off">
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <h4 class="text-info text-bold">Company Details:</h4>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="name" placeholder=" ">
                                            <label class="textboxlabel">Company Name:</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="phone"
                                                placeholder=" ">
                                            <label class="textboxlabel">Phone:</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="email" id="Email"
                                                placeholder=" ">
                                            <label class="textboxlabel">Email(Optional):</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="address"
                                                placeholder=" ">
                                            <label class="textboxlabel">Address(Optional):</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="website"
                                                placeholder=" ">
                                            <label class="textboxlabel">Website(Optional):</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <h4 class="text-info text-bold">Contact Person Details:</h4>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="cname"
                                                placeholder=" ">
                                            <label class="textboxlabel">Name:</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control textbox" name="designation" id="designation"
                                                required>
                                                <option value="CEO">CEO</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Supervisor">Supervisor</option>
                                                <option value="Operator">Worker</option>
                                            </select>
                                            <label class="textboxlabel">Designation:</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="cphone"
                                                placeholder=" ">
                                            <label class="textboxlabel">Phone:</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control textbox" name="cemail"
                                                placeholder=" ">
                                            <label class="textboxlabel">Email(Optional):</label>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- /.box-body -->

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pull-left" id="add_supplier_btn"
                            name="add_customer">Add
                            Supplier</button>
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


<!-- Jquery Insert Supplier Form Validation -->
<script>
  $(document).ready(function () {


    $("#add_supplier_form").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        phone: {
          required: true,
          digits: true,
          minlength: 11,
          maxlength: 11

        },
        email: {
          required: false,
          email: true
        },

        cname: {
          required: true,
          minlength: 3
        },
        cphone: {
          required: true,
          number: true,
          minlength: 11,
          maxlength: 11

        },
        cemail: {
          required: false,
          email: true
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

<!-- invoice form velidation -->
<script>
  $(document).ready(function () {

    $("#purchase_Form").validate({
      rules: {
        sup_name: {
          required: true,
          minlength: 1
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

<!-- page script -->
<script>
    $(document).ready(function () {
        ///=============Append row in table=============///
        $(document).on("click", "#add_row_btn", function (e) {
            e.preventDefault;


            var count = $("#pur_table > tbody > tr").length + 1;

            var html = "<tr>";
            html += '<td>' + count + '<input type="hidden" id="check_id"></td>';
            html += '<td style="width:20%;"><select class="form-control" name="pro_name[]" id="pro_name"><option>Select Product</option><?php echo get_product_detail(); ?></select></td>';
            html += '<td><input type="text" class="form-control" name="pur_price[]" id="pur_price"></td>';
            html += '<td><input type="text" class="form-control" name="sale_price[]" id="sale_price"></td>';
            html += '<td><input type="text" class="form-control" name="old_stock[]" id="old_stock" readonly></td>';
            html += '<td><input type="text" class="form-control" name="qty[]" id="qty"></td>';
            html += '<td><input type="text" class="form-control" placeholder="Total(Rs)" name="total[]" id="total" readonly></td>';
            html += '<td><button class="btn btn-danger" type="button" id="remove_row_btn"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';
            html += "</tr>";

            $("#pur_table > tbody:last-child").append(html);
        });
        ///===========Delete row from table============///
        $(document).on("click", "#remove_row_btn", function (e) {
            e.preventDefault;
            $(this).closest("tr").remove();

            calculate();
        });


        ///===========Get product data Ajax Request=========///
        $(document).on("change", "#pro_name", function () {
            var product_id = $(this).val();
            var tr = $(this).parent().parent();

            //select prevent//
            var id_tr = $("#pur_table > tbody > tr #check_id");
            id_tr.each(function () {
                item_id = $(this).val();

                if (product_id == item_id) {
                    Swal.fire({
                        title: "Error!",
                        text: "Product already selected!",
                        type: "error",
                        customClass: "sweet-alert",
                    });

                }

            });
            //select end// 

            $.ajax({
                url: "includes/purchase_module.php",
                type: "POST",
                data: { product_id: product_id },
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);

                    var pur_price = response["pur_price"];
                    var sale_price = response["sale_price"];
                    var old_stock = response["old_stock"];
                    var id = response["id"];
                    tr.find("#pur_price").val(pur_price);
                    tr.find("#sale_price").val(sale_price);
                    tr.find("#old_stock").val(old_stock);
                    tr.find("#check_id").val(id);
                    tr.find("#qty").val(1);
                    var qty = tr.find("#qty").val();

                    tr.find("#total").val(pur_price * qty);
                    calculate();
                }
            });

        });

        ///===change qty====///
        $(document).on("keyup", "#qty", function () {

            var tr = $(this).parent().parent();
            var pur_price = tr.find("#pur_price").val();
            var qty = tr.find("#qty").val();

            tr.find("#total").val(pur_price * qty);

            calculate();

        });

        ///====purchase price change===///
        $(document).on("keyup", "#pur_price", function () {

            var tr = $(this).parent().parent();
            var pur_price = tr.find("#pur_price").val();
            var qty = tr.find("#qty").val();

            tr.find("#total").val(pur_price * qty);
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
            $("#final_amount").text((sub_total) * 1 - (tax_rupees) * 1);
            $("#f_amount").val((sub_total) * 1 - (tax_rupees) * 1);


            ///===paid amount===///
            var final_amount = $("#final_amount").text();
            var paid_amount = $("#paid_amount").val();

            $("#due_amount").val((final_amount - paid_amount).toFixed(2));

        }


    });
</script>

<!-- Save invoice ajax request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#save_invoice_btn", function (e) {
            e.preventDefault();

            if ($("#purchase_Form").valid()) {

            var form_data = new FormData($("#purchase_Form")[0]);
            form_data.append("action", "save_invoice");

            $.ajax({
                url: "includes/purchase_module.php",
                type: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function (invoice) {
                    console.log(invoice);
                    if ($.trim(invoice) === 'purchase_added') {
                        Swal.fire({
                            title: "Success!",
                            text: "Purchase Invoice saved Successfully!",
                            type: "success",
                            customClass: "sweet-alert",
                        }).then(function () {
                            // $("#purchase_Form")[0].reset();
                            location.reload(true);
                        });
                    }
                    else if ($.trim(invoice) === 'purchase_not_added') {
                        Swal.fire({
                            title: "Error!",
                            text: "Insert Purchase Error!",
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
        });

    });
</script>

<!-- Insert new supplier ajax request -->
<script>
    $(document).ready(function () {

        $(document).on("click", "#supplier_modal_btn", function (e) {
            e.preventDefault();

            $("#insert_supplier_modal").modal("show");

            ///Send supplier-data in database///
            $("#add_supplier_btn").click(function (e) {

                e.preventDefault();

                //call velidation//
                if ($("#add_supplier_form").valid()) {

                    ///Add supplier-data ajax request///
                    $.ajax({

                        url: "includes/supplier_module.php",
                        type: "POST",
                        data: $("#add_supplier_form").serialize() + "&action=insert_supplier",
                        success: function (one) {
                            // console.log(one);

                            if ($.trim(one) === "inserted") {
                                toastr.success("Supplier has been added successfuly!", "Successful!");
                                $("#add_supplier_form")[0].reset();
                                $("#insert_supplier_modal").modal("hide");
                                
                            }
                            else if ($.trim(one) === "not_inserted") {
                                Swal.fire({
                                    title: "Error",
                                    text: "Insert Supplier Error!",
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
                            else if ($.trim(one) === "same_both_emails") {
                                Swal.fire({
                                    title: "Error",
                                    text: "Enter Different Emails in both fields!",
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