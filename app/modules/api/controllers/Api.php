<?php

require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->library('system_log');

        ini_set('display_errors', 0);
        error_reporting(0);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function batches_get($id = 0)
    {
        if(!empty($id)){
            $data = $this->db->get_where("asms_m_batches", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("asms_m_batches")->result();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function intakes_get($id = 0)
    {
        if(!empty($id)){
            $data = $this->db->get_where("asms_m_batch_intakes", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("asms_m_batch_intakes")->result();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function programs_get($id = 0)
    {
        if(!empty($id)){
            $data = $this->db->get_where("asms_m_programs", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("asms_m_programs")->result();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('asms_students_register ',$input);

        $insert_id = $this->db->insert_id();

        $this->system_log->create_system_log("Student Register", "Success", "Student added successfully by API. Student ID #" . $insert_id);

        $this->response(['New Student Successfully Added.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    /*public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('auth_users', $input, array('id'=>$id));

        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }*/

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    /*public function index_delete($id)
    {
        $this->db->delete('auth_users', array('id'=>$id));

        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }*/

}