<?php   
    $countryCode = $_GET["selectedCountryCode"];
    print_r($_GET);
    // echo $countryCode;


    $url = "https://api.countrystatecity.in/v1/countries/".$countryCode."/states";
  
    $api_key = "VUsxWm53NURjSU9kbTI0dkp5R1RDUWI3ZXdWS3Z1UW13anRWdlpYaw==";

    $headers = array(
        "X-CSCAPI-KEY: $api_key",
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
    ));

        $response = curl_exec($curl);
        $error = curl_error($curl);
 
    curl_close($curl);

    $json_object = json_decode($response);
    $stateName = array_map(function($object){
        return $object->name;
    },$json_object);

    
    $stateCode = array_map(function($object){
        return $object->iso2;
    },$json_object);


    if ($error) {
        echo "cURL Error: " . $error;
    } else{
      
//         $state = array();
// $state['stateCode'] = array('apple','banana','cherry');
// $state['animals'] = array('dog', 'elephant');
// echo json_encode($state);
        // var_dump()
        echo json_encode(array_combine($stateCode,$stateName));
        // echo json_encode($stateCode);
        // echo json_encode($stateName);
    }

?> 
