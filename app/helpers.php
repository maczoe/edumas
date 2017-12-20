<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//throw this in your helper.php
function set_active($path, $active = 'active') {

    return call_user_func_array('Request::is', (array)$path) ? $active : '';

}