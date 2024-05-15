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


<table>
    <thead>
    <tr>
        <th style="width: 50px">Student ID</th>
        <th style="width: 290px;">Student Name</th>
        <th>Batch</th>
        <th>Intake</th>
        <th>Program</th>
        <th>Gender</th>
        <th>NIC/Passport</th>
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
            <td><?php echo $data->st_gender; ?></td>
            <td><?php echo $data->st_nic_num; ?></td>
        </tr>
        <?php
    }
?>
    </tbody>

</table>
