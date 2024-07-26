<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    
    public function index() {
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
                $pageColumns = $section['access_page_columns'];
                $buttonColumns = $section['access_button_columns'];

    
                $this->updateSectionSettings($sectionId, $pageHeading, $sideHeading, $pageColumns, $buttonColumns);
            }
    
            // Redirect back to the settings page
            redirect('settings/index?settings_updated=true');
        }
    }
    
    private function getFormData($postData) {
        $formData = [];
    
        foreach ($postData as $section) {
            $formData[] = [
                'access_page_id' => $section['access_page_id'],
                'access_page_heading' => $section['access_page_heading'],
                'access_side_heading' => $section['access_side_heading'],
                'access_page_columns' => $section['access_page_columns'],
                'access_button_columns' => $section['access_button_columns'],

            ];
        }
        // echo"<pre>";print_r($formData);exit;

        return $formData;
    }
    
    private function updateSectionSettings($sectionId, $pageHeading, $sideHeading, $pageColumns, $buttonColumns) {
            // Load the existing settings from the database
            $existingSettings = $this->db->where('dic_id', $sectionId)->get('dictionary_table')->row();

            // If there are no existing settings, insert a new record
            if (!$existingSettings) {
                $data = array(
                    'dic_id' => $sectionId,
                    'pagehead' => $pageHeading,
                    'sidehead' => $sideHeading,
                    'tablehead' => implode(', ', $pageColumns), // Store columns as JSON for simplicity
                    'buttonhead' => implode(', ', $buttonColumns) // Store columns as JSON for simplicity

                );
                $this->db->insert('dictionary_table', $data);
            } else {
                // Update existing record
                $data = array(
                    'pagehead' => $pageHeading,
                    'sidehead' => $sideHeading,
                    'tablehead' => implode(', ', $pageColumns),
                    'buttonhead' => implode(', ', $buttonColumns) // Store columns as JSON for simplicity

                );
                $this->db->where('dic_id', $sectionId)->update('dictionary_table', $data);
            }
        }
    
    
       
}


