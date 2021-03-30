<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function login()
    {
        if($this->input->post('login'))
        {
            $email=$this->input->post('email');
            $password=$this->input->post('pass');
            
            // API key
            $apiKey = 'CODEX@123';

            // API auth credentials
            $apiUser = "admin";
            $apiPass = "1234";

            // API URL
            $url = 'http://localhost/itd62-276/CES/index.php/authentication/login';

            // User account login info
            $userData = array(
                'email' => $email,
                'password' => $password
            );

            // Create a new cURL resource
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $apiKey));
            curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);

            $result = curl_exec($ch);
            print_r($result);

            // Close cURL resource
            curl_close($ch);	
        }
        $this->load->view('login',@$data);	
    }
    function dashboard()
    {
        $this->load->view('dashboard');
    }
    
}
?>