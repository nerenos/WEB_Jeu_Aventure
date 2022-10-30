<style>
.careline{display: block;height: 35px;}
.care{display: inline-block; height: 35px; width: 35px; border-radius: 5px; background-color: red; overflow: hidden;background-image: url('/jeux/aventure/images/wall.gif');}
.finish{display: inline-block; height: 35px; width: 35px; border-radius: 5px; background-color: grey; overflow: hidden;background-image: url('/jeux/aventure/images/finish.gif');}
.player{display: block; height: 35px; width: 35px; border-radius: 15px; position: relative;background-image: url('/jeux/aventure/images/player.gif');background-position:0px 70px}
.aventure{display: block; height: 35px; width: 35px; border-radius: 5px; background-color: blue; position: relative;background-image: url('/jeux/aventure/images/box.gif');}
.trap{display: inline-block; height: 35px; width: 35px; border-radius: 5px; background-color: black; overflow: hidden; background-image: url('/jeux/aventure/images/trap.gif');}
.buket{display: inline-block; height: 35px; width: 35px; border-radius: 5px; overflow: hidden; position: relative;background-image: url('/jeux/aventure/images/buket.gif');background-position:0px 0px}
.buket{display: inline-block; height: 35px; width: 35px; border-radius: 5px; overflow: hidden; position: relative;background-image: url('/jeux/aventure/images/block.gif');background-position:0px 0px}
</style>
<div>
<SELECT id="level" onchange="document.location.href = '<?php echo $Domaine;?>/jeux/aventure/admin.php?level='+document.getElementById('level').value;">
<?php
if(isset($_GET['level']) && isset($_GET['save']) && isset($_GET['xp']) && isset($_GET['yp']) && isset($_GET['xb']) && isset($_GET['yb'])){
$file = "level/".$_GET['level'];
unlink ($file);
$fp = fopen($file, "w+");
fseek($fp, 0);
for($i = 0; $i < 75; $i++){
$line = substr($_GET['save'], ($i*75)+1, 75);
fputs($fp, $line);
fputs($fp, "\n");
}
fputs($fp, $_GET['xp']);
fputs($fp, "\n");
fputs($fp, $_GET['yp']);
fputs($fp, "\n");
fputs($fp, $_GET['xb']);
fputs($fp, "\n");
fputs($fp, $_GET['yb']);
}
$nlevel = 0;
$flevel = array();
$tf = null;
if (!isset($_SESSION['level'])) {
  $_SESSION['level'] = "l0.txt";
}
if(isset($_GET['level'])){
$_SESSION['level'] = $_GET['level'];
}
if ($handle = opendir('./level')) {
while (false !== ($entry = readdir($handle))) {
if($entry!='index.php' && $entry!='.' && $entry!='..' && $entry!="Thumbs.db"){
$flevel[$nlevel] = $entry;
$nlevel++;
}}
if("new"==$_SESSION['level']){
$tf = "l".$nlevel.".txt";
$flevel[$nlevel] = $tf;}
asort ($flevel);
foreach ($flevel as $entry){
echo "<OPTION value=\"".$entry."\"";
if($entry==$_SESSION['level'] || $entry==$tf){echo "selected=\"selected\"";}
echo ">".$entry."</OPTION>";
}}
closedir($handle);
?>
<OPTION value="new">nouveau</OPTION>
</SELECT>
<div class="trap" onclick="ck(0)"></div>
<div class="care" onclick="ck(1)"></div>
<div class="finish" onclick="ck(2)"></div>
<div class="buket" onclick="ck(3)"></div>
<div class="player" onclick="ck(10)"></div>
<div class="aventure" onclick="ck(11)"></div>
</div>
<?php
if("new"==$_SESSION['level']){
$_SESSION['level'] = "l".$nlevel.".txt";
$file = 'level/'.$_SESSION['level'];
$fp = fopen($file, "w+");
fseek($fp, 0);
for($i = 0; $i < 75; $i++){
fputs($fp, "111111111111111111111111111111111111111111111111111111111111111111111111111");
fputs($fp, "\n");
}
fputs($fp, "0");
fputs($fp, "\n");
fputs($fp, "0");
fputs($fp, "\n");
fputs($fp, "0");
fputs($fp, "\n");
fputs($fp, "1");
}
$file = 'level/'.$_SESSION['level'];
$levelbackground = file($file);
echo "<div class=\"level\">";
for($i = 0; $i < 75; $i++){
echo "<div class=\"careline\">";
for($j = 0; $j < 75; $j++){
$bgd = substr($levelbackground[$i], $j, 1);
$ii = $i;
$jj = $j;
if($i<10){$ii = '0'.$i;}
if($j<10){$jj = '0'.$j;}
switch($bgd){
case 0:
echo "<div id=\"c".$jj.$ii."\" class=\"trap\" onclick=\"change(".$j.",".$i.")\"></div>";
break;
case 1:
echo "<div id=\"c".$jj.$ii."\" class=\"care\" onclick=\"change(".$j.",".$i.")\"></div>";
break;
case 2:
echo "<div id=\"c".$jj.$ii."\" class=\"finish\" onclick=\"change(".$j.",".$i.")\"></div>";
break;
case 3:
echo "<div id=\"c".$jj.$ii."\" class=\"buket\" onclick=\"change(".$j.",".$i.")\"></div>";
break;
case 3:
echo "<div id=\"c".$jj.$ii."\" class=\"block\" onclick=\"change(".$j.",".$i.")\"></div>";
break;
}
}
echo "</div>";
}
?>
<div class="player" id="player"></div>
<div class="aventure" id="aventure"></div>
<div class="player" onclick="save()"></div>
<script language="javascript">
var tablevel = new Array;
<?php
for($i = 0; $i < 75; $i++){
echo "var tabcol".$i."=new Array;";
for($j = 0; $j < 75; $j++){
$bgd = substr($levelbackground[$j], $i, 1);
echo "tabcol".$i."[".$i.",".$j."]=".$bgd.";";
}
echo "tablevel[".$i."]=tabcol".$i.";";
}
echo "var xp =".intval($levelbackground[75]).";";
echo "var yp =".intval($levelbackground[76]).";";
echo "var xb =".intval($levelbackground[77]).";";
echo "var yb =".intval($levelbackground[78]).";";
?>
var block = 1;
function change(x, y){
switch(block){
case 10:
xp = x;
yp = y;
place();
break;
case 11:
xb = x;
yb = y;
place();
break;
default:
tablevel[x] [y] = block;
xx = x;
yy = y;
if(x<10){xx = '0'+x;}
if(y<10){yy = '0'+y;}
ide = "c"+xx+yy;
id = document.getElementById(ide);
switch(block){
case 0:
id.className= 'trap';
break;
case 1:
id.className= 'care';
break;
case 2:
id.className= 'finish';
break;
case 3:
id.className= 'buket';
break;
}
break;
}
}

function ck(i){
if(block <10 && i>9){place();}
if(block >10 && i<9){kill();}
block = i;
}

function place(){
var posbx = 35*xb;
var posby = -560+35*yb;
var aventure = document.getElementById('aventure');
var posx = 35*xp;
var posy = -525+35*yp;
var player = document.getElementById('player');
aventure.style.left = posbx;
aventure.style.top = posby;
aventure.style.display = "block";
player.style.left = posx;
player.style.top = posy;
player.style.display = "block";
}

function kill(){
aventure.style.display = "none";
player.style.display = "none";
}

function save(){
var s = 's';
for(i = 0; i<75; i++){
for(j = 0; j<75; j++){
s += tablevel[j] [i];
}
}
url = '<?php echo $Domaine;?>/jeux/aventure/admin.php?level='+document.getElementById('level').value+'&save='+s+'&xp='+xp+'&yp='+yp+'&xb='+xb+'&yb='+yb;
document.location.href = url;
}

place();
kill();
</script>