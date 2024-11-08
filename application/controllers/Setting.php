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
  # This is Setting Controller
  ###########################################################
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Cl_Controller {

    /**
     * load constructor
     * @access public
     * @return void
     */   
    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Outlet_model');
        $this->load->library('form_validation');
        $this->Common_model->setDefaultTimezone();
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        //start check access function
        $segment_2 = $this->uri->segment(2);
        $controller = "1";
        $function = "";
        if($segment_2 == "index" || $segment_2 == "validate_invoice_logo" || $segment_2 == 'moduleManagement'){
            $function = "edit";
        }else if($segment_2 == "add_dummy_data"){
            $controller = "325";
            $function = "add_dummy_data";
        }else if($segment_2 == "deleteDummyData"){
            $controller = "329";
            $function = "deleteDummyData";
        }else if($segment_2 == "wipeTransactionalData"){
            $controller = "331";
            $function = "wipeTransactionalData";
        }else if($segment_2 == "wipeAllData"){
            $controller = "333";
            $function = "wipeAllData";
        }else if($segment_2 == "whatsappSetting"){
            $controller = "327";
            $function = "whatsappSetting";
        }else{
            $this->session->set_flashdata('exception_1',lang('no_access'));
            redirect('Authentication/userProfile');
        }
        if(!checkAccess($controller,$function)){
            $this->session->set_flashdata('exception_1',lang('no_access'));
            redirect('Authentication/userProfile');
        }
    }


    /**
     * index
     * @access public
     * @param int
     * @return void
     */

    public function index($id = '') {
        $register_content = array();
        $company_id = $this->session->userdata('company_id');
        $user_id = $this->session->userdata('user_id');
        if (htmlspecialcharscustom($this->input->post('submit'))) {
            $is_loyalty = htmlspecialcharscustom($this->input->post('is_loyalty_enable'));
            $this->form_validation->set_rules('business_name', lang('Business_Name'), 'required|max_length[50]');
            if((isServiceAccess2($user_id, $company_id, 'sGmsJaFJE') == 'Saas Super Admin') || (isServiceAccess2($user_id, $company_id, 'sGmsJaFJE') == 'Not SaaS')){
                $this->form_validation->set_rules('short_name', lang('short_name'), 'required|max_length[5]');
            }
            $this->form_validation->set_rules('address', lang('address'), 'max_length[255]');
            $this->form_validation->set_rules('website', lang('website'), 'max_length[255]');
            $this->form_validation->set_rules('phone', lang('phone'), 'required|max_length[30]');
            $this->form_validation->set_rules('email', lang('email'), 'required|max_length[55]');
            $this->form_validation->set_rules('date_format', lang('date_format'), 'required|max_length[55]');
            $this->form_validation->set_rules('zone_name', lang('zone_name'), 'required|max_length[55]');
            $this->form_validation->set_rules('currency', lang('currency'), 'required|max_length[3]');
            $this->form_validation->set_rules('currency_position', lang('currency_position'), 'required|max_length[25]');
            $this->form_validation->set_rules('decimals_separator', lang('decimals_separator'), 'required|max_length[10]');
            $this->form_validation->set_rules('thousands_separator', lang('thousands_separator'), 'required|max_length[10]');
            $this->form_validation->set_rules('invoice_prefix', lang('invoice_prefix'), 'required|max_length[11]|regex_match[/^[a-zA-Z0-9_]+$/]');
            $this->form_validation->set_rules('letter_head_gap', lang('letter_head_gap'), 'max_length[50]');
            $this->form_validation->set_rules('letter_footer_gap', lang('letter_footer_gap'), 'max_length[50]');
            $this->form_validation->set_rules('allow_less_sale', lang('Allow_Overselling'), 'required|max_length[10]');
            $this->form_validation->set_rules('default_customer', lang('default_customer'), 'required|max_length[10]');
            $this->form_validation->set_rules('default_payment', lang('default_payment_method'), 'required|max_length[10]');
            $this->form_validation->set_rules('installment_days', lang('installment_notification_days'), 'required|max_length[10]');
            $this->form_validation->set_rules('is_loyalty_enable', lang('loyalty_point'), 'required|max_length[10]');
            if($is_loyalty == 'Enable'){
                $this->form_validation->set_rules('minimum_point_to_redeem', lang('minimum_point_to_redeem'), 'required|max_length[10]');
                $this->form_validation->set_rules('loyalty_rate', lang('loyalty_rate'), 'required|max_length[10]');
            }else{
                $this->form_validation->set_rules('minimum_point_to_redeem', lang('minimum_point_to_redeem'), 'max_length[10]');
                $this->form_validation->set_rules('loyalty_rate', lang('loyalty_rate'), 'max_length[10]');
            }
            $this->form_validation->set_rules('default_cursor_position', lang('default_cursor_position'), 'required|max_length[25]');
            $this->form_validation->set_rules('product_display', lang('Display_Product'), 'required|max_length[25]');
            $this->form_validation->set_rules('onscreen_keyboard_status', lang('onscreen_keyboard_status'), 'required|max_length[25]');
            $this->form_validation->set_rules('inv_no_start_from', lang('inv_no_start_from'), 'required|max_length[6]');
            $this->form_validation->set_rules('product_code_start_from', lang('product_code_start_from'), 'required|max_length[6]');
            $this->form_validation->set_rules('grocery_experience', lang('grocery_experience'), 'required|max_length[25]');
            $this->form_validation->set_rules('direct_cart', lang('Direct_Cart_Add'), 'required');


            if ($this->form_validation->run() == TRUE) {
                $outlet_info = array();
                $outlet_info['business_name'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('business_name')));
                $outlet_info['short_name'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('short_name')));
                $outlet_info['address'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('address')));
                $outlet_info['website'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('website')));
                $outlet_info['phone'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('phone')));
                $outlet_info['email'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('email')));
                // Base64 Image Convert Into Image
                if($_POST['logo_image'] != ''){
                    //generate png files from base_64 data
                    $data = escape_output($_POST['logo_image']);
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $imageName = time().'.png';
                    createDirectory('uploads/site_settings');
                    file_put_contents('uploads/site_settings/'.$imageName, $data);
                    $media_path = $imageName;
                    $this->session->set_userdata('logo_image', $media_path);
                    $outlet_info['invoice_logo'] = htmlspecialcharscustom($media_path);
                }else{
                    $outlet_info['invoice_logo'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('invoice_logo_p')));
                }
                $outlet_info['date_format'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('date_format')));
                $outlet_info['zone_name'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('zone_name')));
                $outlet_info['currency'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('currency')));
                $outlet_info['currency_position'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('currency_position')));
                $outlet_info['precision'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('precision')));
                $outlet_info['decimals_separator'] = htmlspecialcharscustom($this->input->post('decimals_separator'));
                $outlet_info['thousands_separator'] = htmlspecialcharscustom($this->input->post('thousands_separator'));
                $outlet_info['invoice_prefix'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('invoice_prefix')));
                $outlet_info['letter_head_gap'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('letter_head_gap')));
                $outlet_info['letter_footer_gap'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('letter_footer_gap')));
                $outlet_info['allow_less_sale'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('allow_less_sale')));
                $outlet_info['default_customer'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('default_customer')));
                $outlet_info['default_payment'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('default_payment')));
                $outlet_info['installment_days'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('installment_days')));
                $outlet_info['is_loyalty_enable'] = htmlspecialcharscustom($this->input->post('is_loyalty_enable'));
                $outlet_info['minimum_point_to_redeem'] = htmlspecialcharscustom($this->input->post('minimum_point_to_redeem'));
                $outlet_info['loyalty_rate'] = htmlspecialcharscustom($this->input->post('loyalty_rate'));
                $outlet_info['default_cursor_position'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('default_cursor_position')));
                $outlet_info['product_display'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('product_display')));
                $outlet_info['onscreen_keyboard_status'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('onscreen_keyboard_status')));
                $outlet_info['inv_no_start_from'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('inv_no_start_from')));
                $outlet_info['product_code_start_from'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('product_code_start_from')));
                $outlet_info['grocery_experience'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('grocery_experience')));
                $outlet_info['direct_cart'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('direct_cart')));
                $outlet_info['api_token'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('api_token')));
                $outlet_info['pos_total_payable_type'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('pos_total_payable_type')));
                $outlet_info['user_id'] = $user_id;
                //This variable could not be escaped because this is html content
                $outlet_info['term_conditions'] = $_POST['term_conditions'];
                $outlet_info['invoice_footer'] = $_POST['invoice_footer'];
                // Register Information
                $register_content['register_expense'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_expense')));
                $register_content['register_purchase'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_purchase')));
                $register_content['register_purchase_return'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_purchase_return')));
                $register_content['register_supplier_payment'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_supplier_payment')));
                $register_content['register_sale'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_sale')));
                $register_content['register_sale_return'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_sale_return')));
                $register_content['register_installment_down_payment'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_installment_down_payment')));
                $register_content['register_installment_collection'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_installment_collection')));
                $register_content['register_customer_due_receive'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_customer_due_receive')));
                $register_content['register_servicing'] =htmlspecialcharscustom($this->input->post($this->security->xss_clean('register_servicing')));
                $outlet_info['register_content'] = json_encode($register_content);

                if ($company_id == "") {
                    $outlet_info['added_date'] = date('Y-m-d H:i:s');
                    $this->Common_model->insertInformation($outlet_info, "tbl_companies");
                    $this->session->set_flashdata('exception', lang('Information_added_successfully'));
                } else {
                    $this->Common_model->updateInformation($outlet_info, $company_id, "tbl_companies");
                    $this->session->set_flashdata('exception', lang('Information_updated_successfully'));
                }
                //update for progressive app.
                updateAppInfo();
                $this->session->set_userdata($outlet_info);
                redirect('Setting/index');
            } else {
                $data = array();
                $data['outlet_information'] = $this->Common_model->getDataById($company_id, "tbl_companies");
                $data['zone_names'] = $this->Common_model->getAllForDropdown("tbl_time_zone");
                $data['customers'] = $this->Common_model->getAllCustomerNameMobile();
                $data['paymentMethods'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_payment_methods");
                $data['main_content'] = $this->load->view('authentication/setting', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        } else {
            $data = array();
            $data['outlet_information'] = $this->Common_model->getDataById($company_id, "tbl_companies");
            $data['zone_names'] = $this->Common_model->getAllForDropdown("tbl_time_zone");
            $data['customers'] = $this->Common_model->getAllCustomerNameMobile();
            $data['paymentMethods'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_payment_methods");
            $data['main_content'] = $this->load->view('authentication/setting', $data, TRUE);
            $this->load->view('userHome', $data);
        }
        
    }

    
    /**
     * whatsappSetting
     * @access public
     * @param int
     * @return void
     */

     public function whatsappSetting($id = '') {
        $company_id = $this->session->userdata('company_id');
        if (htmlspecialcharscustom($this->input->post('submit'))) {
            $this->form_validation->set_rules('whatsapp_invoice_enable_status', lang('whatsapp_invoice_status'), 'required|max_length[50]');
            $whatsapp_invoice_enable_status = htmlspecialcharscustom($this->input->post($this->security->xss_clean('whatsapp_invoice_enable_status')));
            if($whatsapp_invoice_enable_status=="Enable"){
                $this->form_validation->set_rules('whatsapp_app_key', lang('whatsapp_app_key'), 'required');
                $this->form_validation->set_rules('whatsapp_authkey', lang('whatsapp_app_key'), 'required');
            }
            if ($this->form_validation->run() == TRUE) {
                $outlet_info = array();
                $outlet_info['whatsapp_invoice_enable_status'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('whatsapp_invoice_enable_status')));
                $outlet_info['whatsapp_app_key'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('whatsapp_app_key')));
                $outlet_info['whatsapp_authkey'] = htmlspecialcharscustom($this->input->post($this->security->xss_clean('whatsapp_authkey')));
                if ($company_id == "") {
                    $this->Common_model->insertInformation($outlet_info, "tbl_companies");
                    $this->session->set_flashdata('exception', lang('Information_added_successfully'));
                } else {
                    $this->Common_model->updateInformation($outlet_info, $company_id, "tbl_companies");
                    $this->session->set_flashdata('exception', lang('Information_updated_successfully'));
                }
                redirect('Setting/whatsappSetting');
            } else {
                $data = array();
                $data['outlet_information'] = $this->Common_model->getDataById($company_id, "tbl_companies");
                $data['main_content'] = $this->load->view('shop_setting/whatsapp_setting', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        } else {
            $data = array();
            $data['outlet_information'] = $this->Common_model->getDataById($company_id, "tbl_companies");
            $data['main_content'] = $this->load->view('shop_setting/whatsapp_setting', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }

    /**
     * downloadFile
     * @access public
     * @param string
     * @param string
     * @return boolean
     */
    public function downloadFile($url, $path) {
        $newfname = $path;
        $file = fopen ($url, 'rb');
        if ($file) {
            $newf = fopen ($newfname, 'wb');
            if ($newf) {
                while(!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
            }
        }
        if ($file) {
            fclose($file);
        }
        if ($newf) {
            fclose($newf);
            return true;
        }else{
            return false;
        }
    }

    /**
     * recurse_copy
     * @access public
     * @param string
     * @param string
     * @return boolean
     */
    protected function recurse_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' ) && ($file != 'installer.json')) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                }else{
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * add_dummy_data
     * @access public
     * @param no
     * @return void
     */
    public function add_dummy_data() { 
        if($this->downloadFile(str_rot13("uggcf://jjj.qbbefbsg.pb/hcqngre/bss_cbf/qhzzl_qngn.mvc"), 'build.zip')){
            $zip = new ZipArchive;
            $res = $zip->open('build.zip');
            if($res==TRUE){
                $zip->extractTo('_temp/');
                if($zip){
                    $src = '_temp/';
                            $dst = '.';
                            if(!file_exists('_temp/installer.json')){
                                $this->session->set_flashdata('exception_1',  lang('error_dummy_data_added'));
                                redirect('Authentication/userProfile');
                            }
                            //get information from installer json file
                            $installer = json_decode(file_get_contents('_temp/installer.json'));
                            if(isset($installer->sql)){
                                foreach ($installer->sql as $key => $query) {
                                    if($query){
                                        $this->db->query($query);
                                    }
                                }
                            }

                            $this->recurse_copy($src, $dst);
                            
                        $this->session->set_flashdata('exception',  lang('success_dummy_data_added'));
                        redirect('Item/items');      
                }else{ 
                    $this->session->set_flashdata('exception_1',  lang('error_dummy_data_added'));
                    redirect('Authentication/userProfile');
                }
                $zip->close();
            }
        }else{
            $this->session->set_flashdata('exception_1',  lang('error_dummy_data_added'));
            redirect('Authentication/userProfile');
        }
    }

    /**
     * deleteDummyData
     * @access public
     * @param no
     * @return void
     */
    public function deleteDummyData() { 
        //truncate dummy Data
        $this->db->query("TRUNCATE tbl_items");
        $this->db->query("TRUNCATE 	tbl_item_categories");
        $this->session->set_flashdata('exception',  lang('success_dummy_data_deleted'));
        redirect('Item/items');
    }

    /**
     * wipeTransactionalData
     * @access public
     * @param no
     * @return void
     */
    public function wipeTransactionalData() { 
        //truncate Transactional Data
        $company_id = $this->session->userdata('company_id');
        $this->db->query("DELETE FROM tbl_damages WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_damage_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_deposits WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_expenses WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_expense_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_incomes WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_income_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_installments WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_installment_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase_payments WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase_return WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase_return_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_salaries WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sales WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sales_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sale_payments WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sale_return WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sale_return_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_supplier_payments WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_transfer WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_transfer_items WHERE `company_id` = $company_id");
        $this->session->set_flashdata('exception',  lang('success_transactional_data_deleted'));
        redirect('Authentication/userProfile');
    }


    /**
     * wipeAllData
     * @access public
     * @param no
     * @return void
     */
    public function wipeAllData() { 
        //truncate all wipe Data
        $company_id = $this->session->userdata('company_id');
        $this->db->query("DELETE FROM tbl_attendance WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_brands WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_customer_due_receives WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_customer_groups WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_damages WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_damage_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_delivery_partners WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_deposits WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_expenses WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_expense_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_fixed_asset_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_fixed_asset_stocks WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_fixed_asset_stock_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_fixed_asset_stock_outs WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_fixed_asset_stock_out_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_holds WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_holds_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_incomes WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_income_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_installments WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_installment_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_item_categories WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_notifications WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_printers WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_promotions WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase_payments WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase_return WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_purchase_return_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_quotations WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_quotation_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_racks WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_register WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_roles WHERE id != 1 AND `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_role_access WHERE role_id != 1 AND `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_salaries WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sales WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sales_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sale_payments WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sale_return WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sale_return_details WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_servicing WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_sessions WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_set_opening_stocks WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_supplier_payments WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_transfer WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_transfer_items WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_variations WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_warranties WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_units WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_suppliers WHERE `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_customers WHERE  `name` != 'Walk-in Customer' AND `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_users WHERE id != 1 AND `company_id` = $company_id");
        $this->db->query("DELETE FROM tbl_outlets WHERE `company_id` = $company_id");
        $this->session->set_flashdata('exception',  lang('success_all_data_deleted'));
        redirect('Authentication/userProfile');
    }

    /**
     * validate_invoice_logo
     * @access public
     * @param no
     * @return void
     */

    public function validate_invoice_logo() {
        if ($_FILES['invoice_logo']['name'] != "") {
            $config['upload_path'] = './uploads/site_settings';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = '1000';
            $config['encrypt_name'] = TRUE;
            $config['detect_mime'] = TRUE;
            $this->load->library('upload', $config);

            if(createDirectory('uploads/site_settings')){
                // Delete the old file if it exists
                $old_file = $this->session->userdata('invoice_logo');
                if ($old_file && file_exists($config['upload_path'] . '/' . $old_file)) {
                    unlink($config['upload_path'] . '/' . $old_file);
                }
                if ($this->upload->do_upload("invoice_logo")) {
                    $upload_info = $this->upload->data();
                    $file_name = $upload_info['file_name'];
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './uploads/site_settings/' . $file_name;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $this->session->set_userdata('invoice_logo', $file_name);
                } else {
                    $this->form_validation->set_message('validate_invoice_logo', $this->upload->display_errors());
                    return FALSE;
                }
            } else {
                echo "Something went wrong";
            }
        }
    }


    /**
     * moduleManagement
     * @access public
     * @param int
     * @return void
     */
    public function moduleManagement() {
        if (htmlspecialcharscustom($this->input->post('submit'))) {
            $menuArr = $_POST['menu_arr'];
            $array = [];
            foreach($menuArr as $menu){
                $array['is_hide'] = $_POST['menu_id'.$menu];
                $this->Common_model->updateInformation($array, $menu, "tbl_module_managements");
            }
            $this->session->set_flashdata('exception', lang('Information_updated_successfully'));
            $module_hide_show = getAllChildModule();
            $moduleArr = [];
            foreach($module_hide_show as $module){
                array_push($moduleArr, $module->module_name.'-YES');
            }
            $session_data = [];
            $session_data['module_show_hide'] = $moduleArr;
            $this->session->set_userdata($session_data);
            redirect('Setting/moduleManagement');
        } else {
            $data = array();
            $data['module'] = $this->Common_model->getModuleManagement();
            $data['main_content'] = $this->load->view('authentication/moduleManagement', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }
}
