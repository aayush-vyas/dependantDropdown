<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

</html>
<?php

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
    <option value="">Select a Country</option>
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

    <option value="">Select a State</option>
</select>


<select name="city" id="city">

    <option value="">Select a City </option>

</select>



<script>
    $("#country").change(function () {
        var selectedCountry = $(this).find(':selected').attr("id");
        $("#state").empty();
        countrySelected(selectedCountry);

    });


    $("#state").change(function () {
        var selectedState = $(this).find(':selected').attr("id");
        var selectedCountry = $("#country").find(':selected').attr("id");

        $("#city").empty();
        console.log(selectedState);
        stateSelected(selectedState);

    });

    function stateSelected(selectedState) {
        var selectedCountry = $("#country").find(":selected").attr("id");
        $.ajax({
            url: 'city.php',
            method: 'GET',
            data: {
                "selectedCountryCode": selectedCountry,
                "selectedStateCode": selectedState
            },

            success: function (response) {
                // var parsedResponse = JSON.parse(response);
                // var cities = document.getElementById("city");
                // for (var i = 0; i < parsedResponse.length; i++) {

                //     var el = document.createElement("option");
                //     el.textContent = parsedResponse[i].name; // access the name property of each object
                //     cities.appendChild(el);
                // console.log(parsedResponse[i].name);
                // }
                // console.log(cities);
                // console.log(response);

                // const response = '[{\"id\":57589,\"name\":\"Achalpur\"}]';
                // const parsedResponse = JSON.parse(response);
                // const cityNames = parsedResponse.map(city => city.name);
                // console.log(cityNames); // prints ["Achalpur", "Adilabad", "Adalaj"]




                console.log(typeof response);


            },
            error: function (response) {

            }
        });
    }


    function countrySelected(selectedCountry) {
        $.ajax({
            url: 'state.php',
            method: 'GET',
            data: {
                "selectedCountryCode": selectedCountry,

            },

            success: function (response) {
                var parsedResponse = JSON.parse(response);


                var state = document.getElementById("state");

                for (var i = 0; i < parsedResponse.stateName.length; i++) {
                    var el = document.createElement("option");
                    el.textContent = parsedResponse.stateName[i];
                    el.value = parsedResponse.stateName[i];
                    el.setAttribute("id", parsedResponse.stateCode[i]);
                    state.appendChild(el);
                }

            },
            error: function (response) {

            }
        });
    }
</script>