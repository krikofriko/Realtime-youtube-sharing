<?php
class DB
{
  public $db = "";
  
  public function DB()
  {
    $username = "root";
    $password = "MRFIVi1829";
    $hostname = "localhost";  
    $database = "yt_video";

    $this->db = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
    mysql_select_db($database); 
  }
  
  public function query($query)
  {
    return mysql_query($query);
  }
  
  public function close()
  {
    mysql_close($this->db);
  }
}

?>