<?
require_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ian's Link</title>
	<script type="text/javascript">
	function del(key){
		if (confirm("Are you really want to delete?")!=0) {
            var link = "do.php?t=d&k="+ key;
			location.href = link;
	    } 
		
	}
	</script>
</head>
<body>
<form action="do.php" accept-charset="UTF-8" method="POST">
	<input name="t" type="hidden" value="u">
	KEY<input name="k" type="text"><br>
	URL<input name="l" type="text">
	<br>
	<input type="submit" value="insert or update">
	<br>
	<br>

	</form>
	<?
		$conn = mysql_connect($host_name,$user_name,$user_password);
		mysql_select_db($db_name, $conn );

		 $data = mysql_query("SELECT * FROM forwarding.map");
		 while($row = mysql_fetch_array($data)){
         	echo "[".$row['from']."] ".$row['to']."  <input type=\"button\" value=\"삭제\" onclick=\"del('".$row['from']."')\" > \n <br>";
        }

        ?>
</form>
</body>
</html>