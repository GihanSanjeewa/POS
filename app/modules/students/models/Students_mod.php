<?php

class Students_mod extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function save($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    public function update($table,$data,$where){
        $this->db->update($table,$data,$where);
        return true;
    }

    public function delete($table,$where){
        $this->db->delete($table,$where);
        return true;
    }

    public function get_programs()
    {
        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query = $this->db->get();

        return $query->result();
    }
    public function get_acdemic_uni()
    {
        $this->db->select('*');
        $this->db->from('asms_academic_univeristies_lists');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_academic_types()
    {
        $this->db->select('id,type_name');
        $this->db->from('asms_academic_types');
        $this->db->where('asms_academic_types.status',"1");
        $query = $this->db->get();

        return $query->result();
    }

    public function get_batches()
    {
        $this->db->select('std.batch_id,asms_m_intakes_list.intake_name,std.year,std.intake_list_id,std.id');
        $this->db->from('asms_m_batch_intakes std');
        $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=std.intake_list_id','left');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_batches_program_wise($id)
    {
        $this->db->select('asms_m_batches.id,asms_m_batch_intakes.id AS intake_id,asms_m_batches.batch_code,asms_m_batches.name AS batch_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name');
        $this->db->from('asms_m_batch_intakes');
        $this->db->join('asms_m_batches','asms_m_batch_intakes.batch_id=asms_m_batches.id','left');
        $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->db->where('asms_m_batches.program_id', $id);
        $this->db->where('asms_m_batches.batch_status',"OPEN");
        $this->db->order_by('asms_m_batches.id', 'DESC');
        $query=$this->db->get();
        return $query->result();
//        $this->db->select('std.batch_id,asms_m_intakes_list.intake_name,std.year,std.intake_list_id,std.id');
//        $this->db->from('asms_m_batch_intakes std');
//        $this->db->where('asms_m_batches.program_id',$id);
//        $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=std.intake_list_id','left');
//        $query = $this->db->get();
//        return $query->result();
    }

    function get_last_student_number()
    {
        $this->db->select('id');
        $this->db->from('asms_students_register');
        $query=$this->db->get();

        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select("asms_students_register.*,CONCAT('(',asms_m_batches.batch_code,' )',asms_m_intakes_list.intake_name,'-',asms_m_batch_intakes.year)AS batch_data");
        $this->db->from('asms_students_register');
        $this->db->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_students_register.intake','left');
        $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
            $this->db->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->db->where('asms_students_register.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_student_photo_by_id($id)
    {
        $this->db->from('asms_students_photos');
        $this->db->where('student',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_student_photo_by_id_ajax($id)
    {
        $this->db->from('asms_students_photos');
        $this->db->where('student',$id);
        $query = $this->db->get();
        return $query;
    }

    public function get_student_documents_by_student_id($id)
    {
        $this->db->select('*');
        $this->db->from('asms_students_documents');
        $this->db->where('student',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id($id)
    {
        $this->db->select('std.id,asms_m_batches.name AS batch_name,std.student_id,std.title,std.full_name,std.name,std.address,std.phone,std.address2,std.occupation,std.office_address,std.birthday,std.st_nic_num AS nic_number,std.gender,std.race,std.religion,std.parents,std.educational,std.institutions,std.attended,std.admission,std.ol_result,std.al_result,std.awaiting,std.other,std.examination,std.address3,std.remarks,auth_users.first_name,std.created_at,std.updated_at,std.status');
        $this->db->from('asms_students_register std');
        $this->db->join('asms_m_batches','asms_m_batches.id=std.batch','left');
        $this->db->join('auth_users','auth_users.id=std.user','left');
        $this->db->where('std.id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function check_image_availability($std_id){
        $this->db->from('asms_students_photos');
        $this->db->where('student',$std_id);
        $query = $this->db->get();
        return $query;
    }

    public function get_programe_id($id)
    {
        $this->db->from('asms_m_programs');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_intakes($batch_id)
    {

        $this->db->select('std.batch_id,asms_m_intakes_list.intake_name,std.year,std.intake_list_id,std.id');
        $this->db->from('asms_m_batch_intakes std');
        $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=std.intake_list_id','left');
        $this->db->where('std.id',$batch_id);
        $query = $this->db->get_where('asms_m_batch_intakes');

        if ($query->result()) {
            foreach ($query->result() as $dt) {
                $dts[$dt->id.'-'.$dt->batch_id] = $dt->batch_id.'-'.$dt->intake_name.'-'.$dt->year;
            }
            return $dts;
        } else {
            return FALSE;
        }
    }

    public function get_view_programe($id)
    {
        $this->db->from('asms_m_programs');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_view_university($id)
    {
        $this->db->from('asms_m_universities');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    //nipun
    public function uni_data_pathway($id)
    {
        $check = array('pu.m_program_id'=>$id, 'pu.uni_type' => "Pathway");
        $this->db->select('pu.university_id,pu.uni_type,pu.local_st_val,uni.name');
        $this->db->from('asms_m_programs_universities pu');
        $this->db->join('asms_m_universities uni','uni.id=pu.university_id','left');
        $this->db->where('pu.m_program_id',$id);
        $this->db->group_by('pu.university_id');
        $query = $this->db->get();
        return $query->result();
    }
    public function uni_data_foreign($id)
    {

        $this->db->select('pu.university_id,pu.uni_type,pu.local_st_val,uni.name');
        $this->db->from('asms_m_programs_universities pu');
        $this->db->join('asms_m_universities uni','uni.id=pu.university_id','left');
        $this->db->where('pu.m_program_id',$id);
        $this->db->group_by('pu.university_id');
        $query = $this->db->get();
        return $query->result();
    }
    //end nipun


    public function get_uni_data_by_prog_id($id)
    {
        $this->db->select('pu.university_id,pu.uni_type,pu.local_st_val,uni.name');
        $this->db->from('asms_m_programs_universities pu');
        $this->db->join('asms_m_universities uni','uni.id=pu.university_id','left');
        $this->db->where('pu.m_program_id',$id);
        $this->db->group_by('pu.university_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_uni_data_by_uni_id($id,$program_id)
    {
        $check = array('university_id'=>$id, 'm_program_id' =>$program_id);
        $this->db->select('*');
        $this->db->from('asms_m_programs_universities');
        $this->db->where($check);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_view_batch($id)
    {
        $this->db->select('std.batch_id,asms_m_intakes_list.intake_name,std.year,std.intake_list_id');
        $this->db->from('asms_m_batch_intakes std');
        $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=std.intake_list_id','left');
        $this->db->where('std.id',$id);
        $query = $this->db->get(); 
        return $query->row();
    }

    public function get_view_intake($id)
    {
        $this->db->from('asms_m_batch_intakes');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_mark_max_disc($programe,$batch_id,$ntake){

        $this->db->from('asms_program_enrollment_details');
        $this->db->where(array('program_id'=>$programe,'batch_id'=>$batch_id,'intake_id'=>$ntake));
        $query = $this->db->get();
        return $query->row();

    }

    public function update_mark_max_disc($programe,$batch_id,$ntake,$data){
        $where = array('program_id'=>$programe,'batch_id'=>$batch_id,'intake_id'=>$ntake);
        $this->db->update('asms_program_enrollment_details',$data,$where);
        $query = $this->db->get();
        return $query->row();
    }


    public function get_last_att_id()
    {
        $this->db->select('asms_students_register.another_student_id');
        $this->db->from('asms_students_register');
        $this->db->where('asms_students_register.another_student_id!=','');
        $this->db->order_by('asms_students_register.id', 'DESC');
        $query=$this->db->get();
        return $query->row();

    }
    public function get_last_program_id_data($id)
    {
        $this->db->select('asms_students_register.student_id');
        $this->db->from('asms_students_register');
        $this->db->where('asms_students_register.programe=',$id);
        $this->db->where('asms_students_register.another_student_id!=','');
        $this->db->order_by('asms_students_register.id', 'DESC');
        $query=$this->db->get();
        return $query->row();

    }

}