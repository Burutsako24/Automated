<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class SchoolAPI extends REST_Controller {
    public $dada;
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get()
	{
        try {
            $this->load->model('SchoolModel');
            $this->load->helper("security"); 
            $stream = $this->security->xss_clean( $this->input->raw_input_stream );
            $data = json_decode(trim($stream), true);
            if(!empty($data["id"])){
                $id = $data["id"];
                $data = $this->SchoolModel->getbyID($id);
            }else if(!empty($data["search"])){
                $search = $data["search"];
                $data = $this->SchoolModel->getbySearch($search);
            }else{
                $data = $this->SchoolModel->getAll();
            }
            $msg = array("Status"=>"success", "Message"=>"","data"=>$data);
            $this->response($msg, REST_Controller::HTTP_OK);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            $msg = array("Status"=>"error", "Message"=>$e->getMessage());
            $this->response($msg, REST_Controller::HTTP_OK);
        }
        
	}
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        try {
            $this->load->model('SchoolModel');
            $this->load->helper("security"); 
            $stream = $this->security->xss_clean( $this->input->raw_input_stream );
            $data = json_decode(trim($stream), true);
            if(!empty($data["SID"]) && !empty($data["Name"])){
                $ststus = $this->SchoolModel->insert($data);
                $msg = array("Status"=>$ststus["Status"], "Message"=>$ststus["Message"],"data"=>array());
            }else{
                $msg = array("Status"=>"error", "Message"=>"Data is not complete","data"=>array());
            }
            $this->response($msg, REST_Controller::HTTP_OK);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            $msg = array("Status"=>"error", "Message"=>$e->getMessage());
            $this->response($msg, REST_Controller::HTTP_OK);
        }
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put()
    {
        try {
            $this->load->model('SchoolModel');
            $this->load->helper("security"); 
            $stream = $this->security->xss_clean( $this->input->raw_input_stream );
            $data = json_decode(trim($stream), true);
            if(!empty($data["SID"]) && !empty($data["Name"])){
                $ststus = $this->SchoolModel->update($data);
                $msg = array("Status"=>$ststus["Status"], "Message"=>$ststus["Message"],"data"=>array());
            }else{
                $msg = array("Status"=>"error", "Message"=>"Data is not complete","data"=>array());
            }
            $this->response($msg, REST_Controller::HTTP_OK);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            $msg = array("Status"=>"error", "Message"=>$e->getMessage());
            $this->response($msg, REST_Controller::HTTP_OK);
        }
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete()
    {
        try {
            $this->load->model('SchoolModel');
            $this->load->helper("security"); 
            $stream = $this->security->xss_clean( $this->input->raw_input_stream );
            $data = json_decode(trim($stream), true);
            if(!empty($data["SID"])){
                $ststus = $this->SchoolModel->delete($data);
                $msg = array("Status"=>$ststus["Status"], "Message"=>$ststus["Message"],"data"=>array());
            }else{
                $msg = array("Status"=>"error", "Message"=>"Data is not complete","data"=>array());
            }
            $this->response($msg, REST_Controller::HTTP_OK);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            $msg = array("Status"=>"error", "Message"=>$e->getMessage());
            $this->response($msg, REST_Controller::HTTP_OK);
        }
    }
    	
}