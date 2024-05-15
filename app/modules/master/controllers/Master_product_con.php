<?php 

class Master_product_con extends CI_Controller
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

        $this->load->model('Master_product_mod','product_mod');
        $this->load->library('kcrud');
        $this->table="asms_m_product";
        $this->load->library('system_log');
    }

    public function index()
    {
        $meta['title']="Product - Master";
        $this->load->view('common/header',$meta);
        $this->load->view("master_product");

        $this->load->view('common/footer');
    }

    public function industries_list(){

        $select="asms_m_product.id,code,name,asms_m_product.id AS sub_id";
        $action="<a href='javascript:;' onclick='edit_product(".'$1'.")'><i class='fa fa-pencil' title='Edit product'></i></a>&nbsp;
        <a href='javascript:;' onclick='view_product(".'$1'.")'><i class='fa fa-eye' title='View product'></i></a>&nbsp;";
        $unset_column="sub_id";
        $action_column="sub_id";
        $this->kcrud->getDatatableInfo($select,$this->table,null,null,$action,$unset_column,$action_column);
    }

    public function get_product(){
        $val=$this->input->post();
        $select="id,code,name";
        $where=$this->table.".id=".$val['id'];
        $product=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('product'=>$product));
    }

    public function save(){

        $this->form_validation->set_rules("code","Code","trim|required|is_unique[asms_m_product.code]");
        $this->form_validation->set_rules("name","Name","trim|required[asms_m_product.name ]");
        

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

                echo json_encode(array('status'=>TRUE,'message'=>'New Product added successfully !'));
                $this->system_log->create_system_log("Master - Product", "Success", "New Product added #" . $insert_id);
            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'New Product add Failed !'));
                 $this->system_log->create_system_log("Master - Product", "Success", "New Product added failed #" . $insert_id);

            }
        }
        
    }

    public function update(){

        $val = $this->input->post();
        $pr_id = $val['id'];
        $q1 = $this->db->query("SELECT *  FROM asms_m_product WHERE id ='$pr_id'");
        $data = $q1->row();

        $original_code_value = $data->code;
        $original_name_value = $data->name;
        if($val['code'] != $original_code_value) {
            $is_code_unique =  '|is_unique[asms_m_product.code]';
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

                echo json_encode(array('status'=>TRUE,'message'=>'product updated successfully !'));
                $this->system_log->create_system_log("Master - Product", "Success", "Product Updated #" . $insert_id);
            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'product updated Failed !'));
                $this->system_log->create_system_log("Master - Product", "Success", "Product Updated Failed #" . $insert_id);
            }
        }
    }


    public function view_product($id){

        $select="id,code,name";
        $where=$this->table.".id=".$id;
        $product=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('product'=>$product));

    }
}