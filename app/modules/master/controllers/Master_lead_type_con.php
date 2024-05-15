<?php

class Master_lead_type_con extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if(!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->load->model('Master_lead_type_mod','lead_mod');
        $this->load->library('kcrud');
        $this->table="asms_m_lead_type";
        $this->load->library('system_log');
    }
    public function index()
    { 
        $meta['title']="Lead Type - Master";
        $this->load->view('common/header',$meta);
        $this->load->view("master_lead_type");
        $this->load->view('common/footer');
    }
    

    public function leades_list(){

        $select="asms_m_lead_type.id,code,name,quentity ,asms_m_lead_type.id AS sub_id";
        $action="<a href='javascript:;' onclick='edit_lead(".'$1'.")'><i class='fa fa-pencil' title='Edit lead'></i></a>&nbsp;
        <a href='javascript:;' onclick='view_lead(".'$1'.")'><i class='fa fa-eye' title='View lead'></i></a>&nbsp;";
        $unset_column="sub_id";
        $action_column="sub_id";
        $this->kcrud->getDatatableInfo($select,$this->table,null,null,$action,$unset_column,$action_column);
    }

    public function get_lead(){
        $val=$this->input->post();
        $select="id,code,name,quentity ";
        $where=$this->table.".id=".$val['id'];
        $lead=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('lead'=>$lead));
    }

    public function save(){

        $this->form_validation->set_rules("code","Code","trim|required|is_unique[asms_m_lead_type.code]");
        $this->form_validation->set_rules("name","Name","trim|required[asms_m_lead_type.name ]");
        $this->form_validation->set_rules("quentity","Quentity","trim|required|numeric[asms_m_lead_type.quentity ]");
        

        if($this->form_validation->run() == false){

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;

            if(form_error("code")){

                $data["input_error"][] ="code";
                $data["error_string"][]=form_error("code");
            }
            if(form_error("name")){

                $data["input_error"][] ="name";
                $data["error_string"][]=form_error("name");
            }
            if(form_error("quentity")){

                $data["input_error"][] ="quentity";
                $data["error_string"][]=form_error("quentity");
            }

            echo json_encode($data);
            exit();
        }
        else{

            $val=$this->input->post();
            
            $data=array(
                'code'=>$val['code'],
                'name'=>$val['name'],
                'quentity'=>$val['quentity']
            );

            if($insert_id=$this->kcrud->save($this->table,$data)){

                echo json_encode(array('status'=>TRUE,'message'=>'Lead Type added successfully !'));
                $this->system_log->create_system_log("Master - Lead Type", "Success", "New Lead Type added #" . $insert_id);
            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'Lead Type add Failed !'));
                $this->system_log->create_system_log("Master - Lead Type", "Failed", "New Lead Type added failed ");

            }
        }

        
    }

    public function update(){

        $val = $this->input->post();
        $pr_id = $val['id'];
        $q1 = $this->db->query("SELECT *  FROM asms_m_lead_type WHERE id ='$pr_id'");
        $data = $q1->row();

        $original_code_value = $data->code;
        $original_name_value = $data->name ;
        if($val['code'] != $original_code_value) {
            $is_code_unique =  '|is_unique[asms_m_lead_type.code]';
        } else {
            $is_code_unique =  '';
        }
        
        $this->form_validation->set_rules('code', 'Code', 'trim|required' . $is_code_unique);
        $this->form_validation->set_rules('name', 'Name', 'trim|required' );
        $this->form_validation->set_rules('quentity', 'Quentity', 'trim|required|numeric' );


        if($this->form_validation->run() == false){

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;

            if(form_error("code")){

                $data["input_error"][] ="code";
                $data["error_string"][]=form_error("code");
            }
            if(form_error("name")){

                $data["input_error"][] ="name";
                $data["error_string"][]=form_error("name");
            }
            if(form_error("quentity")){

                $data["input_error"][] ="quentity";
                $data["error_string"][]=form_error("quentity");
            }

            echo json_encode($data);
            exit();
        }
        else{

           $val=$this->input->post();

            $data=array(
                'code'=>$val['code'],
                'name '=>$val['name'],
                'quentity'=>$val['quentity']
            );

            if($insert_id=$this->kcrud->update($this->table,$data,array('id'=>$val['id']))){

                echo json_encode(array('status'=>TRUE,'message'=>'Lead updated successfully !'));
                $this->system_log->create_system_log("Master - Lead Type", "Success", "Lead Type Updated #" . $insert_id);

            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'Lead updated Failed !'));
                $this->system_log->create_system_log("Master - Lead Type", "Failed", "Lead Type Updated failed ");
            }
        }
    }


    public function view_lead($id){

        // var_dump($id);
        // die();
        $select="id,code,name,quentity ";

        $where=$this->table.".id=".$id;
        $lead=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('lead'=>$lead));

    }

}