<table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
        <th class="all" style="width: 5%;">#</th>
        <th class="all" >Course</th>
        <th class="all" style="width: 20%">Enrolled Students</th>
        <th class="all" style="width: 20%">Total Commision(USD)</th>
        </tr>
    </thead>
    <tbody id="module_data_id">
        <?php
        $count =1;

         foreach ($course_details as $course_data) { ?>
        <tr>
            <td><?php echo $count;  ?></td>
            <td><?php echo '['.$course_data->code.']'.$course_data->name;  ?></td>
            <td></td>
            <td></td>
        </tr>
    <?php $count++; } ?>

    </tbody>
</table>