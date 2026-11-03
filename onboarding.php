<?php require 'includes/layout.php';
$role=($_GET['role']??$role)==='employer'?'employer':'employee';$_SESSION['role']=$role;
$f=fn($n,$l,$t='text',$o=[],$ph='')=>compact('n','l','t','o','ph');
$S=[ // each step: title, subtitle, fields. Add/reorder steps here.
 'name'=>['What is your name?','',[$f('name','Full name','text',[],'e.g. Aarav Patel')]],
 'about'=>['About you','A short introduction.',[$f('about','About you','textarea')]],
 'age'=>['How old are you?','',[$f('age','Age','number')]],
 'worktype'=>['Work type','',[$f('worktype','Preferred work type','cards',['Full Time','Part Time','Casual','Contract'])]],
 'lookingin'=>['Looking in','Where would you like to search?',[$f('lookingin','Preferred area','select',['Ahmedabad','Gandhinagar','Vadodara','Surat','Anywhere in Gujarat'])]],
 'phone'=>['Verify your phone','We will send a one-time code.',[$f('phone','Phone number','tel',[],'+91 98765 43210')]],
 'otp'=>['Enter the code','Demo code: 123456',[$f('otp','6-digit OTP','otp')]],
 // employee
 'e_loc'=>['Your location','',[$f('location','Location','location')]],
 'e_nat'=>['Nationality','',[$f('nationality','Nationality','select',['Indian','Other'])]],
 'e_qual'=>['Qualification','',[$f('qualification','Highest qualification','select',['Higher Secondary','Diploma','Bachelor’s','Master’s','Doctorate'])]],
 'e_tix'=>['Tickets & licences','Add any certifications you hold.',[$f('ticket_name','Ticket / licence name'),$f('ticket_body','Issuing body'),$f('ticket_exp','Expiry year','number')]],
 'e_exp'=>['Experience','',[$f('experience','Years of experience','number')]],
 'e_sal'=>['Expected salary','',[$f('salary','Expected annual salary (₹)','number')]],
 'e_type'=>['Employment type','',[$f('emptype','Employment type','cards',['Full Time','Part Time','Casual'])]],
 'e_ind'=>['Industries','Select all that apply; tap again to remove.',[$f('industries','Industries','multi',$industries)]],
 'e_pic'=>['Profile picture','',[$f('picture','Upload a photo','file')]],
 'e_cv'=>['Upload your CV','',[$f('cv','Upload Your CV','file')]],
 // employer
 'r_co'=>['Your company','',[$f('company','Company name')]],
 'r_loc'=>['Company location','',[$f('location','Location','location')]],
 'r_ind'=>['Industry','',[$f('industry','Industry','select',$industries)]],
 'r_pos'=>['Position','What role are you hiring for?',[$f('position','Position')]],
 'r_type'=>['Employment type','',[$f('emptype','Employment type','cards',['Full Time','Part Time','Casual'])]],
 'r_sal'=>['Salary','',[$f('salary','Offered annual salary (₹)','number')]],
 'r_det'=>['Job details','',[$f('jobdetail','Describe the role','textarea')]],
 'r_logo'=>['Company logo','',[$f('logo','Upload logo','file')]],
];
$keys=['name','about','age','worktype','lookingin','phone','otp'];
$keys=array_merge($keys,$role==='employer'?['r_co','r_loc','r_ind','r_pos','r_type','r_sal','r_det','r_logo']:['e_loc','e_nat','e_qual','e_tix','e_exp','e_sal','e_type','e_ind','e_pic','e_cv']);
$n=count($keys);$i=max(1,min($n,(int)($_GET['step']??1)));[$title,$sub,$fields]=$S[$keys[$i-1]];
if($_SERVER['REQUEST_METHOD']==='POST'){ /* BACKEND HOOK: save step */
 foreach($fields as $x){$_SESSION['profile'][$x['n']]=$x['t']==='file'?($_FILES[$x['n']]['name']??''):($_POST[$x['n']]??'');}
 header('Location: '.($i<$n?"onboarding.php?role=$role&step=".($i+1):($role==='employer'?'employer-home.php':'employee-home.php')));exit;}
head($title);?>
<div class="narrow" style="margin:auto"><div class="steps"><i style="width:<?=round($i/$n*100)?>%"></i></div>
<div class="card"><p class="mute">Step <?=$i?> of <?=$n?> · <?=ucfirst($role)?> setup</p><h1><?=e($title)?></h1><p class="mute"><?=e($sub)?></p>
<form method="post" enctype="multipart/form-data">
<?php foreach($fields as $x):$v=pv($x['n']);?><div class="f"><label><?=e($x['l'])?></label>
<?php switch($x['t']){
 case 'textarea':echo '<textarea name="'.$x['n'].'" rows="4">'.e($v).'</textarea>';break;
 case 'select':echo '<select name="'.$x['n'].'">';foreach($x['o'] as $o)echo '<option'.($o==$v?' selected':'').'>'.e($o).'</option>';echo '</select>';break;
 case 'cards':foreach($x['o'] as $o)echo '<label class="opt"><input type="radio" name="'.$x['n'].'" value="'.e($o).'"'.($o==$v?' checked':'').' required><div>'.e($o).'</div></label>';break;
 case 'multi':echo '<div class="chips">';foreach($x['o'] as $o)echo '<label><input type="checkbox" name="'.$x['n'].'[]" value="'.e($o).'"'.(strpos(", $v,",", $o,")!==false?' checked':'').'><span class="chip">'.e($o).'</span></label>';echo '</div>';break;
 case 'file':echo '<input type="file" name="'.$x['n'].'">';break;
 case 'location':echo '<input name="location" value="'.e($v).'" placeholder="Enter or pick on map"><p><a class="btn ghost sm" style="margin-top:.6rem" href="map.php?ret='.urlencode("onboarding.php?role=$role&step=$i").'">📍 Pick on map</a></p>';break;
 case 'otp':echo '<input class="otp" name="otp" maxlength="6" inputmode="numeric" placeholder="······">';break;
 default:echo '<input type="'.$x['t'].'" name="'.$x['n'].'" value="'.e($v).'" placeholder="'.e($x['ph']).'">';}?></div><?php endforeach;?>
<div style="display:flex;gap:.8rem"><?php if($i>1):?><a class="btn ghost" href="onboarding.php?role=<?=$role?>&step=<?=$i-1?>">Back</a><?php endif;?><button class="btn" style="flex:1"><?=$i<$n?'Next':'Finish'?></button></div></form></div></div>
<?php foot();
