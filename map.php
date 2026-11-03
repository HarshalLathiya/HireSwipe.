<?php require 'includes/layout.php';
$ret=$_GET['ret']??$_POST['ret']??'employee-home.php';
if($_SERVER['REQUEST_METHOD']==='POST'){$_SESSION['profile']['location']=$_POST['loc'];header('Location: '.$ret);exit;} // BACKEND HOOK: real maps API
head('Select Location');?>
<div class="narrow" style="margin:auto"><a href="<?=e($ret)?>">← Back</a><h1>Select location</h1>
<input id="q" list="pl" placeholder="Search a place, e.g. Alkapuri" autocomplete="off"><datalist id="pl"><?php foreach($places as $p)echo '<option value="'.e($p[0]).'">';?></datalist>
<div class="map"><span class="pin" id="pin">📍</span></div>
<div class="card"><h3>Selected address</h3><p id="addr"><?=e($places[0][0])?></p>
<form method="post"><input type="hidden" name="ret" value="<?=e($ret)?>"><input type="hidden" name="loc" id="loc" value="<?=e($places[0][0])?>"><button class="btn full">Select Location</button></form></div></div>
<script>const P=<?=json_encode($places)?>,pin=document.getElementById('pin');
function set(p){pin.style.left=p[1]+'%';pin.style.top=p[2]+'%';addr.textContent=p[0];loc.value=p[0]}set(P[0]);
q.oninput=()=>{const m=P.find(p=>p[0].toLowerCase().includes(q.value.toLowerCase()));if(q.value&&m)set(m)}</script>
<?php foot();
