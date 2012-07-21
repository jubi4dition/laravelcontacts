<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?=URL::to('user'); ?>"><img src="<?=URL::to_asset('img/yourcontacts.png'); ?>" width="57px"/></a>
			<ul class="nav">
				<li class="divider-vertical"></li>
				<li <? if ($active == "add") echo "class=\"active\"" ?>><?=HTML::link('user/add', 'Add'); ?></li>
				<li class="divider-vertical"></li>
				<li <? if ($active == "delete") echo "class=\"active\"" ?>><?=HTML::link('user/delete', 'Delete'); ?></li>
				<li class="divider-vertical"></li>
				<li <? if ($active == "edit") echo "class=\"active\"" ?>><?=HTML::link('user/edit', 'Edit'); ?></li>
				<li class="divider-vertical"></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?=HTML::link('user/profile', Session::get('email')); ?> </small>
				<a href="<?=URL::to('login/logout') ?>" class="btn btn-primary"><i class="icon-road icon-white"></i> Logout</a>
			</div>
		</div>
	</div>
</div>
