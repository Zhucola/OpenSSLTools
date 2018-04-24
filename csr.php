<?php
	$config = [
		"private_key_bits"=>1024,
		"digest_alg"=>"sha512",
		"private_key_type"=>OPENSSL_KEYTYPE_RSA,
		"config" =>"D:/wamp/wamp64/bin/php/php7.0.4/extras/ssl/openssl.cnf"
	];
	//生成私钥与公钥对，返回资源类型
	$r = openssl_pkey_new($config);

	$dn = [
		"countryName" => "CN",//国家
	    "stateOrProvinceName" => "Beijing",//省份
	    "localityName" => "Beijing",//区域
	    "organizationName" => "aspire",//公司
	    "organizationalUnitName" => "software",//部门
	    "commonName" => "www.abc.com",//域名
	    "emailAddress" => "363260961@qq.com"//邮箱
	];
	$pk_info = openssl_pkey_get_details($r);
	$public_key = $pk_info["key"];
	var_dump("PUBLIC_KEY:".$public_key);
	$private_bool = openssl_pkey_export($r,$private_key,"",$config);
	var_dump("PRIVATE_KEY:".$private_key);

	$csr = openssl_csr_new($dn,$r,$config);
	var_dump(openssl_csr_get_subject($csr));

	$csr_pk_info = openssl_csr_get_public_key($csr);
	$csr_pk_info = openssl_pkey_get_details($csr_pk_info);
	var_dump($csr_pk_info["key"]==$public_key);  //true

	//csr
	var_dump($csr);//resource
	openssl_csr_export($csr,$csrout,false) && var_dump($csrout);
	file_put_contents("./csr",$csrout);

	//crt
	$x509 = openssl_csr_sign($csr,null,$r,365,$config,2);
	var_dump($x509);//resource

	openssl_x509_export($x509,$cerout,false);
	file_put_contents("./crt",$cerout);

	var_dump(openssl_x509_parse($x509));
	while($error = openssl_error_string()){
		var_dump($error);
	}