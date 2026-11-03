<?php require 'includes/layout.php';head('Subscription Plans');$sel=$_GET['plan']??'';?>
<a href="profile.php">← Back</a><h1>Choose your plan</h1><?php if($sel)echo '<div class="alert">'.e($sel).' plan selected (demo — no payment taken).</div>';?>
<div class="grid"><?php foreach($plans as $i=>$p):?><div class="card plan <?=$i==1?'hot':''?>"><h2><?=$p[0]?></h2><div class="pr"><?=$p[1]?></div><div class="mute"><?=$p[2]?></div><ul><?php foreach($p[3] as $f)echo '<li>✓ '.e($f).'</li>';?></ul><a class="btn full <?=$i==1?'gold':''?>" href="plans.php?plan=<?=$p[0]?>">Get Started</a></div><?php endforeach;?></div>
<?php foot();
