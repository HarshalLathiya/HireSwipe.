<?php
session_start();
require __DIR__.'/app.php';
$page = $_GET['page'] ?? 'welcome';
$allowed = ['welcome','signin','signup','role','employee-onboarding','employer-onboarding','home','jobs','job-detail','apply','interviews','profile','edit-profile','notifications','settings','plans','employer-home','search-candidates','post-job','job-preview','logout'];
if (!in_array($page,$allowed,true)) $page='welcome';
if ($page==='logout') { session_unset(); session_destroy(); session_start(); flash('success','You have been signed out safely.'); redirect('welcome'); }
if ($_SERVER['REQUEST_METHOD']==='POST') handle_post($page);
$user = current_user();
$protected = ['home','jobs','job-detail','apply','interviews','profile','edit-profile','notifications','settings','plans','employer-home','search-candidates','post-job','job-preview','employee-onboarding','employer-onboarding'];
if (in_array($page,$protected,true) && !$user) redirect('signin');
if ($user && in_array($page,['home','jobs','job-detail','apply','interviews','profile','edit-profile','notifications','settings','plans'],true) && $user['role']==='employer') redirect('employer-home');
if ($user && in_array($page,['employer-home','search-candidates','post-job','job-preview'],true) && $user['role']!=='employer') redirect('home');
$title = page_title($page);
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="theme-color" content="#101116"><title><?=e($title)?> · Easy Employment</title><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet"><link rel="stylesheet" href="assets/css/style.css"></head><body>
<?php if (!in_array($page,['welcome','signin','signup','role','employee-onboarding','employer-onboarding'],true)): ?>
<header class="topbar"><a class="brand" href="<?=url($user && $user['role']==='employer'?'employer-home':'home')?>"><span class="brand-mark">e<span>e</span></span><span>easy<span class="brand-gold">employment</span></span></a><nav class="desktop-nav"><?php if($user && $user['role']==='employee'): ?><a class="<?=active($page,['home'])?>" href="<?=url('home')?>">Overview</a><a class="<?=active($page,['jobs','job-detail'])?>" href="<?=url('jobs')?>">Find jobs</a><a class="<?=active($page,['interviews'])?>" href="<?=url('interviews')?>">Interviews</a><?php else: ?><a class="<?=active($page,['employer-home'])?>" href="<?=url('employer-home')?>">Overview</a><a class="<?=active($page,['search-candidates'])?>" href="<?=url('search-candidates')?>">Find talent</a><a class="<?=active($page,['post-job','job-preview'])?>" href="<?=url('post-job')?>">Post a job</a><?php endif; ?></nav><div class="top-actions"><a class="icon-button" aria-label="Notifications" href="<?=url('notifications')?>">♧<span class="notif-dot"></span></a><a class="user-chip" href="<?=url('profile')?>"><span class="avatar"><?=e(strtoupper(substr($user['name']??'U',0,1)))?></span><span class="user-chip-name"><?=e($user['name']??'Account')?></span><span class="chevron">⌄</span></a><button class="mobile-menu" id="mobileMenu" aria-label="Toggle menu">☰</button></div></header>
<div class="mobile-nav" id="mobileNav"><a href="<?=url($user['role']==='employer'?'employer-home':'home')?>">Overview</a><a href="<?=url($user['role']==='employer'?'search-candidates':'jobs')?>"><?= $user['role']==='employer'?'Find talent':'Find jobs' ?></a><a href="<?=url('profile')?>">Profile</a><a href="<?=url('settings')?>">Settings</a><a href="<?=url('logout')?>">Sign out</a></div>
<?php endif; ?>
<main class="<?=in_array($page,['welcome','signin','signup','role','employee-onboarding','employer-onboarding'],true)?'public-main':'app-main'?>">
<?php render_page($page,$user); ?>
</main>
<?php if (!in_array($page,['welcome','signin','signup','role','employee-onboarding','employer-onboarding'],true)): ?><footer class="app-footer"><span>© <?=date('Y')?> Easy Employment</span><span>Built for the next step in your career.</span><a href="<?=url('logout')?>">Sign out</a></footer><?php endif; ?>
<div class="toast-stack" id="toastStack"><?php foreach(take_flashes() as $f): ?><div class="toast toast-<?=e($f['type'])?>"><span><?= $f['type']==='success'?'✓':'!' ?></span><?=e($f['message'])?></div><?php endforeach; ?></div><script src="assets/js/app.js"></script></body></html>
