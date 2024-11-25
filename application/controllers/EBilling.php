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
    # This is EBilling Controller
    ###########################################################
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class EBilling extends Cl_Controller {


    /**
     * load constructor
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('EBilling_model');
        $this->load->library('form_validation');
        $this->load->library('excel'); //load PHPExcel library
        $this->Common_model->setDefaultTimezone();
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if (!$this->session->has_userdata('outlet_id')) {
            $this->session->set_flashdata('exception_2', lang('Please_click_on_green'));
            $this->session->set_userdata("clicked_controller", $this->uri->segment(1));
            $this->session->set_userdata("clicked_method", $this->uri->segment(2));
            redirect('Outlet/outlets');
        }

        //start check access function
        $segment_2 = $this->uri->segment(2);
        $segment_3 = $this->uri->segment(3);
        $controller = "350";
        $function = "";
        if($segment_2=="ebillings" || $segment_2 == "getAjaxData"){
            $function = "list";
        }else{
            $this->session->set_flashdata('exception_1',lang('no_access'));
            redirect('Authentication/userProfile');
        }
        if(!checkAccess($controller,$function)){
            $this->session->set_flashdata('exception_1',lang('no_access'));
            redirect('Authentication/userProfile');
        }
        //end check access function
    }

    /**
     * ebillings
     * @access public
     * @param no
     * @return void
     */
    public function ebillings() {
        $data = array();
        //$data['ebillings'] = $this->Common_model->getAllCustomersWithOpeningBalance();
        $data['main_content'] = $this->load->view('EBilling/ebillings', $data, TRUE);
        $this->load->view('userHome', $data);
    }

        /**
     * getAjaxData
     * @access public
     * @param no
     * @return json
     */
    public function getAjaxData() {
        $outlet_id = $this->session->userdata('outlet_id');
        $delivery_status = htmlspecialcharscustom($this->input->post('delivery_status'));
        $ebillings = $this->EBilling_model->make_datatables($outlet_id, $delivery_status);
        $data = array();
        if ($ebillings && !empty($ebillings)) {
            $i = count($ebillings);
        }
        foreach ($ebillings as $value){

            $html = '';
            /*$delivery_html = '';
            $delivery_html='';
            $delivery_html .= '<div data_id="' . escape_output($value->id) . '">
                <div class="form-group ' . (($value->delivery_status == 'Cash Received' || $value->delivery_status == 'Returned' ) ? 'pointer-events-none' : '') . '">
                    <select name="delivery_status" id="delivery_status_trigger" class="form-control select2">
                        <option ' . ($value->delivery_status == 'Sent' ? 'selected' : '') . ' value="Sent">' . lang('Sent') . '</option>
                        <option ' . ($value->delivery_status == 'Returned' ? 'selected' : '') . ' value="Returned">' . lang('Returned') . '</option>
                        <option ' . ($value->delivery_status == 'Cash Received' ? 'selected' : '') . ' value="Cash Received">' . lang('Cash_Received') . '</option>
                    </select>
                </div>
            </div>';*/
            $sub_array =  array();
            $sub_array[] =  '
            <div class="btn_group_wrap">
                <a class="btn btn-deep-purple view_challan" href="javascript:void(0)" sale_id="'. $this->custom->encrypt_decrypt($value->id, 'encrypt') .'" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="'. lang('Challan') .'">
                    <i class="fas fa-print"></i>
                </a>
                <a class="btn btn-unique view_invoice" href="javascript:void(0)" sale_id="'. $this->custom->encrypt_decrypt($value->id, 'encrypt') .'" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="'. lang('print_invoice') .'">
                    <i class="fas fa-print"></i>
                </a>
                <a class="btn btn-cyan pdf_invoice" href="javascript:void(0)" sale_id="'. $this->custom->encrypt_decrypt($value->id, 'encrypt') .'" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="'. lang('download_invoice') .'">
                    <i class="fas fa-download"></i>
                </a>
                <a class="btn btn-warning pdf_invoice" href="javascript:void(0)" sale_id="'. $this->custom->encrypt_decrypt($value->id, 'encrypt') .'" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="'. lang('fe_forward_email') .'">
                    <i class="fas fa-paper-plane"></i>
                </a>
                '.$html.'
            </div>';

            $var_htl = ''; //"<tr><td>".escape_output($variation->name) . "(" . $variation->code . ")</td><td>". getAmtCustom($variation->sale_price)."</td><td>". (isset($variation->purchase_price) && $variation->purchase_price ? getAmtCustom($variation->purchase_price):'0.00'). "</td></tr>";
            //$sub_array[] = '<br><button id="view_fe" type="button" class="new-btn"><i class="far fa-eye"></i>'."<table class='table d-none' id='email_status_html'>".$var_htl."</table>";

            //$sub_array[] = $i--;
            $sub_array[] = '<button id="view_fe_detail" type="button" class="new-btn"><i class="far fa-eye"></i>'."<table class='table d-none' id='email_status_html'>".$var_htl."</table>";
            $sub_array[] = $value->sale_no . "</br><span class='clave_fe_sub'>" . "00100001010000000004" . "</span>";           
            //$sub_array[] = $value->sale_no;          
            $sub_array[] = $value->customer_name . "</br><span class='clave_fe_sub'>" . "3101987654" . "</span>";
            $sub_array[] = getAmtCustom($value->total_payable);
            $sub_array[] = dateFormat($value->date_time);
            $sub_array[] = "<span class='label-status-fe label-status-fe-success'>" . "FACTURA" . "</span>"; // $delivery_html;
            $sub_array[] = "<span class='label-status-fe label-status-fe-success'>" . "ACEPTADO" . "</span>";
            //$sub_array[] = dateFormat($value->added_date);
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($this->EBilling_model->getDrawData()),
            "recordsTotal" => $this->EBilling_model->get_all_data($outlet_id, $delivery_status),
            "recordsFiltered" => $this->EBilling_model->get_filtered_data($outlet_id, $delivery_status),
            "data" => $data
        );
        echo json_encode($output);
    }
}
