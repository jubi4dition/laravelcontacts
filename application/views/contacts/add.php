<?=render('includes.header'); ?>
<?=render('includes.navbar'); ?>
<div class="container">
<div class="content">
  <div class="page-header">
    <h1>Add A Contact</h1>
  </div>
  <div class="row">
    <div class="span5 offset3">
      <form id="formAdd" action="<?=URL::to('user/contacts/add'); ?>" method="post" class="well" accept-charset="utf-8">
          <input type="text" name="name" class="input-block-level" value="Name" placeholder="Name" required maxlength="60" autofocus />
          <input type="email" name="email" class="input-block-level" placeholder="Email" required maxlength="60" />
          <input type="text" name="phone" class="input-block-level" placeholder="Phone" required maxlength="30" />
          <button type="submit" class="btn btn-success btn-large">
          <i class="icon-plus icon-white"></i> Add Contact</button>
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

  $('#formAdd').submit(function() {

    var form = $(this);
    form.children('button').prop('disabled', true);
    $('#success').hide();
    $('#error').hide();

    var faction = "<?=URL::to('user/contacts/add'); ?>";
    var fdata = form.serialize();

    $.post(faction, fdata, function(json) {
        
        if (json.success) {
            $('#successMessage').html(json.message);
            $('#success').show();
        } else {
            $('#errorMessage').html(json.message);
            $('#error').show();
        }

        form.children('button').prop('disabled', false);
        form.children('input[name="name"]').select();
    });

    return false;
  });

  $('#nav-add').addClass('active');

   $('.content').fadeIn(1000);
});
</script>
</body>
</html>
