<?php


class Reports_student_mod extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('datatables');
    }
    

    

    public function get_batches(){
        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $this->db->order_by("asms_m_batches.id", "DESC");
        $query=$this->db->get();
        return $query->result();
    }
    public function get_intakes(){
        $this->db->select('asms_m_batch_intakes.id,asms_m_intakes_list.intake_name,asms_m_batch_intakes.year');
        $this->db->from('asms_m_batch_intakes');
        $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->db->order_by("asms_m_batch_intakes.id", "DESC");
        $query=$this->db->get();
        return $query->result();
    }
    public function get_programs(){
        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $this->db->order_by("asms_m_programs.id", "DESC");
        $query=$this->db->get();
        return $query->result();
    }
    public function get_universities(){
        $this->db->select('*');
        $this->db->from('asms_m_universities');
        $this->db->order_by("asms_m_universities.id", "DESC");
        $query=$this->db->get();
        return $query->result();
    }
    public function get_students(){
        $this->db->select('*');
        $this->db->from('asms_students_register');
        $this->db->order_by("asms_students_register.id", "DESC");
        $query=$this->db->get();
        return $query->result();
    }
    public function get_paymentPlans(){
        $this->db->select('*');
        $this->db->from('asms_payments_plan');
        $this->db->order_by("asms_payments_plan.id", "DESC");
        $query=$this->db->get();
        return $query->result();
    }
    public function checkStudentInfo($where){
        $query=$this->db->query("
SELECT
asms_m_intakes_list.intake_name,
asms_m_batch_intakes.year,
asms_m_batches.id AS batch_name,
asms_m_programs.name AS program_name,
asms_students_register.*
FROM 
asms_students_register 
LEFT JOIN asms_m_batches ON asms_m_batches.id=asms_students_register.batch
LEFT JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id=asms_students_register.intake
LEFT JOIN asms_m_intakes_list ON asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id
LEFT JOIN asms_m_programs ON asms_m_programs.id=asms_students_register.programe
WHERE ".$where);
        return $query->result();
    }
    public function checkStudentPayment($where){
        $query=$this->db->query("
SELECT 
asms_students_register.student_id,
asms_students_register.st_full_name,
asms_students_register.batch AS batch_name,
asms_m_intakes_list.intake_name,
asms_m_batch_intakes.year,
asms_m_programs.name AS program_name,
asms_program_fee_details.installment,
CONCAT(asms_payments_accounts.bank_name, ' (', asms_payments_accounts.account_type,'-',asms_payments_accounts.account_no, ' )') AS payment_method,
CONCAT(asms_currencies.symbol, ' ', asms_payments.amount) AS price,
CONCAT(asms_currencies.symbol, ' ', asms_payments.discount_amount, '(',discount_rate, '%)') AS price2,
CONCAT(asms_currencies.symbol, ' ', (asms_payments.amount-asms_payments.discount_amount)) AS price3,
asms_payments.payment_status
FROM 
asms_payments
LEFT JOIN asms_students_register ON asms_students_register.id=asms_payments.student_id
LEFT JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id=asms_students_register.intake
LEFT JOIN asms_m_intakes_list ON asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id
LEFT JOIN asms_m_programs ON asms_m_programs.id=asms_payments.program_id
LEFT JOIN asms_program_fee_details ON asms_program_fee_details.id=asms_payments.installment_id
LEFT JOIN asms_payments_accounts ON asms_payments_accounts.id=asms_payments.payment_method_account_id
LEFT JOIN asms_currencies ON asms_currencies.id=asms_payments.currency_id
WHERE".$where);
        return $query->result();
    }




}