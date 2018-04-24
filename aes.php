<?php
	$cipher = openssl_get_cipher_methods();
	//AES-256-CBC
	$method = $cipher[17];

	//获取iv长度
	$iv_length = openssl_cipher_iv_length($method);
	$iv = openssl_random_pseudo_bytes($iv_length);//iCm���P
	$key = "sadiuvnxvewjkvdbfnms";
	$data = "abcd";
	$encrypt = base64_encode(openssl_encrypt($data, $method, $key,0,$iv));
	$decrypt = openssl_decrypt(base64_decode($encrypt), $method,$key,0,$iv);
	var_dump($decrypt);