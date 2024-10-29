<?php
class Site_setting { 
    function setSetting(){   
        /**
         * There is some demo of 'OFF POS' don't delete theme
         * All Type
         * General Store
         * Fashion Shop
         * Mobile Shop
         * Computer Shop
         * Pharmacy
         * Service Center
         * Installment Sale
         * Beauty Pourlar
         */
        define('APPLICATION_DEMO_TYPE', 'All Type');

        /**
         * Application SaaS Type Checker
         * SaaS
         * Not SaaS
         */
        define('APPLICATION_SaaS_TYPE', 'Not SaaS');

        /**
         * Application Mode Checker
         * live
         * demo
         */
        define('APPLICATION_MODE', 'live'); 

        if (APPLICATION_MODE == 'demo') {
            # Load the URI core class
            $uri =& load_class('URI', 'core');
            // getting base url
            $root=(isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
            $root.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
            $base_url = $root;
            # Get the third segment
            $get_second_uri = $uri->segment(2)??''; // returns the id
            $get_first_uri = ucfirst($uri->segment(1)??""); // returns the id
            $first_six_letter = substr($get_second_uri, 0, 6); 
            if ($first_six_letter == "delete") {
                //There are no view page that's why used the inline css
                echo "<h2 style='color: red; margin-top: 15%; text-align: center;'>Deleting is not allowed in demo mode!</h2>";
                echo "<p style='color: red; text-align: center;'><a href='".$base_url."Authentication/userProfile'</a>Click to Return</p>";
                    exit;
            }
            $concate_url = $get_first_uri."_".$get_second_uri;

            // echo $get_second_uri;exit;
            if ($get_second_uri == 'setting' || $get_second_uri == 'changeProfile' || $get_second_uri == 'changePassword'  || $get_second_uri == 'TaxSetting'  || $get_second_uri == 'whiteLabel'  || $get_second_uri == 'securityQuestion' || $concate_url == 'Setting_index' | $concate_url == 'WhiteLabel_index' || $get_second_uri == 'whatsappSetting' || $get_second_uri == 'emailSetting' || $get_second_uri == 'SMSSetting' || $get_second_uri == 'add_dummy_data' || $get_second_uri == 'deleteDummyData' || $get_second_uri == 'wipeTransactionalData' || $get_second_uri == 'wipeAllData') {
                if (!empty($_POST['submit'])) {
                    //There are no view page that's why used the inline css
                      echo "<h2 style='color: red; margin-top: 15%; text-align: center;'>Not allowed in demo mode!</h2>";
                      echo "<p style='color: red; text-align: center;'><a href='".$base_url."Authentication/userProfile'</a>Click to Return</p>";
                    exit;
                }
            }
            if ($get_second_uri == 'deleteDummyData' || $get_second_uri == 'wipeTransactionalData' || $get_second_uri == 'wipeAllData') {
                //There are no view page that's why used the inline css
                echo "<h2 style='color: red; margin-top: 15%; text-align: center;'>Not allowed in demo mode!</h2>";
                echo "<p style='color: red; text-align: center;'><a href='".$base_url."Authentication/userProfile'</a>Click to Return</p>";
                exit;
            }
            if ($get_first_uri == 'Update') {
                //There are no view page that's why used the inline css
                echo "<h2 style='color: red; margin-top: 15%; text-align: center;'>Not allowed in demo mode!</h2>";
                  echo "<p style='color: red; text-align: center;'><a href='".$base_url."Authentication/userProfile'</a>Click to Return</p>";
                exit;
            }
        }
    }
}
?>