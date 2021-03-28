<?php

require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
}


$db = get_db_connect();
$user = get_login_user($db);

$user_type = judge_user_type($db,$user['user_id']);

if($user_type['type'] === 1){
    $data = get_all_history($db);
}else if($user_type['type'] === 2){
    $data = get_user_history($db,$user['user_id']);
}else{
    set_error('不正なアクセスです。');
}


include_once VIEW_PATH . 'history_view.php';