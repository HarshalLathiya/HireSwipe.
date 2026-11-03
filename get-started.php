<?php require 'includes/layout.php';
head('Get Started','auth');?>
<div class="card"><h1>How will you use Easy Employment?</h1><p class="mute">Choose one to personalise your setup.</p>
<a class="opt" href="onboarding.php?role=employee&step=1"><div>🔎 Looking for Work<br><span class="mute">Find and apply for jobs</span></div></a>
<a class="opt" href="onboarding.php?role=employer&step=1"><div>🏢 Looking for an Employee<br><span class="mute">Post jobs and find candidates</span></div></a></div>
<?php foot('auth');
