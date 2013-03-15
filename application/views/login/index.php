<?=render('includes.header'); ?>
<?=render('includes.nli_navbar'); ?>
<div class="container">
<div class="content" style="display:none">
  <div class="page-header">
    <h1>Login</h1>
  </div>
  <div class="row">
    <div class="span5 offset3">
      <form class="well" action="<?=Url::to('login/check'); ?>" method="post" accept-charset="utf-8">
        <input type="text" class="input-block-level" name="email" value="Email" placeholder="Email" required maxlength="60" autofocus />
        <input type="password" class="input-block-level" name="pwd" placeholder="Password" required maxlength="30" />
        <button type="submit" class="btn btn-primary btn-block">
        <i class="icon-home icon-white"></i> Login</button>
      </form>
    </div>
  </div>
  <? if (isset($error)): ?>
  <div class="row">
    <div class="span5 offset3">
      <div class="alert alert-error">
        <strong>Login</strong> failed!.
      </div>
    </div>
  </div>
  <? else: ?>
  <div class="row">
    <div class="span5 offset3">
      <div class="alert alert-info">
        <p><strong>You</strong> are not logged in!</p>
        <small>No Account? </small>
        <a href="#" class="btn btn-info"><i class="icon-arrow-right icon-white"></i> sign up now</a>
      </div>
    </div>
  </div>
  <? endif; ?>
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
