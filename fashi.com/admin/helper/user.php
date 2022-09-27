<?php 
function is_login()
{
    if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == 1){
        return true;
    }
    else{
        return false;
    }
}
