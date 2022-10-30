<?php
if ($_GET['level']==100100){
$_SESSION['level']++;
}
if ($_GET['level']==10000){
$_SESSION['hearth']--;
if($_SESSION['hearth'] < 1){
$_SESSION['level'] = 0;
$_SESSION['maxhearth'] = 3;
$_SESSION['hearth'] = 3;
}
}
?>
<script language="javascript">
hred('/?page=jeux/aventure/aventure.php');
</script>