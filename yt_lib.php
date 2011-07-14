<?php
class YoutubeLib
{
  public $config = array(
    'autoplay' => 1, // autoplay
    'rel' => 0,  // related
    'fs' => 1, // fulscreen
    'version' => 3 // version
  );
  
  public function url_isYt($url="")
  {
    if (strpos($url, "youtube.") || strpos($url, "youtu.be"))
    {
      return true;
    }
    
    return false;
  }
  
  private function embed($args=array())
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
      
      return $base.$params;
    }
    
    return false;
  }
  
  public function getEmbedCode($args=array())
  {
    $embed = $this->embed($args);
    
    if ($embed != false)
    {
      $fs = ($this->config['fs'] == 1) ? "'allowfullscreen': 'true'" : "'allowfullscreen': 'false'";
      
      return "<object 
      width=\"640\" 
      height=\"480\">
        <embed
          src=\"".$embed."\"
          type=\"application/x-shockwave-flash\"
          wmode=\"transparent\"
          ".$fs."
          width=\"640\" 
          height=\"480\">
        </embed>
      </object>";
    }
  }
  
  public function getjQueryEmbedCode($args=array(), $append)
  {
    $embed = $this->embed($args);
    
    if ($embed != false)
    {
      $fs = ($this->config['fs'] == 1) ? "'allowfullscreen': 'true'" : "'allowfullscreen': 'false'";
      
      return "jQuery('".$append."').html('');
          jQuery('<embed/>', {
            'width': '640',
            'height': '480',
            'src': '".$embed."',
            'type': 'application/x-shockwave-flash',
            ".$fs."
          }).appendTo(
          jQuery('<object/>', {
            'width': '640',
            'height': '480',
          }).appendTo('".$append."')
          );";
    }
  }
}
?>