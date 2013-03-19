<?=render('includes.header'); ?>
<?=render('includes.navbar'); ?>
<div class="container">
<div class="content">
  <div class="page-header">
    <h1>Change Your Password</h1>
  </div>
  <div class="row">
    <div class="span5 offset3">
      <form id="formPassword" class="well" action="<?=Url::to('user/password'); ?>" method="post" accept-charset="utf-8">
        <input type="password" name="curpwd" class="input-block-level" value="Current Password" placeholder="Current Password" required maxlength="30" autofocus>
        <input type="password" name="newpwd" class="input-block-level" placeholder="New Password" required maxlength="30">
        <button type="submit" class="btn btn-danger btn-large">
        <i class="icon-refresh icon-white"></i> Change Password</button>
      </form>
    </div>
  </div>
  <div id="success" class="row" style="display: none">
    <div class="span5 offset3">
      <div id="successMessage" class="alert alert-success"></div>
    </div>
  </div>
  <div id="error" class="row" style="display: none">
    <div class="span5 offset3">
      <div id="errorMessage" class="alert alert-error"></div>
    </div>
  </div>
</div>
<?=render('includes.footer'); ?>
</div>
<?=HTML::script('js/jquery.js'); ?>
<script>
$(document).ready(function() {
  
  $('#formPassword').submit(function(){
    
    var form = $(this);
    form.children('button').prop('disabled', true);
    form.children('input').blur();

    $('#success').hide();
    $('#error').hide();
  
    var faction = "<?=Url::to('user/password'); ?>";
    var fdata = form.serialize();

    $.post(faction, fdata, function(json) {
        
        if (json.success) {
          $('#successMessage').html(json.message);
          $('#success').show();
          form.children('input[name="curpwd"]').val('');
          form.children('input[name="newpwd"]').val('');
        } else {
          $('#errorMessage').html(json.message);
          $('#error').show();
          form.children('input[name="curpwd"]').select();
        }
        
        form.children('button').prop('disabled', false);
    });
    
    return false;
  });

  $('input[type="password"]').focus(function() {
      $(this).attr('type', 'text');
  }).blur(function() {
      $(this).attr('type', 'password');
  });

  $('.content').fadeIn(1000);
});
</script>
</body>
</html>
