<?php

include_once "config.php";

///Handle load ajax request///
if (isset($_POST["load"])) {

        $output = "<table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Supplier</th>
                        <th>Date</th>
                        <th>Invoice No</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                </table>";

        echo $output;
    
    
}

///Handle search ajax request///
if (isset($_POST["action"]) && $_POST["action"]=="load_data") {

    $from_date=$_POST["from_date"];
    $to_date=$_POST["to_date"];

    $query = $con->prepare("SELECT * FROM purchase WHERE pur_date BETWEEN '$from_date' AND '$to_date'");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    $no = 1;

    if ($row) {
        $output = "<table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Supplier</th>
                <th>Date</th>
                <th>Invoice No</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>";
        foreach ($row as $row) {

            $output .= "<tr>
                            <th>{$no}</th>
                            <td>1</td>
                            <td>{$row["pur_date"]}</td>
                            <td>001</td>
                            <td>2</td>
                            <td>{$row["subtotal"]}</td>
                            <td>{$row["total"]}</td>
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
        <th>Supplier</th>
        <th>Date</th>
        <th>Invoice No</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Total</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>";
    }
    

    
}

?>