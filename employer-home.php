<?php require 'includes/layout.php';$_SESSION['role']='employer';$role='employer';head('Dashboard');?>
<h1>Employer dashboard</h1><p class="mute">Manage your vacancies and find candidates.</p>
<div class="grid" style="margin-bottom:1.5rem"><div class="card stat"><b>4</b>Active jobs</div><div class="card stat"><b>27</b>Applicants</div><div class="card stat"><b>5</b>Interviews</div></div>
<p><a class="btn gold" href="employer-post-job.php">+ Post a job</a> <a class="btn ghost" href="employer-search.php">Search candidates</a></p>
<div class="card"><h2>Your job posts</h2><table class="tbl"><tr><th>Title</th><th>Location</th><th>Type</th><th>Applicants</th></tr><?php foreach($jobs as $k=>$j)echo '<tr><td>'.e($j['title']).'</td><td>'.e($j['loc']).'</td><td>'.e($j['type']).'</td><td>'.(3+$k*4).'</td></tr>';?></table></div>
<?php foot();
