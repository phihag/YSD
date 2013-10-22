<?php

# $_GET['sig'] - Signature to decrypt.
# $_GET['vid'] - Video ID.
# $_GET['url'] - Video player url.

# $_GET['type'] - Response type: text / json

# $_GET['test'] - Use dummy data to test the service

# Test (dummy) data
$valid_request = false;
$request_data = array(
	"sig" => "2632A05256F6B7C1B4A133C5E22E2AC1FE6D36996.DC02CDEDFEA0911562A5D59533693512B0D25242242",
	"vid" => "oRdxUFDoQe0",
	"url" => "http://s.ytimg.com/yts/jsbin/html5player-vflO-N-9M.js"
	);

# Response (dummy) data
define("RESP_TEXT", 1);
define("RESP_JSON", 2);
define("STATUS_SUCCESS", 1);
define("STATUS_FAILED", -1);
define("DESCRIPTION_SUCCESS", "signature decrypted");
define("DESCRIPTION_FAILED", "failed to decrypt signature");
define("DEFAULT_SIGNATURE", "none");
$response_type = RESP_TEXT;
$json_response_data = array(
	"status" => STATUS_FAILED,
	"description" => DESCRIPTION_FAILED,
	"signature" => DEFAULT_SIGNATURE,
	);

# Python config
$py_path = "/usr/bin/python";
$py_sig_decrypter_path = "./sighelper.py";
$py_other_args = "2>&1"; # use '2>&1' to print python errors - not advised in production



# script start ---

if(isset($_GET['type']) && $_GET['type'] === "json"){
	$response_type = RESP_JSON;
}

if(isset($_GET['test']) && $_GET['test'] === "true"){
	$valid_request = true;
}
else{
	if(isset($_GET['sig']) && $_GET['s'] !== "" && isset($_GET['vid']) && $_GET['vid'] !== "" && isset($_GET['url']) && $_GET['url'] !== ""){
		$request_data[sig] = $_GET['sig'];
		$request_data[vid] = $_GET['vid'];
		$request_data[url] = $_GET['url'];

		$valid_request = true;
	}
}


if($valid_request){
	$decrypted_signature = shell_exec("$py_path $py_sig_decrypter_path $request_data[sig] $request_data[vid] $request_data[url] $py_other_args");
	if($decrypted_signature != ""){
		$json_response_data[status] = STATUS_SUCCESS;
		$json_response_data[description] = DESCRIPTION_SUCCESS;
		$json_response_data[signature] = trim(preg_replace('/\s+/', ' ', $decrypted_signature));
	}
}

if($response_type == RESP_JSON){
	echo json_encode($json_response_data);
}
else{
	echo $json_response_data[signature];
}

?>