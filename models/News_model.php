<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->helper('url');

                $this->load->database();
        }
        

        public function get_cat()
        {
        
                $query = $this->db->get('category');
                return $query->result_array();
        
        }

        //Get all news
        public function get_news($slug = FALSE)
        {
        if ($slug === FALSE)
        {
                $query = $this->db->get('news');
                return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
        }


        //Get Data by ID

        public function get_data($id=FALSE)
        {
        if ($id === FALSE)
        {
                $query = $this->db->get('news');
                return $query->result_array();
        }

        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
        }

        //Add News to DB
        public function set_news()
        {
        $this->load->helper('url');

        // $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
        }

        

        //Edit News
        public function editCrud($update, $id)
        {
                

                $this->db->where('id',$id);
                $this->db->update('news', $update);
        }

        //Delete data
        function delete_row($id)
        {
        $this->db->where('id', $id);
        $this->db->delete('news');
        }
}