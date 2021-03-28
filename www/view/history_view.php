<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'history.css'); ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>

  <h1>購入履歴</h1>
  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php' ?>
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th>注文番号</th>
          <th>購入日時</th>
          <th>注文の合計金額</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $history) { ?>
          <tr>
          <form action="details.php" method="GET">
            <td><?php print $history['history_id'] ?></td>
            <td><?php print $history["purchace_date"] ?></td>
            <td><?php print $history["sum"] ?></td>
            <td><input type="submit" class="btn btn-danger" value="購入明細表示"></td>
            <input type="hidden" name = "history_id" value="<?php print $history['history_id']; ?>">
          </form>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>