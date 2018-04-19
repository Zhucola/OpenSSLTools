<?php
	$config = [
		"private_key_bits"=>2048,
		"digest_alg"=>"sha512",
		"private_key_type"=>OPENSSL_KEYTYPE_RSA,
		"config" =>"D:/wamp/wamp64/bin/php/php7.0.4/extras/ssl/openssl.cnf"
	];
	//生成私钥与公钥对，返回资源类型
	$r = openssl_pkey_new($config);
	//获取秘钥详细信息
	$key_info = openssl_pkey_get_details($r);
	$public_key = $key_info["key"];
	var_dump("PUBLIC_KEY:".$public_key);
	//私钥保护密码
	$password = "";
	$private_bool = openssl_pkey_export($r,$private_key,$password,$config);
	var_dump("PRIVATE_KEY".$private_key);
	
	//获取私钥资源类型
	$private_key_resource = openssl_pkey_get_private($r);
	openssl_get_privatekey($r);

	//获取公钥资源类型
	$public_key_resource = openssl_pkey_get_public($public_key);
	openssl_get_publickey($public_key);

	//私钥加密，公钥解密
	openssl_private_encrypt(base64_encode("asdsda"),$encrypt1,$private_key_resource);
	openssl_public_decrypt($encrypt1,$decrypt1,$public_key_resource);
	var_dump(base64_decode($decrypt1));

	//公钥加密，私钥解密
	openssl_public_encrypt(base64_encode("aaaa"),$encrypt2,$public_key_resource);
	openssl_private_decrypt($encrypt2,$decrypt2,$private_key_resource);
	var_dump(base64_decode($decrypt2));
	while($error = openssl_error_string()){
		var_dump($error);
	}