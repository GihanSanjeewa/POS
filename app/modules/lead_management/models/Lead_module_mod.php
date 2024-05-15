<?php
class Lead_module_mod extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_title()
    {
        $query = $this->db->query("SELECT * FROM asms_m_lead_title");
        return $query->result();
    }
    public function get_industry()
    {
        $query = $this->db->query("SELECT * From asms_m_industry");
        return $query->result();
    }

    public function get_lead_source()
    {
        $query = $this->db->query("SELECT * FROM asms_m_lead_source");
        return $query->result();
    }

    public function get_lead_type()
    {
        $query = $this->db->query("SELECT * FROM asms_m_lead_type");
        return $query->result();
    }

    public function get_deal()
    {
        $query = $this->db->query("SELECT * FROM asms_m_deal");
        return $query->result();
    }

    public function get_product()
    {
        $query = $this->db->query("SELECT * FROM asms_m_product");
        return $query->result();
    }

    public function view_history($id)
    {
        $query = $this->db->query("SELECT 
        lead_module_details.*,
        asms_users_info.full_name,
        CONCAT(lead_status_master.name,' (',lead_status_master.presentage,'%)') Lead_status_details
        FROM lead_module_details
                
        -- LEFT JOIN asms_m_lead_title ON asms_m_lead_title.id=lead_module.tittle 
        -- LEFT JOIN asms_m_industry ON asms_m_industry.id=lead_module.industry 
        -- LEFT JOIN asms_m_deal ON asms_m_deal.id=lead_module.deal 
        -- LEFT JOIN asms_m_product ON asms_m_product.id=lead_module.product
        LEFT JOIN asms_users_info ON asms_users_info.id=lead_module_details.user_id
        LEFT JOIN lead_status_master ON lead_status_master.id=lead_module_details.lead_status 
        WHERE lead_module_details.lead_id = '$id' ORDER BY lead_module_details.id DESC");


        return $query->result();
    }

    public function get_lead_status_data($id)
    {
        $query = $this->db->query("SELECT * FROM lead_module where lead_module.id = '$id'");
        return $query->result();
    }

    public function lead_update_status()
    {
        $query = $this->db->query("SELECT * FROM lead_status_master ");
        return $query->result();
    }

    public function check_leads_status_already_exists($lead_status, $update_id)
    {
        $this->db->select('*');
        $this->db->from('lead_module_details');
        $this->db->where('lead_module_details.lead_status', $lead_status);
        $this->db->where('lead_module_details.lead_id', $update_id);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
