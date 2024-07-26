<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Google\Client;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;




include_once APPPATH . 'libraries/vendor/autoload.php'; 

class Dashboard extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->helper(array('form', 'url', 'string'));
		$this->load->library(array('form_validation','session', 'upload', 'encryption', 'email'));
		$this->load->database();
                $this->load->model('upload_model'); 
                $this->load->model('User_model');
                $this->load->helper('download');
                $this->load->library('Google');



	}
       
	public function index()
	{            
        

                if($this->session->userdata('UserLoginSession')){
                        
                        $uid = $this->session->userdata('UserLoginSession');
                        $id=$uid['id'];
                        
                        // $role=$uid['role'];

                        $data['profiles']=$this->User_model->getbyid($id);
                        $data['logo_data']=$this->User_model->getall_logosettings();

                        // if($role=='Admin'){
                        $data['settings_data'] = $this->User_model->getSettings();

                        $this->load->view('templates/sidebar', $data);
                        $this->load->view('templates/header');
                        $this->load->view('profile_view', $data);
                        $this->load->view('templates/footer');
                        }
                        
                
                        else{
                        $data['title']="User Login Page";
                        $data['logo_data']=$this->User_model->getall_logosettings();

                        $this->load->view('login_view', $data);
                }

	}

       

        

        public function viewusers($filterrole=NULL){

                                // echo "<pre>";print_r($data['settings_data']);exit;


        
                if($filterrole !=NULL){
                        if($this->session->userdata('UserLoginSession')){
                                $uid = $this->session->userdata('UserLoginSession');
                                $id=$uid['id'];
                                $role=$uid['role'];
                                $data['filrole']=$filterrole;
                                if($role=='Admin' || $role=='Default Admin'){
                                $data['title']="List of Users";
                                $data['employees']=$this->User_model->getall();
                                $data['settings_data'] = $this->User_model->getSettings();
                                // $data['profiles']=$this->User_model->getbyid($id);
                                // echo "<pre>";print_r($data['employees']);exit;
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                $this->load->view('templates/sidebar', $data);
                                $this->load->view('templates/header');
                                $this->load->view('dashboard_view', $data);                        
                                $this->load->view('templates/footer');
                                }
                                else{
                                        redirect('dashboard/userdashborad');
        
                                }
                        }
                        else{
                                $data['title']="User Login Page";
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                $this->load->view('login_view', $data);
                        }
                }
                else{
                        //login from google-sign in
                        if($this->session->userdata('UserLoginSession')){
                                $uid = $this->session->userdata('UserLoginSession');
                                $id=$uid['id'];
                                $role=$uid['role'];
                                $data['filrole']="";
                                if($role=='Admin'  || $role=='Default Admin'){
                                $data['title']="List of Users";
                                $data['employees']=$this->User_model->getall();
                                // $data['profiles']=$this->User_model->getbyid($id);
                                $data['settings_data'] = $this->User_model->getSettings();
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                $this->load->view('templates/sidebar', $data);
                                $this->load->view('templates/header');
                                $this->load->view('dashboard_view', $data);                        
                                $this->load->view('templates/footer');
                                }
                                else{
                                        redirect('dashboard/userdashborad');
        
                                }
                        }
                        else{
                                $data['title']="User Login Page";
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                $this->load->view('login_view', $data);
                        }

                }
        }

        //Login method to call login view
        public function login(){

                $data['title']="User Login Page";
                $data['logo_data']=$this->User_model->getall_logosettings();

                $this->load->view('login_view', $data);
              
        }

        //Loginnow method to call checkpassword model
        public function loginnow()
        {
                          
                
                if($this->input->post('loginsubmit'))
                { 
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
                // $this->form_validation->set_rules('accept_terms', 'Check remember me', 'required');

		if ($this->form_validation->run()==true) {
			
			$email = $this->input->post('email');
                        $password = $this->input->post('password');
                        // $password =sha1($password);


                        $this->load->model('user_model');
                        $status=$this->User_model->checkpassword($email, $password);

                        if($status!=false)
                        {
                                
                                $id=$status->id;
                                $name=$status->name;
                                $mobile=$status->mobile;
                                $address=$status->address;
                                $email=$status->email;
                                $education=$status->education;
                                // $status=$status->status;
                                $role=$status->role;
                                $profpic=$status->profpic;


                                $datecreateon=$status->datecreateon;
                                $dateupdatedon=$status->dateupdatedon;

                                $this->db->where('username',$name);
                                $query = $this->db->get('access');
                                $res= $query->row();
                                $accesstypes=$res->accesstypes;

                                $accessbutton=$res->accessbutton;


                                // $accesstypes=

                                $session_data=array('id'=>$id, 'name'=>$name, 'email'=>$email,
                                'mobile'=>$mobile,'address'=>$address,'education'=>$education, 
                                'role'=>$role, 'profpic'=>$profpic, 'accesstypes'=>$accesstypes, 'accessbutton'=>$accessbutton, 'datecreateon'=>$datecreateon, 'dateupdatedon'=>$dateupdatedon,);
                                $this->session->set_userdata('UserLoginSession', $session_data);
                                
                               
                        
                               
                                        $this->load->model('User_model');
                                        $data['employees']=$this->User_model->getall();
                                        // $this->load->view('dashboard_view', $data);
                                        $uid = $this->session->userdata('UserLoginSession');
                                        $id=$uid['id'];
                                        $role=$uid['role'];
                                if($role=='Admin')
                                {
                                        
                                        // $this->load->view('templates/sidebar');
                                        // $this->load->view('templates/header');
                                        // $this->load->view('dashboard_view', $data);
                                        // $this->load->view('templates/footer');
                                        redirect('dashboard/generaldash');
                                        
                                }
                                else if($role=='HR')
                                {
                                        
                                        redirect('dashboard/generaldash');

                                }
                                else{
                                        redirect('dashboard/generaldash');
        
                                }
                                
                                
                        }
                        else
                        {
                                $this->session->set_flashdata('error', 'Check email or password is wrong/Contact admin you are inactive');
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                $this->load->view('login_view', $data);
                        }     
                }
                else
                {
                        $this->session->set_flashdata('error', 'Fill all the fields');
                        $data['logo_data']=$this->User_model->getall_logosettings();

                        $this->load->view('login_view', $data);
                } 
                       
                } 
                else{
                        
                        if($this->session->userdata('user_data')){
                                $usdata= $this->session->userdata('user_data');
                                $email = $usdata['email'];
                                $password = $usdata['password'];
                                // echo"<pre>";print_r($password);exit;
                                $this->load->model('user_model');
                        $status=$this->User_model->checkpassword($email, $password);
                        
                        if($status!=false)
                        {
                                $id=$status->id;
                                $name=$status->name;
                                $mobile=$status->mobile;
                                $address=$status->address;
                                $email=$status->email;
                                $education=$status->education;
                                // $status=$status->status;
                                $role=$status->role;
                                $profpic=$status->profpic;


                                $datecreateon=$status->datecreateon;
                                $dateupdatedon=$status->dateupdatedon;

                                $this->db->where('username',$name);
                                $query = $this->db->get('access');
                                $res= $query->row();
                                $accesstypes=$res->accesstypes;

                                $accessbutton=$res->accessbutton;


                                // $accesstypes=

                                $session_data=array('id'=>$id, 'name'=>$name, 'email'=>$email,
                                'mobile'=>$mobile,'address'=>$address,'education'=>$education, 
                                'role'=>$role, 'profpic'=>$profpic, 'accesstypes'=>$accesstypes, 'accessbutton'=>$accessbutton, 'datecreateon'=>$datecreateon, 'dateupdatedon'=>$dateupdatedon,);
                                $this->session->set_userdata('UserLoginSession', $session_data);
                                
                               
                        
                               
                                        $this->load->model('User_model');
                                        $data['employees']=$this->User_model->getall();
                                        
                                        // $this->load->view('dashboard_view', $data);
                                        $uid = $this->session->userdata('UserLoginSession');
                                        $id=$uid['id'];
                                        $role=$uid['role'];
                                if($role=='Admin')
                                {
                                        
                                        // $this->load->view('templates/sidebar');
                                        // $this->load->view('templates/header');
                                        // $this->load->view('dashboard_view', $data);
                                        // $this->load->view('templates/footer');
                                        redirect('dashboard/generaldash');
                                        
                                }
                                else if($role=='HR')
                                {
                                        
                                        redirect('dashboard/generaldash');

                                }
                                else{
                                        redirect('dashboard/generaldash');
        
                                }  
                        }
                        }
                }
                     
        }
                		
        //Logout method
        public function logout()
        {
                $this->session->sess_destroy();
                redirect('dashboard/login');
        }

        //Register method to call register view
        public function register()
	{            
                $data['title']="User Register";
                $data['logo_data']=$this->User_model->getall_logosettings();

                $this->load->view('register_view', $data);

	}

        //Register method to call registernow model
        public function registernow()
	{                       
                // if($this->input->post('registersubmit'))
                if($_SERVER['REQUEST_METHOD']=='POST')
                {       
                        $this->form_validation->set_rules('name', 'Name', 'required');
                        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
                        $this->form_validation->set_rules('password', 'Password', 'required');
        
                        if ($this->form_validation->run()==true)
                        {

                                $name = $this->input->post('name');
                                $email = $this->input->post('email');
                                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                                
                               
                                $data=array(
                                        'name'=>$name,
                                        'email'=>$email,
                                        'password'=>$password,
                                        'status'=>'Active',
                                );
                                
                                // Check for email presence;
                                $query = $this->db->query("SELECT * FROM user WHERE email='$email'");

                                if($query->num_rows()>0)
                                {
                                        $this->session->set_flashdata('error', 'Email already presnted in db check with alternate');
                                        $this->load->view('register_view');
                                }
                                else
                                {
                                        $this->load->model('user_model');
                                        $status=$this->User_model->insertuser($data);
                                        $this->session->set_flashdata('success', 'Register successfully!');

                                        redirect('dashboard/login');
                                }

                               
                        }
                        else
                        {
                                $this->session->set_flashdata('error', 'Check email or password is wrong');
                                $this->load->view('register_view'); 
                        } 
                }
	
        }

        //Forgot Password Method to Call forgot_password view
        public function forgot_password()
        {

                $data['title']="Password Sending";
                $data['logo_data']=$this->User_model->getall_logosettings();

                $this->load->view('forgot_password', $data);
               
        }
//send_password method to call getUserByEmail check for user presence and send new password

