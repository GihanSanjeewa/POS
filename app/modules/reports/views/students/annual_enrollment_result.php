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
        <th>STUDENT ID</th>
        <th>STUDENT NAME</th>
        <th>BARNCHES</th>
        <th>BATCH</th>
        <th>INTAKE</th>
        <th>PROGRAMME</th>
        <th>YEAR</th>

    </tr>

    </thead>
    <tbody>
    <?php
    $count=1;
    foreach ($annual_data as $data) {

        ?>
        <tr>
            <td><?php echo $count;  $count++; ?></td>
            <td><?php echo $data->ID; ?></td>
            <td><?php echo $data->NAME; ?></td>
            <td><?php echo $data->BRANCH; ?></td>
            <td><?php echo $data->BATCH; ?></td>
            <td><?php echo $data->intake; ?></td>
            <td><?php echo $data->PROGRAMME; ?></td>
            <td><?php echo $data->YEAR; ?></td>



        </tr>
        <?php
    }
    ?>
    </tbody>

</table>
