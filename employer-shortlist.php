<?php require 'includes/layout.php';$_SESSION['role']='employer';$role='employer';head('Shortlisted Candidates');?>
<h1>Shortlisted candidates</h1><p class="mute">Everyone you accepted by swiping right.</p>
<input id="s" placeholder="Search shortlisted candidates" style="margin-bottom:1rem"><div id="out"></div>
<script>
const esc=s=>String(s).replace(/[&<>"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
const get=()=>{try{return JSON.parse(localStorage.getItem('ee_accepted')||'[]')}catch(e){return[]}};
function draw(){const q=s.value.toLowerCase(),L=get().filter(c=>(c.name+c.role+c.loc+c.skills.join()).toLowerCase().includes(q));
 out.innerHTML=L.length?'<div class="grid">'+L.map(c=>`<div class="card fade"><div style="display:flex;gap:1rem;align-items:center"><div class="av">${esc(c.name[0])}</div><div><h3 style="margin:0">${esc(c.name)}</h3><span class="mute">${esc(c.role)}</span></div></div>
 <table class="tbl" style="margin:.8rem 0"><tr><th>Experience</th><td>${esc(c.exp)}</td></tr><tr><th>Location</th><td>${esc(c.loc)}</td></tr><tr><th>Qualification</th><td>${esc(c.qual)}</td></tr><tr><th>Expected</th><td>${esc(c.salary)}</td></tr><tr><th>Email</th><td>${esc(c.email)}</td></tr><tr><th>Phone</th><td>${esc(c.phone)}</td></tr><tr><th>Accepted</th><td>${new Date(c.at).toLocaleDateString()}</td></tr></table>
 <div class="chips">${c.skills.map(k=>'<span class="chip on">'+esc(k)+'</span>').join('')}</div><button class="btn ghost sm" onclick="rm(${c.id})">Remove</button></div>`).join('')+'</div>'
 :'<div class="card" style="text-align:center"><h2>No shortlisted candidates yet</h2><p class="mute">Swipe right on a candidate to add them here.</p><a class="btn gold" href="employer-search.php">Start searching</a></div>'}
function rm(id){localStorage.setItem('ee_accepted',JSON.stringify(get().filter(c=>c.id!==id)));draw()}
s.oninput=draw;draw();</script>
<?php foot();
