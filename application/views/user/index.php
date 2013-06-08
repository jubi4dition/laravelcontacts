<?=render('includes.header'); ?>
<?=render('includes.navbar'); ?>
<div class="container">
<div class="content">
  <div class="page-header">
    <h1>Home</h1>
  </div>
  <div class="row">
    <div class="span6">
      <div class="alert alert-info">Welcome to <b>LaravelContacts</b>, you can manage your <b>contacts</b> now!</div>
    <? if (Contact::where('uid', '=', Session::get('uid'))->count() > 0): ?>
      <div class="well well-small">
        <b>Contacts:</b> <span class="badge badge-info"><?=Contact::where('uid', '=', Session::get('uid'))->count(); ?></span>
      </div>
      <div class="well well-small">
        <b>Last updated:</b> <?=Contact::where('uid', '=', Session::get('uid'))->order_by('updated_at', 'desc')->first()->name; ?>
      </div>
      <div class="well well-small">
        <b>Last created:</b> <?=Contact::where('uid', '=', Session::get('uid'))->order_by('created_at', 'desc')->first()->name; ?>
      </div>
    <? endif; ?>
    </div>
  </div>
</div>
<?=render('includes.footer'); ?>
</div>
<?=HTML::script('js/jquery.js'); ?>
<script>
$(document).ready(function() {
  
  $('.content').fadeIn(1000);

});
</script>
</body>
</html>
