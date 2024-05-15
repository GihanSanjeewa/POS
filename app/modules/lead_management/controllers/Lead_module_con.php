<?php

class Lead_module_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lead_module_mod', 'lead_mod');
        $this->load->library('form_validation');
        $this->load->library('grocery_CRUD');
        $this->load->library('excel');
        $this->table = "lead_module";
        $this->load->library('system_log');


        $this->load->library('kcrud');
        if (!$this->ion_auth->logged_in()) {

            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = $this->lead_mod->get_title();
        $data['industry'] = $this->lead_mod->get_industry();
        $data['lead_source'] = $this->lead_mod->get_lead_source();
        $data['lead_type'] = $this->lead_mod->get_lead_type();
        $data['deal'] = $this->lead_mod->get_deal();
        $data['product'] = $this->lead_mod->get_product();
        $data['lead_update_status'] = $this->lead_mod->lead_update_status();



        $this->load->view('common/header');
        $this->load->view('lead_module_view', $data);
        $this->load->view('common/footer');
    }

    public function save()
    {

        $this->form_validation->set_rules("title", "Title ", "trim|required");
        $this->form_validation->set_rules("f_name", "First Name", "trim|required");
        $this->form_validation->set_rules("l_name", "Last Name", "trim|required");
        $this->form_validation->set_rules("filter_email", "Email", "trim|required");

        $this->form_validation->set_rules("industry", "Industry", "trim|required");
        $this->form_validation->set_rules("deal", "Deal", "trim|required");
        $this->form_validation->set_rules("product", "Product", "trim|required");
        $this->form_validation->set_rules("filter_mobile", "Mobile Number", "trim|required");

        $this->form_validation->set_rules("l_source", "Lead Source", "trim|required");
        $this->form_validation->set_rules("lead_type", "Lead Type", "trim|required");

        if ($this->form_validation->run() == false) {

            $data = array();
            $data["error"] = array();
            $data["input_error"] = array();
            $data["status"] = FALSE;

            if (form_error("title")) {

                $data["input_error"][] = "title";
                $data["error_string"][] = form_error("title");
            }
            if (form_error("f_name")) {

                $data["input_error"][] = "f_name";
                $data["error_string"][] = form_error("f_name");
            }

            if (form_error("l_name")) {

                $data["input_error"][] = "l_name";
                $data["error_string"][] = form_error("l_name");
            }

            if (form_error("filter_email")) {

                $data["input_error"][] = "filter_email";
                $data["error_string"][] = form_error("filter_email");
            }

            if (form_error("industry")) {

                $data["input_error"][] = "industry";
                $data["error_string"][] = form_error("industry");
            }

            if (form_error("deal")) {

                $data["input_error"][] = "deal";
                $data["error_string"][] = form_error("deal");
            }
            if (form_error("product")) {

                $data["input_error"][] = "product";
                $data["error_string"][] = form_error("product");
            }
            if (form_error("filter_mobile")) {

                $data["input_error"][] = "filter_mobile";
                $data["error_string"][] = form_error("filter_mobile");
            }
            if (form_error("l_source")) {

                $data["input_error"][] = "l_source";
                $data["error_string"][] = form_error("l_source");
            }
            if (form_error("lead_type")) {

                $data["input_error"][] = "lead_type";
                $data["error_string"][] = form_error("lead_type");
            }

            echo json_encode($data);
            exit();
        } else {

            $val = $this->input->post();
            $data = array(
                'title' => $val['title'],
                'f_name' => $val['f_name'],
                'l_name' => $val['l_name'],
                'filter_email' => $val['filter_email'],
                'industry' => $val['industry'],
                'deal' => $val['deal'],
                'product' => $val['product'],
                'filter_mobile' => $val['filter_mobile'],
                'l_source' => $val['l_source'],
                'address' => $val['address'],
                'company' => $val['company'],
                'lead_type' => $val['lead_type'],
                'discription' => $val['discription'],
            );

            if ($insert_id = $this->db->insert('lead_module', $data)) {

                $data1 = array(
                    'lead_id' => $insert_id,
                    'lead_status' => '1',
                    'user_id' => USER_ID,
                );

                $this->db->insert('lead_module_details', $data1);

                echo json_encode(array('status' => TRUE, 'message' => 'Lead Module Added Successfully !'));
            } else {
                echo json_encode(array('status' => FALSE, 'message' => 'Sorry, Lead Module Added Failed !'));
            }
        }
    }

    public function get_all_leads()
    {
        $this->load->library('datatables');

        $this->datatables->select("
        lead_module.id,
        CONCAT(asms_m_lead_title.name,'',lead_module.f_name, ' ',lead_module.l_name) AS customer_name,
        filter_email,
        filter_mobile,
        asms_m_lead_source.source_title,
        asms_m_industry.name AS industry_name,
        asms_m_deal.name AS deal_name,
        asms_m_product.name product_name,
        asms_m_lead_type.name AS lead_type_name,        
        address,
        company,        
        discription,        
        CONCAT(lead_status_master.name,' (',lead_status_master.presentage,'%)'),
        lead_module.created_at,
        lead_module.updated_at ,
        lead_module.id AS sub_id,
            ", FALSE);

        $this->datatables->from('lead_module');
        $this->datatables->join('asms_m_lead_title', 'asms_m_lead_title.id=lead_module.title', 'left');
        $this->datatables->join('asms_m_industry', 'asms_m_industry.id=lead_module.industry', 'left');
        $this->datatables->join('asms_m_deal', 'asms_m_deal.id=lead_module.deal', 'left');
        $this->datatables->join('asms_m_product', 'asms_m_product.id=lead_module.product', 'left');
        $this->datatables->join('asms_m_lead_source', 'asms_m_lead_source.id=lead_module.l_source', 'left');
        $this->datatables->join('asms_m_lead_type', 'asms_m_lead_type.id=lead_module.lead_type', 'left');
        $this->datatables->join('lead_status_master', 'lead_status_master.id=lead_module.lead_status', 'left');
        $this->datatables->add_column(
            "Actions",
            "<a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='View' onclick='view_lead(" . '$1' . ");'>
                <i class='fa fa-list'></i> View
            </a>
            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Status' onclick='update_lead_status(" . '$1' . ");'>
                <i class='fa fa-check-square-o'></i> Status
            </a>
            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Edit' onclick='edit_lead(" . '$1' . ");'>
                <i class='fa fa-edit'></i> Edit
            </a>",
            "sub_id"
        );
        $this->datatables->unset_column('sub_id');
        echo $this->datatables->generate();
    }

    public function update()
    {
        $this->form_validation->set_rules("title", "Title ", "trim|required");
        $this->form_validation->set_rules("f_name", "First Name", "trim|required");
        $this->form_validation->set_rules("l_name", "Last Name", "trim|required");
        $this->form_validation->set_rules("filter_email", "Email", "trim|required");

        $this->form_validation->set_rules("industry", "Industry", "trim|required");
        $this->form_validation->set_rules("deal", "Deal", "trim|required");
        $this->form_validation->set_rules("product", "Product", "trim|required");
        $this->form_validation->set_rules("filter_mobile", "Mobile Number", "trim|required");

        $this->form_validation->set_rules("l_source", "Lead Source", "trim|required");
        $this->form_validation->set_rules("lead_type", "Lead Type", "trim|required");

        if ($this->form_validation->run() == false) {

            $data = array();
            $data["error"] = array();
            $data["input_error"] = array();
            $data["status"] = FALSE;

            if (form_error("title")) {
                $data["input_error"][] = "title";
                $data["error_string"][] = form_error("title");
            }
            if (form_error("f_name")) {
                $data["input_error"][] = "f_name";
                $data["error_string"][] = form_error("f_name");
            }

            if (form_error("l_name")) {
                $data["input_error"][] = "l_name";
                $data["error_string"][] = form_error("l_name");
            }

            if (form_error("filter_email")) {
                $data["input_error"][] = "filter_email";
                $data["error_string"][] = form_error("filter_email");
            }

            if (form_error("industry")) {
                $data["input_error"][] = "industry";
                $data["error_string"][] = form_error("industry");
            }

            if (form_error("deal")) {
                $data["input_error"][] = "deal";
                $data["error_string"][] = form_error("deal");
            }
            if (form_error("product")) {
                $data["input_error"][] = "product";
                $data["error_string"][] = form_error("product");
            }
            if (form_error("filter_mobile")) {
                $data["input_error"][] = "filter_mobile";
                $data["error_string"][] = form_error("filter_mobile");
            }
            if (form_error("l_source")) {
                $data["input_error"][] = "l_source";
                $data["error_string"][] = form_error("l_source");
            }
            if (form_error("lead_type")) {
                $data["input_error"][] = "lead_type";
                $data["error_string"][] = form_error("lead_type");
            }

            echo json_encode($data);
            exit();
        } else {
            $val = $this->input->post();

            $data = array(
                'title' => $val['title'],
                'f_name' => $val['f_name'],
                'l_name' => $val['l_name'],
                'filter_email' => $val['filter_email'],
                'industry' => $val['industry'],
                'deal' => $val['deal'],
                'product' => $val['product'],
                'filter_mobile' => $val['filter_mobile'],
                'l_source' => $val['l_source'],
                'address' => $val['address'],
                'company' => $val['company'],
                'lead_type' => $val['lead_type'],
                'discription' => $val['discription'],
            );
            if ($this->kcrud->update("lead_module", $data, array('id' => $val['inq_id']))) {

                echo json_encode(array('status' => TRUE, 'message' => 'Lead Module Updated Successfully !'));
                $this->system_log->create_system_log("Lead Module", "Success", "Lead Module Updated Successfully ");
            } else {
                echo json_encode(array('status' => FALSE, 'message' => 'Sorry, Lead Module Updated Failed !'));
                $this->system_log->create_system_log("Lead Module", "Failed", "Lead Module Updated failed ");
            }
        }
    }

    public function get_lead()
    {
        $val = $this->input->post();
        $select = "*";
        $where = $this->table . ".id=" . $val['id'];
        $lead = $this->kcrud->getValueOne($this->table, $select, $where, null, null, null, null);
        echo json_encode(array('lead' => $lead));
    }

    public function view_history($id)
    {
        $data = $this->lead_mod->view_history($id);
        echo json_encode(array('histories' => $data));
    }

    public function update_status()
    {

        $this->form_validation->set_rules("lead_status", "Lead Status ", "trim|required");

        if ($this->form_validation->run() == false) {

            $data = array();
            $data["error"] = array();
            $data["input_error"] = array();
            $data["status"] = FALSE;

            if (form_error("lead_status")) {

                $data["input_error"][] = "lead_status";
                $data["error_string"][] = form_error("lead_status");
            }


            echo json_encode($data);
            exit();
        } else {

            $val = $this->input->post();

            //check selected status already exists
            $count = $this->lead_mod->check_leads_status_already_exists($val['lead_status'], $val['update_id']);

            if ($count == 0) {

                $data = array(
                    'lead_id' => $val['update_id'],
                    'lead_status' => $val['lead_status'],
                    'next_contact_date' => $val['next_date'],
                    'next_contact_time' => $val['next_time'],
                    'remarks' => $val['remarks'],
                    'user_id' => USER_ID,
                );

                if ($this->db->insert('lead_module_details', $data)) {

                    $upate_data = array(
                        'lead_status' => $val['lead_status']
                    );

                    $this->kcrud->update("lead_module", $upate_data, array('id' => $val['update_id']));


                    echo json_encode(array('status' => TRUE, 'message' => 'Lead Module Histroy Updated Successfully !'));
                    $this->system_log->create_system_log("Lead Module", "Success", "Lead Module Updated Successfully ");
                } else {
                    echo json_encode(array('status' => FALSE, 'message' => 'Sorry, Lead Module Histroy Updated Failed !'));
                    $this->system_log->create_system_log("Lead Module", "Failed", "Lead Module Updated failed ");
                }
            } else {
                echo json_encode(array('status' => FALSE, 'message' => 'Sorry, Lead Status Already Updated !'));
            }
        }
    }

    public function get_lead_status_data($id)
    {

        $data = $this->lead_mod->get_lead_status_data($id);
        // var_dump($data);
        // die();
        echo json_encode(array('lead_status' => $data));
    }
}
