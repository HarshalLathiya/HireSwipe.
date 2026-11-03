<?php require 'includes/layout.php';$_SESSION['role']='employer';$role='employer';head('Search Candidates');?>
<h1>Search candidates</h1><p class="mute">Swipe right (or press ✓) to shortlist · swipe left (or press ✕) to pass. Arrow keys also work.</p>
<div class="chips"><span class="chip on" data-c="">All</span><?php foreach($categories as $c)echo '<span class="chip" data-c="'.e($c).'">'.e($c).'</span>';?></div>
<div class="deck" id="deck"></div>
<div class="acts"><button class="round n" id="no" title="Reject">✕</button><button class="round y" id="yes" title="Accept">✓</button></div>
<p style="text-align:center"><a href="employer-shortlist.php">View shortlisted candidates →</a> · <a href="#" id="reset">Reset deck</a></p>
<script>
const ALL=<?=json_encode($candidates)?>,K={a:'ee_accepted',r:'ee_rejected'},deck=document.getElementById('deck');let cat='';
const get=k=>{try{return JSON.parse(localStorage.getItem(k)||'[]')}catch(e){return[]}},set=(k,v)=>{try{localStorage.setItem(k,JSON.stringify(v))}catch(e){}}; // BACKEND HOOK: save decision per job
const esc=s=>String(s).replace(/[&<>"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
function render(){deck.innerHTML='';const done=[...get(K.a).map(x=>x.id),...get(K.r)];
 const list=ALL.filter(c=>!done.includes(c.id)&&(!cat||c.cat===cat));
 deck.insertAdjacentHTML('beforeend','<div class="empty"><div><h2>No more candidates</h2><p>Try another category or reset the deck.</p></div></div>');
 list.slice().reverse().forEach((c,i,a)=>{const top=i===a.length-1,el=document.createElement('div');el.className='sc fade';el.dataset.id=c.id;
  const d=a.length-1-i;if(d>2)el.style.display='none';el.style.transform=`scale(${1-d*.05}) translateY(${d*14}px)`;
  el.innerHTML=`<span class="stamp y">ACCEPT</span><span class="stamp n">REJECT</span><div class="av lg">${esc(c.name[0])}</div><h2>${esc(c.name)}</h2><div class="mute">${esc(c.role)}</div>
  <dl><dt>Experience</dt><dd>${esc(c.exp)}</dd><dt>Location</dt><dd>${esc(c.loc)}</dd><dt>Qualification</dt><dd>${esc(c.qual)}</dd><dt>Expected salary</dt><dd>${esc(c.salary)}</dd></dl>
  <div class="chips" style="margin-top:1rem">${c.skills.map(s=>'<span class="chip on">'+esc(s)+'</span>').join('')}</div>`;
  deck.appendChild(el);if(top)bind(el,c)})}
function decide(el,c,dir){const w=innerWidth;el.classList.remove('drag');el.style.transform=`translate(${dir*w}px,-40px) rotate(${dir*30}deg)`;el.style.opacity=0;
 if(dir>0){const a=get(K.a);a.push({...c,at:new Date().toISOString()});set(K.a,a)}else{const r=get(K.r);r.push(c.id);set(K.r,r)}
 setTimeout(render,320)}
function bind(el,c){let sx=0,dx=0,on=false;const y=el.querySelector('.y'),n=el.querySelector('.n');
 el.onpointerdown=e=>{on=true;sx=e.clientX;el.classList.add('drag');el.setPointerCapture(e.pointerId)};
 el.onpointermove=e=>{if(!on)return;dx=e.clientX-sx;el.style.transform=`translate(${dx}px,${-Math.abs(dx)*.05}px) rotate(${dx/18}deg)`;y.style.opacity=Math.max(0,dx/120);n.style.opacity=Math.max(0,-dx/120)};
 el.onpointerup=()=>{if(!on)return;on=false;if(Math.abs(dx)>110)decide(el,c,dx>0?1:-1);else{el.classList.remove('drag');el.style.transform='';y.style.opacity=n.style.opacity=0}dx=0};
 el._d=dir=>decide(el,c,dir)}
const topCard=()=>[...deck.querySelectorAll('.sc')].pop();
document.getElementById("yes").onclick=()=>{const t=topCard();t&&t._d&&t._d(1)};document.getElementById("no").onclick=()=>{const t=topCard();t&&t._d&&t._d(-1)};
document.onkeydown=e=>{if(e.key==='ArrowRight')document.getElementById("yes").onclick();if(e.key==="ArrowLeft")document.getElementById("no").onclick()};
document.getElementById("reset").onclick=e=>{e.preventDefault();set(K.a,[]);set(K.r,[]);render()};
document.querySelectorAll('.chips .chip').forEach(x=>x.onclick=()=>{document.querySelectorAll('.chips .chip').forEach(y=>y.classList.remove('on'));x.classList.add('on');cat=x.dataset.c;render()});
render();</script>
<?php foot();
