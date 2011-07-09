<?php require("db.php") ?>
<?php
// http://www.youtube.com/watch?v=mTTwcCVajAc&t=1m1s
  $ip = @$REMOTE_ADDR;
  $return["error"] = false;
  
  $db = new DB();
  $result = $db->query("SELECT * from video ORDER BY id DESC LIMIT 1");
  
  if ($result)
  {
    $row = mysql_fetch_array($result);
    $return["db"] = $row;
  } else
  {
    $return["error"] = true;
  }
  
  echo json_encode( $return );
  
?>