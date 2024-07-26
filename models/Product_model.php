
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
  
  
    public function get_all_products()
    {
        $this->db->from('news');
        $query=$this->db->get();
        return $query->result();
    }
     
    public function create($data)
    {   
       $this->db->insert('news', $data);
       return $this->db->insert_id();
    }
  
    public function get_by_id($id)
    {
        $this->db->from('news');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
 
//Update model method
    public function update($data)
    {
        $where = array('id' => $this->input->post('product_id'));   // were condition that matches id value in database
                                                                    // matches with the id supplied 
         $this->db->update('news', $data, $where);                  //update database news with the $data
         return $this->db->affected_rows();
    }


//Delete model method
    public function delete()
    {
        $id = $this->input->post('product_id');
        $this->db->where('id', $id);
        $this->db->delete('news');
    }
}
