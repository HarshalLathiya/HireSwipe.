<?php require 'includes/layout.php';$_SESSION['role']='employer';$role='employer';
$F=['title'=>'Job Title','company'=>'Company','emptype'=>'Employment Type','experience'=>'Experience','salary'=>'Expected Salary','location'=>'Job Location','jobtype'=>'Job Type','workplace'=>'WorkPlace Type'];
$err=[];$ok=0;
if($_SERVER['REQUEST_METHOD']==='POST'){foreach($F as $k=>$l){if(trim($_POST[$k]??'')==='')$err[]=$l;else $_SESSION['job'][$k]=$_POST[$k];}
 if(!$err)$ok=1; /* BACKEND HOOK: save job */}
$J=$_SESSION['job']??[];$J['location']=$_SESSION['profile']['location']??($J['location']??'');
head('Post a Job');?>
<div class="narrow" style="margin:auto"><h1>Tell us who you're hiring</h1>
<?php if($ok)echo '<div class="alert">Job submitted successfully (demo).</div>';if($err)echo '<div class="alert err">Please fill: '.e(implode(', ',$err)).'</div>';?>
<form method="post" class="card"><?php foreach($F as $k=>$l):$opts=['emptype'=>['Full Time','Part Time','Casual'],'jobtype'=>['Permanent','Contract','Internship'],'workplace'=>['On-site','Remote','Hybrid']][$k]??null;?>
<div class="f"><label><?=$l?> *</label><?php if($opts){echo '<select name="'.$k.'"><option value="">Select</option>';foreach($opts as $o)echo '<option'.(($J[$k]??'')==$o?' selected':'').'>'.$o.'</option>';echo '</select>';}else
 echo '<input name="'.$k.'" value="'.e($J[$k]??'').'" placeholder="Add '.strtolower($l).'">';?>
<?php if($k==='location')echo '<a class="btn ghost sm" style="margin-top:.6rem" href="map.php?ret=employer-post-job.php">📍 Pick on map</a>';?></div><?php endforeach;?>
<button class="btn full">Submit</button></form></div>
<?php foot();