//send_password method to call getUserByEmail check for user presence and send new password
public function send_password()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Check email');
            $data['logo_data']=$this->User_model->getall_logosettings();

            $this->load->view('forgot_password', $data);
        } else {
            $email = $this->input->post('email');
            $this->load->model('User_model');

            if ($user = $this->User_model->getUserByEmail($email)) {
                // CodeIgniter version
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'ssl://smtp.gmail.com'; // smtp host name
                $config['smtp_port'] = '465'; // smtp port number

                $config['smtp_timeout'] = '7';
                $config['smtp_user'] = 'nivas609@gmail.com';
                $config['smtp_pass'] = "xqob zwhn snwt rleo"; // $from_email password
                $config['charset'] = "utf-8";
                $config['newline'] = "\r\n"; // use double quotes
                $config['mailtype'] = "html";
                $config['validation'] = TRUE;
                $this->email->initialize($config);

                // send mail
                $this->email->from('nivas609@gmail.com', 'ADMIN');
                $this->email->to($email);
                $this->email->subject('New Password Send');
                $this->email->set_mailtype("html");

                // $message =  '<!DOCTYPE html>
                // <html>
                
                // <head>
                //   <title>Your Email Subject</title>
                // </head>
                
                // <body>
                
                //   <p align="justify"><span style="font-family: arial, helvetica, sans-serif; font-size: 10pt;">Dear Sir/Mdm,</span></p>
                //   <p align="justify"><span style="font-family: arial, helvetica, sans-serif; font-size: 10pt;"><strong>A.&nbsp; &nbsp; &nbsp;<u>Annual Filing for Foreign Companies &ndash; Financial reporting obligations</u></strong><u></u></span></p>
                //   <p align="justify"><span style="font-family: arial, helvetica, sans-serif; font-size: 10pt;">Any notification in respect of the above has to be made not later than 30 days from the occurrence of the relevant change or event, failing which, the ACRA may impose penalty for non-compliance.</span></p>                
                //   <p align="justify"><span style="font-size: 10pt; font-family: arial, helvetica, sans-serif;">Best Regards</span></p>
                //   <p align="justify"><span style="font-family: arial, helvetica, sans-serif; font-size: 10pt;">Corporate Services Group<br /><span style="color: #ff0000;"><strong>E</strong></span> <a href="mailto:allcorporatesecretarialsg@rajahtann.com">allcorporatesecretarialsg@rajahtann.com</a> <span style="color: #ff0000;"><strong>T </strong></span>+65 6535 3600</span></p>
                
                //   <!-- Other closing paragraphs -->
                
                // </body>
                
                // </html>
                
                // ';

                // $this->email->message($message);

                $this->email->message('Your new password is: ' . $user->password);
                $this->email->set_mailtype("html");

                // Try to send the email
                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'Password sent!');
                    $data['logo_data']=$this->User_model->getall_logosettings();

                    $this->load->view('login_view', $data);
                } else {
                    $this->session->set_flashdata('error', 'Email could not be sent.');
                    $data['logo_data']=$this->User_model->getall_logosettings();

                    $this->load->view('forgot_password', $data);
                }
            } else {
                $this->session->set_flashdata('error', 'No user with this email exists!');
                $data['logo_data']=$this->User_model->getall_logosettings();

                $this->load->view('forgot_password', $data);
            }
        }
    }
}


        //change_password method to call change_password_form view
        public function change_password()
        {
                
                $data['title']="User Password Change";

                if($this->session->userdata('UserLoginSession'))
                {
                        
                        // $id = $this->session->userdata('UserLoginSession');
                        // $role=$id['role'];
                        // if($role=='Admin')
                        // {
                        $data['settings_data'] = $this->User_model->getSettings();
                        $data['logo_data']=$this->User_model->getall_logosettings();

                        $this->load->view('templates/sidebar', $data);
                        $this->load->view('templates/header');
                        $this->load->view('change_password_form', $data);
                        $this->load->view('templates/footer');
                        // }
                        // else
                        // {
                        //         $this->load->view('templates/header');
                        //         $this->load->view('change_password_form', $data);
                        //         $this->load->view('templates/footer');   
                        // }
                }
                else
                {
                        redirect('dashboard/login');
                }
        }

        
        //change_password method to call oldPasswordMatches to match existing email in db and update using changeUserPassword models
        public function update_password()
        {

                if($_SERVER['REQUEST_METHOD']=='POST')
                {
              
                $this->form_validation->set_rules('old_password','Old Password','required');
                $this->form_validation->set_rules('new_password','New Password','required');
                $this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[new_password]');               

                        if($this->form_validation->run()==FALSE)
                        {
                                $this->load->view('change_password_form');
                        }
                        else
                        {
                        $old_password = $this->input->post('old_password');
                        $new_password = $this->input->post('new_password');
                        
                           if(strcmp($old_password, $new_password)==0)
                           {
                                
                                        $this->session->set_flashdata('error', 'New Password should be different from old');
                                        $data['settings_data'] = $this->User_model->getSettings();
                                        $data['logo_data']=$this->User_model->getall_logosettings();

                                        $this->load->view('templates/sidebar', $data);
                                        $this->load->view('templates/header');
                                        $this->load->view('change_password_form');
                                        $this->load->view('templates/footer');
                           }
                           else
                          {

                                        $id = $this->session->userdata('UserLoginSession');
                                        $uid=$id['id'];
                                        $uname=$id['name'];
                                        $this->load->model('User_model');

                                if($this->User_model->oldPasswordMatches($uid, $old_password))                               
                                {
                                        
                                        $this->User_model->changeUserPassword($uid,$new_password);      
                                        
                                        $id = $this->session->userdata('UserLoginSession');
                                        $role=$id['role'];
                                        $this->log_Dashboard_action('Edited the record with ID: ' . $uid, 'Password Change Menu', 'Password changed for the record: ' . $uid.'/'.$uname);

                                        if($role=='Admin'){
                                                $data['settings_data'] = $this->User_model->getSettings();
                                                $data['logo_data']=$this->User_model->getall_logosettings();

                                        $this->load->view('templates/sidebar', $data);
                                        $this->load->view('templates/header');
                                        $this->load->view('change_password_form');
                                        $this->session->set_flashdata('success', 'Password updated successfully!');
                                        $this->load->view('templates/footer');
                                        
                                        }
                                        else{
                                                $this->load->view('templates/header');
                                                $this->load->view('change_password_form');
                                                $this->session->set_flashdata('success', 'Password updated successfully!');
                                                $this->load->view('templates/footer'); 
                                        }
                                }
                                else
                                {
                                        $this->session->set_flashdata('error', 'Your old password is wrong');
                                        $data['settings_data'] = $this->User_model->getSettings();
                                        $data['logo_data']=$this->User_model->getall_logosettings();

                                        $this->load->view('templates/sidebar', $data);
                                        $this->load->view('templates/header');
                                        $this->load->view('change_password_form');
                                        $this->load->view('templates/footer');
                                }
                                
                            }
                        }
                }
        

        }

        //profileShow method shows profile_edit view
        public function profileShow()
	{

                $udata=$this->session->userdata('UserLoginSession');
                $id=$udata['id'];
                // $role=$udata['role'];

                                $data['profiles']=$this->User_model->getbyid($id);
                //                 if($role=='Admin'){
                        $data['settings_data'] = $this->User_model->getSettings();
                        $data['logo_data']=$this->User_model->getall_logosettings();

                                $this->load->view('templates/sidebar', $data);
                                $this->load->view('templates/header');
                                $this->load->view('profile_edit', $data);
                                $this->load->view('templates/footer');
                                // }
                                // else{    
                                // $data['profiles']=$this->User_model->getbyid($id);
                            
                                // $this->load->view('templates/header');
                                // $this->load->view('profile_edit', $data);
                                // $this->load->view('templates/footer'); 
                                // }
                                
        }

        //profile page update
        public function profileUpdate()
	{                       
                // if($this->input->post('registersubmit'))
                // if($_SERVER['REQUEST_METHOD']=='POST')
                // {                              

                        $this->form_validation->set_rules('name', 'Name', 'required');
                        $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[10]|max_length[10]');
                        $this->form_validation->set_rules('address', 'Address', 'required');
                        $this->form_validation->set_rules('education', 'Education', 'required');
                        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        


                        if ($this->form_validation->run()==true)
                        {
                                $udata=$this->session->userdata('UserLoginSession');
                                $id=$udata['id'];
                                // $role=$udata['role'];
                                
                                $config['allowed_types']='gif|jpg|png|Jpeg';
                                $config['max_size']=2048;//2MB
                                $config['upload_path']= './uploads/';
                                $config['encrypt_name']=FALSE;

                                $this->upload->initialize($config);     // <- set configuration

                                if(!$this->upload->do_upload('userfiles'))
                                {
                                        $this->session->set_flashdata('error', 'First choose profile photo for update');
                                        
                                        $data['profiles']=$this->User_model->getbyid($id);
                                        $udata=$this->session->userdata('UserLoginSession');
                                        $data=$this->upload->data();
                                        $fileName=$data['orig_name'];
                                        $new_picture = $this->upload->data('file_name');
                                       
                                        $this->session->set_userdata('profile_picture', $new_picture);

                                        $data['settings_data'] = $this->User_model->getSettings();
                                        $data['logo_data']=$this->User_model->getall_logosettings();

                                                $this->load->view('templates/sidebar', $data);
                                                $this->load->view('templates/header');
                                                $this->load->view('profile_edit', $data);
                                                $this->load->view('templates/footer');
                                }
                                else
                                {
                                
                                        $data=$this->upload->data();
                                        $fileName=$data['orig_name'];
                                        
                                        $new_picture_path = $this->upload->data('file_name');
                                        $this->session->set_userdata('profile_picture', $new_picture_path);

                                $name = $this->input->post('name');
                                $mobile = $this->input->post('mobile');
                                $address = $this->input->post('address');
                                $education = $this->input->post('education');
                                $email = $this->input->post('email');
                                $profpic = $new_picture_path;
                                // // $pic=$profpic[0];
                                // echo"<pre>";
                                // print_r($new_picture_path);exit; 
                               
                                $query = $this->db->query("SELECT * FROM user WHERE id='$id'");

                                if($query->num_rows()>0)
                                { 
                                $data=array(
                                        'id'=>$id,
                                        'name'=>$name,
                                        'mobile'=>$mobile,
                                        'address'=>$address,
                                        'education'=>$education,
                                        'email'=>$email,
                                        'profpic'=>$profpic,
                                        'status'=>'Active',
                                        );
                                
                                        $this->load->model('user_model');
                                        $this->User_model->updateProfile($data);
                                        $this->session->set_flashdata('success', 'Register successfully!');

                                        $this->log_Dashboard_action('Edited the record with ID/Name: ' . $id.'/'.$name, 'Profile Menu', 'Details of the edited record: ' . $id .',' . $name . ',' . $mobile . ',' . $address . ',' . $education . ',' . $email . ',' . $profpic);

                                        $data['profiles']=$this->User_model->getbyid($id);
                                        //update profile picture using session updated
                                        $profiles=$data['profpic'];
                                        // echo"<pre>";
                                        // print_r($data['profpic']);exit; 
                                       
                                        // if($role=='Admin'){                    
                                                $data['settings_data'] = $this->User_model->getSettings();
                                                $data['logo_data']=$this->User_model->getall_logosettings();

                                                $this->load->view('templates/sidebar', $data);
                                                $this->load->view('templates/header', $profiles);
                                                $this->load->view('profile_view', $data);
                                                $this->load->view('templates/footer'); 
                                //         }else{
                                //                 $data['profiles']=$this->User_model->getbyid($id);

                                //                 $this->load->view('templates/header');
                                //                 $this->load->view('profile_view', $data);
                                //                 $this->load->view('templates/footer');                                          
                                // }
                                }
                        
                                else
                                {
                                $this->session->set_flashdata('error', 'Update error in profile');
                                
                                $data['title']="Profile Page";
                                $data['settings_data'] = $this->User_model->getSettings();
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                $this->load->view('templates/sidebar', $data);
                                $this->load->view('templates/header');
                                $this->load->view('profile_view', $data);
                                $this->load->view('templates/footer'); 
                                } 
                                                              
                                
                        }
                }

                        else
                        {
                                $this->session->set_flashdata('error', 'All fileds should be filled');
                                $data['title']="Profile Page";
                                $udata=$this->session->userdata('UserLoginSession');
                                $id=$udata['id'];
                                $data['profiles']=$this->User_model->getbyid($id);
                                $data['settings_data'] = $this->User_model->getSettings();
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                $this->load->view('templates/sidebar', $data);
                                $this->load->view('templates/header');
                                $this->load->view('profile_edit', $data);
                                $this->load->view('templates/footer'); 
                        }
                // } 
                
        }

        public function remove_prof_pic(){
                $id = $this->input->post('product_id');

                $this->User_model->getbyid($id);

                $data = array(
                        'profpic'=>'default.jpg'
                );

                $this->User_model->update($data);
                $prof_pic=$data['profpic'];
                $this->session->set_userdata('profile_picture', $prof_pic);

                $data['title']="Profile Page";
                $data['profiles']=$this->User_model->getbyid($id);
                $data['settings_data'] = $this->User_model->getSettings();
                $data['logo_data']=$this->User_model->getall_logosettings();

                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/header');
                $this->load->view('profile_view', $data);
                $this->load->view('templates/footer'); 
        }

        //Documents view
        public function  documents($filterrole=NULL)
        {
                $data['document_page_heading'] = $this->config->item('document_page_heading');
                $data['document_page_columns'] = $this->config->item('document_page_columns');
                $data['filrole']=$filterrole;
                $uid = $this->session->userdata('UserLoginSession');
                $name=$uid['name'];
                $role=$uid['role'];
                $data['title']='Files Uploads';
                if($role=='Admin'){
                $data['employees_files']=$this->User_model->get_files();
                $data['settings_data'] = $this->User_model->getSettings();
                $data['logo_data']=$this->User_model->getall_logosettings();

                // echo "<pre>";
                // print_r($data['employees_files']);exit;
                        $this->load->view('templates/sidebar', $data);
                        $this->load->view('templates/header');
                        $this->load->view('documents', $data);
                        $this->load->view('templates/footer');
                }
                else{
                        
                        $data['roleuser'] = $this->User_model->get_by_id_docs($name);
                        $data['settings_data'] = $this->User_model->getSettings();
                        $data['logo_data']=$this->User_model->getall_logosettings();

                        $this->load->view('templates/sidebar', $data);
                        $this->load->view('templates/header');
                        $this->load->view('documentsuser', $data);//@@@change it to uploaded_view
                        $this->load->view('templates/footer');
                        
                } 
                               
        }

        //Documents view
        public function  multipleuploads()
        {               
                $data['title']='Files Uploads';
                $data['employees']=$this->User_model->getall();
                $data['settings_data'] = $this->User_model->getSettings();
                $data['logo_data']=$this->User_model->getall_logosettings();

                        $this->load->view('templates/sidebar', $data);
                        $this->load->view('templates/header');
                        $this->load->view('documents_view', $data);
                        $this->load->view('templates/footer'); 
                               
        }
	

        //Uploads multiple files/documents
        public function filesDocument(){

                $userdocs = $this->input->post('name');
                // echo "<pre>";
                // print_r($this->input->post('name'));exit;

                $udata=$this->session->userdata('UserLoginSession');
                $id=$udata['id'];
                $role=$udata['role'];
                
                // If files are selected to upload 
            if(!empty($_FILES['userfiles']['name']) && count(array_filter($_FILES['userfiles']['name'])) > 0)
            { 
                                $config['allowed_types']='gif|jpg|png|Jpeg|doc|docx|pdf';
                                $config['max_size']=2048;//2MB
                                $config['upload_path']= './uploads/';
                                // $config['encrypt_name']=TRUE;

                                $this->upload->initialize($config);     // <- set configuration
                                
                                $files_count=count($_FILES['userfiles']['name']);
                                
                                for($i=0;$i<$files_count;$i++)
                                {
                                        $_FILES['file']['name']     = $_FILES['userfiles']['name'][$i]; 
                                        $_FILES['file']['type']     = $_FILES['userfiles']['type'][$i]; 
                                        $_FILES['file']['tmp_name'] = $_FILES['userfiles']['tmp_name'][$i]; 
                                        $_FILES['file']['error']    = $_FILES['userfiles']['error'][$i]; 
                                        $_FILES['file']['size']     = $_FILES['userfiles']['size'][$i]; 
                                        
                                

                                if(!$this->upload->do_upload('file'))
                                {
                                        $error=$this->upload->display_errors();
                                        $this->session->set_flashdata('error', 'Upload failed!');

                                }
                                else
                                {
                                
                                $data=$this->upload->data();
                                
                                $fileNames=$_FILES['userfiles']['name'];
                                
                               
                                       
                                $filename_string = implode(', ', $fileNames);
                                  
                               
                                
                               
                        
                                }

                                }
                                $query = $this->db->query("SELECT * FROM user WHERE id='$userdocs'");
                                $name=$query->row()->name;
                                // echo "<pre>";
                                // print_r($name);exit;
                                        if($query->num_rows()>0)
                                        { 
                                        $data=array(
                                                'username'=>$name,
                                                'doc_name'=>$filename_string,
                                        );
                                
                                        $this->load->model('user_model');
                                        $this->User_model->insertdoc($data);
                                        //Add documents Action logs
                                        $this->log_Dashboard_action('Added the record for: ' . $name, 'Documents Menu', 'Details of the added record: ' . $filename_string);

                                                if($role=='Admin')
                                                {
                                                        $this->session->set_flashdata('success', 'Upload successfully!');
                                                        $data['employees']=$this->User_model->getall();
                                                        $data['settings_data'] = $this->User_model->getSettings();
                                                        $data['logo_data']=$this->User_model->getall_logosettings();

                                                        $this->load->view('templates/sidebar', $data);
                                                        $this->load->view('templates/header');
                                                        $this->load->view('documents_view', $data);//@@@change it to uploaded_view
                                                        $this->load->view('templates/footer'); 

                                                
                                                }else
                                                {
                                                        $this->session->set_flashdata('success', 'Upload successfully!');

                                                        redirect('dashboard/index');
                                                
                                                }
                                        }
                                        else
                                        {
                                                echo "Data not found";
                                        }
                        
        }
        else{
                $this->session->set_flashdata('error', 'First select files for upload');

                redirect('dashboard/multipleuploads');

        }    

        }

        //Get id wise data from DB
        public function get_product_by_id()
        {
        $id = $this->input->post('id');
         
        $productData = $this->User_model->get_by_id($id);
        $arr = array('success' => false, 'data' => '');
        

        if($productData){
        $arr = array('success' => true, 'data' => $productData);
         // Get roles data
         $query = $this->db->query("SELECT * FROM role_table");
         $rolesData = $query->result();
               
         if ($rolesData) {
             // Add roles data to the response
             $arr['roles'] = $rolesData;
         } else {
             // Handle the case when no roles data is found
             $arr['roles'] = array();
         }
        }
        echo json_encode($arr);
    }
 
