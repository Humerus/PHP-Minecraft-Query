<?php
    require_once("MinecraftQuery.class.php");
    $servers = array('198.52.216.130','198.52.216.131','198.52.216.132','198.52.216.133','198.52.216.146','198.52.216.147','198.52.216.148','198.52.216.149','198.52.216.162','198.52.216.163','198.52.216.164','198.52.216.165','198.52.216.178','198.52.216.179','198.52.216.180','198.52.216.181','198.52.216.194','198.52.216.195','198.52.216.196','198.52.216.197','198.52.216.210','198.52.216.211','198.52.216.212','198.52.216.213','198.52.216.226','198.52.216.227','198.52.216.228','198.52.216.229','198.52.216.242','198.52.216.243','198.52.216.244','198.52.216.245');
    $timer = MicroTime(true);
    $onlinemax = "";
    $onlinetotal = "";
    $failed = "";
    $Query = new MinecraftQuery( );
    foreach($servers as $serverIP) {
      try {
          $Query->Connect($serverIP, 19132);
          $infoarr = $Query->GetInfo();
          $onlinetotal += $infoarr["Players"];
          $onlinemax += $infoarr["MaxPlayers"];
      }catch( MinecraftQueryException $e ) {
          $failed++;
      }
    }
    $Timer = Number_Format(MicroTime( true ) - $timer, 4, '.', '' );
    echo "Lifeboat Server Status: Queried ".count($servers)." servers in $Timer; There are a total of $onlinetotal players online out of $onlinemax slots available. $failed servers didn't respond to our query.";
?>
