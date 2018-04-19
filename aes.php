<?php
	$cipher = openssl_get_cipher_methods();
	//AES-256-CBC
	$method = $cipher[17];
	$key = "sadiuvnxvewjkvdbfnms";
	$data = "abcd";
	//非null的初始化向量，如果为null则会抛出warning
	$iv = "aaaaaaaaaaaaaaaa";
	$encrypt = base64_encode(openssl_encrypt($data, $method, $key,0,$iv));
	var_dump($encrypt);
	$decrypt = openssl_decrypt(base64_decode($encrypt), $method,$key,0,$iv);
	var_dump($decrypt);