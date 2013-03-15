<?=render('includes.header'); ?>
<?=render('includes.navbar', array('active' => 'no')); ?>
<div class="container">
<div class="content" style="display: none">
  <div class="page-header">
    <h1>Change Your Password</h1>
  </div>
  <div class="row">
    <div class="span5 offset3">
      <form id="formPassword" class="well" action="<?=Url::to('user/password'); ?>" method="post" accept-charset="utf-8">
        <input type="text" name="curpwd" class="input-block-level" placeholder="Current Password" required maxlength="30" autofocus />
        <input type="text" name="newpwd" class="input-block-level" placeholder="New Password" required maxlength="30" />
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
          form.children('input').blur();
        } else {
          $('#errorMessage').html(json.message);
          $('#error').show();
          form.children('input[name="curpwd"]').select();
        }
        
        form.children('button').prop('disabled', false);
    });
    
    return false;
  });

  $('.content').fadeIn(1000);
});
</script>
</body>
</html>
