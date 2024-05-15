<style>
    table {
        font-family: arial, sans-serif !important;
        border-collapse: collapse;
        width: 100%;
        text-align:left;
    }
    th {
        font-weight: bolder !important;
        border: 1px solid #FFC66D !important;
        background-color: #FFC66D !important;
        text-align: left;
        padding: 10px !important;
        font-size: inherit;
    }
    td {
        border: 1px solid #dddddd !important;
        background-color: #ffffff !important;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd !important;
    }
</style>


<table width="600px">
    <thead>
    <tr>
        <th style="width: 50px">Student ID</th>
        <th style="width: 290px;">Student Name</th>
        <th style="width: 80px;">Batch</th>
        <th style="width: 100px;">Intake</th>
        <th style="width: 250px;">Program</th>
        <th>Installment</th>
        <th>Payment Method</th>
        <th>Amount</th>
        <th>Discount</th>
        <th>Paid Amount</th>
        <th style="width: 80px;">Payment Status</th>
    </tr>

    </thead>
    <tbody>
<?php
    foreach ($student_data as $data) { ?>
        <tr>
            <td><?php echo $data->student_id; ?></td>
            <td><?php echo $data->st_full_name; ?></td>
            <td>Batch <?php echo $data->batch_name; ?></td>
            <td><?php echo $data->intake_name; ?>-<?php echo $data->year; ?></td>
            <td><?php echo $data->program_name; ?></td>
            <td><?php echo $data->installment; ?></td>
            <td><?php echo $data->payment_method; ?></td>
            <td><?php echo $data->price; ?></td>
            <td><?php echo $data->price2; ?></td>
            <td><?php echo $data->price3; ?></td>
            <td><?php if ($data->payment_status==1){echo "Complete Payment";}elseif ($data->payment_status==1){ echo "Partial Payment";}else{ echo "Avoid Late Payment";}; ?></td>
        </tr>
        <?php
    }
?>
    </tbody>

</table>
