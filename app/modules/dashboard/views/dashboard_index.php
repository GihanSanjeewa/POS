<style>
    .m-widget4 .m-widget4__item {
        display: table;
        padding-top: 0.012rem;
        padding-bottom: 0.25rem;
    }
</style>

<?php


?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h6 class="text-themecolor">Dashboard & Statistics</h6>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
    <?php
    $message = $this->session->flashdata('message');
    if(!empty($message))
    {
        if($message == "access_denied")
        {
            ?>
            <div class="alert alert-danger"><?php echo "You are not authorized to access this page."; ?></div>
            <?php
        }
    }
    ?>
</div>


<div id="hr">
    <div class="row">
        <div class="col-md-12">
            <div class="element-wrapper">
                <div class="element-content">
                    <div class="row">
                        <?php $groups=array('admin','department'); if ($this->ion_auth->in_group($groups)) { ?>
                            <div class="col-sm-3 col-xxxl-3">
                                <!-- <a class="element-box el-tablo cta-w cta-with-media purple dashboard-stat" href="<?php echo base_url('students/students_con');?>">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="cta-content">
                                                <h3 class="cta-header">
                                                    Student Management
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </a> -->
                            </div>
                            <div class="col-sm-3 col-xxxl-3">
                                <!-- <a class="element-box el-tablo cta-w cta-with-media purple dashboard-stat" href="<?php echo site_url('attendance/attendance_con'); ?>">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <i class="fa fa-calendar-check-o"></i>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="cta-content">
                                                <h3 class="cta-header">
                                                    Attendance Management
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </a> -->
                            </div>
                            <div class="col-sm-3 col-xxxl-3">
                                <!-- <a class="element-box el-tablo cta-w cta-with-media purple dashboard-stat" href="<?php echo base_url('exam/exam_eligible_con');?>">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="cta-content">
                                                <h3 class="cta-header">
                                                    Exam Management
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </a> -->
                            </div>
                            <div class="col-sm-3 col-xxxl-3">
                                <!-- <a class="element-box el-tablo cta-w cta-with-media purple dashboard-stat" href="<?php echo base_url('payments/payments_con');?>">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="cta-content">
                                                <h3 class="cta-header">
                                                    Payment Management
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </a> -->
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
            <div class="col-md-6">
            <div class="element-wrapper">
                <div class="element-actions">
                </div>

                <div class="card-header bg-purple">
                    <h4 class="card-title  text-white" style="display: inline-block"> Achivement Vs Target</h4>
                </div>
                <div class="element-box" style="height: 380px;max-height: 380px; overflow-y: scroll">
                   <!--  <div class="element-box"  style="height: 280px;max-height: 280px; overflow-y: scroll"> -->
                <div class="row">
                    <div class="col-md-6">
                        <select name="counseller_info" id="counseller_info" class="form-control selectpicker" data-live-search="true" tabindex="-98" data-trigger="change" data-required="true">
                            <option value="">--Select Counselor--</option>

                            <?php

                            foreach ($counselor_list as $counselor_data) { ?>

                                <option value="<?php echo $counselor_data->id ?>"><?php echo $counselor_data->name ?></option>
                               
                            <?php }


                             ?>
                                                  
                        </select>
                    </div>

                    <div class="col-md-6">
                          <div class="element-actions">
                            <?php
                            $d = new DateTime('first day of this month');
                            $from_date= $d->format('Y-m-d');
                            $last= $d->format('Y-m-d');
                            $to_date=date('Y-m-d', strtotime($last. ' + 1 month'));
                            ?>

                            <input type="hidden" id="from_date" name="from_date" value="<?php echo $from_date; ?>">
                            <input type="hidden" id="to_date" name="to_date"  value="<?php echo $to_date; ?>">
                            <div id="dashboard-report-range" class="btn btn-sm pull-left" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range" style=" background: #d46c20;color: #fff; margin-top: 10px;">
                                <i class="icon-calendar"></i>Period :
                                <span class="new thin uppercase hidden-xs"></span>&nbsp;
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                    <div id="chartContainer4">
                        <canvas id="pieChart4"></canvas>
                    </div>
                </div>
         
            </div>
        </div>

        <div class="col-md-6">
            <div class="element-wrapper">
                <div class="element-actions">
                </div>
                <!--<h6 class="element-header">

                </h6>-->
                <div class="card-header bg-info">
                    <h4 class="card-title  text-white" style="display: inline-block"> Total Inquiry</h4>
                </div>

              
                <div class="element-box" style="height: 380px;max-height: 380px; overflow-y: scroll">
                       <div class="row">

                         <div class="col-md-6"></div>
                   
                    <div class="col-md-6">
                          <div class="element-actions">
                            <?php
                            $d = new DateTime('first day of this month');
                            $from_date= $d->format('Y-m-d');
                            $last= $d->format('Y-m-d');
                            $to_date=date('Y-m-d', strtotime($last. ' + 1 month'));
                            ?>

                            <input type="hidden" id="from_date_2" name="from_date_2" value="<?php echo $from_date; ?>">
                            <input type="hidden" id="to_date_2" name="to_date_2"  value="<?php echo $to_date; ?>">
                            <div id="dashboard-report-range_2" class="btn btn-sm pull-left" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range" style=" background: #d46c20;color: #fff; margin-top: 10px;">
                                <i class="icon-calendar"></i>Period :
                                <span class="new thin uppercase hidden-xs"></span>&nbsp;
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
             <!--         <div class="element-box"  style="height: 280px;max-height: 280px; overflow-y: scroll"> -->
                      <div id="chartContainer5">
                        <canvas id="pieChart5"></canvas>
                    </div>
                </div>
            </div>
        </div>



    <!-- <?php $groups=array('admin','department','dataentry'); if ($this->ion_auth->in_group($groups)) { ?>
        <div class="col-md-6">
            <div class="element-wrapper">
                <div class="element-actions">
                </div>
                <div class="card-header bg-cyan">
                    <h4 class="card-title  text-white" style="display: inline-block"> Upcoming Birthday</h4>
                </div>
                <div class="element-box" style='background-image: url("<?php echo base_url(''); ?>assets/images/background/birthday.png");'>
                    <div class="m-widget4" style="height: 234px;max-height: 234px; overflow-y: scroll">
                        
                        <?php


                        foreach($bday as $b){

                            for($i=0; $i<count($b); $i++) {

                                $tod = new DateTime('today');
                                $tom = new DateTime('tomorrow');
                                $today = $tod->format('m-d');
                                $tomorrow = $tom->format('m-d');

                                if ($b[$i]->bday == $today) {
                                    $bday = 'Today';
                                } else if ($b[$i]->bday == $tomorrow) {
                                    $bday = 'Tomorrow';
                                } else {
                                    $date = new DateTime();
                                    $Y = $date->format('Y');
                                    $bday = $b[$i]->bday;
                                }

                                $empphotodata = $this->dash_mod->get_employee_photo_details_by_id($b[$i]->id);
                                ?>
                                <div class="m-widget4__item" style="border-bottom: 2px silver">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        <img src="<?php echo base_url(''); ?>uploads/user_photos/<?php echo $empphotodata->photo; ?>"
                                             alt="employee" alt=""
                                             style="border-radius: 50%;border-style: none;width: 40px;">
                                    </div>
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                            <?php echo $b[$i]->name; ?>
                                            </span>
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#"
                                           class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary"><?php echo $bday ?></a>
                                    </div>
                                </div>
                                <?php

                            }
                        }?>
                        <div id="load_birthdays" class="mt-actions">
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    <?php } ?> -->
    <?php $groups=array('admin','department','dataentry'); if ($this->ion_auth->in_group($groups)) { ?>
        <div class="col-md-6">
            <div class="element-wrapper">
                <div class="element-actions">
                </div>
                <div class="card-header bg-cyan">
                    <h4 class="card-title  text-white" style="display: inline-block"> Batches</h4>
                </div>
                <div class="element-box"  style="height: 280px;max-height: 280px; overflow-y: scroll">
                    <div id="chartContainer1">
                        <canvas id="pieChart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $groups=array('admin','department'); if ($this->ion_auth->in_group($groups)) { ?>
        <div class="col-md-6">
            <div class="element-wrapper">
                <div class="element-actions">
                </div>

                <div class="card-header bg-purple">
                    <h4 class="card-title  text-white" style="display: inline-block"> Last 07 Days Attendance</h4>
                </div>
                <div class="element-box"  style="height: 280px;max-height: 280px; overflow-y: scroll">
                    <div id="chartContainer2">
                        <canvas id="pieChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php  } ?>
    <?php $groups=array('admin','department'); if ($this->ion_auth->in_group($groups)) { ?>
        <div class="col-md-6">
            <div class="element-wrapper">
                <div class="element-actions">
                </div>
                <!--<h6 class="element-header">

                </h6>-->
                <div class="card-header bg-info">
                    <h4 class="card-title  text-white" style="display: inline-block"> Class</h4>
                </div>
                <div class="element-box"  style="height: 280px;max-height: 280px; overflow-y: scroll">
                    <div id="chartContainer3">
                        <canvas id="lev_monthly"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</div>
</div>

<script src="<?php echo base_url(); ?>assets/js/charts/chart.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/charts/chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/charts/chart.PieceLabel.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {

          $('#dashboard-report-range').daterangepicker({
                "ranges": {
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')]
                }
            }, function(start, end, label) {
                var start_date = start.format('YYYY-MM-DD'), end_date = end.format('YYYY-MM-DD');
                $('#dashboard-report-range span').html(start_date + ' - ' + end_date);
                $('#from_date').val(start_date);
                $('#to_date').val(end_date);
                //showBirthdays(start_date, end_date, label);
                //getAttendance(start, end, label, showAttendance);
                // load_attenedance();
                load_agent_targets();


            });
           


        var myChartMData4 = {
            type: 'bar',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'Target',
                        data: [],
                        fill: false,
                        backgroundColor: '#4965fb',
                        borderColor: '#4965fb',
                        borderWidth: 1
                    },
                    {
                        label: 'Achivement',
                        data: [],
                        fill: false,
                        backgroundColor: '#fd8035',
                        borderColor: '#fd8035',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: ''
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Target Count'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Agent Achivement Vs Target'
                }
            }
        };

        document.getElementById("chartContainer4").innerHTML = '&nbsp;';
        document.getElementById("chartContainer4").innerHTML = '<canvas id="PieChart4"></canvas>';
        var ctx = document.getElementById("PieChart4").getContext('2d');
        window.myBarCM = new Chart(ctx, myChartMData4);



           $('#dashboard-report-range_2').daterangepicker({
                "ranges": {
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')]
                }
            }, function(start, end, label) {
                var start_date = start.format('YYYY-MM-DD'), end_date = end.format('YYYY-MM-DD');
                $('#dashboard-report-range_2 span').html(start_date + ' - ' + end_date);
                $('#from_date_2').val(start_date);
                $('#to_date_2').val(end_date);
                //showBirthdays(start_date, end_date, label);
                //getAttendance(start, end, label, showAttendance);
                // load_attenedance();
                total_inquiry();


            });
           


        var myChartMData5 = {
            type: 'bar',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'Inquiry',
                        data: [],
                        fill: false,
                        backgroundColor: '#4965fb',
                        borderColor: '#4965fb',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Counselor'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Inquiry Count'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Total Inquiry'
                }
            }
        };

        document.getElementById("chartContainer5").innerHTML = '&nbsp;';
        document.getElementById("chartContainer5").innerHTML = '<canvas id="PieChart5"></canvas>';
        var ctx = document.getElementById("PieChart5").getContext('2d');
        window.myBarCM = new Chart(ctx, myChartMData5);



        // ----------------------------------------------------------------------------------

        var myChartMData1 = {
            type: 'bar',
            data: {
                labels: [<?php echo $batch_name; ?>],
                datasets: [
                    {
                        label: 'Students',
                        data: [<?php echo $student_count; ?>],
                        fill: false,
                        backgroundColor: [<?php echo $batch_color; ?>],
                        borderColor: [<?php echo $batch_color; ?>],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Student Count'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Student Count In Batch'
                }
            }
        };

        document.getElementById("chartContainer1").innerHTML = '&nbsp;';
        document.getElementById("chartContainer1").innerHTML = '<canvas id="PieChart1"></canvas>';
        var ctx1 = document.getElementById("PieChart1").getContext('2d');
        window.myBarCM = new Chart(ctx1, myChartMData1);


        var myChartMData = {
            type: 'bar',
            data: {
                labels: [<?php echo $dates; ?>],
                datasets: [
                    {
                        label: 'Present',
                        data: [<?php echo $present; ?>],
                        fill: false,
                        backgroundColor: '#96d277',
                        borderColor: '#96d277',
                        borderWidth: 1
                    },
                    {
                        label: 'Absent',
                        data: [<?php echo $absent; ?>],
                        fill: false,
                        backgroundColor: '#f71b14',
                        borderColor: '#f7202b',
                        borderWidth: 1
                    },
                    {
                        label: 'Medical',
                        data: [<?php echo $medical; ?>],
                        fill: false,
                        backgroundColor: '#1d8af7',
                        borderColor: '#288bf7',
                        borderWidth: 1
                    },
                    {
                        label: 'Other',
                        data: [<?php echo $other; ?>],
                        fill: false,
                        backgroundColor: '#f740e5',
                        borderColor: '#e33bf7',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Student Count'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Student Attendance Chart'
                }
            }
        };

        document.getElementById("chartContainer2").innerHTML = '&nbsp;';
        document.getElementById("chartContainer2").innerHTML = '<canvas id="PieChart2"></canvas>';
        var ctx = document.getElementById("PieChart2").getContext('2d');
        window.myBarCM = new Chart(ctx, myChartMData);


        var myChartMData3 = {
            type: 'bar',
            data: {
                labels: [<?php echo $classes_str; ?>],
                datasets: [
                    {
                        label: 'Actual Capacity',
                        data: [<?php echo $actual_capacity; ?>],
                        fill: false,
                        backgroundColor: '#96d277',
                        borderColor: '#96d277',
                        borderWidth: 1
                    },
                    {
                        label: 'Available Capacity',
                        data: [<?php echo $available_capacity; ?>],
                        fill: false,
                        backgroundColor: '#42ccf7',
                        borderColor: '#3dbff7',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Class Allocation'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Student Attendance Chart'
                }
            }
        };

        document.getElementById("chartContainer3").innerHTML = '&nbsp;';
        document.getElementById("chartContainer3").innerHTML = '<canvas id="PieChart3"></canvas>';
        var ctx = document.getElementById("PieChart3").getContext('2d');
        window.myBarCM = new Chart(ctx, myChartMData3);

    });


    function load_agent_targets(){
                                            
        var counseller_id = $('#counseller_info').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        var new_data = '';
        var new_data_l = '';

                $.ajax({
                        url: '<?php echo base_url('dashboard/get_achivement_list'); ?>',
                        type: 'post',
                        dataType: "JSON",
                        data: {
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                            "id": counseller_id,"from_date":from_date,"to_date":to_date,
                        },
                        success: function(data_nw) {                     

                            var myChartMData4 = {
                                type: 'bar',
                                data: {
                                    labels: data_nw.programm,
                                    datasets: [
                                        {
                                            label: 'Target',
                                            data: data_nw.target,
                                            fill: false,
                                            backgroundColor: '#4965fb',
                                            borderColor: '#4965fb',
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Achivement',
                                            data: data_nw.target_counselor,
                                            fill: false,
                                            backgroundColor: '#fd8035',
                                            borderColor: '#fd8035',
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        xAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Program Details'
                                            }
                                        }],
                                        yAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Target Count'
                                            },
                                            ticks: {
                                                beginAtZero: true,
                                                userCallback: function (label, index, labels) {
                                                    if (Math.floor(label) === label) {
                                                        return label;
                                                    }

                                                },
                                            }
                                        }]
                                    },
                                    responsive: true,
                                    legend: {
                                        position: 'top'
                                    },
                                    title: {
                                        display: true,
                                        text: 'Agent Achivement Vs Target'
                                    }
                                }
                            };

                            document.getElementById("chartContainer4").innerHTML = '&nbsp;';
                            document.getElementById("chartContainer4").innerHTML = '<canvas id="PieChart4"></canvas>';
                            var ctx = document.getElementById("PieChart4").getContext('2d');
                            window.myBarCM = new Chart(ctx, myChartMData4);

                        }

                    });

    }



        function total_inquiry(){                                            

        var from_date = $('#from_date_2').val();
        var to_date = $('#to_date_2').val();

                $.ajax({
                        url: '<?php echo base_url('dashboard/get_total_inquiry_list'); ?>',
                        type: 'post',
                        dataType: "JSON",
                        data: {
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                            "from_date":from_date,"to_date":to_date,
                        },
                        success: function(data_nw) {     
                            
                            var myChartMData5 = {
                                type: 'bar',
                                data: {
                                    labels: data_nw.counselor_name,
                                    datasets: [
                                        {
                                            label: 'Inquiry',
                                            data: data_nw.target_counselor,
                                            fill: false,
                                            backgroundColor: '#4965fb',
                                            borderColor: '#4965fb',
                                            borderWidth: 0
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        xAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Counselor'
                                            }
                                        }],
                                        yAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Inquiry Count'
                                            },
                                            ticks: {
                                                beginAtZero: true,
                                                userCallback: function (label, index, labels) {
                                                    if (Math.floor(label) === label) {
                                                        return label;
                                                    }

                                                },
                                            }
                                        }]
                                    },
                                    responsive: true,
                                    legend: {
                                        position: 'top'
                                    },
                                    title: {
                                        display: true,
                                        text: 'Total Inquiry'
                                    }
                                }
                            };

                            document.getElementById("chartContainer5").innerHTML = '&nbsp;';
                            document.getElementById("chartContainer5").innerHTML = '<canvas id="PieChart5"></canvas>';
                            var ctx = document.getElementById("PieChart5").getContext('2d');
                            window.myBarCM = new Chart(ctx, myChartMData5);

                        }

                    });

    }



</script>