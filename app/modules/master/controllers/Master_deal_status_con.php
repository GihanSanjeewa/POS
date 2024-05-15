<?php 

class Master_deal_status_con extends CI_Controller
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

        $this->load->model('Master_deal_status_mod','deal_mod');
        $this->load->library('kcrud');
        $this->table="asms_m_deal";
        $this->load->library('system_log');
    }

    public function index()
    {
        $meta['title']="Deal - Master";
        $this->load->view('common/header',$meta);
        $this->load->view("master_deal");

        $this->load->view('common/footer');
    }

    public function industries_list(){

        $select="asms_m_deal.id,code,name,asms_m_deal.id AS sub_id";
        $action="<a href='javascript:;' onclick='edit_deal(".'$1'.")'><i class='fa fa-pencil' title='Edit deal'></i></a>&nbsp;
        <a href='javascript:;' onclick='view_deal(".'$1'.")'><i class='fa fa-eye' title='View deal'></i></a>&nbsp;";
        $unset_column="sub_id";
        $action_column="sub_id";
        $this->kcrud->getDatatableInfo($select,$this->table,null,null,$action,$unset_column,$action_column);
        
    }

    public function get_deal(){
        $val=$this->input->post();
        $select="id,code,name";
        $where=$this->table.".id=".$val['id'];
        $deal=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('deal'=>$deal));
    }

    public function save(){

        $this->form_validation->set_rules("code","Code","trim|required|is_unique[asms_m_deal.code]");
        $this->form_validation->set_rules("name","Name","trim|required[asms_m_deal.name ]");
        

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

                echo json_encode(array('status'=>TRUE,'message'=>'Deal added successfully !'));
                $this->system_log->create_system_log("Master - Deal", "Success", "New Deal added #" . $insert_id);
            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'Deal add Failed !'));
                $this->system_log->create_system_log("Master - Deal", "Failed", "New Deal added failed ");

            }
        }

        

        
    }

    public function update(){

        $val = $this->input->post();
        $pr_id = $val['id'];
        $q1 = $this->db->query("SELECT *  FROM asms_m_deal WHERE id ='$pr_id'");
        $data = $q1->row();

        $original_code_value = $data->code;
        $original_name_value = $data->name;
        if($val['code'] != $original_code_value) {
            $is_code_unique =  '|is_unique[asms_m_deal.code]';
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

           // $val=$this->input->post();

            $data=array(
                'code'=>$val['code'],
                'name'=>$val['name']
            );

            if($insert_id=$this->kcrud->update($this->table,$data,array('id'=>$val['id']))){

                echo json_encode(array('status'=>TRUE,'message'=>'deal updated successfully !'));
                $this->system_log->create_system_log("Master - Deal", "Success", " Deal Updated #" . $insert_id);
            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'deal updated Failed !'));
                $this->system_log->create_system_log("Master - Deal", "Failed", "Deal Updated failed ");
            }
        }
    }


    public function view_deal($id){

        $select="id,code,name";
        $where=$this->table.".id=".$id;
        $deal=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('deal'=>$deal));

    }
}