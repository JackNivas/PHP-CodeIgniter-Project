<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User_model extends CI_Model{ 
    function __construct() { 

    } 
     
     
    /* 
     * Insert user data into the database 
     * @param $data data to be inserted 
     */ 
    public function insertuser($data) {        

        $this->db->insert('user', $data);
        return true;

    }
    
    
    public function getall(){
        
        $this->db->limit(PHP_INT_MAX, 1);
        $query = $this->db->get('user');
        
        return $query->result();

    }

    public function getbyid($id){

        return $this->db->where('id',$id)->get('user')->row();
        
    }

    function checkpassword($email, $password){                           

        $query = $this->db->query("SELECT * FROM user WHERE email='$email' AND password='$password' AND status='Active'");        
        $row= $query->row();
        if(!empty($row)){
            return $row;
           
            // if(!empty($row) && password_verify($password, $row->password)) {
            //     echo "true";

            //     return $query->row();
            // } else {
            //     return false;
            // }
        }
        else{
            return false;
        }
    }


    public function getUserByEmail($email){

        $new_password= random_string('alnum', 8);//random password

        $this->db->set('password',$new_password)->where('email',$email)->update('user');

        return $this->db->where('email',$email)->get('user')->row();
    }

    public function getByEmail_id($email){

        return $this->db->where('email',$email)->get('user')->row();
    }

    public function changeUserPassword($uid,$new_password){
       
        $this->db->set('password',$new_password)->where('id',$uid)->update('user');
        
    }

    public function oldPasswordMatches($uid,$old_password){

        $query = $this->db->where('id',$uid)->where('password',$old_password)->get('user');
        if($query->num_rows()>0){
            return true;
        }
        else{
        return false;
    }


    }


    public function updateProfile($data){

        $udata=$this->session->userdata('UserLoginSession');
        $id=$udata['id'];

        $data = [
        'id'=>$id,
        'name'=>$data['name'],
        'mobile'=>$data['mobile'],
        'address'=>$data['address'],
        'email'=>$data['email'],
        'education'=>$data['education'],
        'profpic'=>$data['profpic'],

        ];

        // echo "<pre>";
        // print_r($name);exit;

        // $this->db->set('mobile',$mobile, 'address',$address, 'email',$email, 'education',$education)->where('id',$id)->update('user');
        $this->db->where('id', $id);
        $this->db->update('user', $data);

        return true;

    }

    public function insertdoc($data){
        $udata=$this->session->userdata('UserLoginSession');
        $id=$udata['id'];
        $userdocs = $this->input->post('name');

        // $data = [
        // 'userid'=>$userdocs,
        // 'doc_name'=>$data['filesdoc'],

        // ];

        // echo "<pre>";
        // print_r($data);exit;

        // $this->db->set('mobile',$mobile, 'address',$address, 'email',$email, 'education',$education)->where('id',$id)->update('user');
        $this->db->insert('filedocs', $data);
        return true;
    }

    
    /* 
     Fetch files data from the database 
     */ 
    public function getRows($id = ''){ 
        $this->db->select('id,file_name,uploaded_on'); 
        $this->db->from('files'); 
        
        if($id){ 
            $this->db->where('id',$id); 
            $query = $this->db->get(); 
            $result = $query->row_array(); 
        }
        else
        { 
            $this->db->order_by('uploaded_on','desc'); 
            $query = $this->db->get(); 
            $result = $query->result_array(); 
        } 

        return !empty($result)?$result:false;
    } 
     
    /* 
     Insert file data into the database 
     */ 
    public function insert($data=array()){ 
        $insert = $this->db->insert_batch('files',$data); 
        return $insert?true:false;
        // echo "<pre>";
        // print_r($data);exit; 
        // $result = $this->db->insert('user', $data);
        // return $result;

    }
    
    //AJAX insert
    public function get_all_products()
    {
        $this->db->from('user');
        $query=$this->db->get();
        return $query->result();
    }

    public function create($data)
    {   
       $this->db->insert('user', $data);
       return $this->db->insert_id();
    }
    public function get_by_id($id)
    {
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
        // echo "<pre>";
        // print_r($query->row());exit; 
    }

    public function get_by_id_docs($name)
    {
        $this->db->from('filedocs');
        $this->db->where('username', $name);
        $query = $this->db->get();
        return $query->row();
        // echo "<pre>";
        // print_r($query->row());exit; 
    }
 
//Update model method
    public function update($data)
    {
        $where = array('id' => $this->input->post('product_id'));   // were condition that matches id value in database
                                                                    // matches with the id supplied 
         $this->db->update('user', $data, $where);                  //update database news with the $data
         return $this->db->affected_rows();
    }


//Delete model method
    public function delete()
    {
        $id = $this->input->post('product_id');
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    //Add Access to DB
    public function storeaccess($id, $accessuser, $straccess, $straccessbuttons){
        $data = array(
            'userid'=>$id,
            'username'=>$accessuser,
            'accesstypes' => $straccess,
            'accessbutton'=>$straccessbuttons,
            
        );

        $this->db->insert('access', $data);
        return true;

    }

    public function getaccessbyid($accessid){
        
        $this->db->from('access');
        $this->db->where('userid', $accessid);
        $query = $this->db->get();
        return $query->row();

    }

    public function updateaccessbyid($accessuserupdate, $straccess, $straccessbutton){

        $data = array(

            'accesstypes'=>$straccess,
            'accessbutton'=>$straccessbutton,

    
        );
        
            $this->db->where('accessid', $accessuserupdate);
            $this->db->update('access', $data);
            
            

            // echo "<pre>";
            // print_r($this->db->affected_rows());exit;

            return true;
    }

    public function accessdeletebyid($id){
        
        // $id = $this->input->post('product_id');
       
        $this->db->where('accessid', $id);
        $this->db->delete('access');
    }

    public function get_by_role($role){

        $this->db->from('user');
        // $this->db->where('id', $id);
        $this->db->where('role', 'HR');

        $query = $this->db->get();
            // echo "<pre>";
            // print_r($query->result());exit;
        
        return $query->result();

    }
    public function get_by_manrole($role){

        $this->db->from('user');
        // $this->db->where('id', $id);
        $this->db->where('role', 'Manager');

        $query = $this->db->get();
            // echo "<pre>";
            // print_r($query->result());exit;
        
        return $query->result();

    }

    public function get_five(){
        
        
        $this->db->from('user');
        $this->db->limit(PHP_INT_MAX, 1)->limit(5);
        $query = $this->db->get();
            // echo "<pre>";
            // print_r($query->result());exit;
        
        return $query->result();
    }

    //get custom filter datashow
    public function get_by_ajax()
    {

        // echo "<pre>";
        // print_r($this->input->post('filter_news_title')); exit;

        
        // https://codeigniter.com/userguide3/database/query_builder.html#looking-for-similar-data
        $this->db->like('name', $this->input->post('filter_news_title'));
        $this->db->or_like('email', $this->input->post('filter_news_title'));
        $this->db->or_like('role', $this->input->post('filter_news_title'));
        $this->db->or_like('status', $this->input->post('filter_news_title'), 'none');
        // $this->db->or_like('filesdoc', $this->input->post('filter_news_title'));
            

        $query = $this->db->limit(PHP_INT_MAX, 1)->get('user');
        
        // check the number of rows in the result set
        if ($query->num_rows() > 0) {
            // return the query result as array
            return $query->result_array();
        } else {
            // return the empty array if no row
            return array();
        }
    }

    
    public function get_by_ajax_docs()
    {

       

        // https://codeigniter.com/userguide3/database/query_builder.html#looking-for-similar-data
        $this->db->like('username', $this->input->post('filter_news_title'));
        $this->db->or_like('doc_name', $this->input->post('filter_news_title'));
        $this->db->or_like('dateupdated', $this->input->post('filter_news_title'));



        $query = $this->db->get('filedocs');
            
        // check the number of rows in the result set
        if ($query->num_rows() > 0) {
            // return the query result as array
            return $query->result_array();
        } else {
            // return the empty array if no row
            return array();
        }
    }
    
    public function get_by_searchkey_docs($searchkey){
        $this->db->like('username', $searchkey);
        $this->db->or_like('doc_name', $searchkey);



        $query = $this->db->get('filedocs');

        // check the number of rows in the result set
        if ($query->num_rows() > 0) {
            // return the query result as array
            return $query->result_array();
        } else {
            // return the empty array if no row
            return array();
        } 
    }
    public function get_by_searchkey($searchkey){
        $this->db->like('name', $searchkey);
        $this->db->or_like('email', $searchkey);
        $this->db->or_like('role', $searchkey);
        $this->db->or_like('status', $searchkey);
        // $this->db->or_like('filesdoc', $searchkey);


        $query = $this->db->get('user');

        // check the number of rows in the result set
        if ($query->num_rows() > 0) {
            // return the query result as array
            return $query->result_array();
        } else {
            // return the empty array if no row
            return array();
        } 
    }

    public function get_files()
{
	return $this->db->select()->limit(PHP_INT_MAX, 1)
			->from('filedocs')
            ->get()
            ->result();

			
}
public function updatedoc($fileid, $doc_name){

    $data = array(

        'doc_name'=>$doc_name,

    );
    
    
        $this->db->where('fileid', $fileid);
        $this->db->update('filedocs', $data);
        
        

        

        return true;
}


public function getbydocs_id($id){
        
    $this->db->from('filedocs');
    $this->db->where('fileid', $id);
    $query = $this->db->get();
    return $query->row();

}
public function deletefiledoc()
    {
        $id = $this->input->post('product_id');
        $this->db->where('fileid', $id);
        $this->db->delete('filedocs');
    }


    public function insertData($data) {
        // Start a database transaction
        $this->db->trans_start();
    
        try {
            foreach ($data as $row) {
                // Validate the data before insertion (example: email format)
                if (!filter_var($row['B'], FILTER_VALIDATE_EMAIL)) {
                    // Log or handle validation error
                    continue; // Skip the current iteration if validation fails
                }
    
                $insertData = array(
                    'name' => $row['A'],
                    'email' => $row['B'],
                    'password' => $row['C'],
                    'mobile' => $row['D'],
                    'address' => $row['E'],
                    'education' => $row['F'],
                    'role' => $row['G'],
                    'profpic' => $row['H'],
                    'status' => $row['I'],
                    'datecreateon' => $row['J'],
                    'dateupdatedon' => $row['K'],
                );
    
                $this->db->insert('user', $insertData);
            }
    
            // Complete the transaction
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === false) {
                // Transaction failed, handle the error (log, show message, etc.)
                // You might want to roll back the changes in case of an error
                $this->db->trans_rollback();
            } else {
                // Transaction succeeded, commit the changes
                $this->db->trans_commit();
            }
        } catch (Exception $e) {
            // Handle any other unexpected exceptions
            // You might want to log the exception
            $this->db->trans_rollback();
        }
    }
    
    // Function in User_model to check if an email is duplicate
    public function isEmailDuplicate($email) {
        // Adjust this query based on your database structure
        $query = $this->db->get_where('user', array('email' => $email));
    
        return $query->num_rows() > 0;
    }
    

//Import excel data to database
public function insertDatadocs($data) {
    
       
        $insertData = array(
            'username' => $data['A'],
            'doc_name' => $data['B'],
        );

        $this->db->insert('filedocs', $insertData);

}

public function isNameExists($name) {
        
    $result = $this->db->select()
    ->from('filedocs')
    ->where('username', $name)
    ->get()
    ->result(); 

    return !empty($result);

}

public function isNameuserExists($name) {
        
    // Implement logic to check if the name already exists in the 'user' table
    $this->db->where('name', $name);
    $query = $this->db->get('user');
    return $query->num_rows() > 0;

}
public function isNameaccExists($name) {
        
    // $result = $this->db->select()
    // ->from('access')
    // ->where('username', $name)
    // ->get()
    // ->result(); 

    // return !empty($result);
    // Implement logic to check if the name already exists in the 'access' table
    $this->db->where('username', $name);
    $query = $this->db->get('access');
    return $query->num_rows() > 0;

}
public function insertDataacc($name) {
        
    $result = $this->db->select()
    ->from('access')
    ->where('username', $name)
    ->get()
    ->result(); 

    return !empty($result);

}
public function isNamedocExists($name) {
        
    // $result = $this->db->select()
    // ->from('filedocs')
    // ->where('username', $name)
    // ->get()
    // ->result(); 

    // return !empty($result);
    // Implement logic to check if the name already exists in the 'documents' table
    $this->db->where('username', $name);
    $query = $this->db->get('filedocs');
    return $query->num_rows() > 0;

}

public function insertDatauser($data) {
    
       
    $insertData = array(
        'name' => $data['A'],
        'email' => $data['B'],
        'mobile' => $data['C'],
        'address' => $data['D'],
        'education' => $data['E'],
        'role' => $data['F'],
        'profpic' => $data['G'],
        'status' => $data['H'],

    );

    $this->db->insert('user', $insertData);
    // $this->db->insert('user', $data);


}
public function insertacc($row) {

    $accessuser=$row['A'];

    if($row != NULL){
    $result = $this->db->select('id')
    ->from('user')
    ->where('name', $accessuser)
    ->get()
    ->row(); 
    
    if ($result) {
        $id = $result->id;

        $insertData = array(
            'username' => $row['A'],
            'accesstypes' => $row['B'],
            'accessbutton' => $row['C'],
            'userid' => $id,

        );

        $this->db->insert('access', $insertData);
    } else {
        // Handle the case where no result was found
        echo "No user found for name: $accessuser";
        return false;
    }
    } else {
    // Handle the case where $row is NULL
    return false;
    }
}
    
    


public function insertDatadocsall($row) {
    
    
        
    // $insertData = array(
    //     'username' => $row['A'],
    //     'doc_name' => $row['B'],
    // );

    // $this->db->insert('filedocs', $insertData);


    $username = isset($row['A']) ? trim($row['A']) : '';  // Check if 'username' exists in the row

    if (!empty($username)) {
        // Check if the 'username' already exists in the database
        if (!$this->isNamedocExists($username)) {
            $insertData = array(
                'username' => $username,
                'doc_name' => $row['B'],  // Assuming 'doc_name' is the column name in your Excel file
            );

            // Insert the data into the 'filedocs' table
            $this->db->insert('filedocs', $insertData);
        } else {
            // If the 'username' already exists, skip processing for this row
            echo "Name '$username' already exists in the database. Skipping import for this entry.";
        }
    } else {
        // Handle the case where 'username' is missing or empty
        echo "Username is missing or empty for this entry. Skipping import for this entry.";
    }
}

public function updateDatauser($name, $row) {
    // Assuming you have a primary key column named 'id', you may need to adjust this based on your table structure
    $this->db->where('name', $name);
    

    // Retrieve the existing data from the database
    $existingData = $this->db->get('user')->row_array();

    // Check if the values in the columns are different
    if ($row['B'] != $existingData['email']
        || $row['C'] != $existingData['mobile'] 
        || $row['D'] != $existingData['address'] 
        || $row['E'] != $existingData['education']
        || $row['F'] != $existingData['role'] 
        || $row['G'] != $existingData['profpic'] 
        || $row['H'] != $existingData['status']
        )
    {
        // Append the additional details to the existing values
        $updatedData = array(
            'email' => $row['B'],
            'mobile' => $row['C'],
            'address' => $row['D'],
            'education' => $row['E'],
            'role' => $row['F'],
            'profpic' => $row['G'],
            'status' => $row['H']
        );
       
        if (!empty($existingData)) {
            // echo "<pre>";
            // print_r($existingData);exit;
            $this->db->set($updatedData);
            $this->db->where('name', $name); // Additional WHERE condition
            $this->db->update('user');

            // echo $this->db->last_query(); // Output the last executed query
            // echo $this->db->affected_rows(); // Output the number of affected rows
        } else {
            // Output a message or handle the case when no matching record is found
            echo "No matching record found for name: $name";
        }
    }
     else {
        // Output a message or handle the case when there are no differences in values
        echo "No differences found for name: $name";
    }
    }





public function update_Data_access($name, $row) {
    // Assuming you have a primary key column named 'id', you may need to adjust this based on your table structure
    $this->db->where('username', $name);

    // Retrieve the existing data from the database
    $existingData = $this->db->get('access')->row_array();
    $updatedData = array();

    // Check if the values in the columns are different
    if ($row['B'] != $existingData['accesstypes']
        || $row['C'] != $existingData['accessbutton'] 
        
        )
    {
        // Append the additional details to the existing values
        $updatedData = array(
            'accesstypes' => $existingData['accesstypes'] . ' ' . $row['B'],
            'accessbutton' => $existingData['accessbutton'] . ' ' . $row['C'],
        );
        
        if (!empty($existingData)) {
            $this->db->set($updatedData);
            $this->db->update('access');
        }    
    }


}

public function update_Data_doc($name, $row) {
    // Assuming you have a primary key column named 'id', you may need to adjust this based on your table structure
    $this->db->where('username', $name);

    // Retrieve the existing data from the database
    $existingData = $this->db->get('filedocs')->row_array();
    $updatedData = array();

    // Check if the values in the columns are different
    if ($row['B'] != $existingData['doc_name'])
    {
        // Append the additional details to the existing values
        $updatedData = array(
            'doc_name' => $existingData['doc_name'] . ' ' . $row['B'],
        );
        if (!empty($existingData)) {
            $this->db->set($updatedData);
            $this->db->update('filedocs');
        }
    }  
}

public function role_delete_by_id($id){
    $this->db->where('roleid', $id);
    $this->db->delete('role_table');
}

//Add Access to DB
public function insert_role($data){

    $this->db->insert('role_table', $data);
    return true;

}

public function get_role_by_id($id){
    
        $this->db->from('role_table');
        $this->db->where('roleid', $id);
        $query = $this->db->get();
        return $query->row();

}

public function update_role_by_id($id, $data){

    
        $this->db->where('roleid', $id);
        $this->db->update('role_table', $data);
        
        if ($this->db->affected_rows() > 0) {
            return array(
                'status' => true,
                'roleid' => $id,
                // Add other relevant information
            );
        } else {
            return false;
        }
    }

//Google login process start
function Is_already_register($email)
 {
  $this->db->where('email', $email);
  $query = $this->db->get('user');
  if($query->num_rows() > 0)
  {
   return true;
  }
  else
  {
   return false;
  }
 }

 function Update_user_data($data, $email)
 {

  $this->db->where('email', $email);
  $this->db->update('user', $data);
 }

 function Insert_user_data($data)
 {
  $this->db->insert('user', $data);
 }

 public function getbyemail($id){
    
    $this->db->where('email', $id);
    $query = $this->db->get('user');
    // echo "<pre>";
    // print_r($query->result_array());exit;
    return $query->result_array();
    
 }

 public function insert_log($user_id, $user_name, $action, $menu_item, $additional_info) {
    $data = array(
        'user_id' => $user_id,
        'user_name' => $user_name,
        'action' => $action,
        'menu_item' => $menu_item,
        'additional_info' => $additional_info
    );
    $this->db->insert('user_logs', $data);
}

public function getall_logs(){
    
    $query = $this->db->get('user_logs');
    // echo "<pre>";
    // print_r($query->result_array());exit;
    return $query->result_array();
    
 }


public function get_by_logs_ajax() {
    $filter_user_name = $this->input->post('filter_user_name');

    if (empty($filter_user_name) || $filter_user_name == 'All') {
        // If "All" is selected, retrieve all records without filtering
        $query = $this->db->get('user_logs');
    } else {
        // If a specific user name is selected, apply the filtering conditions
        $this->db->group_start();
        $this->db->like('user_name', $filter_user_name, 'none');
        $this->db->or_like('action', $filter_user_name);
        $this->db->or_like('menu_item', $filter_user_name);
        $this->db->group_end();

        $query = $this->db->get('user_logs');
    }

    // check the number of rows in the result set
    if ($query->num_rows() > 0) {
        // return the query result as an array
        return $query->result_array();
    } else {
        // return an empty array if no rows
        return array();
    }
}


public function get_by_logs_date_ajax()
{
    $filter_user_name = $this->input->post('filter_user_name');
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');

    if (!empty($from_date) && !empty($to_date)) {
        $from_date = new DateTime($from_date);
        $to_date = new DateTime($to_date);

        // Adjust the time part if necessary
        $to_date->setTime(23, 59, 59); // Set the time to the end of the day

        $this->db->where('timestamp >=', $from_date->format('Y-m-d H:i:s'));
        $this->db->where('timestamp <=', $to_date->format('Y-m-d H:i:s'));
    }

    $query = $this->db->get('user_logs');

    // check the number of rows in the result set
    if ($query->num_rows() > 0) {
        // return the query result as an array
        return $query->result_array();
    } else {
        // return an empty array if no rows
        return array();
    }
}


 public function getSettings() {
    // Fetch settings data from the database
    // Modify this query based on your database structure
    $query = $this->db->get('dictionary_table');
    return $query->result_array();
    // echo"<pre>";print_r($query->result_array());exit;

}
public function getall_logosettings() {
    $query = $this->db->get('logo_settings');
    return $query->result_array();

}

function Update_logo_setting($logoName, $logoImage, $copyYear, $logocolor)
 {
    $data = array(
        'logoImage' => $logoImage,
        'logoName' => $logoName,
        'copyYear' => $copyYear,
        'themecolor' => $logocolor,
    );
//   $this->db->where('logo_settings', $email);
  $this->db->update('logo_settings', $data);
 }
 

}