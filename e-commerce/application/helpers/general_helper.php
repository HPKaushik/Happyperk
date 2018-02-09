<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function prx($array, $exit = 1) {
    echo $res = "<pre>";
    if (is_array($array) || is_object($array)) {
        echo print_r($array);
    } else {
        echo var_dump($array);
    }
    echo "</pre><hr />";
    if ($exit == 1) {
        die();
    }
}

function query($die = 1) {
    $CI = & get_instance();
    echo $CI->db->last_query();
    if ($die) {
        die;
    }
}

function printdate($date) {
    if (empty($date)) {
        return "No date provided";
    }
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
    $now = time();
    $unix_date = strtotime($date);
// check validity of date
    if (empty($unix_date)) {
        return "Bad date";
    }
// is it future date or past date
    if ($now > $unix_date) {
        $difference = $now - $unix_date;
        $tense = "ago";
    } else {
        $difference = $unix_date - $now;
        $tense = "from now";
    }
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }
    $difference = round($difference);
    if ($difference != 1) {
        $periods[$j] .= "s";
    }
    return "$difference $periods[$j] {$tense}";
}

function generateFormToken($form) {
    $CI = & get_instance();
    $num = rand(1000, 2147483647) *  1641;
    $time = uniqid(microtime(), true);
    $token = md5($num . $time);
    // Write the generated token to the session variable to check it against the hidden field when the form is sent
    $CI->session->set_userdata($form . '_token', $token);
    // echo $CI->session->userdata($form.'_token');exit;
    return $token;
}

function escape_post_strings($postarray) {
    $CI = & get_instance();
    if ($CI->db->conn_id === FALSE) {
        $CI->initialize();
    }
    if (!empty($postarray) && is_array($postarray)) {
        foreach ($postarray as $key => $post) {
            $array["$key"] = mysqli_real_escape_string($CI->db->conn_id, $post);
        }
        return $array;
    } else {
        die("Parameter expected to be array.");
    }
}

function get_session_var($value='')
{   
    $CI = & get_instance();
    if(isset($value) && !empty($value))
     {
         if(array_key_exists($value, $CI->session->userdata()))
            return $CI->session->userdata($value); 
     }
     else return $CI->session->userdata();
}
function unset_session_var($value='')
{   
    $CI = & get_instance();
    if(isset($value) && !empty($value))
     {
         if(array_key_exists($value, $CI->session->userdata()))
            return $CI->session->unset_userdata($value); 
     }
     else return false;
}
//function format_uri($string, $separator = '-') {
//    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
//    $special_cases = array('&' => 'and', "'" => '');
//    $string = mb_strtolower(trim($string), 'UTF-8');
//    $string = str_replace(array_keys($special_cases), array_values($special_cases), $string);
//    $string = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
//    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
//    $string = preg_replace("/[$separator]+/u", "$separator", $string);
//    return $string;
//}

function is_model_loaded($model) {
    $ci = &get_instance();
    $load_arr = (array) $ci->load;
    $mod_arr = array();
    foreach ($load_arr as $key => $value) {
        if (substr(trim($key), 2, 50) == "_ci_models") {
            $mod_arr = $value;
        }
    }
    return (in_array($model, $mod_arr)) ? TRUE : FALSE;
}

function print_date($date) {
    return date('d M Y', strtotime($date));
}

function new_transaction_num() {
    $number = "";
    for ($i = 0; $i < 9; $i++) {
        $min = ($i == 0) ? 1 : 0;
        $number .= mt_rand($min, 9);
    }
    return $number . time();
}
?>
