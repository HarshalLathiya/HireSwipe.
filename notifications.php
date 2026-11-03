<?php require 'includes/layout.php';head('Notifications');?>
<div class="dark"><h1>Notifications</h1></div><div class="card"><?php foreach($notif[$role] as $n):?><div class="row"><div class="av"><?=$n[0]?></div><div class="grow"><?=e($n[1])?><div class="mute"><?=e($n[2])?></div></div></div><?php endforeach;?></div>
<p><a class="btn ghost" href="preferences.php">Notification preferences</a></p>
<?php foot();
