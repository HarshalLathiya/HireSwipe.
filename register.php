<?php require 'includes/layout.php';
if($_SERVER['REQUEST_METHOD']==='POST'){ /* BACKEND HOOK: create account */ $_SESSION['profile']['email']=$_POST['email']??'';header('Location: get-started.php');exit;}
head('Sign Up','auth');?>
<div class="card"><div class="logo"><b>Easy <span>Employment</span></b><p class="mute">Create your account in a minute.</p></div>
<form method="post"><div class="f"><label>Full name</label><input name="name" required></div>
<div class="f"><label>Email</label><input type="email" name="email" required></div>
<div class="f"><label>Password</label><input type="password" name="password" minlength="6" required></div>
<button class="btn full">Create Account</button></form>
<p class="or">Already registered? <a href="index.php">Sign In</a></p></div>
<?php foot('auth');
