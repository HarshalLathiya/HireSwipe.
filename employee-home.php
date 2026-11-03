<?php require 'includes/layout.php';$_SESSION['role']='employee';$role='employee';head('Home');?>
<h1>Welcome<?=pv('name')?', '.e(pv('name')):''?></h1><p class="mute">Here is your job search at a glance.</p>
<div class="grid" style="margin-bottom:1.5rem"><div class="card stat"><b>12</b>Applications sent</div><div class="card stat"><b>3</b>Upcoming interviews</div><div class="card stat"><b>8</b>New job matches</div></div>
<h2>Quick actions</h2><div class="grid" style="margin-bottom:1.5rem">
<a class="card" href="employee-apply.php">🔎 <b>Find Jobs</b><p class="mute">Browse and apply</p></a><a class="card" href="employee-interviews.php">📅 <b>Interviews</b><p class="mute">Your schedule</p></a>
<a class="card" href="notifications.php">🔔 <b>Notifications</b><p class="mute">Latest updates</p></a><a class="card" href="plans.php">⭐ <b>Subscription</b><p class="mute">Manage your plan</p></a></div>
<h2>Recommended for you</h2><div class="card"><?php foreach(array_slice($jobs,0,3) as $j):?><div class="row"><div class="av"><?=e($j['co'][0])?></div><div class="grow"><b><?=e($j['title'])?></b><div class="mute"><?=e($j['co'])?> · <?=e($j['loc'])?></div></div><a class="btn sm ghost" href="employee-apply.php">View</a></div><?php endforeach;?></div>
<?php foot();
