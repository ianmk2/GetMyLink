<?
require_once("config.php");

$conn = mysql_connect($host_name,$user_name,$user_password);
mysql_select_db($db_name, $conn );
if(isset($_REQUEST['t'])){
        $type = $_REQUEST['t'];
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
        }
}
?>
<script type="text/javascript">
	alert("완료되었습니다");
	location.replace("link.php");
</script>