//Insert data to DB
public function store()
    {
        $email = $this->input->post('email');
        
        
        $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role'),
                'status' => $this->input->post('status'),
                // 'profpic'=> 'default.jpg',
                // 'created_at' => date('Y-m-d H:i:s'),
            );
         
        
            $status = false;
            $id = $this->input->post('product_id');
    
            if($id){
                // Update existing data to the database

                    $update = $this->User_model->update($data);
                    $status = true;
                    
                }
                else
                {
                // Check if the email already exists in the database

                if ($this->User_model->Is_already_register($email)) {
                $data = $this->User_model->getByEmail_id($email);
                $id=$data->id;
                // echo "<pre>";print_r($id);exit;
                $status = true;
                }
                else
                {
                        $data = array(
                                'name' => $this->input->post('name'),
                                'email' => $this->input->post('email'),
                                'role' => $this->input->post('role'),
                                'status' => $this->input->post('status'),
                                'profpic'=> 'default.jpg',
                                // 'created_at' => date('Y-m-d H:i:s'),
                            );
                                     
                $id = $this->User_model->create($data);
                $status = true;                    
                }
                }
                $data = $this->User_model->get_by_id($id);
        
        echo json_encode(array("status" => $status, 'data' => $data));
        
 
        
}
        
    
 
//Delete data from DB
public function delete()
    {
        $this->User_model->delete();
        echo json_encode(array("status" => TRUE));
    }

public function deletefiles(){
        $this->User_model->deletefiledoc();
        echo json_encode(array("status" => TRUE));
    }

public function userdashborad(){
        $uid = $this->session->userdata('UserLoginSession');
        $id=$uid['id'];
        // $role=$uid['role'];
        $data['roleuser'] = $this->User_model->get_by_id($id);
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('dashboarduser_view', $data);//@@@change it to uploaded_view
        $this->load->view('templates/footer'); 
    }


    

public function documentsuploadview($id){
        $uid = $this->session->userdata('UserLoginSession');
        $id=$uid['id'];
        // $role=$uid['role'];
        $data['roleuser'] = $this->User_model->get_by_id($id);
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('documentsupload_view', $data);//@@@change it to uploaded_view
        $this->load->view('templates/footer'); 
    }

       
 

public function get_user_by_docs_id($id)
{

// echo "<pre>";
// print_r($id);exit;

        $data['docs_by_id']=$this->User_model->getbydocs_id($id);
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('dashboarduserdoc_view', $data);
        $this->load->view('templates/footer'); 

}  

public function get_user_by_docs_edit_id($id)
{
        $data['docs_by_id']=$this->User_model->getbydocs_id($id);
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('documents_edit', $data);
        $this->load->view('templates/footer');
}  


public function get_user_by_docs_update_id()
{
        

        $userdocs = $this->input->post('name');
        // echo "<pre>";
        // print_r($this->input->post('name'));exit;

        $udata=$this->session->userdata('UserLoginSession');
        $id=$udata['id'];
        $role=$udata['role'];
        
        // If files are selected to upload 
    if(!empty($_FILES['userfiles']['name']) && count(array_filter($_FILES['userfiles']['name'])) > 0)
    { 
                        $config['allowed_types']='gif|jpg|png|Jpeg|JPEG|doc|docx|pdf';
                        $config['max_size']=2048;//2MB
                        $config['upload_path']= './uploads/';
                        // $config['encrypt_name']=TRUE;

                        $this->upload->initialize($config);     // <- set configuration
                        
                        $files_count=count($_FILES['userfiles']['name']);
                        
                        for($i=0;$i<$files_count;$i++)
                        {
                                $_FILES['file']['name']     = $_FILES['userfiles']['name'][$i]; 
                                $_FILES['file']['type']     = $_FILES['userfiles']['type'][$i]; 
                                $_FILES['file']['tmp_name'] = $_FILES['userfiles']['tmp_name'][$i]; 
                                $_FILES['file']['error']    = $_FILES['userfiles']['error'][$i]; 
                                $_FILES['file']['size']     = $_FILES['userfiles']['size'][$i]; 
                                
                        

                        if(!$this->upload->do_upload('file'))
                        {
                                $error=$this->upload->display_errors();
                                $this->session->set_flashdata('error', 'Upload failed!');

                        }
                        else
                        {
                        
                        $data=$this->upload->data();
                        
                        $fileNames=$_FILES['userfiles']['name'];
                        
                       
                               
                        $filename_string = implode(', ', $fileNames);
                          
                       
                        
                       
                
                        }

                        }
                        $query = $this->db->query("SELECT * FROM filedocs WHERE fileid='$userdocs'");
                        $name=$query->row()->fileid;
                        
                                if($query->num_rows()>0)
                                { 
                                
                                        $fileid=$name;
                                        $doc_name=$filename_string;
                                        // echo "<pre>";
                                        // print_r($doc_name);exit;
                        
                                $this->load->model('user_model');
                                $this->User_model->updatedoc($fileid, $doc_name);
                                $this->session->set_flashdata('success', 'Upload successfully!');
                                //Edit documents log
                                $this->log_Dashboard_action('Edited the record with ID: ' . $fileid, 'Documents Menu', 'Details of the edited record: ' . $doc_name);

                                $data['employees_files']=$this->User_model->get_files();
                                $data['document_page_heading'] = $this->config->item('document_page_heading');
                                $data['document_page_columns'] = $this->config->item('document_page_columns');

                                
                                $uid = $this->session->userdata('UserLoginSession');
                                $name=$uid['name'];
                                $role=$uid['role'];
                                $data['title']='Files Uploads';
                                if($role=='Admin'){
                                $data['employees_files']=$this->User_model->get_files();
                                // echo "<pre>";
                                // print_r($data['employees_files']);exit;
                                $data['settings_data'] = $this->User_model->getSettings();
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                        $this->load->view('templates/sidebar', $data);
                                        $this->load->view('templates/header');
                                        $this->load->view('documents', $data);
                                        $this->load->view('templates/footer');
                                }
                                else{

                                        $data['document_page_heading'] = $this->config->item('document_page_heading');
                                        $data['document_page_columns'] = $this->config->item('document_page_columns');
                                        $data['roleuser'] = $this->User_model->get_by_id_docs($name);
                                        $data['settings_data'] = $this->User_model->getSettings();
                                        $data['logo_data']=$this->User_model->getall_logosettings();

                                        $this->load->view('templates/sidebar', $data);
                                        $this->load->view('templates/header');
                                        $this->load->view('documentsuser', $data);//@@@change it to uploaded_view
                                        $this->load->view('templates/footer');
                                        
                                } 
                                
                                }
                                else
                                {
                                        echo "Data not found";

                                }
                
}
else{
        $this->session->set_flashdata('error', 'First select files for upload');

        redirect('dashboard/multipleuploads');

}    

}  

