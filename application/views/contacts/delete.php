<?=render('includes.header'); ?>
<?=render('includes.navbar', array('active' => 'delete')); ?>
<div class="container">
<div class="content" style="display:none">
  <div class="page-header">
    <h1>Delete a Contact</h1>
  </div>
  <div class="row">
    <div class="span5 offset3">
      <form id="formDelete" class="well" action="<?=Url::to('user/contacts/delete'); ?>" method="post" accept-charset="utf-8">
        <select id="formSelect" name="name" class="input-block-level">
        <? foreach ($contacts as $contact): ?>
          <option value="<?=$contact->name; ?>">
            <?=$contact->name; ?>
          </option>
        <? endforeach; ?>
        </select>
        <button type="submit" class="btn btn-danger btn-large">
        <i class="icon-trash icon-white"></i> Delete Contact</button>
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
  
  $('#formDelete').submit(function() {

    var form = $(this);
    form.children('button').prop('disabled', true);
    $('#success').hide();
    $('#error').hide();

    var faction = "<?=Url::to('user/contacts/delete'); ?>";
    var fdata = form.serialize();

    $.post(faction, fdata, function(json) {
        
        if (json.success) {
            $('#successMessage').html(json.message);
            $('#success').show();
            //$('#formSelect option[value="'+ json.name + '"]').remove();
            $('#formSelect option:selected').remove();
        } else {
            $('#errorMessage').html(json.message);
            $('#error').show();
        }

        form.children('button').prop('disabled', false);
    });
  
    return false;
  });

  //$('#nav-delete').addClass('active');

  $('.content').fadeIn(1000);
});
</script>
<?=render('includes.footer'); ?>
