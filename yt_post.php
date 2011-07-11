<?php require("yt_lib.php") ?>
<?php require("db.php") ?>
<?php
// http://www.youtube.com/watch?v=mTTwcCVajAc&t=1m1s
  $ip = @$REMOTE_ADDR;
  $return["error"] = false;
  
  $yt = new YoutubeLib();
  
  if ( $yt->url_isYt($_POST['url']) )
  {
    // YT url
    $url = parse_url($_POST['url']);
    $query = $url['query'];

    parse_str($query, $args);
    
    if (!isset($args))
    {
      $return["error"] = true;
      echo json_encode( $return );
    } else
    {
      $db = new DB();
      
      $embed = $yt->getEmbedCode($args);
      $embed = mysql_real_escape_string($embed);
    
      $query = "INSERT INTO `yt_video`.`video` (
        `id` ,
        `embed` ,
        `ip` ,
        `date` 
        )
        VALUES (
        NULL , '".$embed."', '".$ip."', 
        CURRENT_TIMESTAMP 
      );";
      
      $db->query($query);
      $db->close();
      
      $return["error"] = false;
      echo json_encode( $return );
    }
  } else
  {
    // not YT url
    $return["error"] = true;
    echo json_encode( $return );
  }
  
//   $return["data"] = $args;
  
?>