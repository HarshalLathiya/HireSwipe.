<?php require 'includes/layout.php';
if($_SERVER['REQUEST_METHOD']==='POST'){foreach(['name','phone','location','age','worktype'] as $k)$_SESSION['profile'][$k]=$_POST[$k]??'';header('Location: profile.php');exit;} // BACKEND HOOK: update profile
head('Edit Profile');?>
<div class="narrow" style="margin:auto"><a href="profile.php">← Back</a><h1>Edit basic details</h1><form method="post" class="card">
<div class="f"><label>Full name</label><input name="name" value="<?=e(pv('name','Aarav Patel'))?>"></div><div class="f"><label>Phone</label><input name="phone" value="<?=e(pv('phone','+91 98765 43210'))?>"></div>
<div class="f"><label>Location</label><input name="location" value="<?=e(pv('location','Ahmedabad, Gujarat'))?>"></div><div class="f"><label>Age</label><input type="number" name="age" value="<?=e(pv('age','29'))?>"></div>
<div class="f"><label>Work type</label><select name="worktype"><?php foreach(['Full Time','Part Time','Casual','Contract'] as $o)echo '<option'.(pv('worktype')==$o?' selected':'').'>'.$o.'</option>';?></select></div><button class="btn full">Save</button></form></div>
<?php foot();