public function generaldash()
{
        $this->load->database();
                        $sql ="SELECT * FROM user";
                        $query = $this->db->query($sql);
                        $records = $query->num_rows();
                        $data['all_records'] = $records-1;
                        // $count1=$data['all_records'];

                       

                        $sql ="SELECT * FROM user WHERE role='HR'";
                        $query = $this->db->query($sql);
                        $records = $query->num_rows();
                        $data['all_HR'] = $records;
                        $data['all_HR_role']=$query->result();


                        $sql ="SELECT * FROM user WHERE status='Inactive'";
                        $query = $this->db->query($sql);
                        $records = $query->num_rows();
                        $data['inactive_persons'] = $records;

                       

        $data['dashboardFive']=$this->User_model->get_five();
  
        $udata=$this->session->userdata('UserLoginSession');
        
                        // echo "<pre>";
                        // print_r($data['all_HR_role']);exit;
                        $data['settings_data'] = $this->User_model->getSettings();
                        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('generaldashboard_view', $data);
        $this->load->view('templates/footer'); 

}

//For line, bar, pie chart creation with same data
public function generaldashchart()
{
        $this->load->database();

        $sql = "SELECT role, COUNT(*) as total FROM user GROUP BY role";
        $query = $this->db->query($sql);
        $data['chart_data'] = $query->result();
    
        // Return JSON response
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data['chart_data']));
    

}

public function accessDashboard()
{

        
        $data['page_heading'] = $this->config->item('access_page_heading');
        $data['table_columns'] = $this->config->item('access_page_columns');
        

        $query = $this->db->limit(PHP_INT_MAX, 1)->get('access');
        $records = $query->result();
        $data['no_docs_persons'] = $records;

        // echo "<pre>";
        // print_r($data);exit;
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('access_dashboard', $data);
        $this->load->view('templates/footer'); 

}

//Add access details per employees
public function accessperuser()
{

        if ($this->input->post('editsubmit')) {
                
                $this->form_validation->set_rules('name', 'Name', 'required');


                if (!$this->form_validation->run()==true)
                {
                        $this->session->set_flashdata('error', 'You Should Select User First!');

                        
                }
                else
                {
                        // Add a validation rule for unique user
            $this->form_validation->set_rules('name', 'Name', 'is_unique[user.name]');
            
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error', 'User already has access!');
            
                
            } else {
                $id = $this->input->post('name');

                // Check if the user already has an entry in the 'access' table
                $existingAccess = $this->db->get_where('access', array('userid' => $id))->row();
            
                if ($existingAccess) {
                    // User already has access, you may update the existing entry or handle it as needed
                    $this->session->set_flashdata('error', 'User already has access!');
            
                   
                }
                else{
                        // $userid = $this->input->post('userid');
                        $accessuser = $this->input->post('name');
                        $access=array('accessMenu' => $this->input->post('accessMenu'),
                        'hrMenu' => $this->input->post('hrMenu'),
                        'managerMenu'  => $this->input->post('managerMenu'),
                        'documentsMenu'  => $this->input->post('documentsMenu'),
                        'detailsMenu'  => $this->input->post('detailsMenu'),
                        'Role'  => $this->input->post('Role'),
                        'Dictionary'  => $this->input->post('Dictionary'),
                        'directoryLogs'  => $this->input->post('directoryLogs'),
                        'settings'  => $this->input->post('settings'),
                        'employee'  => $this->input->post('employee'));
                        $accessbuttons=array('add' => $this->input->post('add'),
                        'edit' => $this->input->post('edit'),
                        'delete'  => $this->input->post('delete'));
                        // echo "<pre>";
                        // print_r($accessbuttons);exit;
                        $straccess=implode(', ', $access);
                        $straccessbuttons=implode(', ', $accessbuttons);

                        
                        $query = $this->db->query("SELECT * FROM user WHERE id='$accessuser'");

                          
                        if($query->num_rows()>0)
                        { 
                                $res=$query->result();
                                $row=$res[0];
                                $id=$row->id;
                                $name=$row->name;
                                                     
                        }
                        else{
                                $this->session->set_flashdata('error', 'Failed to Add Access!');
                                $data['employees']=$this->User_model->getall();
                                $data['settings_data'] = $this->User_model->getSettings();
                                $data['logo_data']=$this->User_model->getall_logosettings();
                        
                                $this->load->view('templates/sidebar', $data);
                                $this->load->view('templates/header');
                                $this->load->view('access_view', $data);
                                $this->load->view('templates/footer');
                        }
                                              
        
                        $this->load->model('User_model');

                        $this->User_model->storeaccess($id, $name, $straccess, $straccessbuttons);
                        $this->session->set_flashdata('success', 'Access Added successfully!');

                        $this->log_Dashboard_action('Added the record for: ' . $name, 'Access Menu', 'Details of the added access: ' . $straccess.'/' . $straccessbuttons);

                }   
                }                  

            }
        }
            
        $data['employees']=$this->User_model->getall();
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('access_view', $data);
        $this->load->view('templates/footer'); 

}  

public function accessedit($id){

        
        // if ($this->input->post('editsubmit'))
        // {
        // $accessid=$this->input->post('name');
        
        $data['accesseditpage']=$this->User_model->getaccessbyid($id);       
        // $id=$data['accesseditpage'];        
        // echo "<pre>";
        // print_r($id);exit;
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('accessedit_view', $data);
        $this->load->view('templates/footer'); 
        
        // }
        // else
        // {
        //         $this->session->set_flashdata('error', 'Failed to update!');
                

        // }

}

public function accessupdate(){

                        $accessuserupdate = $this->input->post('name');
                        $accessupdate=array('accessMenu' => $this->input->post('accessMenu'),
                        'hrMenu' => $this->input->post('hrMenu'),
                        'managerMenu'  => $this->input->post('managerMenu'),
                        'documentsMenu'  => $this->input->post('documentsMenu'),
                        'detailsMenu'  => $this->input->post('detailsMenu'),
                        'Role'  => $this->input->post('Role'),
                        'Dictionary'  => $this->input->post('Dictionary'),
                        'directoryLogs'  => $this->input->post('directoryLogs'),
                        'settings'  => $this->input->post('settings'),
                        'employee'  => $this->input->post('employee'));

                        $straccess=implode(', ', $accessupdate);

                        $accessbuttons=array('add' => $this->input->post('add'),
                        'edit' => $this->input->post('edit'),
                        'delete'  => $this->input->post('delete'));

                        $straccessbutton=implode(', ', $accessbuttons);



                        // echo "<pre>";
                        // print_r($straccess);exit;
                        $status=$this->User_model->updateaccessbyid($accessuserupdate, $straccess, $straccessbutton);
                        
                        $this->log_Dashboard_action('Edited the access with ID: ' . $accessuserupdate, 'Access Menu', 'Details of the edited access: ' . $straccess.'/'.$straccessbutton);

                        if($status ==TRUE){

                                $this->session->set_flashdata('success', 'Successfully Access Updated!');
                                $data['settings_data'] = $this->User_model->getSettings();
                                $data['logo_data']=$this->User_model->getall_logosettings();

                                
                                $this->load->view('templates/sidebar', $data);
                                $this->load->view('templates/header');
                                redirect('dashboard/accessDashboard');
                                $this->load->view('templates/footer');
                        }
                        else{
                                echo "error in update data";
                                
                        }

}

public function accesssidebar(){
        // $query = $this->db->query("SELECT * FROM access");
        // $res=$query->result();
        // $row=$res[1];
        // echo "<pre>";
        // print_r($row);exit;
        // $data['getallaccess']=$this->User_model->getallaccess($accessuser);
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('user');
        $this->db->join('access', 'access.accessid = user.id');

        $query = $this->db->get();
        $data['accesssidebar']=$query->result();
        // echo "<pre>";
        // print_r($data);exit;
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('sidebar', $data);
        $this->load->view('templates/footer'); 
        

}

public function accessdelete($id)
    {

        $this->User_model->accessdeletebyid($id);
        echo json_encode(array("status" => TRUE));       

    }

//Download each files while click download button
public function download($file){   

        $this->load->helper('download');

        force_download('uploads/'.$file, NULL);
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('dashboarduserdoc_view');
        $this->load->view('templates/footer'); 

}

//HR Dashboard
public function hrDashboard()
{

        
        $uid = $this->session->userdata('UserLoginSession');
        // $id=$uid['id'];
        $role=$uid['role'];
        $data['hrRole'] = $this->User_model->get_by_role($role);
             
        // echo "<pre>";
        // print_r($data);exit;
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('hr_view', $data);
        $this->load->view('templates/footer'); 

}

public function managerDashboard()
{

        
        $uid = $this->session->userdata('UserLoginSession');
        // $id=$uid['id'];
        $role=$uid['role'];
        $data['managerRole'] = $this->User_model->get_by_manrole($role);
        $data['title'] = "Manager Page";

        // echo "<pre>";
        // print_r($data);exit;
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('manager_view', $data);
        $this->load->view('templates/footer'); 

}

//filter search
public function get_by_filters()
{        
        $news = $this->User_model->get_by_ajax();
        // var_dump($news);
        // exit;
       

        // # Return our data back to ajax with Json format (json_encode)
        // you must use "echo" for returning the result you want back to Ajax call
        echo json_encode($news);
     }

public function get_by_filtersdoc()
     {        

        
             
             $news = $this->User_model->get_by_ajax_docs();
             
             echo json_encode($news);
          }
     
