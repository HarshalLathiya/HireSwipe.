<?php require 'includes/layout.php';head('Find Jobs');?>
<h1>Find jobs</h1><input id="s" placeholder="Search by title, company or location" style="margin:.5rem 0 1rem">
<div class="chips"><span class="chip on" data-c="">All</span><?php foreach($categories as $c)echo '<span class="chip" data-c="'.e($c).'">'.e($c).'</span>';?></div>
<div class="card" id="list"><?php foreach($jobs as $j):?><div class="row job" data-cat="<?=e($j['cat'])?>" data-t="<?=e(strtolower($j['title'].$j['co'].$j['loc']))?>"><div class="av"><?=e($j['co'][0])?></div>
<div class="grow"><b><?=e($j['title'])?></b><div class="mute"><?=e($j['co'])?> · <?=e($j['loc'])?></div><div class="mute"><?=e($j['type'])?> · <?=e($j['sal'])?></div></div><button class="btn sm apply">Apply</button></div><?php endforeach;?></div>
<script>let cat='';const rows=[...document.querySelectorAll('.job')];
function f(){rows.forEach(r=>r.style.display=(!cat||r.dataset.cat==cat)&&r.dataset.t.includes(s.value.toLowerCase())?'':'none')}
s.oninput=f;document.querySelectorAll('.chips .chip').forEach(c=>c.onclick=()=>{document.querySelectorAll('.chips .chip').forEach(x=>x.classList.remove('on'));c.classList.add('on');cat=c.dataset.c;f()});
document.querySelectorAll('.apply').forEach(b=>b.onclick=()=>{b.textContent='Applied ✓';b.classList.add('done')}) /* BACKEND HOOK: submit application */</script>
<?php foot();
