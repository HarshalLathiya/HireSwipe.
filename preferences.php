<?php require 'includes/layout.php';
$opts=['relevant'=>'Relevant job notifications','match'=>'Notify me when a match is found','applies'=>'Notify me when someone applies for a job on my post','invites'=>'Receive invitation notifications'];
if($role==='employee')unset($opts['applies']);
if($_SERVER['REQUEST_METHOD']==='POST'){$_SESSION['prefs']=$_POST['p']??[];$ok=1;} // BACKEND HOOK: persist
$cur=$_SESSION['prefs']??array_keys($opts);head('Notification Preferences');?>
<div class="narrow" style="margin:auto"><h1>Notification preferences</h1><?php if(!empty($ok))echo '<div class="alert">Preferences saved.</div>';?>
<form method="post" class="card"><?php foreach($opts as $k=>$l):?><div class="row"><div class="grow"><?=e($l)?></div><label class="sw"><input type="checkbox" name="p[]" value="<?=$k?>" <?=in_array($k,$cur)?'checked':''?>><span></span></label></div><?php endforeach;?>
<button class="btn full" style="margin-top:1rem">Save preferences</button></form></div>
<?php foot();
