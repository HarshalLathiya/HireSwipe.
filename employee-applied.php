<?php require 'includes/layout.php';$_SESSION['role']='employee';$role='employee';head('Applied Jobs');?>
<h1>Applied jobs</h1><p class="mute">Every job you applied for by swiping right.</p>
<input id="s" placeholder="Search applied jobs" style="margin-bottom:1rem"><div id="out"></div>
<script>
const esc=s=>String(s).replace(/[&<>"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
const get=()=>{try{return JSON.parse(localStorage.getItem('ee_applied')||'[]')}catch(e){return[]}};
const stages=['Under review','Shortlisted','Application sent'];
function draw(){const q=document.getElementById('s').value.toLowerCase(),L=get().filter(j=>(j.title+j.co+j.loc+j.cat).toLowerCase().includes(q));
 document.getElementById('out').innerHTML=L.length?'<div class="grid">'+L.map(j=>`<div class="card fade"><div style="display:flex;gap:1rem;align-items:center"><div class="av">${esc(j.co[0])}</div><div><h3 style="margin:0">${esc(j.title)}</h3><span class="mute">${esc(j.co)}</span></div></div>
 <table class="tbl" style="margin:.8rem 0"><tr><th>Location</th><td>${esc(j.loc)}</td></tr><tr><th>Type</th><td>${esc(j.type)} · ${esc(j.work)}</td></tr><tr><th>Salary</th><td>${esc(j.sal)}</td></tr><tr><th>Experience</th><td>${esc(j.exp)}</td></tr><tr><th>Applied on</th><td>${new Date(j.at).toLocaleDateString()}</td></tr><tr><th>Status</th><td><span class="chip on">${stages[j.id%2]}</span></td></tr></table>
 <div class="chips">${j.skills.map(k=>'<span class="chip">'+esc(k)+'</span>').join('')}</div><button class="btn ghost sm" onclick="rm(${j.id})">Withdraw</button></div>`).join('')+'</div>'
 :'<div class="card" style="text-align:center"><h2>No applications yet</h2><p class="mute">Swipe right on a job to apply and it will appear here.</p><a class="btn gold" href="employee-apply.php">Find jobs</a></div>'}
function rm(id){localStorage.setItem('ee_applied',JSON.stringify(get().filter(j=>j.id!==id)));draw()}
document.getElementById('s').oninput=draw;draw();</script>
<?php foot();
