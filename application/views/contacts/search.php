<?=render('includes.header'); ?>
<?=render('includes.navbar'); ?>
<div class="container">
<div class="content">
  <div class="page-header">
    <h1>Search A Contact</h1>
  </div>
  <div class="row">
    <div class="span6 offset3">
    <? if (Contact::where('uid', '=', Session::get('uid'))->count() > 0): ?>
      <form id="formSearch" class="well" action="<?=Url::to('user/contacts/search'); ?>" method="post" accept-charset="utf-8">
        <input type="text" name="name" class="input-block-level" placeholder="Name" required maxlength="10">
        <button type="submit" class="btn btn-warning btn-large">
        <i class="icon-search icon-white"></i> Search Contact</button>
      </form>
    <? else: ?>
      <div class="alert alert-info"><b>Info!</b> There are no <b>contacts</b>!</div>
    <? endif; ?>
    </div>
  </div>
  <div class="row">
    <div class="span10 offset1">
      <table id="tcontacts" class="table table-striped table-bordered tablesorter">
        <thead>
          <tr>
            <th><i class="icon-tags"></i> ID</th>
            <th><i class="icon-user"></i> Name</th>
            <th><i class="icon-envelope"></i> Email</th>
            <th><i class="icon-headphones"></i> Phone</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?=render('includes.footer'); ?>
</div>
<?=HTML::script('js/jquery.js'); ?>
<script>
$(document).ready(function() {
  
  $('#formSearch').submit(function() {

    var form = $(this);
    form.children('button').prop('disabled', true);
    
    $('#tcontacts > tbody').empty();

    var faction = "<?=Url::to('user/contacts/search'); ?>";
    var fdata = form.serialize();

    $.post(faction, fdata, function(json) {
        
        var contacts = jQuery.parseJSON(json);

        for (var i = 0; i < contacts.length; i++) {
            $('#tcontacts > tbody').append('<tr>' +
              '<td>' + contacts[i].id + '</td>' +
              '<td>' + contacts[i].name + '</td>' +
              '<td>' + contacts[i].email + '</td>' +
              '<td>' + contacts[i].phone + '</td>' +
              '</tr>');
        }

        form.children('button').prop('disabled', false);
    });
  
    return false;
  });

  $('#nav-search').addClass('active');

  $('.content').fadeIn(1000);
});
</script>
</body>
</html>
