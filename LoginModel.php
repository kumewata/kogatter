<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:26
 */

//session_start();
//
//session_regenerate_id(true);


function storeVariableToSession($variable, $column){

    global $err_flg;

    if (!strlen($variable)) {
        $err_flg = 1;
    } else {
        $_SESSION["{$column}"] = $variable;
    }
}

