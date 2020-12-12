<?php

include('functions.php');

$id = $_GET['id'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM post_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
//   var_dump($record);
//   exit();

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
 <div class="input">
        <ul>

          <li>
            title: <input type="text" name="title">
          </li>
          <li>
            text: <textarea type="text" rows="5" cols="35" name="text" value="<?= $record["id"]?>"></textarea>
          </li>
          <li>

            <input type="file" name="image">
          </li>
          <li>
            <input type="submit" name="upload" value="送信">
          </li>
        </ul>
      </div>

</body>
</html>

