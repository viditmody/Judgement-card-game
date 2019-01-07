<?php

include("connect.php");

?>

<form method="post">
	<table>
    	<tr>
        	<td>Enter Number of player</td>
            <td><input type="text" name="playerNumb"></td>
        </tr>
        <tr>
        	<td></td>
            <td><input type="submit" name="submitNumbPlayer"></td>
        </tr>
    </table>
</form>

<?php
	if(isset($_POST['submitNumbPlayer'])){
		$numbPlayer=$_POST['playerNumb'];
		?>
		<form method="post" action="points.php">
			<table>
		<?php for($i=0;$i<$numbPlayer;$i++){
				?>
            	<tr>
        			<td>Username</td>
		            <td><input type="text" name="player[]"></td>
		        </tr>
            <?php
				}
			?>
            	<tr>
                	<td></td>
                    <td><input type="submit" name="savePlayer"></td>
                </tr>
             </table>
		</form>
            <?php
	}
?>

    	
   