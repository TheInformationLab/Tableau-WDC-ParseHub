<?php

if(isset($_GET['apikey'])) {
        $apikey = $_GET['apikey'];
} else {
        $apikey = "";
}
if(isset($_GET['req'])) {
        $req = $_GET['req'];
} else {
        $req = "";
}
if(isset($_GET['run_token'])) {
        $run_token = $_GET['run_token'];
} else {
        $run_token = "";
}
switch ($req) {
        case 'projects':
                $reqURL = 'https://www.parsehub.com/api/v2/projects?api_key='.$apikey;
                break;
        case 'data':
                $reqURL = 'https://www.parsehub.com/api/v2/runs/'.$run_token.'/data?api_key='.$apikey;
                break;
        }
$options = array(
        'http' => array(
                'method' => 'GET'
        ),
);
$context  = stream_context_create($options);
$GETresult = @file_get_contents($reqURL , false, $context);

if($GETresult === FALSE)
        {
                echo "Invalid Request";
        } else {
                echo $GETresult ;
        }
?>
