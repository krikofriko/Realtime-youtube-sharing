<?php
class YoutubeLib
{
  public $config = array(
    'autoplay' => 1, // autoplay
    'rel' => 0,  // related
    'fs' => 1 // fulscreen
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
        ## Parse time TODO
        if ($key == "t")
        {
          $pattern = "@((?P<num>[0-9]+)(?P<unit>[a-z]{1}))@";
          preg_match_all($pattern, $val, $matches, PREG_SET_ORDER);
         
          $secs = 0;
//           [][3] - h/m/s, [][2] - number
          foreach ($matches as $slice)
          {
          //   print_r($slice);
            switch ($slice['unit'])
            {
                case 'h':
                    $secs += $slice['num']*60*60;
                    break;
                case 'm':
                    $secs += $slice['num']*60;
                    break;
                case 's':
                    $secs += $slice['num'];
                    break;
            }
            
          }
          
          $params = $params."&"."start"."=".$secs;
        }
        else
        {
          $params = $params."&".$key."=".$val;
        }
      }
      
      foreach ($this->config as $key => $val)
      {
        $params = $params."&".$key."=".$val;
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
}
?>