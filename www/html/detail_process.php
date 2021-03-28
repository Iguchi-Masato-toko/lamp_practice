<?php
session_start();
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';


// var_dump($_POST['history_id']);
$history_id = $_POST['history_id'];
set_session('history_id', $history_id);
redirect_to(DETAILS_URL);

// if ($_POST['history_id'] !== "13") {
//     $history_id = $_POST['history_id'];
//     set_session('history_id', $history_id);
//     redirect_to(DETAILS_URL);
// } else {
//     set_error('不正なアクセスです。');
//     redirect_to(HISTORY_URL);
// }
