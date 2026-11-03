<?php require 'includes/layout.php';$name=pv('name','Aarav Patel');head('Profile');?>
<div class="card" style="text-align:center"><div class="av lg" style="margin:0 auto 1rem"><?=e(strtoupper($name[0]))?></div><h1><?=e($name)?></h1><p class="mute"><?=$role=='employer'?'Employer':'Job seeker'?> · <?=e(pv('email','aarav@example.com'))?></p>
<a class="btn ghost" href="edit-profile.php">Edit details</a> <a class="btn gold" href="plans.php">Update Plan</a></div><br>
<div class="card"><h2>Basic details</h2><table class="tbl">
<?php foreach(['Phone'=>pv('phone','+91 98765 43210'),'Location'=>pv('location','Ahmedabad, Gujarat'),'Age'=>pv('age','29'),'Work type'=>pv('worktype','Full Time'),$role=='employer'?'Company':'Qualification'=>$role=='employer'?pv('company','Sample Company'):pv('qualification','Bachelor’s'),'Industries'=>pv('industries',pv('industry','Logistics, Finance'))] as $k=>$v)echo '<tr><th>'.e($k).'</th><td>'.e($v).'</td></tr>';?></table></div>
<?php foot();