public function createexcel()
     {

        $searchkey = $this->input->post('filter_title');
                
        // $fileName = 'employee.xlsx';
        $currentDateTime = date('Ymd_His');
        $fileName = 'Employee_' . $currentDateTime . '.xlsx';

        $employeeData =$this->User_model->get_by_searchkey($searchkey);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

         // Set the title of the active sheet
        $sheet->setTitle('Employee Data');

        $sheet->setCellValue('A1', 'Name')->getStyle('A1')->getFont()->setBold(true);
        $sheet->setCellValue('B1', 'Email')->getStyle('B1')->getFont()->setBold(true);
        $sheet->setCellValue('C1', 'Role')->getStyle('C1')->getFont()->setBold(true);
        $sheet->setCellValue('D1', 'Status')->getStyle('D1')->getFont()->setBold(true);
        $sheet->setCellValue('E1', 'Profile Pic')->getStyle('E1')->getFont()->setBold(true);
        $sheet->setCellValue('F1', 'Registered Date')->getStyle('F1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);

        $sheet->getProtection()->setSheet(true);

        $rows = 2;
        foreach ($employeeData as $val){
               
        $sheet->setCellValue('A' . $rows, $val['name']);
        $sheet->setCellValue('B' . $rows, $val['email']);
        $sheet->setCellValue('C' . $rows, $val['role']);
        $sheet->setCellValue('D' . $rows, $val['status']);
        $sheet->setCellValue('E' . $rows, $val['profpic']);
        $sheet->setCellValue('F' . $rows, $val['datecreateon']);
        $rows++;
        } 
        
                $writer = new Xlsx($spreadsheet);

                $writer->save("uploads/".$fileName);
                header("Content-Type: application/vnd.ms-excel");
                redirect(base_url()."/uploads/".$fileName);              
    }  

    
public function createpdfusers()
     {
        
        $searchkey = $this->input->post('filter_news_title');
        // echo "<pre>";
        //         print_r($searchkey);exit;
        // $fileName = 'User_details.pdf';
        // $fileName = 'employee.xlsx';
        $currentDateTime = date('Ymd_His');
        $fileName = 'Employee_' . $currentDateTime . '.pdf';

        $employeeData =$this->User_model->get_by_searchkey($searchkey);
        
        $spreadsheet = new Spreadsheet();
       
        $sheet = $spreadsheet->getActiveSheet()->setPrintGridlines(true);
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'User Details')->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->setCellValue('A2', 'Name')->getStyle('A2')->getFont()->setBold(true);
        $sheet->setCellValue('B2', 'Email')->getStyle('B2')->getFont()->setBold(true);
        $sheet->setCellValue('C2', 'Role')->getStyle('C2')->getFont()->setBold(true);
        $sheet->setCellValue('D2', 'Status')->getStyle('D2')->getFont()->setBold(true);
        $sheet->setCellValue('E2', 'Profile Pic')->getStyle('E2')->getFont()->setBold(true);
        $sheet->setCellValue('F2', 'Registered Date')->getStyle('F2')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal('center');

       
        $rows = 3;
        foreach ($employeeData as $val){
               
        $sheet->setCellValue('A' . $rows, $val['name']);
        $sheet->setCellValue('B' . $rows, $val['email']);
        $sheet->setCellValue('C' . $rows, $val['role']);
        $sheet->setCellValue('D' . $rows, $val['status']);
        $sheet->setCellValue('E' . $rows, $val['profpic']);
        $sheet->setCellValue('F' . $rows, $val['datecreateon']);
        
        $sheet->getStyle('A' . $rows . ':F' . $rows)->getAlignment()->setHorizontal('center');
        
        $rows++;
        } 
     
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet);
                
        $pdfFilePath = FCPATH . '/uploads/'.$fileName;
        $writer->save($pdfFilePath);

        // Respond with the URL to the saved PDF file
        $response = array(
                'success' => true,
                'file_url' => base_url('/uploads/'.$fileName),
                'fileName' => $fileName,
        );

        // Set the content type to JSON
        $this->output->set_content_type('application/json');
        // Send the JSON response
        echo json_encode($response);
             
    }

public function createexceldocument()
     {

        $searchkey = $this->input->post('filter_title');

        // $fileName = 'employee.xlsx';
        $currentDateTime = date('Ymd_His');
        $fileName = 'Employee_Documents_' . $currentDateTime . '.xlsx';
        
        $employeeData =$this->User_model->get_by_searchkey_docs($searchkey);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setPrintGridlines(true);
        // Set the title of the active sheet
        $sheet->setTitle('Employee Data');      

        $sheet->setCellValue('A1', 'Name')->getStyle('A1')->getFont()->setBold(true);
        $sheet->setCellValue('B1', 'Documents')->getStyle('B1')->getFont()->setBold(true);
        $sheet->setCellValue('C1', 'Updated Date')->getStyle('C1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->getAlignment()->setHorizontal('center');

       
        $rows = 2;
        foreach ($employeeData as $val){
               
        $sheet->setCellValue('A' . $rows, $val['username']);
        $sheet->setCellValue('B' . $rows, $val['doc_name']);
        $sheet->setCellValue('C' . $rows, $val['dateupdated']);
        $sheet->getStyle('A' . $rows . ':C' . $rows)->getAlignment()->setHorizontal('center');

        $rows++;
        } 
        
                $writer = new Xlsx($spreadsheet);

                $writer->save("uploads/".$fileName);
                header("Content-Type: application/vnd.ms-excel");
                redirect(base_url()."/uploads/".$fileName); 
                
                            
    }

public function createpdfdocument()
     {
        
        $searchkey = $this->input->post('filter_news_title');
       
        $currentDateTime = date('Ymd_His');
        $fileName = 'Employee_Documents_' . $currentDateTime . '.pdf';
        //  echo "<pre>";
        // print_r($fileName);exit;
        $employeeData =$this->User_model->get_by_searchkey_docs($searchkey);
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setPrintGridlines(true);

        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'Document Details')->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->setCellValue('A2', 'Name')->getStyle('A2')->getFont()->setBold(true);
        $sheet->setCellValue('B2', 'Documents')->getStyle('B2')->getFont()->setBold(true);
        $sheet->setCellValue('C2', 'Updated Date')->getStyle('C2')->getFont()->setBold(true);


        // $sheet->setCellValue('A1', 'Name')->getStyle('A1')->getFont()->setBold(true);
        // $sheet->setCellValue('B1', 'Documents')->getStyle('B1')->getFont()->setBold(true);
        // $sheet->setCellValue('C1', 'Updated Date')->getStyle('C1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

        $rows = 3;
        foreach ($employeeData as $val){
               
        $sheet->setCellValue('A' . $rows, $val['username']);
        $sheet->setCellValue('B' . $rows, $val['doc_name']);
        $sheet->setCellValue('C' . $rows, $val['dateupdated']);

        
        $sheet->getStyle('A' . $rows . ':C' . $rows)->getAlignment()->setHorizontal('center');

        $rows++;
        } 
        
        

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet);
                $pdfFilePath = FCPATH . '/uploads/' . $fileName;
                $writer->save($pdfFilePath);

                // Respond with the URL to the saved PDF file
                $response = array(
                        'success' => true,
                        'file_url' => base_url('/uploads/' . $fileName),
                        'fileName' => $fileName,
                );

                // Set the content type to JSON
                $this->output->set_content_type('application/json');
                // Send the JSON response
                echo json_encode($response);     
             
    }


// //Import excel to database
// public function import() {
//         $config['upload_path']   = './uploads/';
//         $config['allowed_types'] = 'xlsx|xls'; // Adjust file types as needed

//         $this->upload->initialize($config);

//         if ($this->upload->do_upload('userfile')) {
//             $fileData = $this->upload->data();
//             $filePath = $fileData['full_path'];

//         //     // Load PhpSpreadsheet library
//         //     $this->load->library('PhpSpreadsheet');

//             $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
//             $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

//             // Process $sheetData and insert into database
//             // Example: Assuming you have a model method to insert data
//             $this->User_model->insertData($sheetData);
                
//             // You may want to redirect or show a success message
//             redirect('dashboard/viewusers');
//         } else {
//             // Handle upload error
//             $error = array('error' => $this->upload->display_errors());
//         //     print_r($error);
//         }
//     }
public function import() {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'xlsx|xls'; // Adjust file types as needed
    
        $this->upload->initialize($config);
    
        if ($this->upload->do_upload('userfile')) {
            $fileData = $this->upload->data();
            $filePath = $fileData['full_path'];
    
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    
            // Check for duplicate email and empty values
            $duplicates = $this->checkForDuplicates($sheetData);
    
            if (!empty($duplicates)) {
                // Pass the non-duplicates to the model for insertion
                $nonDuplicates = array_diff_key($sheetData, $duplicates);
                $nonDuplicates = array_values($nonDuplicates);  // Reset array keys
                $this->User_model->insertData($nonDuplicates);
    
                // Pass the duplicates to the view along with other necessary data
                $data['duplicates_list'] = $duplicates;
                $data['settings_data'] = $this->User_model->getSettings();
                $data['logo_data'] = $this->User_model->getall_logosettings();
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/header');
                // Load the dashboard_view with duplicates
                $this->load->view('dashboard_view_duplicates', $data);
                $this->load->view('templates/footer');
            } else {
                // No duplicates found, insert all records into the database
                $this->User_model->insertData($sheetData);
    
                // Redirect or show a success message
                redirect('dashboard/viewusers');
            }
        } else {
            // Handle upload error
            $error = array('error' => $this->upload->display_errors());
            // Handle or log the error as needed
        }
    }
    
    
    // Function to check for duplicate emails
    public function checkForDuplicates($sheetData) {
        $duplicates = [];
    
        foreach ($sheetData as $rowNumber => $rowData) {
                $name = $rowData['A'];
                $email = $rowData['B'];
            
                // Check if the email already exists in the database
                if ($this->User_model->isEmailDuplicate($email)) {
                    $duplicates[] = [
                        'row' => $rowNumber,
                        'email' => $email,
                        'name' => $name  // Add the name to the duplicates list
                    ];
                }
            }
            
        return $duplicates;
    }
    
    
    
    

