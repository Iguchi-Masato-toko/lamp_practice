<?php
session_start();
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$user_type = judge_user_type($db,$user['user_id']);

$id = $_GET['history_id'];
set_session('history_id', $id);


$history_id = get_session('history_id');
if($history_id !== ''){
    if ($user_type['type'] === 1) {
        $details = get_details($db,$history_id);
        $detail_item = get_detail_item($db,$history_id);
    } else if ($user_type['type'] === 2) {
        $details = get_details($db,$history_id,$user['user_id']);
        $detail_item = get_detail_item($db,$history_id,$user['user_id']);
    } else {
        set_error('不正なアクセスです。');
        redirect_to(HISTORY_URL);
    }
}else{
    set_error('不正なアクセスです。');
    redirect_to(HISTORY_URL);
}


include_once VIEW_PATH . 'details_view.php';