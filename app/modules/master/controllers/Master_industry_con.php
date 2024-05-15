<?php 

class Master_industry_con extends CI_Controller
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

        $this->load->model('Master_industry_mod','industry_mod');
        $this->load->library('kcrud');
        $this->table="asms_m_industry";
        $this->load->library('system_log');
    }

    public function index()
    {
        $meta['title']="Industry - Master";
        $this->load->view('common/header',$meta);
        $this->load->view("master_industry");

        $this->load->view('common/footer');
    }

    public function industries_list(){

        $select="asms_m_industry.id,code,name,asms_m_industry.id AS sub_id";
        $action="<a href='javascript:;' onclick='edit_industry(".'$1'.")'><i class='fa fa-pencil' title='Edit industry'></i></a>&nbsp;
        <a href='javascript:;' onclick='view_industry(".'$1'.")'><i class='fa fa-eye' title='View industry'></i></a>&nbsp;";
        $unset_column="sub_id";
        $action_column="sub_id";
        $this->kcrud->getDatatableInfo($select,$this->table,null,null,$action,$unset_column,$action_column);
    }

    public function get_industry(){
        $val=$this->input->post();
        $select="id,code,name";
        $where=$this->table.".id=".$val['id'];
        $industry=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('industry'=>$industry));
    }

    public function save(){

        $this->form_validation->set_rules("code","Code","trim|required|is_unique[asms_m_industry.code]");
        $this->form_validation->set_rules("name","Name","trim|required[asms_m_industry.name ]");
        

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

            echo json_encode($data);
            exit();
        }
        else{

            $val=$this->input->post();
            
            $data=array(
                'code'=>$val['code'],
                'name'=>$val['name']
            );

            if($insert_id=$this->kcrud->save($this->table,$data)){

                echo json_encode(array('status'=>TRUE,'message'=>'industry added successfully !'));
                $this->system_log->create_system_log("Master - industry", "Success", "New industry added #" . $insert_id);
            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'industry add Failed !'));
                $this->system_log->create_system_log("Master - industry", "Failed", "New industry added failed ");

            }
        }
        
    }

    public function update(){

        $val = $this->input->post();
        $pr_id = $val['id'];
        $q1 = $this->db->query("SELECT *  FROM asms_m_industry WHERE id ='$pr_id'");
        $data = $q1->row();

        $original_code_value = $data->code;
        $original_name_value = $data->name;
        if($val['code'] != $original_code_value) {
            $is_code_unique =  '|is_unique[asms_m_industry.code]';
        } else {
            $is_code_unique =  '';
        }
       
        $this->form_validation->set_rules('code', 'Code', 'trim|required' . $is_code_unique);
        $this->form_validation->set_rules('name', 'name', 'trim|required' );

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

            echo json_encode($data);
            exit();
        }
        else{

           $val=$this->input->post();

            $data=array(
                'code'=>$val['code'],
                'name'=>$val['name']
            );

            if($insert_id=$this->kcrud->update($this->table,$data,array('id'=>$val['id']))){

                echo json_encode(array('status'=>TRUE,'message'=>'industry updated successfully !'));
                $this->system_log->create_system_log("Master - industry", "Success", "industry Updated #" . $insert_id);
            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'industry updated Failed !'));
                $this->system_log->create_system_log("Master - industry", "Failed", "industry Updated failed ");
            }
        }
    }


    public function view_industry($id){

        $select="id,code,name";
        $where=$this->table.".id=".$id;
        $industry=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('industry'=>$industry));

    }
}