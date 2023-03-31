<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    </head>
    
</html>
<?php

// $curl = curl_init();
// $url  = "https://api.countrystatecity.in/v1/countries";
// $api_key = "VUsxWm53NURjSU9kbTI0dkp5R1RDUWI3ZXdWS3Z1UW13anRWdlpYaw==";
// curl_setopt($curl,CURLOPT_URL,$url);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
// curl_setopt($curl,CURLOPT_HTTPHEADER,['Authorization: Bearer'.$api_key]);

// $response = curl_exec($curl);
// print_r($response);
// curl_close($curl);
// phpinfo();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// print_r(get_loaded_extensions());
// $url = "https://www.learningcontainer.com/wp-content/uploads/2020/03/Sample-employee-XML-file.xml";
$url = "https://api.countrystatecity.in/v1/countries/";
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
} else  ?> 

<label for="country">Choose a country:</label>
    
<select name="country" id="country">
<?php
    $json_object = json_decode($response);
    $countryName = array_map(function($object){
        return $object->name;
    },$json_object);

    $countryCode = array_map(function($object){
        return $object->iso2;
    },$json_object);

    // print_r($countryCode);

    for ($i = 0; $i < count($countryName); $i++){
        echo "<option id=\"$countryCode[$i]\" value=\"$countryName[$i]\">$countryName[$i] </option>";
    }
?>  

</select>
<select name="state" id="state">
    <option value="" id></option>
</select>
<?php
?>

<script>
     $("#country").change(function(){
        var selectedCountry = $(this).find(':selected').attr("id");

        countrySelected(selectedCountry);
    });      
    
     function countrySelected(selectedCountry){
     $.ajax({
        url : 'state.php',               
        method : 'GET',
        data :{
            "selectedCountryCode": selectedCountry
        },

        success : function(response){
        // $("#state").html(response.stateCode)
        // console.log(typeof(response));
        // var res = JSON.'p'arse(response);
        for(var key in response){
            console.log(key);
            console.log(response[key]);
        }
        // console.log(typeof(response));
     },
     error : function(response){
            
        }
    }
    );
}
</script>
