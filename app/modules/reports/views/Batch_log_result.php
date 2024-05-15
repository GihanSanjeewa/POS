<style>
    /* table {
        font-family: arial, sans-serif !important;
        border-collapse: collapse;
        width: 100%;
        text-align:left;
        align: center;
    }
    th {
        font-weight: bolder !important;
        border: 1px solid #132675 !important;
        background-color: #132675 !important;
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
    } */
    #students {
        font-family: arial, sans-serif !important;
        border-collapse: collapse;
        width: 100%;
        text-align:left;
        align: center;
    }
    #students td, #students th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #students tr:nth-child(even){background-color: #f2f2f2;}
    #students tr:hover {background-color: #ddd;}
    #students th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #132675;
        color: white;
    }

</style>


<table id="students">
    <thead>
    <tr>
        <th>#</th>
        <th style="width: 290px;">Branch Name</th>
        <th style="width: 50px">Batch CODE</th>
        <th style="width: 290px;">Course Name</th>
        <th style="width: 290px;">Started Date</th>

    </tr>

    </thead>
    <tbody>
    <?php
    $count=1;
    foreach ($payment_data as $data) {

        ?>
        <tr>
            <td><?php echo $count;  $count++; ?></td>
            <td><?php echo $data->NAME; ?></td>
            <td><?php echo $data->CODE; ?></td>
            <td><?php echo $data->PRG; ?></td>
            <td><?php echo $data->START; ?></td>



        </tr>
        <?php
    }
    ?>
    </tbody>

</table>
