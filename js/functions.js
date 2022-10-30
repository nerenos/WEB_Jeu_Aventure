var limvit = true;
var play = true;


function playermove(x, y){
pousse(x, y);
if(bop){
if((posx!=0 && x<0) || (posx!=490 && x>0)){poslvx = poslvx + x/5;}
if((posy!=-35 && y>0) || (posy!=-525 && y<0)){poslvy = poslvy + y/5;}
for(i=0; i<7; i++){
if((posx!=0 && x<0) || (posx!=490 && x>0)){posx = posx + x;}
if((posy!=-35 && y>0) || (posy!=-525 && y<0)){posy = posy + y;}
color = (i+1)*35;
if(x == 5){orient = 105};
if(x == -5){orient = 35};
if(y == 5){orient = 70};
if(y == -5){orient = 0};
setTimeout(move , 50*i, player, posx, posy, color, orient);
}
if(tablevel[poslvx] [poslvy]==0 || tablevel[poslvx] [poslvy]==3){
play=false;
setTimeout(kill, 700);
}
}
bop = true;
}

function pousse(x, y){
dist = Math.round(Math.sqrt(Math.pow((posx-posbx),2)+Math.pow((posy-posby-35),2)));
if(dist == 35){
if(x>0 && -35==(posx-posbx)){boxmove(5, 0);}
if(x<0 && 35==(posx-posbx)){boxmove(-5, 0);}
if(y>0 && 0==Math.abs(posy-posby)){boxmove(0, 5);}
if(y<0 && 70==Math.abs(posy-posby)){boxmove(0, -5);}
}
}

function boxmove(x, y){
poslvbx = poslvbx + x/5;
poslvby = poslvby + y/5;
if(!(((posbx!=0 && x<0) || (posbx!=490 && x>0)) || ((posby!=-70 && y>0) || (posby!=-560 && y<0)))){bop = false;}
for(i=0; i<7; i++){
if((posbx!=0 && x<0) || (posbx!=490 && x>0)){posbx = posbx + x;}
if((posby!=-70 && y>0) || (posby!=-560 && y<0)){posby = posby + y;}
setTimeout(move, 50*i, box, posbx, posby);
}
switch(tablevel[poslvbx] [poslvby]){
case 0:
for(j=-7; j<1; j++){
setTimeout(tombe, 75*(j+7), box, posbx+(2.5*(j+7)), posby+(2.5*(j+7)), j);
}
posbx = 35*poslvbxi;
posby = -560+35*poslvbyi;
poslvbx = poslvbxi;
poslvby = poslvbyi;
setTimeout(tombe, 700, box, posbx, posby, 7);
break;
case 2:
play = false;
setTimeout(gagne, 800);
break;
case 3:
for(j=-7; j<1; j++){
setTimeout(tombe, 75*(j+7), box, posbx+(2.5*(j+7)), posby+(2.5*(j+7)), j);
}
posbx = 35*poslvbxi;
posby = -560+35*poslvbyi;
tablevel[poslvbx] [poslvby]=1;
idex = poslvbx;
idey = poslvby;
poslvbx = poslvbxi;
poslvby = poslvbyi;
if(idex<10){idex = "0"+idex;}
if(idey<10){idey = "0"+idey;}
ide = "c" + idex + idey;
document.getElementById(ide).style.backgroundPosition = "35px 0px";
setTimeout(tombe, 700, box, posbx, posby, 7);
break;
}
}

function tombe(id, x, y, t){
id.style.height = Math.abs(5*t);
id.style.width = Math.abs(5*t);
id.style.left = x;
id.style.top = y;
}

function move(id, x, y, c, o){
id.style.left = x;
id.style.top = y;
if(typeof(o) != 'undefined'){
txpo = c+"px "+o+"px";
id.style.backgroundPosition = txpo;
}
}

function checkEventObj ( _event_ ){
	// --- IE explorer
	if ( window.event )
		return window.event;
	// --- Netscape and other explorers
	else
		return _event_;
}

function lim(){
limvit = true;
}

function gagne(){
alert('gagne');
hred('?page=jeux/aventure/passlevel.php&level=100100');
}

function kill(){
player.style.backgroundImage = "url('/jeux/aventure/images/kill.gif')";
hred('?page=jeux/aventure/passlevel.php&level=10000');
}

function applyKey (_event_){
	
	var winObj = checkEventObj(_event_);
	
	var intKeyCode = winObj.keyCode;
	var intAltKey = winObj.altKey;
	var intCtrlKey = winObj.ctrlKey;
if(play && limvit){	
limvit = false;
if (intKeyCode == KEY_S){playermove(0 ,5);}
if (intKeyCode == KEY_Z){playermove(0 ,-5);}
if (intKeyCode == KEY_Q){playermove(-5 ,0);}
if (intKeyCode == KEY_D){playermove(5 ,0);}
setTimeout(lim, 250);
}
}

KEY_DOWN	= 40;
KEY_UP		= 38;
KEY_LEFT	= 37;
KEY_RIGHT	= 39;

KEY_END		= 35;
KEY_BEGIN	= 36;



KEY_BACK_TAB 	= 8;
KEY_TAB				= 9;
KEY_SH_TAB  	= 16;
KEY_ENTER			= 13;
KEY_ESC				= 27;
KEY_SPACE			= 32;
KEY_DEL				= 46;

KEY_A		= 65;
KEY_B		= 66;
KEY_C		= 67;
KEY_D		= 68;
KEY_E		= 69;
KEY_F		= 70;
KEY_G		= 71;
KEY_H		= 72;
KEY_I		= 73;
KEY_J		= 74;
KEY_K		= 75;
KEY_L		= 76;
KEY_M		= 77;
KEY_N		= 78;
KEY_O		= 79;
KEY_P		= 80;
KEY_Q		= 81;
KEY_R		= 82;
KEY_S		= 83;
KEY_T		= 84;
KEY_U		= 85;
KEY_V		= 86;
KEY_W		= 87;
KEY_X		= 88;
KEY_Y		= 89;
KEY_Z		= 90;

KEY_PF1		= 112;
KEY_PF2		= 113;
KEY_PF3		= 114;
KEY_PF4		= 115;
KEY_PF5		= 116;
KEY_PF6		= 117;
KEY_PF7		= 118;
KEY_PF8		= 119;

REMAP_KEY_T	= 5019;
	

