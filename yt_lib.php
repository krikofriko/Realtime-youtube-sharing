<?php
class YoutubeLib
{
  public $config = array(
    'autoplay' => 1, // autoplay
    'rel' => 0  // related
  );
  
  public function url_isYt($url="")
  {
    if (strpos($url, "youtube.") || strpos($url, "youtu.be"))
    {
      return true;
    }
    
    return false;
  }
  
  public function getEmbedCode($args=array())
  {
    $base = "http://www.youtube.com/";
    
    if (count($args) != 0 && isset($args['v']))
    {
      $vid = $args['v'];
      unset($args['v']);
      
      $params = "v/".$vid;
      
      foreach ($args as $key => $val)
      {
        $params = $params."&".$key."=".$val;
      }
      
      foreach ($this->config as $key => $val)
      {
        ## Parse time TODO
//         preg_match_all("/(([0-1]\d|2[0-3])m[0-5]\d)/",$y,$matches);
//         
//         if ($key = "t")
//         {
//           $params = $params."&"."start"."=".$val;
//         } 
//         else
        {
          $params = $params."&".$key."=".$val;
        }
      }
// http://www.youtube.com/watch?v=mTTwcCVajAc&t=1m0s
      return "<object 
      width=\"640\" 
      height=\"480\">
        <embed
          src=\"".$base.$params."\"
          type=\"application/x-shockwave-flash\"
          wmode=\"transparent\"
          width=\"640\" 
          height=\"480\">
        </embed>
      </object>";
    }
    
    return false;
  }
//         <param 
//           name=\"movie\"
//           value=\"http://www.youtube.com/v/EBM854BTGL0&autoplay=1\">
//         </param>
//         <param
//           name=\"wmode\" 
//           value=\"transparent\">
//         </param>
}
?>