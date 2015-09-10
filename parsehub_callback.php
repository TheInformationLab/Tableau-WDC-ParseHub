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
if(isset($_GET['runtoken'])) {
        $runtoken = $_GET['runtoken'];
} else {
        $runtoken = "";
}
$uncompress = false;
switch ($req) {
        case 'projects':
                $reqURL = 'https://www.parsehub.com/api/v2/projects?api_key='.$apikey;
                break;
        case 'data':
                $reqURL = 'compress.zlib://https://www.parsehub.com/api/v2/runs/'.$runtoken.'/data?api_key='.$apikey;
                $uncompress=false;
                 break;
        }
$options = array(
        'http' => array(
                'method' => 'GET',
                'header'=>"Accept-Encoding: gzip\r\n"
        ),
);
$context  = stream_context_create($options);
$GETresult = @file_get_contents($reqURL , false, $context);

if($GETresult === FALSE)
        {
                echo "Invalid Request";
        } elseif ($uncompress){
                echo gzdecode($GETresult );
        } else {
                echo $GETresult;
        }

?>
