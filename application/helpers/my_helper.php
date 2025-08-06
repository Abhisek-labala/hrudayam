<?php
function encrypt($string)
{
    if (empty($string)) {
        return $string;
    } else {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'key';
        $secret_iv = 'iv';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
}

function decrypt($string)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'key';
    $secret_iv = 'iv';
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function prd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die;
}

function escapeSpcl($string)
{
    $string = trim($string);
    $string = preg_replace('/[^a-zA-Z0-9&\-]/', ' ', $string);
    $string = preg_replace('/^[\-]+/', '', $string);
    $string = preg_replace('/[\-]+$/', '', $string);
    $string = preg_replace('/[\-]{2,}/', ' ', $string);
    $string = trim($string);
    return $string;
}

function escapeSpclNew($string)
{
    $string = preg_replace('/[^a-zA-Z0-9&\-]/', '', $string);
    $string = trim($string);
    return $string;
}


function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


// Function to sanitize input
function sanitize_input($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

function imageExtensionAllow()
{
    return $allowedfileExtensions = array('jpg', 'jpeg', 'png');
}

function DocExtensionAllow()
{
    return $allowedfileExtensions = array('pdf', 'xls');
}

function getFullName($firstName, $lastName)
{
    if ($firstName && $lastName) {
        return $firstName . ' ' . $lastName;
    }
}


function getAllEducator()
{
    $CI =& get_instance();
    $educators = array();
    $query = "SELECT * FROM `educator` WHERE `first_name`!='' ORDER BY `first_name`";
    $educatorData = $CI->master_model->customQueryArray($query);


    $educatorDataIdWise = array();
    if ($educatorData) {
        foreach ($educatorData as $key => $item) {
            $educatorId = $item['id'];
            $educatorDataIdWise[$educatorId] = $item;
        }
    }
    return array('educatorData' => $educatorData, 'educatorDataIdWise' => $educatorDataIdWise);
}
function getAllDigiEducator()
{
    $CI =& get_instance();
    $educators = array();
    $query = "SELECT * FROM `digital_educator` WHERE `first_name`!='' ORDER BY `first_name`";
    $educatorData = $CI->master_model->customQueryArray($query);


    $educatorDataIdWise = array();
    if ($educatorData) {
        foreach ($educatorData as $key => $item) {
            $educatorId = $item['id'];
            $educatorDataIdWise[$educatorId] = $item;
        }
    }
    return array('educatorData' => $educatorData, 'educatorDataIdWise' => $educatorDataIdWise);
}


function getAllRM()
{
    $CI =& get_instance();
    $doctors = array();
    $query = "SELECT * FROM `rm_name` WHERE `name`!='' ORDER BY `name`";
    $rmManagerData = $CI->master_model->customQueryArray($query);

    $rmManagerDataIdWise = array();
    if ($rmManagerData) {
        foreach ($rmManagerData as $key => $item) {
            $educatorId = $item['id'];
            $rmManagerDataIdWise[$educatorId] = $item;
        }
    }

    return array('rmManagerData' => $rmManagerData, 'rmManagerDataIdWise' => $rmManagerDataIdWise);
}






function getAllDoctor()
{
    $CI =& get_instance();
    $doctors = array();
    $query = "SELECT * FROM `doctors_new` WHERE `name`!='' ORDER BY `name`";

    $doctorsData = $CI->master_model->customQueryArray($query);
    return array('doctorsData' => $doctorsData);
}

function getAllZoneManager()
{
    $CI =& get_instance();
    $doctors = array();
    $query = "SELECT * FROM `zone_managers` WHERE `first_name`!='' ORDER BY `first_name`";
    $zonaManagerData = $CI->master_model->customQueryArray($query);
    return array('zoneManagerData' => $zonaManagerData);
}

function getAllDistrictManager()
{
    $CI =& get_instance();
    $doctors = array();
    $query = "SELECT * FROM `district_managers` WHERE `first_name`!='' ORDER BY `first_name`";
    $districtManagerData = $CI->master_model->customQueryArray($query);
    return array('districtManagerData' => $districtManagerData);
}








function getEducatorDetails($educatorId)
{
    $CI =& get_instance();
    $query = "SELECT * FROM `educator` WHERE id='" . $educatorId . "' limit 1";
    $educatorData = $CI->master_model->customQueryRow($query);
    if (!$educatorData) {
        $educatorData = array();
    }
    return array('educatorData' => $educatorData);
}





function getDoctorByEducator($educatorId)
{
    $CI =& get_instance();
    $query = "SELECT * FROM `doctors` WHERE educator_id='" . $educatorId . "' And `first_name`!='' ORDER BY `first_name`";
    //$query = "SELECT * FROM `doctors` WHERE `first_name`!='' ORDER BY `first_name`";
    $doctorsData = $CI->master_model->customQueryArray($query);
    return array('doctorsData' => $doctorsData);
}



function getDistrictManagerByZone($zoneManagerId)
{
    $CI =& get_instance();
    $query = "SELECT * FROM `district_managers` WHERE zonal_manager_id='" . $zoneManagerId . "' And `first_name`!='' ORDER BY `first_name`";
    //$query = "SELECT * FROM `doctors` WHERE `first_name`!='' ORDER BY `first_name`";
    $zoneManagerData = $CI->master_model->customQueryArray($query);
    return array('zoneManagerData' => $zoneManagerData);
}


function getEducatorByDm($dmId)
{
    $CI =& get_instance();
    $query = "SELECT * FROM `educator` WHERE abm_id='" . $dmId . "' And `first_name`!='' ORDER BY `first_name`";
    //$query = "SELECT * FROM `doctors` WHERE `first_name`!='' ORDER BY `first_name`";
    $educatorData = $CI->master_model->customQueryArray($query);
    return array('educatorData' => $educatorData);
}

function getPatientByEducatorAndDoctorId($educatorId, $doctorId)
{
    $CI =& get_instance();
    $doctors = array();
    if ($doctorId && $educatorId) {
        $query = "SELECT * FROM `patient_inquiry` WHERE `doctor_id`='" . $doctorId . "' and `educator_id`='" . $educatorId . "' ORDER BY `first_name`";
    } else {
        $query = "SELECT * FROM `patient_inquiry` WHERE `doctor_id`='" . $doctorId . "' ORDER BY `first_name`";
    }
    //echo $query;
    $patientData = $CI->master_model->customQueryArray($query);
    return array('patientData' => $patientData);
}


function getAllCity()
{
    $CI =& get_instance();
    $query = "SELECT * FROM `all_cities` WHERE `city_name`!='' and `city_code`!='' and `state_code`!='' ORDER BY `city_name`";
    //echo $query;
    $cityData = $CI->master_model->customQueryArray($query);

    $citiesDataIdWise = array();
    if ($cityData) {
        foreach ($cityData as $key => $item) {
            $city_code = $item['city_code'];
            $state_code = $item['state_code'];
            $cityId = $item['id'];
            $citiesDataCityCodeWise[$city_code] = $item;
            $citiesDataIdWise[$cityId] = $item;
        }
    }


    return array('allCities' => $cityData, 'citiesDataCityCodeWise' => $citiesDataCityCodeWise, 'citiesDataIdWise' => $citiesDataIdWise);
}

function getAllState()
{
    $CI =& get_instance();
    $query = "SELECT * FROM `state_list` WHERE `state`!=''ORDER BY `state`";
    //echo $query;
    $stateData = $CI->master_model->customQueryArray($query);
    return array('allState' => $stateData);
}






function getIndianStates()
{
    return array(
        "AN" => "Andaman and Nicobar Islands",
        "AP" => "Andhra Pradesh",
        "AR" => "Arunachal Pradesh",
        "AS" => "Assam",
        "BR" => "Bihar",
        "CH" => "Chandigarh",
        "CT" => "Chhattisgarh",
        "DN" => "Dadra and Nagar Haveli and Daman and Diu",
        "DL" => "Delhi",
        "GA" => "Goa",
        "GJ" => "Gujarat",
        "HR" => "Haryana",
        "HP" => "Himachal Pradesh",
        "JK" => "Jammu and Kashmir",
        "JH" => "Jharkhand",
        "KA" => "Karnataka",
        "KL" => "Kerala",
        "LA" => "Ladakh",
        "LD" => "Lakshadweep",
        "MP" => "Madhya Pradesh",
        "MH" => "Maharashtra",
        "MN" => "Manipur",
        "ML" => "Meghalaya",
        "MZ" => "Mizoram",
        "NL" => "Nagaland",
        "OD" => "Odisha",
        "PY" => "Puducherry",
        "PB" => "Punjab",
        "RJ" => "Rajasthan",
        "SK" => "Sikkim",
        "TN" => "Tamil Nadu",
        "TS" => "Telangana",
        "TR" => "Tripura",
        "UP" => "Uttar Pradesh",
        "UT" => "Uttarakhand",
        "WB" => "West Bengal"
    );
}


function isRequired($value)
{
    return isset($value) && trim($value) !== '';
}

function isNumeric($value)
{
    return isRequired($value) && is_numeric($value);
}

function isOptionalNumeric($value)
{
    return trim($value) === '' || is_numeric($value);
}

function isOptionalEmail($email)
{
    return trim($email) === '' || filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isOptionalMobile($mobile)
{
    return trim($mobile) === '' || preg_match('/^[6-9][0-9]{9}$/', $mobile);
}





function isFloatOrInt($value)
{
    return is_numeric($value);
}

function isAlphabet($value)
{
    return preg_match('/^[a-zA-Z\s]+$/', $value);
}

function isAlphanumeric($value)
{
    return preg_match('/^[a-zA-Z0-9\s]+$/', $value);
}

function isValidFileType($filename)
{
    $allowedExtensions = ['jpeg', 'jpg', 'png'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($ext, $allowedExtensions);
}

function getEducatorPatient($educatorId)
{
    $CI =& get_instance();
    $query = "SELECT * FROM `patient_inquiry_new` WHERE `educator_id`='" . $educatorId . "' AND `patient_name`!=''  ORDER BY `date` desc";
    //echo $query;
    $EducatorPatient = $CI->master_model->customQueryArray($query);
    return array('EducatorPatient' => $EducatorPatient);
}
function getDigitalEducatorPatient($digital_educator_id)
{
    $CI =& get_instance();
    $query = "SELECT A.*, B.first_name AS educator_name 
          FROM `patient_inquiry_new` A 
          LEFT JOIN `educator` B ON A.`educator_id` = B.`id` 
          WHERE A.`digital_educator_id` = '" . $digital_educator_id . "'  AND `patient_name`!='' 
          ORDER BY A.`date` DESC";//echo $query;
    $EducatorPatient = $CI->master_model->customQueryArray($query);
    return array('EducatorPatient' => $EducatorPatient);
}
function getpatientlistdata()
{
    $CI =& get_instance();
    $query = "SELECT * FROM `patient_inquiry_new` where patient_enrolled='Yes' ORDER BY `id` desc";
    //echo $query;
    $EducatorPatient = $CI->master_model->customQueryArray($query);
    return array('EducatorPatient' => $EducatorPatient);
}
function getpatientlistdata2()
{
    $CI =& get_instance();
    $query = "SELECT A.* ,B.first_name AS educator_name,C.first_name AS digital_eductor_name
FROM `patient_inquiry_new` A
LEFT JOIN `educator` B ON B.id = A.educator_id
LEFT JOIN `digital_educator` C ON C.id = A.digital_educator_id
ORDER BY A.id DESC;";
    //echo $query;
    $EducatorPatient = $CI->master_model->customQueryArray($query);
    return array('EducatorPatient' => $EducatorPatient);
}

function genderString($id)
{
    $gender = "";
    $genderArray = array(1 => 'Male', 2 => 'Female');
    if (isset($genderArray[$id])) {
        $gender = $genderArray[$id];
    }
    //echo  $gender;
    return $gender;
}

function generateRandomPassword($minLength = 8, $maxLength = 12)
{
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    //$special   = '!@#$%^&*()-_=+[]{}|;:,.<>?';
    $special = '!@#$%^&*-_=[]';

    // Ensure required character types
    $password = '';
    $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
    $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
    $password .= $special[rand(0, strlen($special) - 1)];

    // Remaining characters
    $allChars = $lowercase . $uppercase . $numbers . $special;
    $remainingLength = rand($minLength, $maxLength) - strlen($password);

    for ($i = 0; $i < $remainingLength; $i++) {
        $password .= $allChars[rand(0, strlen($allChars) - 1)];
    }

    // Shuffle the password so required characters are not always in the same position
    return str_shuffle($password);
}






function medicines()
{
    return $medicines = array(
        ['id' => 1, 'name' => 'Dytor'],
        ['id' => 2, 'name' => 'Dytor Plus'],
        ['id' => 3, 'name' => 'Dytor Plus LS'],
        ['id' => 4, 'name' => 'Dytor E'],
        ['id' => 5, 'name' => 'Dytor MD'],
        ['id' => 6, 'name' => 'Metolar'],
        ['id' => 7, 'name' => 'Metolar XR'],
        ['id' => 8, 'name' => 'Metolar TL'],
        ['id' => 9, 'name' => 'Metolar Trio'],
        ['id' => 10, 'name' => 'Metolar 3D'],
        ['id' => 11, 'name' => 'Metolar XT'],
        ['id' => 12, 'name' => 'Metolar D'],
        ['id' => 13, 'name' => 'CRESAR LN'],
        ['id' => 14, 'name' => 'Cresar'],
        ['id' => 15, 'name' => 'Cresar H'],
        ['id' => 16, 'name' => 'Cresar AM'],
        ['id' => 17, 'name' => 'Cresar CT'],
        ['id' => 18, 'name' => 'Cresar AMH'],
        ['id' => 19, 'name' => 'Cresar M'],
        ['id' => 20, 'name' => 'Cresar 3D'],
        ['id' => 21, 'name' => 'Cresar BS'],
        ['id' => 22, 'name' => 'ROSULIP'],
        ['id' => 23, 'name' => 'ROSULIP ASP'],
        ['id' => 24, 'name' => 'ROSULIP CV'],
        ['id' => 25, 'name' => 'ROSULIP F'],
        ['id' => 26, 'name' => 'ROSULIP GOLD'],
        ['id' => 27, 'name' => 'Rosulip Ez'],
        ['id' => 28, 'name' => 'SITACIP'],
        ['id' => 29, 'name' => 'SITACIP D'],
        ['id' => 30, 'name' => 'SITACIP M'],
        ['id' => 31, 'name' => 'SITACIP DM'],
        ['id' => 32, 'name' => 'Sitacip E'],
        ['id' => 33, 'name' => 'Eplerite'],
        ['id' => 34, 'name' => 'Bisofig'],
        ['id' => 35, 'name' => 'Bisofig AM'],
        ['id' => 36, 'name' => 'Bisofig T'],
        ['id' => 37, 'name' => 'Linacip'],
        ['id' => 38, 'name' => 'Linacip D'],
        ['id' => 39, 'name' => 'Linacip M'],
        ['id' => 40, 'name' => 'Linacip E'],
        ['id' => 41, 'name' => 'Arnicor'],
        ['id' => 42, 'name' => 'Empacip'],
        ['id' => 43, 'name' => 'Empacip M'],
        ['id' => 44, 'name' => 'Empacip M-XR'],
        ['id' => 45, 'name' => 'Empacip S'],
        ['id' => 46, 'name' => 'Empasov'],
        ['id' => 47, 'name' => 'Empasov M'],
        ['id' => 48, 'name' => 'Empasov M-XR'],
        ['id' => 49, 'name' => 'Empasov S'],
        ['id' => 50, 'name' => 'Amlopres'],
        ['id' => 51, 'name' => 'Amlopres TL'],
        ['id' => 52, 'name' => 'Amlopres B'],
        ['id' => 53, 'name' => 'Amlopres Trio'],
        ['id' => 54, 'name' => 'Dapasach MS'],
        ['id' => 55, 'name' => 'Dapasach'],
        ['id' => 56, 'name' => 'Dapasach M'],
        ['id' => 57, 'name' => 'Dapasach S'],
        ['id' => 58, 'name' => 'Ivabeat'],
        ['id' => 59, 'name' => 'Carloc'],
        ['id' => 60, 'name' => 'Apigy'],
        ['id' => 61, 'name' => 'ATORLIP'],
        ['id' => 62, 'name' => 'TICACIP'],
        ['id' => 63, 'name' => 'DABIPLA'],
        ['id' => 64, 'name' => 'Warf'],
        ['id' => 65, 'name' => 'Vysov'],
        ['id' => 66, 'name' => 'Vysov D'],
        ['id' => 67, 'name' => 'Vysov DM'],
        ['id' => 68, 'name' => 'Vysov M'],
        ['id' => 69, 'name' => 'Vysov XR'],
        ['id' => 70, 'name' => 'Mexohar'],
        ['id' => 71, 'name' => 'Galvus Met'],
        ['id' => 72, 'name' => 'Linacip EM'],
        ['id' => 73, 'name' => 'Bisofig D'],
        ['id' => 74, 'name' => 'Metolar D'],
        ['id' => 75, 'name' => 'Rosulip Ez'],

    );
}

function Medicine_Header()
{
    return $Medicine_Header = array(
        ['id' => 1, 'name' => 'Ascend'],
        ['id' => 2, 'name' => 'Velocia'],
        ['id' => 3, 'name' => 'Magna'],
        ['id' => 4, 'name' => 'Vesta'],
        ['id' => 5, 'name' => 'Alpha'],
        ['id' => 6, 'name' => 'Innova']
    );
}
function Compititors()
{
    return $Compititors = array(
        ['id' => 1, 'name' => 'Rosulip-Rosuvas'],
        ['id' => 2, 'name' => 'Rosulip-Rozavel'],
        ['id' => 3, 'name' => 'Rosulip-Rozucor'],
        ['id' => 4, 'name' => 'Rosulip-Roseday'],
        ['id' => 5, 'name' => 'Rosulip-Rozat'],
        ['id' => 6, 'name' => 'Rosulip-Razel'],
        ['id' => 7, 'name' => 'Dytor-Tide'],
        ['id' => 8, 'name' => 'Dytor-Tor'],
        ['id' => 9, 'name' => 'Dytor-Torsid'],
        ['id' => 10, 'name' => 'Dytor-Torset'],
        ['id' => 11, 'name' => 'Dytor-Jbtor'],
        ['id' => 12, 'name' => 'Dytor-Torsinex'],
        ['id' => 13, 'name' => 'Dytor-Torvigress'],
        ['id' => 14, 'name' => 'Dytor-Torget'],
        ['id' => 15, 'name' => 'Dytor-Meltor'],
        ['id' => 16, 'name' => 'Dytor-Durite'],
        ['id' => 17, 'name' => 'Dytor-Retorlix'],
        ['id' => 18, 'name' => 'Dytor-Concitor'],
        ['id' => 19, 'name' => 'Bisofig-Concor'],
        ['id' => 20, 'name' => 'Bisofig-Corbis'],
        ['id' => 21, 'name' => 'Bisofig-Bisoheart'],
        ['id' => 22, 'name' => 'Bisofig-Bisonext'],
        ['id' => 23, 'name' => 'Bisofig-Bisotab'],
        ['id' => 24, 'name' => 'Bisofig-Bisobis'],
        ['id' => 25, 'name' => 'Bisofig-Biselect'],
        ['id' => 26, 'name' => 'Bisofig-Bisopharm'],
        ['id' => 27, 'name' => 'Bisofig-Besicor'],
        ['id' => 28, 'name' => 'Bisofig-Bisolong'],
        ['id' => 29, 'name' => 'Bisofig-Bisosafe'],
        ['id' => 30, 'name' => 'Bisofig-Besoloc'],
        ['id' => 31, 'name' => 'Bisofig-Bisoziff'],
        ['id' => 32, 'name' => 'Bisofig-Bisveda'],
        ['id' => 33, 'name' => 'Bisofig-Bibeta'],
        ['id' => 34, 'name' => 'Bisofig-Concovas'],
        ['id' => 35, 'name' => 'Bisofig-Acbiso'],
        ['id' => 36, 'name' => 'Bisofig-Biscard'],
        ['id' => 37, 'name' => 'Bisofig-Bisocar'],
        ['id' => 38, 'name' => 'Bisofig-Bisodren'],
        ['id' => 39, 'name' => 'Arnicor-Vymada'],
        ['id' => 40, 'name' => 'Arnicor-Cidmus'],
        ['id' => 41, 'name' => 'Arnicor-Azmarda'],
        ['id' => 42, 'name' => 'Arnicor-Neptaz'],
        ['id' => 43, 'name' => 'Arnicor-Zayo'],
        ['id' => 44, 'name' => 'Arnicor-Valentas'],
        ['id' => 45, 'name' => 'Arnicor-Arney'],
        ['id' => 46, 'name' => 'Arnicor-Sacurise'],
        ['id' => 47, 'name' => 'Arnicor-Hefcard'],
        ['id' => 48, 'name' => 'Arnicor-Arnipin'],
        ['id' => 49, 'name' => 'Eplerite-Planep'],
        ['id' => 50, 'name' => 'Eplerite-Eptus'],
        ['id' => 51, 'name' => 'Eplerite-Eplehef'],
        ['id' => 52, 'name' => 'Eplerite-Eplebless'],
        ['id' => 53, 'name' => 'Eplerite-Epnone'],
        ['id' => 54, 'name' => 'Eplerite-Exenta'],
        ['id' => 55, 'name' => 'Eplerite-Exinia'],
        ['id' => 56, 'name' => 'Eplerite-Ezuric'],
        ['id' => 57, 'name' => 'Eplerite-Eplecard'],
        ['id' => 58, 'name' => 'Eplerite-Eplitar'],
        ['id' => 59, 'name' => 'Eplerite-Eplinice'],
        ['id' => 60, 'name' => 'Dytor E-Planep T'],
        ['id' => 61, 'name' => 'Dytor E-Eptus-T'],
        ['id' => 62, 'name' => 'Dytor E-Tide E'],
        ['id' => 63, 'name' => 'Dytor E-Epnone-T'],
        ['id' => 64, 'name' => 'Dytor E-Exenta T'],
        ['id' => 65, 'name' => 'Dytor Plus-Tide Plus'],
        ['id' => 66, 'name' => 'Dytor Plus-Torsid Plus'],
        ['id' => 67, 'name' => 'Dytor Plus-Torget Plus'],
        ['id' => 68, 'name' => 'Dytor Plus-Torsinex Plus'],
        ['id' => 69, 'name' => 'Dytor Plus-Jbtor Plus'],
        ['id' => 70, 'name' => 'Dytor Plus-Aldactone T'],
        ['id' => 71, 'name' => 'Dytor Plus-Semitor Plus'],
        ['id' => 72, 'name' => 'Dytor Plus-Dyamide Plus'],
        ['id' => 73, 'name' => 'Dytor Plus-Torvigress Plus'],
        ['id' => 74, 'name' => 'Dytor Plus-Tormax Plus'],
        ['id' => 75, 'name' => 'Dytor Plus-Dyloop Plus'],
        ['id' => 76, 'name' => 'Dytor Plus-Torsibid Plus'],
        ['id' => 77, 'name' => 'Dytor Plus-Vitator SP'],
        ['id' => 78, 'name' => 'Dytor Plus-Edigo Plus'],
        ['id' => 79, 'name' => 'Dytor Plus-Torvel-Plus'],
        ['id' => 80, 'name' => 'Dytor Plus-Torcard-Plus'],
        ['id' => 81, 'name' => 'Dytor Plus-Diretor Plus'],
        ['id' => 82, 'name' => 'Dytor Plus-Safrotor Plus'],
        ['id' => 83, 'name' => 'Dytor Plus-Torpres-Plus'],
        ['id' => 84, 'name' => 'Dytor Plus-Torzest Plus'],
        ['id' => 85, 'name' => 'Dytor Plus-Torlactone'],
        ['id' => 86, 'name' => 'Dytor Plus-Tordack Plus'],
        ['id' => 87, 'name' => 'Dytor Plus-Aldactone Plus'],
        ['id' => 88, 'name' => 'Dytor Plus-Tormid Plus'],
        ['id' => 89, 'name' => 'Dytor Plus-Torsinex Forte'],
        ['id' => 90, 'name' => 'Metolar XR-Met XL'],
        ['id' => 91, 'name' => 'Metolar XR-Prolomet-XL'],
        ['id' => 92, 'name' => 'Metolar XR-Metocard'],
        ['id' => 93, 'name' => 'Metolar XR-Embeta'],
        ['id' => 94, 'name' => 'Metolar XR-Seloken'],
        ['id' => 95, 'name' => 'Metolar XR-Starpress-XL'],
        ['id' => 96, 'name' => 'Metolar Tl-Metosartan'],
        ['id' => 97, 'name' => 'Metolar Tl-Tazloc-Beta'],
        ['id' => 98, 'name' => 'Metolar Tl-Telmikind-Beta'],
        ['id' => 99, 'name' => 'Metolar Tl-Telvas-Beta'],
        ['id' => 100, 'name' => 'Metolar Tl-Telma-Beta'],
        ['id' => 101, 'name' => 'Metolar Trio-Met XL Trio'],
        ['id' => 102, 'name' => 'Metolar Trio-Arbitel-Trio'],
        ['id' => 103, 'name' => 'Metolar Trio-Metosartan LN'],
        ['id' => 104, 'name' => 'Metolar Trio-Cilacar TM'],
        ['id' => 105, 'name' => 'Metolar Trio-Nexovas TM'],
        ['id' => 106, 'name' => 'Metolar 3D-Metosartan CH'],
        ['id' => 107, 'name' => 'Metolar 3D-Met XL 3D'],
        ['id' => 108, 'name' => 'Metolar 3D-CTD-MT'],
        ['id' => 109, 'name' => 'Metolar 3D-Telma-MCT'],
        ['id' => 110, 'name' => 'Metolar 3D-Metapro 3D'],
        ['id' => 111, 'name' => 'Linacip E-Empanorm L'],
        ['id' => 112, 'name' => 'Linacip E-Empha L'],
        ['id' => 113, 'name' => 'Linacip E-Linaxa E'],
        ['id' => 114, 'name' => 'Linacip E-Dynaduo'],
        ['id' => 115, 'name' => 'Linacip E-Empaneo L'],
        ['id' => 116, 'name' => 'Linacip E-Empaglyde L'],
        ['id' => 117, 'name' => 'Linacip E-Emashield L'],
        ['id' => 118, 'name' => 'Empacip/Empasov-Jardiance'],
        ['id' => 119, 'name' => 'Empacip/Empasov-Gibtulio'],
        ['id' => 120, 'name' => 'Empacip/Empasov-Cospiaq'],
        ['id' => 121, 'name' => 'Empacip/Empasov-Empagreat'],
        ['id' => 122, 'name' => 'Empacip/Empasov-Xenia'],
        ['id' => 123, 'name' => 'Empacip/Empasov-Empanorm'],
        ['id' => 124, 'name' => 'Empacip/Empasov-Empaone'],
        ['id' => 125, 'name' => 'Empacip/Empasov-Empha'],
        ['id' => 126, 'name' => 'Empacip/Empasov-Empadoz'],
        ['id' => 127, 'name' => 'Empacip/Empasov-Empaneo'],
        ['id' => 128, 'name' => 'Empacip/Empasov-Empazio'],
        ['id' => 129, 'name' => 'Empacip/Empasov-Empaglyn'],
        ['id' => 130, 'name' => 'Empacip/Empasov-Empaglyde'],
        ['id' => 131, 'name' => 'Empacip/Empasov-Empabite'],
        ['id' => 132, 'name' => 'Empacip/Empasov-Empajoy'],
        ['id' => 133, 'name' => 'Empacip/Empasov-Empashield'],
        ['id' => 134, 'name' => 'Empacip/Empasov-Jardix'],
        ['id' => 135, 'name' => 'Empacip/Empasov-Empri'],
        ['id' => 136, 'name' => 'Empacip/Empasov-Glempa'],
        ['id' => 137, 'name' => 'Empacip/Empasov-Empahope'],
        ['id' => 138, 'name' => 'Empacip/Empasov-Vicra'],
        ['id' => 139, 'name' => 'Empacip/Empasov-Empapro'],
        ['id' => 140, 'name' => 'Empacip/Empasov-Empexel'],
        ['id' => 141, 'name' => 'Empacip/Empasov-Empalo'],
        ['id' => 142, 'name' => 'Empacip/Empasov-Empadon'],
        ['id' => 143, 'name' => 'Empacip/Empasov-Emphacrest'],
        ['id' => 144, 'name' => 'Empacip/Empasov-Emnorm'],
        ['id' => 145, 'name' => 'Empacip/Empasov-Alempa'],
        ['id' => 146, 'name' => 'Empacip/Empasov-Empatrol'],
        ['id' => 147, 'name' => 'Empacip M/Empasov M-Gibtulio Met'],
        ['id' => 148, 'name' => 'Empacip M/Empasov M-Empabite M'],
        ['id' => 149, 'name' => 'Empacip M/Empasov M-Jardiance Met'],
        ['id' => 150, 'name' => 'Empacip M/Empasov M-Cospiaq Met'],
        ['id' => 151, 'name' => 'Empacip M/Empasov M-Empagreat M'],
        ['id' => 152, 'name' => 'Empacip M/Empasov M-Empaglyde M'],
        ['id' => 153, 'name' => 'Empacip M/Empasov M-Empaone M'],
        ['id' => 154, 'name' => 'Empacip M/Empasov M-Empapro M'],
        ['id' => 155, 'name' => 'Empacip M/Empasov M-Empanorm M'],
        ['id' => 156, 'name' => 'Empacip M/Empasov M-Empha M'],
        ['id' => 157, 'name' => 'Empacip M/Empasov M-Empashield M'],
        ['id' => 158, 'name' => 'Empacip M/Empasov M-Empalo M'],
        ['id' => 159, 'name' => 'Empacip M/Empasov M-Glempa M'],
        ['id' => 160, 'name' => 'Empacip M/Empasov M-Empaglyn M'],
        ['id' => 161, 'name' => 'Empacip M/Empasov M-Empri M'],
        ['id' => 162, 'name' => 'Empacip M/Empasov M-Xenia M'],
        ['id' => 163, 'name' => 'Empacip M/Empasov M-Vicra M'],
        ['id' => 164, 'name' => 'Empacip M/Empasov M-Empadoz M'],
        ['id' => 165, 'name' => 'Empacip M/Empasov M-Empazio M'],
        ['id' => 166, 'name' => 'Empacip M/Empasov M-Jardix M'],
        ['id' => 167, 'name' => 'Empacip M/Empasov M-Cospiaq M'],
        ['id' => 168, 'name' => 'Empacip M/Empasov M-Empahope M'],
        ['id' => 169, 'name' => 'Empacip M/Empasov M-Empexel M'],
        ['id' => 170, 'name' => 'Empacip M/Empasov M-Empaneo M'],
        ['id' => 171, 'name' => 'Empacip M/Empasov M-Vicra Mf'],
        ['id' => 172, 'name' => 'Empacip M/Empasov M-Jardiance Duo'],
        ['id' => 173, 'name' => 'Empacip S/Empasov S-Empadoz S'],
        ['id' => 174, 'name' => 'Empacip S/Empasov S-Alsita E'],
        ['id' => 175, 'name' => 'Empacip S/Empasov S-Xenia St'],
        ['id' => 176, 'name' => 'Empacip S/Empasov S-Empazio S'],
        ['id' => 177, 'name' => 'Empacip S/Empasov S-Empanorm Duo'],
        ['id' => 178, 'name' => 'Empacip S/Empasov S-Empagreat S'],
        ['id' => 179, 'name' => 'Empacip S/Empasov S-Glura E'],
        ['id' => 180, 'name' => 'Empacip S/Empasov S-Cospiaq S'],
        ['id' => 181, 'name' => 'Empacip S/Empasov S-Sitacip E'],
        ['id' => 182, 'name' => 'Empacip S/Empasov S-Gibtulio S'],
        ['id' => 183, 'name' => 'Empacip S/Empasov S-Sitaxa E'],
        ['id' => 184, 'name' => 'Empacip S/Empasov S-Empabite S'],
        ['id' => 185, 'name' => 'Empacip S/Empasov S-Istavel Empa'],
        ['id' => 186, 'name' => 'Empacip S/Empasov S-Empashield S'],
        ['id' => 187, 'name' => 'Empacip S/Empasov S-Empha S'],
        ['id' => 188, 'name' => 'Empacip S/Empasov S-Sitabite E'],
        ['id' => 189, 'name' => 'Empacip S/Empasov S-Empaglyn S'],
        ['id' => 190, 'name' => 'Empacip S/Empasov S-Empaneo S'],
        ['id' => 191, 'name' => 'Empacip S/Empasov S-Empaglyde S'],
        ['id' => 192, 'name' => 'Empacip S/Empasov S-Empajoy S'],
        ['id' => 193, 'name' => 'Empacip S/Empasov S-Empalo S'],
        ['id' => 194, 'name' => 'Empacip S/Empasov S-Sitapride E'],
        ['id' => 195, 'name' => 'Empacip S/Empasov S-Empaone S'],
        ['id' => 196, 'name' => 'Empacip S/Empasov S-Empahope S'],
        ['id' => 197, 'name' => 'Bisofig - Bisoreg'],
        ['id' => 198, 'name' => 'Rosulip - rosloy'],
        ['id' => 199, 'name' => 'Arnicor - Sacupil'],
        ['id' => 200, 'name' => 'Arnicor - Arnisac'],
        ['id' => 201, 'name' => 'Arnicor-Orarni'],
        ['id' => 202, 'name' => 'Bosifig- Bisojay'],
        ['id' => 203, 'name' => 'Arnicor - Mymada'],
        ['id' => 204, 'name' => 'Rosulip - Rosuless'],
        ['id' => 205, 'name' => 'Bisofig - Bisoduce'],
        ['id' => 206, 'name' => 'Linacip- Linabite,Linaxaa'],
        ['id' => 207, 'name' => 'Rosulip- Rosoix'],
        ['id' => 208, 'name' => 'Rosulip- Roseday'],
        ['id' => 209, 'name' => 'Rosulip- Rosuvas'],
        ['id' => 210, 'name' => 'Rosulip-Rosavae'],
        ['id' => 211, 'name' => 'Sitacip- Sitabite'],
        ['id' => 212, 'name' => 'Ticacip- Ticabid'],
        ['id' => 213, 'name' => 'Metolar- Metosartan'],
        ['id' => 214, 'name' => 'Metolar- Metocada'],
        ['id' => 215, 'name' => 'Metolar- Met XL'],
        ['id' => 216, 'name' => 'Cresar-Telma'],
        ['id' => 217, 'name' => 'Cresar-Telmikind'],
        ['id' => 218, 'name' => 'Cresar-Telvas'],
        ['id' => 219, 'name' => 'Cresar-Tazloc'],
        ['id' => 220, 'name' => 'Cresar-Tellzy'],
        ['id' => 221, 'name' => 'Cresar-Telista'],
        ['id' => 222, 'name' => 'Cresar-Telsar'],
        ['id' => 223, 'name' => 'Cresar-Sartel'],
        ['id' => 224, 'name' => 'Cresar-Metosartan'],
        ['id' => 225, 'name' => 'Arnicor-Arnipin'],
        ['id' => 226, 'name' => 'Arnicor-Azmarda'],
        ['id' => 227, 'name' => 'Arnicor-Cidmus'],
        ['id' => 228, 'name' => 'Arnicor-Hefcard'],
        ['id' => 229, 'name' => 'Arnicor-Neptaz'],
        ['id' => 230, 'name' => 'Arnicor-Sacurise'],
        ['id' => 231, 'name' => 'Arnicor-Valentas'],
        ['id' => 232, 'name' => 'Arnicor-Vymada'],
        ['id' => 233, 'name' => 'Arnicor-Zayo'],
        ['id' => 234, 'name' => 'Arnicor-Hfril'],
        ['id' => 235, 'name' => 'Arnicor-Nepriheart'],
        ['id' => 236, 'name' => 'Arnicor-onArni'],
        ['id' => 237, 'name' => 'Arnicor-arnisac'],
        ['id' => 238, 'name' => 'Arnicor-sacuval'],
        ['id' => 239, 'name' => 'Arnicor-Hefcard'],
        ['id' => 240, 'name' => 'Cresar AM- Telvas AM'],
        ['id' => 241, 'name' => 'Cresar AM- Telma AM'],
        ['id' => 242, 'name' => 'Cresar H- Telma H'],
        ['id' => 243, 'name' => 'Cresar LN- Telma LN'],
        ['id' => 244, 'name' => 'Cresar-Teli'],
        ['id' => 245, 'name' => 'Cresar-Telpress'],
        ['id' => 246, 'name' => 'Cresar-Telmitac'],
        ['id' => 247, 'name' => 'Cresar-Telcure'],
        ['id' => 248, 'name' => 'Rosulip-Roseday'],
        ['id' => 249, 'name' => 'Rosulip-Rosuvas'],
        ['id' => 250, 'name' => 'Rosulip-Rozat'],
        ['id' => 251, 'name' => 'Rosulip-Rozavel'],
        ['id' => 252, 'name' => 'Rosulip-Rozucor'],
        ['id' => 253, 'name' => 'Rosulip-Rosumac'],
        ['id' => 254, 'name' => 'Rosulip-Rosuless'],
        ['id' => 255, 'name' => 'Rosulip-Jupiros'],
        ['id' => 256, 'name' => 'Rosulip-Crestor'],
        ['id' => 257, 'name' => 'Rosulip-Rosufit'],
        ['id' => 258, 'name' => 'Rosulip-Rosustat'],
        ['id' => 259, 'name' => 'Rosulip-Roseley'],
        ['id' => 260, 'name' => 'Rosulip CV- Rosumac CV'],
    );
}


// all zone
function getAllZone()
{
    $CI =& get_instance();
    $zonesData = array();
    $query = "SELECT * FROM `zones` WHERE `name`!='' ORDER BY `name`";
    $zonesData = $CI->master_model->customQueryArray($query);

    $zoneDataIdWise = array();
    if ($zonesData) {
        foreach ($zonesData as $key => $item) {
            $zoneId = $item['id'];
            $zoneDataIdWise[$zoneId] = $item;
        }
    }

    return array('zonesData' => $zonesData, 'zoneDataIdWise' => $zoneDataIdWise);
}


function uniqueXlsxFileName()
{
    $date = date("Ymd");
    $randomNumber = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
    // Create the filename
    return $filename = $date . "_" . $randomNumber . ".xlsx";
}


function getStartCampDetailsByeducatord($educatorId)
{
    $CI =& get_instance();
    $date = date('Y-m-d');
    $query = "SELECT * FROM `camp` WHERE `edcator_id`='" . $educatorId . "' and date='" . $date . "' and  in_time!='' and out_time='' limit 1";
    $educatorData = $CI->master_model->customQueryRow($query);
    //print_r($educatorData);
    return array('campData' => $educatorData);
}

function digitaleducatorlist()
{
    $CI =& get_instance();
    $query = "SELECT * from `digital_educator`";
    $digitaleducatorlist = $CI->master_model->customQueryArray($query);
    return array('digitaleducatorlist' => $digitaleducatorlist);
}


