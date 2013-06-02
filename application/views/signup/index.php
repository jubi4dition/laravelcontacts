<?=render('includes.header'); ?>
<?=render('includes.nli_navbar'); ?>
<div class="container">
<div class="content">
  <div class="page-header">
    <h1>Signup</h1>
  </div>
  <div class="row">
    <div class="span6 offset3">
      <form id="formSignup" class="well" accept-charset="utf-8">
        <input type="text" class="input-block-level" name="email" placeholder="Your Email" required maxlength="80" autofocus />
        <input type="text" class="input-block-level" name="email-repeat" placeholder="Repeat Email" required maxlength="80" />
        <input type="password" class="input-block-level" name="pwd" placeholder="Your Password" required maxlength="30" />
        <input type="password" class="input-block-level" name="pwd-repeat" placeholder="Repeat Password" required maxlength="30" />
        <button type="submit" class="btn btn-primary btn-block">
        <i class="icon-bell icon-white"></i> Sign Up</button>
      </form>
    </div>
  </div>
  <div id="success" class="row" style="display: none">
    <div class="span6 offset3">
      <div id="successMessage" class="alert alert-success">
        <p><b>Success!</b> The <b>Registration</b> was successful!</p>
        <a href="<?=Url::to('login'); ?>" class="btn btn-success"><i class="icon-arrow-right icon-white"></i>Login</a>
      </div>
    </div>
  </div>
  <div id="error" class="row" style="display: none">
    <div class="span6 offset3">
      <div id="errorMessage" class="alert alert-error"></div>
    </div>
  </div>
</div>
<?=render('includes.footer'); ?>
</div>
<?=HTML::script('js/jquery.js'); ?>
<script>
$(document).ready(function() {
  
  $('#formSignup').submit(function() {
    
    var form = $(this);
    form.children('button').prop('disabled', true);

    $('#success').hide();
    $('#error').hide();
    
    var faction = "<?=Url::to('signup/check'); ?>";
    var fdata = form.serialize();

    $.post(faction, fdata, function(json) {
      
        if(json.success) {
            $('#success').show();
            //form.children('input').val('');
            form.children('input').blur()
        } else {
            $('#errorMessage').html(json.message);
            $('#error').show();
            form.children('input[name="email"]').select();
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
