<?php

include_once "config.php";

///Handle load customer ajax request///
if (isset($_POST["load"])) {
    $query = $con->prepare("SELECT * FROM products");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    $no = 1;

    if ($row) {
        $output = "<table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pro Name</th>
                        <th>Pro Cat</th>
                        <th>Purchase</th>
                        <th>Pur Ret</th>
                        <th>Open Stk</th>
                        <th>Sale</th>
                        <th>Sale Ret</th>
                        <th>Adj</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($row as $row) {
            $pro_id=$row["pro_id"];
            ///1///
            $quer = $con->prepare("SELECT SUM(stock_in_qty), SUM(stock_out_qty), SUM(stock_in_qty-stock_out_qty) FROM all_stock WHERE product_id=:product_id");
            $quer->execute([
                "product_id"=>$pro_id
            ]);
            $ro = $quer->fetch(PDO::FETCH_ASSOC);
            
            ///2///
            $que = $con->prepare("SELECT SUM(stock_in_qty) FROM all_stock WHERE product_id=:product_id AND purchase_id!=0");
            $que->execute([
                "product_id"=>$pro_id
            ]);
            $r = $que->fetch(PDO::FETCH_ASSOC);
            $pur=$r["SUM(stock_in_qty)"];
            if ($pur <= 0) {
                $purchase=0;
            } else {
                $purchase=$r["SUM(stock_in_qty)"];
            }
            
            ///3///
            $qu = $con->prepare("SELECT SUM(stock_out_qty) FROM all_stock WHERE product_id=:product_id AND purchase_ret_id!=0");
            $qu->execute([
                "product_id"=>$pro_id
            ]);
            $s = $qu->fetch(PDO::FETCH_ASSOC);
            $pur_ret=$s["SUM(stock_out_qty)"];
            if ($pur_ret <= 0) {
                $purchase_ret=0;
            } else {
                $purchase_ret=$s["SUM(stock_out_qty)"];
            }

            ///4///
            $q = $con->prepare("SELECT SUM(stock_in_qty) FROM all_stock WHERE product_id=:product_id AND opening_stk_id!=0");
            $q->execute([
                "product_id"=>$pro_id
            ]);
            $t = $q->fetch(PDO::FETCH_ASSOC);
            $open_stk=$t["SUM(stock_in_qty)"];
            if ($open_stk <= 0) {
                $opening_stk=0;
            } else {
                $opening_stk=$t["SUM(stock_in_qty)"];
            }

            ///5///
            $p = $con->prepare("SELECT SUM(stock_out_qty) FROM all_stock WHERE product_id=:product_id AND sale_id!=0");
            $p->execute([
                "product_id"=>$pro_id
            ]);
            $u = $p->fetch(PDO::FETCH_ASSOC);
            $sal=$u["SUM(stock_out_qty)"];
            if ($sal <= 0) {
                $sale=0;
            } else {
                $sale=$u["SUM(stock_out_qty)"];
            }
            ///6///
            $o = $con->prepare("SELECT SUM(stock_in_qty) FROM all_stock WHERE product_id=:product_id AND sale_ret_id!=0");
            $o->execute([
                "product_id"=>$pro_id
            ]);
            $v = $o->fetch(PDO::FETCH_ASSOC);
            $sal_ret=$v["SUM(stock_in_qty)"];
            if ($sal_ret <= 0) {
                $sale_ret=0;
            } else {
                $sale_ret=$v["SUM(stock_in_qty)"];
            }

            ///7///
            $n = $con->prepare("SELECT SUM(stock_out_qty) FROM all_stock WHERE product_id=:product_id AND stk_adj_id!=0");
            $n->execute([
                "product_id"=>$pro_id
            ]);
            $w = $n->fetch(PDO::FETCH_ASSOC);
            $adj=$w["SUM(stock_out_qty)"];
            if ($adj <= 0) {
                $adjust=0;
            } else {
                $adjust=$w["SUM(stock_out_qty)"];
            }


            $output .= "<tr>
                            <th>{$no}</th>
                            <td>{$row["pro_name"]}</td>
                            <td>{$row["pro_catagory"]}</td>
                            <td>{$purchase}</td>
                            <td>{$purchase_ret}</td>
                            <td>{$opening_stk}</td>
                            <td>{$sale}</td>
                            <td>{$sale_ret}</td>
                            <td>{$adjust}</td>
                            <td>{$ro["SUM(stock_in_qty-stock_out_qty)"]}</td>
                        </tr>";
            $no++;
        }

        $output .= "</tbody></table>";

        echo $output;

    } else {
        echo "<table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Pro Name</th>
                <th>Pro Cat</th>
                <th>Purchase</th>
                <th>Pur Ret</th>
                <th>Open Stk</th>
                <th>Sale</th>
                <th>Sale Ret</th>
                <th>Adj</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>";
    }
    

    
}

?>