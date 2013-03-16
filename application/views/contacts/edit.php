<?=render('includes.header'); ?>
<?=render('includes.navbar'); ?>
<div class="container">
<div class="content">
  <div class="page-header">
    <h1>Edit A Contact</h1>
  </div>
  <div class="row">
    <div class="span5 offset3">
    <? if (count($contacts) != 0): ?>
      <form id="formEdit" class="well" action="<?=Url::to('user/contacts/edit'); ?>" method="post" accept-charset="utf-8">
        <select id="formSelect" name="name" class="input-block-level">
        <? foreach ($contacts as $contact): ?>
          <option value="<?=$contact->name; ?>">
            <?=$contact->name; ?>
          </option>
        <? endforeach; ?>
        </select>
        <input type="email" name="email" class="input-block-level" placeholder="Email" required maxlength="60" value="<?=$contacts[0]->email; ?>" />
        <input type="text" name="phone" class="input-block-level" placeholder="Phone" required maxlength="30" value="<?=$contacts[0]->phone; ?>" />
        <button type="submit" class="btn btn-warning btn-large">
        <i class="icon-pencil icon-white"></i> Edit Contact</button>
      </form>
    <? else: ?>
        <div class="alert alert-error">
        <strong>There are no contacts for editing!</strong>
        </div>
    <? endif; ?>
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
  
  $('#formEdit').submit(function(){

    var form = $(this);
    form.children('button').prop('disabled', true);
    $('#success').hide();
    $('#error').hide();

    var faction = "<?=Url::to('user/contacts/edit'); ?>";
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
    });
  
    return false;
  });

  $('#formSelect').change(function() {

    $('#success').hide();
    $('#error').hide();

    var faction = "<?=Url::to('user/contacts/data'); ?>";
    var fdata = $('#formSelect').serialize();

    $.post(faction, fdata, function(json) {
        
        if(json.success) {
            $('#formEdit input[name="email"]').val(json.email);
            $('#formEdit input[name="phone"]').val(json.phone);
        } else {
            $('#errorMessage').html(json.message);
            $('#error').show();
        }
    });
  });

  $('#nav-edit').addClass('active');

  $('.content').fadeIn(1000);
});
</script>
</body>
</html>
