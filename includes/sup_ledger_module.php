<?php

include_once "config.php";

///Handle load customer ajax request///
if (isset($_POST["supplier_id"])) {

    $supplier_id=$_POST["supplier_id"];

    $query = $con->prepare("SELECT * FROM supp_ledger WHERE supp_id=:supp_id");
    $query->execute([
        "supp_id"=>$supplier_id
    ]);
    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    $no = 1;

    if ($row) {
        $output = "<table id='ledger_table'>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Detail</th>
                        <th>Type</th>
                        <th>Paid</th>
                        <th>Received</th>
                        <th>Balance</th>
                        <th style='width:13%'>Action</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($row as $row) {

            $output .= "<tr>
                            <th>{$no}</th>
                            <td>{$row["trn_date"]}</td>
                            <td>{$row["trn_detail"]}</td>
                            <td>{$row["trn_type"]}</td>
                            <td id='paid'>{$row["paid"]}</td>
                            <td id='received'>{$row["received"]}</td>
                            <td id='balance'>0</td>";
                            if ($row["pur_id"] != 0) {
                                $output.="<td>
                                    <button class='btn btn-success' id='edit_btn' data-uid='{$row["ledger_id"]}'><i class='fa fa-edit'></i></button>
                                    <button class='btn btn-danger' id='delete_btn' data-did='{$row["ledger_id"]}'><i class='fa fa-trash'></i></button>
                                </td>";
                            } else {
                                $output.="<td><b style='color:green;'>Welcome<b></td>";
                            }
                        "</tr>";
            $no++;
        }

        $output .= "</tbody></table>";

        echo $output;

    } else {
        echo "<table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Detail</th>
                <th>Type</th>
                <th>Paid</th>
                <th>Received</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>";
    }
    

    
}

?>