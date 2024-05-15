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

        text-align: left;
        background-color: #132675;
        color: white;
    }

</style>


<table id="students">
    <thead>
    <tr>
        <th>#</th>
        <th>COURSE NAME</th>
        <th>INTAKE</th>
        <th>INTAKE YEAR</th>
        <th>BARNCHES</th>
        <th>START DATE</th>
        <th>END DATE</th>
        <th>STATUS</th>

    </tr>

    </thead>
    <tbody>
    <?php
    $count=1;
    foreach ($intake_data as $data) { ?>
        <tr>
            <td><?php echo $count; $count++;?></td>
            <td><?php echo $data->COURSE_NAME; ?></td>
            <td><?php echo $data->INTAKE; ?></td>
            <td><?php echo $data->YEAR; ?></td>
            <td><?php echo $data->BRANCHES; ?></td>
            <td><?php echo $data->START_DATE; ?></td>
            <td><?php echo $data->END_DATE; ?></td>
            <td> <?php $Cstatus=$data->ST;
                if($Cstatus=="1"){
                echo "ACTIVE";
                }
                else if ($Cstatus=="0"){
                echo "INACTIVE";
                } ?></td>



        </tr>
        <?php
    }
    ?>
    </tbody>

</table>
