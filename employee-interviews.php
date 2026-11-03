<?php require 'includes/layout.php';head('Interviews');?>
<h1>Interviews</h1><input id="s" placeholder="Search interviews" style="margin:.5rem 0 1rem"><div class="card"><?php foreach($interviews as $x):?>
<div class="row iv" data-t="<?=e(strtolower($x['co'].$x['role']))?>"><div class="av">📅</div><div class="grow"><b><?=e($x['role'])?></b> · <?=e($x['co'])?><div class="mute"><?=e($x['when'])?> · <?=e($x['mode'])?></div></div><span class="chip <?=$x['status']=='Confirmed'?'on':''?>"><?=e($x['status'])?></span></div><?php endforeach;?></div>
<script>s.oninput=()=>document.querySelectorAll('.iv').forEach(r=>r.style.display=r.dataset.t.includes(s.value.toLowerCase())?'':'none')</script>
<?php foot();
