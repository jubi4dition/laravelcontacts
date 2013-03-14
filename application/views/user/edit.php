<?=render('includes.header'); ?>
<?=render('includes.navbar', array('active' => 'edit')); ?>
<div class="container">
<div class="content" style="display:none">
  <div class="page-header">
    <h1>Edit a Contact</h1>
  </div>
  <div class="row">
    <div class="span5 offset3">
      <form id="formEdit" class="well" action="<?=Url::to('user/edit_contact'); ?>" method="post" accept-charset="utf-8">
        <select id="formSelect" name="name" class="input-block-level">
        <? foreach ($contacts as $contact): ?>
          <option value="<?=$contact->name; ?>">
            <?=$contact->name; ?>
          </option>
        <? endforeach; ?>
        </select>
        <input type="email" name="email" class="input-block-level" placeholder="Email" required maxlength="40" value="<?=$contacts[0]->email; ?>" />
        <input type="text" name="phone" class="input-block-level" placeholder="Phone" required maxlength="15" value="<?=$contacts[0]->phone; ?>" />
        <button type="submit" class="btn btn-warning btn-large">
        <i class="icon-pencil icon-white"></i> Edit Contact</button>
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
<?=HTML::script('js/jquery.js'); ?>
<script>
$(document).ready(function() {
  
  $('#formEdit').submit(function(){

    var form = $(this);
    form.children('button').prop('disabled', true);
    $('#success').hide();
    $('#error').hide();

    var faction = "<?=Url::to('user/edit_contact'); ?>";
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

    var faction = "<?=Url::to('user/contactdata'); ?>";
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

  //$('#nav-edit').addClass('active');

  $('.content').fadeIn(1000);
});
</script>
<?=render('includes.footer'); ?>
