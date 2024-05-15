<?php
/**
 * Created by Earrow.
 * User:NIPUN DE SILVA
 * Email:nipun@earrow.net
 * Date: 01/7/2021
 * Time: 3:32 PM
 */


class System_log_con extends CI_Controller{

    var $table;

    public function __construct(){

        parent::__construct();
        $this->load->library('form_validation');

        if(!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->load->library('kcrud');
        $this->table="auth_system_log";

    }

    public function index(){

        $meta['title']="System Log";

        $this->load->view('common/header',$meta);
        $this->load->view('settings/administration/system_log_index');
        $this->load->view('common/footer');

    }

    public function system_log(){

        $this->load->library('datatables');
        $this->datatables->select("
        auth_system_log.id,
        asms_users_info.name AS u_name,
        auth_system_log.ip_address,
        auth_system_log.date_time,
        auth_system_log.action,
        auth_system_log.status,
        auth_system_log.log_message,
        auth_system_log.id AS sub_id
        ",FALSE);

        $this->datatables->from("auth_system_log");
        $this->datatables->join("asms_users_info","asms_users_info.id=auth_system_log.user_id");
      //  $this->datatables->like('auth_system_log.date_time', '2021-02-12');
     //   $this->datatables->join("asms_m_branches","asms_m_branches.id=asms_m_halls.branch");
         
        $this->datatables->unset_column("sub_id");
        echo $this->datatables->generate();

    }
    public function system_log_search($date){

        $this->load->library('datatables');
        $this->datatables->select("
        auth_system_log.id,
        asms_users_info.name AS u_name,
        auth_system_log.ip_address,
        auth_system_log.date_time,
        auth_system_log.action,
        auth_system_log.status,
        auth_system_log.log_message,
        auth_system_log.id AS sub_id
        ",FALSE);

        $this->datatables->from("auth_system_log");
        $this->datatables->join("asms_users_info","asms_users_info.id=auth_system_log.user_id");
        $this->datatables->like('auth_system_log.date_time', $date);
     //   $this->datatables->join("asms_m_branches","asms_m_branches.id=asms_m_halls.branch");
         
        $this->datatables->unset_column("sub_id");
        echo $this->datatables->generate();

    }

    

    
 
  


}