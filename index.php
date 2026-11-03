<?php require 'includes/layout.php';
if($_SERVER['REQUEST_METHOD']==='POST'){ /* BACKEND HOOK: authenticate */ header('Location: get-started.php');exit;}
head('Sign In','auth');?>
<div class="card"><div class="logo"><b>Easy <span>Employment</span></b><p class="mute">Welcome back. Please sign in to continue.</p></div>
<form method="post"><div class="f"><label>Email</label><input type="email" name="email" placeholder="you@example.com" required></div>
<div class="f"><label>Password</label><input type="password" name="password" placeholder="••••••••" required></div>
<button class="btn full">Sign In</button></form>
<div class="or">or continue with</div><div class="social"><a href="#" title="Facebook">f</a><a href="#" title="Google">G</a></div>
<p class="or">New here? <a href="register.php">Sign Up</a></p></div>
<?php foot('auth');
