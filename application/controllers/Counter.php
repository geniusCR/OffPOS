<?php
/*
  ###########################################################
  # PRODUCT NAME:   Off POS
  ###########################################################
  # AUTHER:   Door Soft
  ###########################################################
  # EMAIL:   info@doorsoft.co
  ###########################################################
  # COPYRIGHTS:   RESERVED BY Door Soft
  ###########################################################
  # WEBSITE:   https://www.doorsoft.co
  ###########################################################
  # This is Counter Controller
  ###########################################################
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Counter extends Cl_Controller {

    /**
     * load constructor
     * @access public
     * @return void
     */    
    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->library('form_validation');
        $this->Common_model->setDefaultTimezone();
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        //start check access function
        $segment_2 = $this->uri->segment(2);
        $segment_3 = $this->uri->segment(3);
        $controller = "3";
        $function = "";
        if($segment_2 == "addEditCounter"){
            $function = "add";
        }elseif($segment_2 == "addEditCounter" && $segment_3){
            $function = "edit";
        }elseif($segment_2 == "deleteCounter"){
            $function = "delete";
        }elseif($segment_2 == "counters"){
            $function = "list";
        }else{
            $this->session->set_flashdata('exception_1', lang('no_access'));
            redirect('Authentication/userProfile');
        }
        if(!checkAccess($controller,$function)){
            $this->session->set_flashdata('exception_1', lang('no_access'));
            redirect('Authentication/userProfile');
        }
        //end check access function
    }
    
    /**
     * addEditCounter
     * @access public
     * @param int
     * @return void
     */
    public function addEditCounter($encrypted_id = "") {
        $company_id = $this->session->userdata('company_id');
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if (htmlspecialcharscustom($this->input->post('submit'))) {
            $this->form_validation->set_rules('name', lang('counter_name'), 'required|max_length[55]');
            $this->form_validation->set_rules('outlet_id', lang('outlet_name'), 'required|max_length[11]');
            $this->form_validation->set_rules('printer_id', lang('printer_name'), 'max_length[11]');
            $this->form_validation->set_rules('description', lang('description'), 'max_length[250]');
            if ($this->form_validation->run() == TRUE) {
                $add_more = $this->input->post($this->security->xss_clean('add_more'));
                $igc_info = array();
                $igc_info['name'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('name')));
                $igc_info['outlet_id'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('outlet_id')));
                $igc_info['printer_id'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('printer_id')));
                $igc_info['description'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('description')));
                $igc_info['company_id'] = $this->session->userdata('company_id');
                $igc_info['user_id'] = $this->session->userdata('user_id');
                if ($id == "") {
                    $igc_info['added_date'] = date('Y-m-d H:i:s');
                    if(APPLICATION_L){
                        if(APPLICATION_LC){
                            $this->session->set_flashdata('exception_error', lang('insert_err_c'));
                            redirect('Counter/counters');
                        } else {
                            $this->Common_model->insertInformation($igc_info, "tbl_counters");
                            $this->session->set_flashdata('exception', lang('insertion_success'));
                        }
                    } else {
                        $this->Common_model->insertInformation($igc_info, "tbl_counters");
                        $this->session->set_flashdata('exception', lang('insertion_success'));
                    }
                } else {
                    $this->Common_model->updateInformation($igc_info, $id, "tbl_counters");
                    $this->session->set_flashdata('exception', lang('update_success'));
                }
                if($add_more == 'add_more'){
                    redirect('Counter/addEditCounter');
                }else{
                    redirect('Counter/counters');
                }
            } else {
                if ($id == "") {
                    $data = array();
                    $data['outlets'] =  $this->Common_model->getAllOutletsASC();
                    $data['printers'] =  $this->Common_model->getAllPrinter($company_id);
                    $data['main_content'] = $this->load->view('master/counter/addCounter', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['outlets'] =  $this->Common_model->getAllOutletsASC();
                    $data['printers'] =  $this->Common_model->getAllPrinter($company_id);
                    $data['counter'] = $this->Common_model->getDataById($id, "tbl_counters");
                    $data['main_content'] = $this->load->view('master/counter/editCounter', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['outlets'] =  $this->Common_model->getAllOutletsASC();
                $data['printers'] =  $this->Common_model->getAllPrinter($company_id);
                $data['main_content'] = $this->load->view('master/counter/addCounter', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['outlets'] =  $this->Common_model->getAllOutletsASC();
                $data['printers'] =  $this->Common_model->getAllPrinter($company_id);
                $data['counter'] = $this->Common_model->getDataById($id, "tbl_counters");
                $data['main_content'] = $this->load->view('master/counter/editCounter', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /**
     * deleteCounter
     * @access public
     * @param int
     * @return void
     */
    public function deleteCounter($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $this->Common_model->deleteStatusChange($id, "tbl_counters");
        $this->session->set_flashdata('exception', lang('delete_success'));
        redirect('Counter/counters');
    }



    /**
     * counters
     * @access public
     * @param no
     * @return void
     */
    public function counters() {
        $company_id = $this->session->userdata('company_id');
        $data = array();
        $data['counters'] = $this->Common_model->getAllCounters($company_id, "tbl_counters");
        $data['main_content'] = $this->load->view('master/counter/counters', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    
}
