<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>あいさつ</title>
</head>
<body>
  <!-- リスト6.1 -->
  <?php $hour = date('H'); ?>
  <?php if(5 <= $hour && $hour < 10): ?>
  <p>おはようございます</p>
  <?php elseif (10 <= $hour && $hour <18):?>
  <p>こんにちは</p>
  <?php else: ?>
  <p>こんばんは。</p>
  <?php endif ?>
  <p>現在<?php echo $hour; ?>時です。</p>
  <!-- リスト6.2 -->
  <?php if (isset($_GET['name']) && strlen($_GET['name']) > 0): ?>
  <p>
        <?php echo htmlspecialchars($_GET['name'],ENT_QUOTES,'UTF-8'); ?>
        さんこんにちは
    </p>
  <?php endif; ?>
  <form action="index.php" method="get">
    <p>
        名前を入力してください:
        <input type="text" name="name"/>
        <input type="submit" value="送信"/>
    </p>
  </form>
</body>
</html>