<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 9/27/2019
 * Time: 10:10 AM
 */

class Lead_con extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->model('Lead_mod','class_mod');
        $this->load->library('form_validation');
              $this->load->library('grocery_CRUD');

        $this->load->library('kcrud');
        if(!$this->ion_auth->logged_in()){

            // redirect them to the login page
            redirect('auth/login', 'refresh');

        }

    }

    public function index(){

        $meta['title']="Lead Management";

        $data['program']=$this->class_mod->get_programes();
        $data['source']=$this->class_mod->get_master_lead_source();

        $this->load->view('common/header',$meta);
        $this->load->view('class_index',$data);
        $this->load->view('common/footer');
    }


     public function ass_submit(){

        $meta['title']="Submitted Assignmnet";

        $this->load->view('common/header',$meta);
        $this->load->view('ass_submit');
        $this->load->view('common/footer');
    }

       public function ass_view(){

        $meta['title']="View Assignment";


        $data['all_assign'] = $this->class_mod->get_all_ass_view();

        $this->load->view('common/header',$meta);
        $this->load->view('ass_view',$data);
        $this->load->view('common/footer');
    }

    public function classes_list(){

        $this->load->library('datatables');

        $this->datatables->select("
        lead_management.id as table_id,
        CONCAT(lead_management.first_name,' ',lead_management.last_name) as f_name,
        lead_management.date as l_date,
        asms_m_programs.name as p_name,
        lead_management.phone as l_phone,
        lead_management.email as l_email,
        employees.employee_id,
        lead_management.status_option,
        lead_management.next_call_date      
        ",FALSE);

        $this->datatables->from('lead_management');
        $this->datatables->join('employees','lead_management.lead_owner=employees.id','left');
        $this->datatables->join('asms_m_programs','lead_management.program=asms_m_programs.id','left');
        $this->datatables->join('asms_m_lead_source','lead_management.lead_source=asms_m_lead_source.id','left');
        $this->datatables->add_column("Actions","
        <a href='javascript:;' onclick='add_arrangement()'><i class='fa fa-plus' title='Edit Customer Details'></i></a>&nbsp;
         <a href='javascript:;' onclick='update_arrangement(" . '$1' . ")'><i class='fa fa-check' title='Update Status'></i></a>&nbsp;
        ","table_id");

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();

    }



    public function save(){

            $val=$this->input->post();

                $data=array(

                    'status_option'=>$val['lead_status'],
                    'remarks'=>$val['remarks'],    
                    'next_call_date'=>$val['next_date'],                
                    'update_person'=>USER_ID
                );          

                $this->db->where('id',$val['update_id']);
                if($this->db->update('lead_management',$data)){            
                echo json_encode(array('status'=>FALSE,'message'=>'Update Successfully !')); 
                }else{

                    echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Updated Was Not Successfully !')); 
                }
       
    }

    public function save_student(){

        $this->form_validation->set_rules("std_batch","Batch","trim|required");
        $this->form_validation->set_rules("student","Student","trim|required");
        $this->form_validation->set_rules("std_class","Class","trim|required");

        if($this->form_validation->run() == false){

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;

            if(form_error("std_batch")){

                $data["input_error"][] ="std_batch";
                $data["error_string"][]=form_error("std_batch");
            }
            if(form_error("student")){

                $data["input_error"][] ="student";
                $data["error_string"][]=form_error("student");
            }
            if(form_error("std_class")){

                $data["input_error"][] ="std_class";
                $data["error_string"][]=form_error("std_class");
            }

            echo json_encode($data);
            exit();

        }
        else{

            $val=$this->input->post();

            $where="batch=".$val['std_batch']." AND class=".$val['std_class'];

            $ref_id=$this->kcrud->getValueOne('asms_class_arrangement','id',$where,null,null,null,null)->id;
            $index_id=$this->kcrud->getValueOne('asms_class_allocation','id','arrange_ref_id='.$ref_id." AND status=0",null,null,null,null)->id;

            $data=array(

                'student'=>$val['student'],
                'status'=>1,
                'updated_at'=>date('Y-m-d H:i:s'),
                'user'=>USER_ID
            );

            $data1=array(
                'allocation_status'=>1,
                'allocated_date'=>date('Y-m-d h:i:s')
            );

            $data2=array(
                'status'=>1,
            );

            $this->kcrud->update('asms_class_allocation',$data,array('id'=>$index_id));
            $this->kcrud->update('asms_students_register',$data1,array('id'=>$val['student']));
            $this->kcrud->update('asms_class_arrangement',$data2,array('id'=>$ref_id));


            echo json_encode(array('status'=>TRUE,'message'=>'Class Arrangement successfully !'));
        }
    }

    public function view_class($id){

        $class=$this->class_mod->view_class($id);
        echo json_encode(array('class'=>$class));

    }

    public function delete_class($id){

        if($this->class_mod->get_list_by_id('asms_class_arrangement','*',array('id'=>$id,'status'=>0))){

            $this->class_mod->delete('asms_class_arrangement',array('id'=>$id,'status'=>0));
            $this->class_mod->delete('asms_class_allocation',array('arrange_ref_id'=>$id,'status'=>0));
            echo json_encode(array('status'=>TRUE));

        }
        else{

            echo json_encode(array('status'=>FALSE));

        }

    }

    public function delete_student($id){

        $where="id=".$id;

        $student=$this->kcrud->getValueOne('asms_class_allocation','student',$where,null,null,null,null)->student;

        $data=array(

            'student'=>0,
            'status'=>0
        );

        $data1=array(
            'allocation_status'=>0,
        );

        $this->kcrud->update('asms_class_allocation',$data,array('id'=>$id));
        $this->kcrud->update('asms_students_register',$data1,array('id'=>$student));
        echo json_encode(array('status'=>TRUE,'message'=>'Class Arrangement Deleted !'));
    }

    public function allocation_save()
    {
        $val = $this->input->post();

        $where0="batch=".$val['allocation_batch']." AND status=1 AND allocation_status=0";
        $where1="batch=".$val['allocation_batch']." AND student=0 AND status=0";

        $students=$this->kcrud->getValueAll("asms_students_register","id,st_gender AS gender,status",$where0,null,null,null,null);
        $classes=$this->kcrud->getValueAll("asms_class_allocation","id",$where1,null,null,null,null);

        $male_count=1;
        $female_count=2;

        $big_array=array();

        foreach($students as $std){

            if($std->gender == "Male"){

                $big_array[$male_count]=$std->id;
                $male_count=$male_count+2;

            }
            else if($std->gender == "Female"){
                $big_array[$female_count]=$std->id;
                $female_count=$female_count+2;
            }
        }

        ksort($big_array);

        $class_array=array();

        foreach ($classes as $cls){
            $class_array[]=$cls->id;
        }

        $x=0;
        foreach($big_array as $key1 => $arr1){

            if($arr1){

                $data1=array(
                    'status'=>1,
                    'student'=>$arr1,
                    'updated_at'=>date('Y-m-d h:i:s'),
                    'user'=>USER_ID
                );

                if($this->kcrud->update('asms_class_allocation',$data1,array('id'=>$class_array[$x]))){

                    $data2=array(
                        'allocation_status'=>1,
                        'allocated_date'=>date('Y-m-d h:i:s')
                    );

                   // $this->kcrud->update('asms_students_register',$data2,array('id'=>$arr1));

                }
            }

            $x++;
        }

        $where2="batch=".$val['allocation_batch']." AND status=1";
        $group2="GROUP BY arrange_ref_id";
        $arrangements=$this->kcrud->getValueAll("asms_class_allocation","arrange_ref_id",$where2,null,null,$group2,null);

        foreach ($arrangements as $arrange1){

            $data3=array(
                'status'=>1,
            );
            $this->kcrud->update('asms_class_arrangement',$data3,array('id'=>$arrange1->arrange_ref_id));
        }

        echo json_encode(array('status'=>TRUE,'message'=>'Class Allocation successfully !'));

    }


    public function reset_save()
    {
        $val = $this->input->post();

        $where1="batch=".$val['reset_batch']." AND status=1";
        $where2="batch=".$val['reset_batch']." AND status=1";
        $group2="GROUP BY arrange_ref_id";

        $classes=$this->kcrud->getValueAll("asms_class_allocation","id,student",$where1,null,null,null,null);
        $arrangements=$this->kcrud->getValueAll("asms_class_allocation","arrange_ref_id",$where2,null,null,$group2,null);

        foreach ($classes as $cls){

            $data2=array(
                'allocation_status'=>0
            );

            $data3=array(
                'status'=>0,
                'student'=>0
            );

            $this->kcrud->update('asms_students_register',$data2,array('id'=>$cls->student));
            $this->kcrud->update('asms_class_allocation',$data3,array('id'=>$cls->id));
        }

        foreach ($arrangements as $arrange1){

            $data3=array(
                'status'=>0,
            );
            $this->kcrud->update('asms_class_arrangement',$data3,array('id'=>$arrange1->arrange_ref_id));
        }

        echo json_encode(array('status'=>TRUE,'message'=>'Class Allocation successfully !'));

    }


    public function _master_output($output = null)
    {
        $this->load->view('master/master.php',$output);
    }


   public function create_lead_source()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_m_lead_source');
        $crud->set_subject('Master Lead Source');
        $crud->required_fields('source_title');
       
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        // $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }


}