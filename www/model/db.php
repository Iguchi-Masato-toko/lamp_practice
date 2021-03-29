<?php

function get_db_connect(){
  // MySQL用のDSN文字列
  $dsn = 'mysql:dbname='. DB_NAME .';host='. DB_HOST .';charset='.DB_CHARSET;
 
  try {
    // データベースに接続
    $dbh = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    exit('接続できませんでした。理由：'.$e->getMessage() );
  }
  return $dbh;
}

function fetch_query($db, $sql, $params = array()){
  try{
    $statement = $db->prepare($sql);
    $statement->execute($params);
    return $statement->fetch();
  }catch(PDOException $e){
    set_error('データ取得に失敗しました。');
  }
  return false;
}

function fetch_all_query($db, $sql, $params = array()){
  try{
    $statement = $db->prepare($sql);
    $statement->execute($params);
    return $statement->fetchAll();
  }catch(PDOException $e){
    set_error('データ取得に失敗しました。');
  }
  return false;
}

function execute_query($db, $sql, $params = array()){
  try{
    $statement = $db->prepare($sql);
    return $statement->execute($params);
  }catch(PDOException $e){
    set_error('更新に失敗しました。');
    throw $e;
  }
  return false;
}

function get_all_history($db){
  $sql = "
  SELECT
  history.history_id,
  history.purchace_date,
  sum(price * amount) AS sum
  from history
  left JOIN history_item
  ON history.history_id = history_item.history_id
  GROUP BY history.history_id
  ";
  return fetch_all_query($db, $sql);
 }

 function get_user_history($db,$user){
  $sql = "
  SELECT
  history.history_id,
  history.purchace_date,
  sum(price * amount) AS sum
  from history
  left JOIN history_item
  ON history.history_id = history_item.history_id
  WHERE history.user_id = ?
  GROUP BY history.history_id
  ";
  return fetch_all_query($db, $sql,[$user]);
 }

 function get_details($db,$history_id,$user_id = false){
   if($user_id === false){
     $where = "";
   }else{
     $where = ' AND hitory.user_id = ?';
   }
  $sql = "
  SELECT
  history.history_id,
  history.purchace_date,
  sum(price * amount) AS sum
  from history
  left JOIN history_item
  ON history.history_id = history_item.history_id
  WHERE history.history_id = ? {$where}
  GROUP BY history.history_id";

  if($user_id === false){
    return fetch_all_query($db, $sql,[$history_id]);
  }else{
    return fetch_all_query($db, $sql,[$history_id,$user_id]);
  }

  return fetch_all_query($db, $sql,[$history_id]);
 }

 function get_detail_item($db,$history_id,$user_id = false){
  $sql = "
  SELECT history_item.price,
  history_item.amount,
  history_item.price * amount as sum,
  items.name from history_item
  left JOIN items
  ON items.item_id = history_item.item_id
  JOIN history
  ON history.history_id = history_item.history_id
  WHERE history_item.history_id = ?";
  if($user_id === false){
    return fetch_all_query($db, $sql,[$history_id]);
  }else{
    $sql.=' AND history.user_id = ?';
    return fetch_all_query($db, $sql,[$history_id,$user_id]);
  }
 }

 function get_ranking_item($db){
   $sql = "
   SELECT
   SUM(history_item.amount) as sum,
   items.name,
   items.image
   FROM history_item
   LEFT JOIN items
   ON history_item.item_id = items.item_id
   GROUP BY history_item.item_id
   ORDER BY sum DESC
   LIMIT 3
   ";
   return fetch_all_query($db, $sql);
 }