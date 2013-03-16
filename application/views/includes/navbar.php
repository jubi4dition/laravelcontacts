<div class="navbar navbar-static-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="<?=URL::to('user'); ?>"><img src="<?=URL::to_asset('img/yourcontacts.png'); ?>" width="57px"/></a>
      <ul class="nav">
        <li class="divider-vertical"></li>
        <li id="nav-contacts"><?=HTML::link('user/contacts', 'Contacts'); ?></li>
        <li class="divider-vertical"></li>
        <li id="nav-add"><?=HTML::link('user/contacts/add', 'Add'); ?></li>
        <li class="divider-vertical"></li>
        <li id="nav-delete"><?=HTML::link('user/contacts/delete', 'Delete'); ?></li>
        <li class="divider-vertical"></li>
        <li id="nav-edit"><?=HTML::link('user/contacts/edit', 'Edit'); ?></li>
        <li class="divider-vertical"></li>
      </ul>
      <div class="pull-right">
        <small class="navbar-text">User: <?=HTML::link('user/profile', Session::get('email')); ?> </small>
        <a href="<?=URL::to('login/logout') ?>" class="btn btn-primary"><i class="icon-road icon-white"></i> Logout</a>
      </div>
    </div>
  </div>
</div>
