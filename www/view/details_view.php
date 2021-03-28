<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入明細</title>
</head>

<body>
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入明細</h1>
  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php' ?>
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th>注文番号</th>
          <th>購入日時</th>
          <th>注文の合計金額</th>
        </tr>
      </thead>
      <tbody>
      <?php if($details !== false){ ?>
        <?php foreach ($details as $detail) { ?>
          <tr>
            <td><?php print $detail['history_id']; ?></td>
            <td><?php print $detail["purchace_date"]; ?></td>
            <td><?php print $detail["sum"]; ?></td>
          </tr>
        <?php } ?>
          <?php } ?>
      </tbody>
    </table>
    <table class="table table-bordered" style="margin-top:30px;">
          <thead class="thead-light">
            <tr>
              <th>商品名</th>
              <th>購入日時の商品価格</th>
              <th>購入数</th>
              <th>小計</th>
            </tr>
          </thead>
          <?php foreach ($detail_item as $item) { ?>
          <tr>
            <td><?php print $item['name']; ?></td>
            <td><?php print $item['price']; ?></td>
            <td><?php print $item['amount']; ?></td>
            <td><?php print $item['sum']; ?></td>
          </tr>
          <?php } ?>
    </table>
  </div>
</body>

</html>