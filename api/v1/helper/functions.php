<?
	function _encode($password, $key){
		$majorsalt = '';

        // if you set your encryption key let's use it
        if ($key != '') {
            // concatenates the encryption key and the password
            $_password = $key . $password;
        } else {
            $_password = $password;
        }

        $_pass = str_split($_password);


        // encrypts every single letter of the password
        foreach ($_pass as $_hashpass) {
            $majorsalt .= md5($_hashpass);
        }

        // encrypts the string combinations of every single encrypted letter
        // and finally returns the encrypted password
        return md5($majorsalt);
	}