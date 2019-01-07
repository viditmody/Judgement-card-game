<?php
$max[]=0;
	include("connect.php");
	$constant=10;
	//print_r($_POST['player']);
	if(isset($_POST['addScore'])){
		for($i=0;$i<count($_POST['user']);$i++){
				if($_POST['score'][$i]<0){
					$finalScore=0;
				} else {
					$finalScore=($_POST['score'][$i]+$constant);
				}
				
			
			$addPointsQuery="insert into points (user,points) values ('".$_POST['user'][$i]."','".$finalScore."')";
			$addPointsResult=mysql_query($addPointsQuery);
			$finalScore=0;
		}
	}
	if(isset($_POST['player'])){
		for($i=0;$i<count($_POST['player']);$i++){
			$addPlayerQuery="insert into username (name) values ('".$_POST['player'][$i]."')";
			$addPlayerResult=mysql_query($addPlayerQuery);
		}
	}
?>
<table border="1">
	<tr>
<?php
	$getPlayerQuery="select * from username";
	$getPlayerResult=mysql_query($getPlayerQuery);
	$numOfPlayer=mysql_num_rows($getPlayerResult);
	for($i=0;$i<$numOfPlayer;$i++){
		list($id,$name)=mysql_fetch_row($getPlayerResult);
?>
		<th><?php echo $name; ?></th>
<?php
	}
?>
	</tr>
    <tr>
<?php
	$getScoreQ="select * from points";
	$getScoreR=mysql_query($getScoreQ);
	$getScoreRows=mysql_num_rows($getScoreR);
	$count=0;
   	for($i=0;$i<$getScoreRows;$i++){
		list($id,$user,$points)=mysql_fetch_row($getScoreR);
		$count++;
?>
		<td><?php echo $points; ?></td>
<?php
		if($count%$numOfPlayer==0){
			echo "</tr>";
		}
	}
?>
	<tr>
<?php
	for($i=0;$i<$numOfPlayer;$i++){
		$userTotal="select name from username where id=".($i+1);
		$userTotalResult=mysql_query($userTotal);
		$userTotal=mysql_fetch_row($userTotalResult);
		$total=0;
		
		$query="select points from points where user='".$userTotal[0]."'";
		$rslt=mysql_query($query);
		$cnt=mysql_num_rows($rslt);
		
		for($k=0;$k<$cnt;$k++){
			$result=mysql_fetch_row($rslt);
			$total=$total+$result[0];
		}
		$max[]=$total;
		echo "<td style=\"background-color:#FF0000; color:#FFFFFF\" align=\"center\"><strong>".$total."</strong></td>";
	}
	
?>
    </tr>
    <tr>
    <form method="post">
<?php
	for($i=0;$i<$numOfPlayer;$i++){
?>
    	<td>
<?php
			$getuserNameQuery="select name from username where id=".($i+1);
			$getuserName=mysql_query($getuserNameQuery);
			$getUser=mysql_fetch_row($getuserName);
?>
        	<input type="hidden" name="user[]" value="<?php echo $getUser[0] ?>">
        	<input type="text" name="score[]">
        </td>
<?php
	}
?>
		<td><input type="submit" name="addScore"></td>
    </form>
    </tr>
</table>
<?php
	$temp=0;$tempName="";
	for($f=0;$f<count($max);$f++){
		if($max[$f]>$temp){
			$temp=$max[$f];
		}
	}
	//sort($max);
	
	
	
	for($i=0;$i<$numOfPlayer;$i++){
		$userTotal="select name from username where id=".($i+1);
		$userTotalResult=mysql_query($userTotal);
		$userTotal=mysql_fetch_row($userTotalResult);
		$total=0;
		
		$query="select points from points where user='".$userTotal[0]."'";
		$rslt=mysql_query($query);
		$cnt=mysql_num_rows($rslt);
		
		for($k=0;$k<$cnt;$k++){
			$result=mysql_fetch_row($rslt);
			$total=$total+$result[0];
		}
		if($total==$temp){
			$tempName=$userTotal[0];
		}
	}
	
?>
<div style="font-weight:bold; font-size:72px; text-align:center"><blink>
<?php
	echo $tempName."   -   ";
	echo $temp;
?>
</blink></div>
