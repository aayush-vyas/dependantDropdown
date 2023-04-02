<?php   
 

    $countryCode = $_GET["selectedCountryCode"];
    $stateCode = $_GET["selectedStateCode"];
    
  



    $url = "https://api.countrystatecity.in/v1/countries/".$countryCode."/states/".$stateCode."/cities";

  
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

    if ($error) {
        echo "cURL Error: " . $error;
    } else{
      
    echo json_encode($response);
  
    }

?>