<?php
	$config = [
		"private_key_bits" => 1024,
		#"digest_alg" => "sha512",
		#"config" =>"D:/wamp/wamp64/bin/php/php7.0.4/extras/ssl/openssl.cnf"
	];
	$r = openssl_pkey_new($config);
	var_dump(openssl_error_string());die;
	openssl_pkey_export($r, $privkey,null,["config"=>"D:/wamp/wamp64/bin/php/php7.0.4/extras/ssl/openssl.cnf"]);
	var_dump($privkey);//str
	$private = openssl_pkey_get_private(file_get_contents("../res.pem"));
	var_dump($private);//resource
	die;
	$details = openssl_pkey_get_details($r);
	$public = openssl_pkey_get_public($details["key"]);
	$encrpyt = "";
	$data = openssl_private_encrypt(base64_encode("anasdsad"),$encrpyt,$private); 
	var_dump(base64_encode($encrpyt));

	$decrypted = "";
	openssl_public_decrypt($encrpyt, $decrypted,$public);
	var_dump(base64_decode($decrypted));
