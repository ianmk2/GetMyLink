<?
require_once("config.php");

function connect(){
        $conn = mysql_connect($host_name,$user_name,$user_password);
        mysql_select_db($db_name, $conn );
}

$key = "";
if(isset($_REQUEST['t'])){
        $type = $_REQUEST['t'];
        connect();
        if($type=='u'){
                $key = mysql_real_escape_string($_REQUEST['k']);
                $link = mysql_real_escape_string($_REQUEST['l']);
                $q = "INSERT INTO `map` (`from`, `to`) VALUES ('$key', '$link') on duplicate key update `to`='$key'";
                mysql_query($q);
                echo "$key - $link was created";
        }else if($type=='d'){
                $key = mysql_real_escape_string($_REQUEST['k']);
                mysql_query("DELETE FROM `map` WHERE `from`='$key'");
                echo "$key was DELETED";
        }else if($type=='l'){
                $data = mysql_query("SELECT * FROM forwarding.map");
                while($row = mysql_fetch_array($data)){
                        echo "[".$row['from']."] ".$row['to']." \n <br>";
                }

        }

}else{
        foreach($_GET as $k=> $v){
                $key = mysql_real_escape_string($k);
                break;
        }
        if(strlen($key)!=0){
                connect();
                $row = mysql_fetch_array(mysql_query("SELECT * FROM map where `from`='$key';"));
                echo $row['to'];
                header("Location: ".$row['to']);
        }
}