<?php
function is_username($value, $min, $max)
{
    $pattern = '/^[A-Za-z0-9_\.]{5,60}$/';
    if (preg_match($pattern, $value)) {
        return true;
    }
    return false;
}

function is_email($value)
{
    $pattern = '/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/';
    if (preg_match($pattern, $value)) {
        return true;
    }
    return false;
}

function is_password($value, $min, $max)
{
    $pattern = '/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/';
    if (preg_match($pattern, $value)) {
        return true;
    }
    return false;
}

function is_confirmed($value, $value_comfirm)
{
    if ($value == $value_comfirm) {
        return true;
    } 
    return false;
}

function sub_number($needed, $value)
{
    $length = strlen($needed);
    return (substr($value, 0, $length) === $needed);
}

function is_phone($value)
{
    global $error;
    $carrier_number = array(
        '086' => 'Viettel',
        '096' => 'Viettel',
        '097' => 'Viettel',
        '098' => 'Viettel',
        '030' => 'Viettel',
        '032' => 'Viettel',
        '033' => 'Viettel',
        '034' => 'Viettel',
        '035' => 'Viettel',
        '036' => 'Viettel',
        '037' => 'Viettel',
        '038' => 'Viettel',
        '039' => 'Viettel',

        '090' => 'Mobifone',
        '093' => 'Mobifone',
        '070' => 'Mobifone',
        '071' => 'Mobifone',
        '072' => 'Mobifone',
        '076' => 'Mobifone',
        '077' => 'Mobifone',
        '078' => 'Mobifone',
        '079' => 'Mobifone',
        '089' => 'Mobifone',

        '091' => 'Vinaphone',
        '094' => 'Vinaphone',
        '081' => 'Vinaphone',
        '082' => 'Vinaphone',
        '083' => 'Vinaphone',
        '084' => 'Vinaphone',
        '085' => 'Vinaphone',
        '087' => 'Vinaphone',
        '088' => 'Vinaphone ',


        '099' => 'Gmobile',
        '059' => 'Gmobile',

        '092' => 'Vietnamobile',
        '056' => 'Vietnamobile',
        '052' => 'Vietnamobile',
        '058' => 'Vietnamobile',

        '095'  => 'SFone',
        '087' => 'ITelecom ',
    );

    $value = trim($value);
    if (!empty($value)) {
        $value = str_replace(array('.', '-', '.', ' '), '', $value);

        $start_numbers = array_keys($carrier_number);

        $pattern = '/^0[0-9]{9}$/';

        if (!preg_match($pattern, $value)) {
            return $error['phone'] = 'So dien thoai phai co 10 chu so!';
        }

        foreach ($start_numbers as $start_number) {
            if (sub_number($start_number, $value)) {
                return $value;
            }
        }
        return $error['phone'] = 'So dien thoai khong dung dinh dang!';
    } else {
        $error['phone'] = 'Vui long nhap so dien thoai!';
    }
}

function form_error($label_field)
{
    global $errors;
    if (!empty($errors[$label_field])) {
        return "<p class='error'><i class='icon-info'></i>{$errors[$label_field]}</p>";
    }
}

function set_value($label_field)
{
    global $$label_field;
    if (!empty($$label_field)) {
        return $$label_field;
    }
}


// function validate($name, $value, $regex, $required = true, $min = 5, $max = 160){
//     global $error;

//     if(!$required && empty($value)){
//         $error[$name] = '';
//         return;
//     }

//     if($required && empty($value)){
//         $error[$name] = 'Bat buoc!';
//     }
//     else if(strlen($value) < $min){
//         $error[$name] = 'Gia tri nhap vao qua ngan!';
//     }
//     else if(strlen($value) > $max){
//         $error[$name] = 'Gia tri nhap vao qua dai!';
//     }
//     else if(preg_match($regex, $value)){
//         return $value;
//     }
//     else{
//         $error[$name] = 'Gia tri nhap vao khong dung.!';
//     }
// }