//Import excel to database
public function importdocuments() {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'xlsx|xls'; // Adjust file types as needed

        $this->upload->initialize($config);

        if ($this->upload->do_upload('userfile')) {
            $fileData = $this->upload->data();
            $filePath = $fileData['full_path'];

        //     // Load PhpSpreadsheet library
        //     $this->load->library('PhpSpreadsheet');

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

       
        // Process $sheetData and insert into database only if the name doesn't exist
        foreach ($sheetData as $row) {

                
            $name = $row['A']; // Assuming 'name' is the column name in your Excel file
        
            // Check if the name already exists in the database
            if (!$this->User_model->isNameExists($name)) {
                // If the name doesn't exist, insert the data into the database
                $this->User_model->insertDatadocs($row);

            } else {
                // If the name already exists, skip processing for this row
                echo "Name '$name' already exists in the database. Skipping import for this entry.";
                continue; // Skip the rest of the processing for this row
            }

        }

        $this->session->set_flashdata('success', 'Successfully imported!');

        redirect('dashboard/documents');


        } else {
            // Handle upload error
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
    }

    
//View all details page
public function alldetails(){

                        $data['title']="All Details";

                        $this->db->select('user.*, access.*, filedocs.*')->limit(PHP_INT_MAX, 1);
                        $this->db->from('user');
                        $this->db->join('access', 'user.name = access.username', 'left');
                        $this->db->join('filedocs', 'user.name = filedocs.username', 'left');
                        
                        $query = $this->db->get();
                        $data['all_details'] = $query->result();
                        // echo "<pre>";
                        // print_r($result);exit;
                        $data['settings_data'] = $this->User_model->getSettings();
                        $data['logo_data']=$this->User_model->getall_logosettings();

                        $this->load->view('templates/sidebar', $data);
                        $this->load->view('templates/header');
                        $this->load->view('dashboard_all', $data);
                        $this->load->view('templates/footer');

    } 


public function detailed_excel_export(){
        $this->load->database();
        
        // Fetch your data from the database
        $data1 = $this->db->get('user')->result_array();
        $data2 = $this->db->get('access')->result_array();
        $data3 = $this->db->get('filedocs')->result_array();

        
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        


        // Create the second sheet
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1);
        $sheet2 = $spreadsheet->getActiveSheet();
        $sheet2->setTitle('Employee Access Data');
        $sheet2->setCellValue('A1', 'Name')->getStyle('A1')->getFont()->setBold(true);
        $sheet2->setCellValue('B1', 'Access Menu')->getStyle('B1')->getFont()->setBold(true);
        $sheet2->setCellValue('C1', 'Access Buttons')->getStyle('C1')->getFont()->setBold(true);
        
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->getAlignment()->setHorizontal('center');
        // $sheet1->fromArray($data1, null, 'A2');

        $rows = 2;
        foreach ($data2 as $val){
               
        $sheet2->setCellValue('A' . $rows, $val['username']);
        $sheet2->setCellValue('B' . $rows, $val['accesstypes']);
        $sheet2->setCellValue('C' . $rows, $val['accessbutton']);

        $sheet2->getStyle('A' . $rows . ':C' . $rows)->getAlignment()->setHorizontal('center');

        $rows++;
        }       

        // Create the third sheet
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(2);
        $sheet3 = $spreadsheet->getActiveSheet();
        $sheet3->setTitle('Employee Documents Data');
        $sheet3->setCellValue('A1', 'Name')->getStyle('A1')->getFont()->setBold(true);
        $sheet3->setCellValue('B1', 'Added Documents')->getStyle('B1')->getFont()->setBold(true);
        
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal('center');
        // $sheet1->fromArray($data1, null, 'A2');

        $rows = 2;
        foreach ($data3 as $val){
               
        $sheet3->setCellValue('A' . $rows, $val['username']);
        $sheet3->setCellValue('B' . $rows, $val['doc_name']);

        $sheet3->getStyle('A' . $rows . ':B' . $rows)->getAlignment()->setHorizontal('center');

        $rows++;
        }      
        // Create the first sheet
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Employee Data');      
        $sheet1->setCellValue('A1', 'Name')->getStyle('A1')->getFont()->setBold(true);
        $sheet1->setCellValue('B1', 'Email')->getStyle('B1')->getFont()->setBold(true);
        $sheet1->setCellValue('C1', 'Mobile')->getStyle('C1')->getFont()->setBold(true);
        $sheet1->setCellValue('D1', 'Address')->getStyle('D1')->getFont()->setBold(true);
        $sheet1->setCellValue('E1', 'Education')->getStyle('E1')->getFont()->setBold(true);
        $sheet1->setCellValue('F1', 'Role')->getStyle('F1')->getFont()->setBold(true);
        $sheet1->setCellValue('G1', 'Profile Picture')->getStyle('G1')->getFont()->setBold(true);
        $sheet1->setCellValue('H1', 'Status')->getStyle('H1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal('center');
        // $sheet1->fromArray($data1, null, 'A2');

        $rows = 2;
        foreach ($data1 as $val){
               
        $sheet1->setCellValue('A' . $rows, $val['name']);
        $sheet1->setCellValue('B' . $rows, $val['email']);
        $sheet1->setCellValue('C' . $rows, $val['mobile']);
        $sheet1->setCellValue('D' . $rows, $val['address']);
        $sheet1->setCellValue('E' . $rows, $val['education']);
        $sheet1->setCellValue('F' . $rows, $val['role']);
        $sheet1->setCellValue('G' . $rows, $val['profpic']);
        $sheet1->setCellValue('H' . $rows, $val['status']);

        $sheet1->getStyle('A' . $rows . ':H' . $rows)->getAlignment()->setHorizontal('center');

        $rows++;
        } 

        // Save the Excel file
        $currentDateTime = date('Ymd_His');
        $fileName = 'Employee_Detailed_Report_' . $currentDateTime . '.xls';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        // header('Cache-Control: max-age=0');
        $writer->save('php://output');
        
    }

//     public function detailed_excel_import(){

//         $config['upload_path']   = './uploads/';
//         $config['allowed_types'] = 'xlsx|xls'; // Adjust file types as needed

//         $this->upload->initialize($config);
        

//         if ($this->upload->do_upload('userfile')) {
//             $fileData = $this->upload->data();
//             $filePath = $fileData['full_path'];

               

//         //     // Load PhpSpreadsheet library
//         //     $this->load->library('PhpSpreadsheet');

//             $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        
//             $sheet1Data = $spreadsheet->getSheetByName('Employee Data')->toArray(null, true, true, true);
            
           
//         // Process $sheetData and insert into database only if the name doesn't exist
//         foreach ($sheet1Data as $row) {

                
//             $name = $row['A']; // Assuming 'name' is the column name in your Excel file
        
//             // Check if the name already exists in the database
//             if (!$this->User_model->isNameuserExists($name)) {
//                 // If the name doesn't exist, insert the data into the database
//                 $this->User_model->insertDatauser($row);

//             } else {
//                 // If the name already exists, skip processing for this row
//                 echo "Name '$name' already exists in the database. Skipping import for this entry.";
//                 continue; // Skip the rest of the processing for this row
//             }
//         } 

//         $sheet2Data = $spreadsheet->getSheetByName('Employee Access Data')->toArray(null, true, true, true);

//             // Process $sheetData and insert into database only if the name doesn't exist
//         foreach ($sheet2Data as $row) {
                
                
//                 $name = $row['A']; // Assuming 'name' is the column name in your Excel file
            
//                 // Check if the name already exists in the database
//                 if (!$this->User_model->isNameaccExists($name)) {
//                     // If the name doesn't exist, insert the data into the database
//                     $this->User_model->insertacc($row);
    
//                 } else {
//                     // If the name already exists, skip processing for this row
//                     echo "Name '$name' already exists in the database. Skipping import for this entry.";
//                     continue; // Skip the rest of the processing for this row
//                 }

//         }
        

//         $sheet3Data = $spreadsheet->getSheetByName('Employee Documents Data')->toArray(null, true, true, true);

//             // Process $sheetData and insert into database only if the name doesn't exist
//         foreach ($sheet3Data as $row) {

                
//                 $name = $row['A']; // Assuming 'name' is the column name in your Excel file
            
//                 // Check if the name already exists in the database
//                 if (!$this->User_model->isNamedocExists($name)) {
//                     // If the name doesn't exist, insert the data into the database
//                     $this->User_model->insertDatadocsall($row);
    
//                 } else {
//                     // If the name already exists, skip processing for this row
//                     echo "Name '$name' already exists in the database. Skipping import for this entry.";
//                     continue; // Skip the rest of the processing for this row
//                 }

//         }

//         $this->session->set_flashdata('success', 'Successfully imported!');

//         redirect('dashboard/documents');


//         } else {
//             // Handle upload error
//             $error = array('error' => $this->upload->display_errors());
//             print_r($error);
//         }

//     }

// YourController.php

public function detailed_excel_import() {
        // ... (upload configuration and file handling)
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'xlsx|xls'; // Adjust file types as needed

        $this->upload->initialize($config);
        

        if ($this->upload->do_upload('userfile')) {
            $fileData = $this->upload->data();
            $filePath = $fileData['full_path'];
        // Load PhpSpreadsheet library
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
    
        // Process Employee Data sheet
        $this->processSheetData($spreadsheet, 'Employee Data', 'isNameuserExists', 'insertDatauser', 'updateDatauser');
    
        // Process Employee Access Data sheet
        $this->processSheetData($spreadsheet, 'Employee Access Data', 'isNameaccExists', 'insertacc', 'update_Data_access');
    
        // Process Employee Documents Data sheet
        $this->processSheetData($spreadsheet, 'Employee Documents Data', 'isNamedocExists', 'insertDatadocsall', 'update_Data_doc');
    
        // ... (redirect and error handling)
        $this->session->set_flashdata('success', 'Successfully imported!');

        redirect('dashboard/alldetails');


        } else {
            // Handle upload error
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
    }
    
    
    

private function processSheetData($spreadsheet, $sheetName, $checkFunction, $insertFunction, $updateFunction) {
        $sheetData = $spreadsheet->getSheetByName($sheetName)->toArray(null, true, true, true);
    
        foreach ($sheetData as $row) {
            $name = $row['A'];
    
            // Check if the name already exists in the database
            if (!$this->User_model->$checkFunction($name)) {
                // If the name doesn't exist, insert the data into the database
                $this->User_model->$insertFunction($row);
            } else {
                // If the name already exists
                $this->User_model->$updateFunction($name, $row);
        }
        }
    

}  


public function userdocuments(){
        $uid = $this->session->userdata('UserLoginSession');
        $name=$uid['name'];
        $role=$uid['role'];
        if($role=='user'){
        $data['roleuser'] = $this->User_model->get_by_id_docs($name);
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('documentsuser', $data);//@@@change it to uploaded_view
        $this->load->view('templates/footer');
        }
        else{
        $data['roleuser'] = $this->User_model->get_by_id_docs($name);
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('documentsuser', $data);//@@@change it to uploaded_view
        $this->load->view('templates/footer');

        }
       
    }

public function getroletypes(){
        $query = $this->db->query("SELECT * FROM role_table");
        $data=$query->result();
        
        $this->output->set_content_type('application/json');
        // Send the JSON response
        echo json_encode($data);     

    }

//Role dashboard view
public function roleDashboard()
    {

        $data['role_page_heading'] = $this->config->item('role_page_heading');
        $data['role_page_columns'] = $this->config->item('role_page_columns');

            $sql ="SELECT * FROM role_table";
            $query = $this->db->query($sql);
            $records = $query->result();
            $data['no_docs_persons'] = $records;
    
            // echo "<pre>";
            // print_r($data);exit;
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data']=$this->User_model->getall_logosettings();

            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header');
            $this->load->view('roledashboard', $data);
            $this->load->view('templates/footer'); 
    
    }

//Delete role detail
public function role_delete($id)
    {

        $this->User_model->role_delete_by_id($id);

        echo json_encode(array("status" => TRUE));       

    }

//Add role details
public function add_role()
    {

        $data = array(
                'roletype' => $this->input->post('name'),
                );

        $id = $this->input->post('id');
        $rtype=$this->input->post('name');
        // $this->log_Dashboard_action('Added the role: ' . $rtype, 'Role Menu', 'Details of the added record: ' . $rtype);

        $status = false;

        $id = $this->input->post('product_id');        
        $id = $this->User_model->insert_role($data);          
        $status = true;

        $data = $this->User_model->get_role_by_id($id);
        echo json_encode(array("status" => $status , 'data' => $data));


        //    $id = $this->User_model->insert_role($data);

        
        // $data = $this->User_model->get_role_by_id($id);
 
        // echo json_encode(array("status" => $status , 'data' => $data));
        
    }

//Update role details
public function update_role()
    {
        $data = array(
                'roletype' => $this->input->post('name'),
                );
                $id = $this->input->post('id');

                $id = $this->input->post('product_id');
                $status = false;
               
        
        $status = $this->User_model->update_role_by_id($id, $data);
       

        // $this->log_Dashboard_action('Edited the record with ID: ' . $id, 'Role Menu', 'Details of the edited record: ' . $rtype);

        // echo json_encode(array("status" => $status , 'data' => $data));
        if (is_array($status) && isset($status['roleid'])) {
                $roleid = $status['roleid'];
                $rtype = $this->input->post('name');
                
                // $this->log_Dashboard_action('Edited the record with ID: ' . $id, 'Role Menu', 'Details of the edited record: ' . $rtype);
            
                echo json_encode(array("status" => $status, 'data' => $data));
            } else {
                // Handle the case where $status is not an array with the expected structure
                echo json_encode(array("status" => false, "message" => "Update failed"));
            }

    }

    public function get_role_id()
    {
        $id = $this->input->post('product_id');
        $data = $this->User_model->get_role_by_id($id);       
        echo json_encode($data);
    }

    
    public function googlelogin(){
        require_once APPPATH. 'libraries/vendor/autoload.php';


        $google_client = $this->google->getClient();

                if (isset($_GET["code"])) {

                        // $code = $this->input->get('code');
                        // $token = $google_client->fetchAccessTokenWithAuthCode($code);
                        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                    
                        // Check if there's an error in the access token response
                        if (isset($token['error'])) {
                            // Handle the error
                            echo 'Error fetching access token: ' . $token['error'];
                            echo 'Error description: ' . $token['error_description'];
                            exit;
                        }
                    
                        // Set the access token in the Google_Client instance
                        // $google_client->setAccessToken($token);
                        $google_client->setAccessToken($token['access_token']);
                        $this->session->userdata('access_token', $token['access_token']);
                        
                        $google_service = new Google_Service_Oauth2($google_client);
                        // Create an OAuth2 instance with the Google_Client object
                        // $oauth2 = new Oauth2($google_client);

                    
                        // Now, retrieve user information
                        // $user_info = $oauth2->userinfo->get();
                         $user_info = $google_service->userinfo->get();
                        

                        if (!$user_info || empty($user_info->getId())) {
                            // Handle the case when user information is not available
                            echo 'Error fetching user information';
                            exit;
                        }
                        
                        //get google picture URL to named as username.jpg file and save in DB
                        $imageUrl=$user_info->picture;
                        $actualcontant=file_get_contents($imageUrl);
                        $upload_directry = 'uploads/';
                        $filename=$user_info->given_name.".jpg";
                        $fullpath=$upload_directry.$filename;
                        file_put_contents($fullpath, $actualcontant);

                        // echo "<pre>";
                        // print_r($filename);exit;
                        $user_data = [
                            'name' => $user_info->name,
                            'email' => $user_info->email,
                            'status' => 'Active',
                            'profpic'=>$filename,
                            'password' => '123',
                        ];
                        // echo "<pre>";
                        // print_r($user_data);exit;

                        if ($this->User_model->Is_already_register($user_info->email)) {
                            $this->session->set_userdata('user_data', $user_data);
                            redirect(base_url('dashboard/loginnow'));
                        
                        } else {
                            $this->User_model->Insert_user_data($user_data);
                            echo "Redirecting to generaldashboard after insert...";
                        //     redirect('dashboard/generaldash');
                        header('Location: generaldashboard_view.php');

                        }

                        // echo "test";exit;

                    } else {
                        $url = $google_client->createAuthUrl();
                        header('Location: ' . filter_var($url, FILTER_SANITIZE_URL));
                    }
                
    }


//Signin with face book  
    public function facebooksignin(){


        require_once APPPATH. 'vendor/autoload.php';

                $app_id = '377190214687465';
                $app_secret = 'fcedee8863409fb8ae2f0a3260753775';
                $redirect_uri = base_url('dashboard/callback');

                // Initialize Facebook SDK
                $fb = new Facebook([
                        'app_id' => $app_id,
                        'app_secret' => $app_secret,
                        'default_graph_version' => 'v14.0',
                ]);

             // Generate Facebook login URL
                $helper = $fb->getRedirectLoginHelper();
                $permissions = ['email','public_profile'];
                $login_url = $helper->getLoginUrl($redirect_uri,$permissions);

                // Redirect to Facebook login
                redirect($login_url);
        }

//Signin with face book callback function 
public function callback() {
        require_once APPPATH. '/vendor/autoload.php';

        try{
                // Initialize Facebook SDK
                $fb = new Facebook([
                        'app_id' => '377190214687465',
                        'app_secret' => 'fcedee8863409fb8ae2f0a3260753775',
                        'default_graph_version' => 'v14.0',
                ]);
        

                $helper = $fb->getRedirectLoginHelper();

        // Get access token
                $accessToken = $helper->getAccessToken();
                // echo print_r($accessToken);die();

                $response = $fb->get('/me?fields=id,name,email,picture.type(large)', $accessToken);
                $user = $response->getGraphUser();

                // Access user data
                $facebook_id = $user->getId();
                $name = $user->getName();
                $email = $user->getField('email');
                $picture = $user->getPicture();
                $picture_url = $picture->getUrl();
                // Check if the URL is valid
        // if (filter_var($picture_url, FILTER_VALIDATE_URL)) {
        //         // Get the image content
        //         $image_content = @file_get_contents($picture_url);
        
        //         // Check if the request was successful
        //         if ($image_content === false) {
        //         // Handle the error (e.g., log it, display a message)
        //         $last_error = error_get_last();
        //         if ($last_error !== null && isset($last_error['message'])) {
        //                 echo "Failed to fetch the image: " . $last_error['message'];
        //             } else {
        //                 echo "Failed to fetch the image: Unknown error";
        //             }
        //         } else {
                // $image_content = file_get_contents($picture_url);
                // echo "<pre>";print_r($image_content);exit;

                // Display the image
                $upload_directory = 'uploads/';
                $filename =$name.".jpg"; // You can customize the filename as needed
                // Save the image to the upload directory
                // $full_path = $filename;

                // file_put_contents($full_path, $image_content);
                // echo "<pre>";print_r($full_path);die();
                $user_data = array(
                        'name'      => $name,
                        'email'     => $email,
                        'password'  =>'123',
                        // 'profpic' =>$full_path,
                    );
                // }
                // }
                // else
                // {
                //         // Handle the case where the URL is not valid
                // echo "Invalid URL";
                // }
        if ($this->User_model->Is_already_register($email)) {
                $this->User_model->Update_user_data($user_data, $email);
                $this->session->set_userdata('user_data', $user_data);

                redirect('dashboard/loginnow');
                //      redirect('generaldashboard_view', 'location');

            
            } else {
                $this->User_model->Insert_user_data($user_data);
                echo "Redirecting to generaldashboard after insert...";
            //     redirect('dashboard/generaldash');
            header('Location: generaldashboard_view.php');

            }

            // echo "test";exit;

        
                } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                // Handle error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                // Handle error
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
        }
    
}                       
        

//document view using Ajax call show without actual url
public function load_document_content() {
        $docName = $this->input->post('docName');
        $filePath = 'uploads/' . $docName;
    
        if (file_exists($filePath)) {
                $docContent = file_get_contents('uploads/' . $docName);
                echo base64_encode($docContent);
        } else {
            // Handle file not found
            header("HTTP/1.0 404 Not Found");
            echo 'File not found';
        }
    }
    
//Directory logs view page
public function log_action_view() {
        if($this->session->userdata('UserLoginSession')){
                $uid = $this->session->userdata('UserLoginSession');
                $id=$uid['id'];
                $data['title']="Directory Logs Page";

                $data['employees']=$this->User_model->getall_logs();
                $data['emp_list']=$this->User_model->getall();
                $data['settings_data'] = $this->User_model->getSettings();
                $data['logo_data']=$this->User_model->getall_logosettings();

                // $data['profiles']=$this->User_model->getbyid($id);
                // echo"<pre>";print_r($data['employees']);exit;
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/header');
                $this->load->view('directory_logs_view', $data);                        
                $this->load->view('templates/footer');    
        }
        else{
                $data['title']="User Login Page";
                $data['logo_data']=$this->User_model->getall_logosettings();

                $this->load->view('login_view', $data);
        }
    }

//Theme settings view page
public function theme_view() {
        if($this->session->userdata('UserLoginSession')){
                $uid = $this->session->userdata('UserLoginSession');
                $id=$uid['id'];
                $data['title']="Directory Logs Page";

                $data['logo_data']=$this->User_model->getall_logosettings();
                // echo "<pre>";print_r($data['logo_data']);exit;
                $data['settings_data'] = $this->User_model->getSettings();

                // $data['profiles']=$this->User_model->getbyid($id);
                // echo"<pre>";print_r($data['employees']);exit;
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/header');
                $this->load->view('theme_set_view', $data);                        
                $this->load->view('templates/footer', $data);    
        }
        else{
                $data['title']="User Login Page";
                $data['logo_data']=$this->User_model->getall_logosettings();

                $this->load->view('login_view', $data);
        }
    }

//profile page update
public function themeUpdate()
{                       
        // if($this->input->post('registersubmit'))
        // if($_SERVER['REQUEST_METHOD']=='POST')
        // {                              

                // $this->form_validation->set_rules('name', 'Name', 'required');

                // if ($this->form_validation->run()==true)
                // {
                        // $udata=$this->session->userdata('UserLoginSession');
                        // $id=$udata['id'];
                        // // $role=$udata['role'];
                        
                        $config['allowed_types']='gif|jpg|png|Jpeg';
                        $config['max_size']=2048;//2MB
                        $config['upload_path']= './uploads/';
                        $config['encrypt_name']=FALSE;

                        $this->upload->initialize($config);     // <- set configuration

                        // if(!$this->upload->do_upload('userfiles'))
                        // {
                        //         $this->session->set_flashdata('error', 'First choose logo for update');
                                
                        //         // $data['profiles']=$this->User_model->getbyid($id);
                        //         // $udata=$this->session->userdata('UserLoginSession');
                        //         $data=$this->upload->data();
                        //         $logoImage=$data['orig_name'];
                        //         // $new_picture = $this->upload->data('file_name');
                        //         // $this->session->set_userdata('profile_picture', $new_picture);

                        //         $data['logo_data']=$this->User_model->getall_logosettings();

                        //         $data['settings_data'] = $this->User_model->getSettings();

                        //                 $this->load->view('templates/sidebar', $data);
                        //                 $this->load->view('templates/header');
                        //                 $this->load->view('theme_set_view', $data);
                        //                 $this->load->view('templates/footer', $data);
                        // }
                        // else
                        // {
                                $logoName = $this->input->post('name');
                                $logocolor = $this->input->post('logocolor');
                                $copyYear = $this->input->post('copyYear');

                                if(!$this->upload->do_upload('userfiles')){
                                $previousimage = $this->input->post('previousimage');
                                // echo "<pre>";print_r($logoImage);exit;
                                $this->User_model->Update_logo_setting($logoName, $previousimage, $copyYear, $logocolor);

                                $this->session->set_flashdata('success', 'Successfully logo settings updated');

                                $data['logo_data']=$this->User_model->getall_logosettings();

                                $data['settings_data'] = $this->User_model->getSettings();

                                        $this->load->view('templates/sidebar', $data);
                                        $this->load->view('templates/header');
                                        $this->load->view('theme_set_view', $data);
                                        $this->load->view('templates/footer', $data);
                                }
                                else{
                                        $data=$this->upload->data();
                                        $logoImage=$data['orig_name'];
                                        $logocolor = $this->input->post('logocolor');
                                        $this->User_model->Update_logo_setting($logoName, $logoImage, $copyYear, $logocolor);

                                        $this->session->set_flashdata('success', 'Successfully logo settings updated');
        
                                        $data['logo_data']=$this->User_model->getall_logosettings();
        
                                        $data['settings_data'] = $this->User_model->getSettings();
        
                                                $this->load->view('templates/sidebar', $data);
                                                $this->load->view('templates/header');
                                                $this->load->view('theme_set_view', $data);
                                                $this->load->view('templates/footer', $data);

                                }
                                

                //         }
                
                // }
                // else{
                //         $this->session->set_flashdata('error', 'Fill all necessarry details for updated');
                //         $data['logo_data']=$this->User_model->getall_logosettings();

                //         $data['settings_data'] = $this->User_model->getSettings();

                //                 $this->load->view('templates/sidebar', $data);
                //                 $this->load->view('templates/header');
                //                 $this->load->view('theme_set_view', $data);
                //                 $this->load->view('templates/footer', $data);

                // }
}

//log details saved via controller
public function log_Dashboard_action($action, $menu_item, $additional_info) {
        
        // You can now use these variables to store the log in your database or perform any other actions.
        // Example: Log to a database
        $this->load->model('User_model');
        $uid = $this->session->userdata('UserLoginSession');
        // echo"<pre>";print_r($additional_info);exit;

        $user_id = $uid['id'];
        $user_name = $uid['name'];
        $this->User_model->insert_log($user_id, $user_name, $action, $menu_item, $additional_info);
        // Get the user ID from the session or any other method you use for authentication
        
        // Respond with success
        // echo 'Log action successful';
    }

//log details saved via AJAX
public function log_action() {
        // Retrieve data from the AJAX request
        $action = $this->input->post('action');
        $menu_item = $this->input->post('menu_item');
        $additional_info = $this->input->post('additional_info');
        // Get the user ID from the session or any other method you use for authentication
        $uid = $this->session->userdata('UserLoginSession');
                // echo"<pre>";print_r($additional_info);exit;

        $user_id = $uid['id'];
        $user_name = $uid['name'];

        // Load the user log model
        $this->load->model('User_model');

        // Insert the log entry into the database
        $this->User_model->insert_log($user_id, $user_name, $action, $menu_item, $additional_info);

        // Respond to the AJAX request (you can customize the response as needed)
        $response = array('success' => true);
        echo json_encode($response);
    }

//Filter name, action, and menu wise
public function get_by_filter_logs(){
        $data = $this->User_model->get_by_logs_ajax();      

        // # Return our data back to ajax with Json format (json_encode)
        // you must use "echo" for returning the result you want back to Ajax call

        echo json_encode($data);
    }

//Filter date range wise
public function get_by_filter_logs_date(){
        $data = $this->User_model->get_by_logs_date_ajax();      

        // # Return our data back to ajax with Json format (json_encode)
        // you must use "echo" for returning the result you want back to Ajax call
        echo json_encode($data);
    }

    //Dictionary settings start
    public function index_dic_set() {
        $this->load->model('User_model');
    
        // Fetch settings data from the database
        $data['settings_data'] = $this->User_model->getSettings();
        $data['logo_data'] = $this->User_model->getall_logosettings();

        // Pass the settings data to the view
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('settings_view', $data);
        $this->load->view('templates/footer');
    }
    
    public function updateSettings() {
        // Handle form submission to update config values
        if ($this->input->post()) {
            $sections = $this->getFormData($this->input->post('sections'));
    
            foreach ($sections as $section) {
                $sectionId = $section['access_page_id'];
                $pageHeading = $section['access_page_heading'];
                $sideHeading = $section['access_side_heading'];
                $sideHeadingUser = $section['access_side_heading_user'];
                $pageColumns = $section['access_page_columns'];
                $buttonColumns = $section['access_button_columns'];
    
                $this->updateSectionSettings($sectionId, $pageHeading, $sideHeading, $sideHeadingUser, $pageColumns, $buttonColumns);
                // $udata=$this->session->userdata('UserLoginSession');
                // $id=$udata['id'];
                // $this->User_model->updateAccessTable($id, $sideHeading);

            }
            $this->session->set_flashdata('success', 'Successfully settings updated');

            // Redirect back to the settings page
            redirect('dashboard/index_dic_set?settings_updated=true');
        }
    }
    
    private function getFormData($postData) {
        $formData = [];
    
        foreach ($postData as $section) {
            $formData[] = [
                'access_page_id' => $section['access_page_id'],
                'access_page_heading' => $section['access_page_heading'],
                'access_side_heading' => $section['access_side_heading'],
                'access_side_heading_user' => $section['access_side_heading_user'],
                'access_page_columns' => $section['access_page_columns'],
                'access_button_columns' => $section['access_button_columns'],

            ];
        }

        return $formData;
    }
    
    private function updateSectionSettings($sectionId, $pageHeading, $sideHeading, $sideHeadingUser, $pageColumns, $buttonColumns) {
            // Load the existing settings from the database
            $existingSettings = $this->db->where('dic_id', $sectionId)->get('dictionary_table')->row();

            // If there are no existing settings, insert a new record
            if (!$existingSettings) {
                $data = array(
                    'dic_id' => $sectionId,
                    'pagehead' => $pageHeading,
                    'sidehead' => $sideHeading,
                    'sideheaduser' => $sideHeadingUser,
                    'tablehead' => implode(', ', $pageColumns), // Store columns as JSON for simplicity
                    'buttonhead' => implode(', ', $buttonColumns) // Store columns as JSON for simplicity

                );
                $this->db->insert('dictionary_table', $data);
            } else {
                // Update existing record
                $data = array(
                    'pagehead' => $pageHeading,
                    'sidehead' => $sideHeading,
                    'sideheaduser' => $sideHeadingUser,
                    'tablehead' => implode(', ', $pageColumns),
                    'buttonhead' => implode(', ', $buttonColumns) // Store columns as JSON for simplicity

                );
                // echo "<pre>";print_r($data);exit;
                $this->db->where('dic_id', $sectionId)->update('dictionary_table', $data);

            }
        }
    //Dictionary settings end

    //file transfer from one location to another
//     public function transferFile() {
//     // Get the file path from the source directory
//     $source_file = 'C:/path_to_source_folder/Individual.txt';
    
//     // Define the destination directory and file name
//     $destination_folder = 'D:/Transfer_file/';
//     $destination_file = $destination_folder . 'destination_file.txt';

//     // Check if the source file exists
//     if (!file_exists($source_file)) {
//         return array('success' => false, 'error' => 'Source file does not exist.');
//     }

//     // Perform the file transfer
//     if (copy($source_file, $destination_file)) {
//         // Set success flash message
//         $this->session->set_flashdata('success', 'File transferred successfully.');
//         // Redirect back to the previous page or to a specific route
//         redirect('dashboard/documents');
//     } else {
//         // Log the error message
//         error_log('Error transferring file: ' . error_get_last()['message']);
//         // Set error flash message
//         $this->session->set_flashdata('error', 'Error transferring file.');
//         // Redirect back to the previous page or to a specific route
//         redirect('dashboard/documents');
//     }
// }
// Assuming you're calling the function within the Dashboard controller
// public function someMethod() {
//         // Define the file paths array
//         $file_paths = array(
//             'C:/path_to_source_folder/Helper/Individual.txt' => 'D:/Transfer_file/Helper/',
//             'C:/path_to_source_folder/Controller/Employee_20240130_044835.pdf' => 'D:/Transfer_file/Controller/'
//         );
    
//         // Call the transferFiles method passing the formatted file paths
//         $this->transferFiles($file_paths);
//     }
    
// public function transferFiles($file_paths) {
//         // Define an array to store transfer results
//         $transfer_results = array();
    
//         foreach ($file_paths as $source_file => $destination_folder) {
//             // Define the destination file path
//             $destination_file = rtrim($destination_folder, '/') . '/' . basename($source_file);
    
//             // Check if the source file exists
//             if (!file_exists($source_file)) {
//                 $transfer_results[$source_file] = array('success' => false, 'error' => 'Source file does not exist.');
//                 continue;
//             }
    
//             // Perform the file transfer
//             if (copy($source_file, $destination_file)) {
//                 $transfer_results[$source_file] = array('success' => true);
//             } else {
//                 // Log the error message
//                 error_log('Error transferring file: ' . error_get_last()['message']);
//                 $transfer_results[$source_file] = array('success' => false, 'error' => 'Error transferring file.');
//             }
//         }
    
//         // Set flash messages based on transfer results
//         foreach ($transfer_results as $source_file => $result) {
//             if ($result['success']) {
//                 $this->session->set_flashdata('success', 'File transferred successfully.');
//             } else {
//                 $this->session->set_flashdata('error', 'Error transferring file from ' . $source_file . ': ' . $result['error']);
//             }
//         }
    
//         // Redirect back to the previous page or to a specific route
//         redirect('dashboard/documents');
//     }
    
    
                               
//     public function someMethod() {
//         $file_paths = array(
//             'D:/Transfer_file/Helper/' => array(
//                 'C:/path_to_source_folder/Helper/Individual.txt',
//                 'C:/path_to_source_folder/Helper/companyform_data_helper.php',
//                 'C:/path_to_source_folder/Helper/common_helper.php'

//             ),
//             'D:/Transfer_file/Controller/' => array(
//                 'C:/path_to_source_folder/Controller/Employee_20240130_044835.pdf',
//                 'C:/path_to_source_folder/Controller/Activities.php',
//                 'C:/path_to_source_folder/Controller/add_member.php',

//             )
//         );
    
//         $this->transferFiles($file_paths);
//     }
    
//     public function transferFiles($file_paths) {
//         $transfer_results = array();
    
//         foreach ($file_paths as $destination_folder => $source_files) {
//             foreach ($source_files as $source_file) {
//                 $destination_file = rtrim($destination_folder, '/') . '/' . basename($source_file);
    
//                 if (!file_exists($source_file)) {
//                     $transfer_results[$source_file] = array('success' => false, 'error' => 'Source file does not exist.');
//                     continue;
//                 }
    
//                 // Perform the file transfer
//                 if (copy($source_file, $destination_file)) {
//                     $transfer_results[$source_file] = array('success' => true);
//                 }
//                 else
//                 {
//                     // Log the error message
//                     error_log('Error transferring file: ' . error_get_last()['message']);
//                     $transfer_results[$source_file] = array('success' => false, 'error' => 'Error transferring file.');
//                 }
//             }
//         }
    
//         // Set flash messages based on transfer results
//         foreach ($transfer_results as $source_file => $result) {
//             if ($result['success'])
//                 {
//                 $this->session->set_flashdata('success', 'File transferred successfully.');
//                 } 
//                 else
//                 {
//                         $this->session->set_flashdata('error', 'Error transferring file from ' . $source_file . ': ' . $result['error']);
//                 }
//         }
    
//         // Redirect back to the previous page or to a specific route
//         redirect('dashboard/documents');
//     }
    
    
      
/* Group_name added dynamically start */
// public function group_name_add($company_id) {

//         $group_name_list = $this->db->query("SELECT * FROM tbl_group_shares WHERE company_id = $company_id");
//         $group_name_list_by_company = $group_name_list->result_array();
    
//         $existing_group_names = [];
//         foreach ($group_name_list_by_company as $group) {
//             $existing_group_names[] = $group['group_name'];
//         }
    
//         $Array_name = [
//             "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
//             "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ"
//         ];
    
//         $next_group_name = null;
//         foreach ($Array_name as $name) {
//             if (!in_array($name, $existing_group_names)) {
//                 $next_group_name = $name;
//                 print_r($next_group_name);
//                 break;
//             }
//         }
    
//         if ($next_group_name) {
//             $insert_query = "INSERT INTO tbl_group_shares (company_id, group_name) VALUES ($company_id, '$next_group_name')";
//             $this->db->query($insert_query);
    
//             return $next_group_name;
//         } else {

//             return null; // or throw an error
//         }
//     }
    
public function group_name_add($company_id) {

        $group_name_list = $this->db->query("SELECT * FROM tbl_group_shares WHERE company_id = $company_id");
        $group_name_list_by_company = $group_name_list->result_array();
    
        $existing_group_names = [];
        foreach ($group_name_list_by_company as $group) {
            $existing_group_names[] = $group['group_name'];
        }
    
        $group_array_name = [
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
            "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ"
        ];
    
        $last_used_group_name = end($existing_group_names); 
        $next_group_name = null;
        $next_index = array_search($last_used_group_name, $group_array_name);
    
        if ($next_index !== false && isset($group_array_name[$next_index + 1])) {
            $next_group_name = $group_array_name[$next_index + 1];
            $insert_query = "INSERT INTO tbl_group_shares (company_id, group_name) VALUES ($company_id, '$next_group_name')";
            $this->db->query($insert_query);

        }
    
        // if ($next_group_name) {
        //     $insert_query = "INSERT INTO tbl_group_shares (company_id, group_name) VALUES ($company_id, '$next_group_name')";
        //     $this->db->query($insert_query);
    
        //     return $next_group_name;
        // } else {
        //     return null; // or throw an error
        // }
    }
    

/* Group share name added dynamically END */


 }