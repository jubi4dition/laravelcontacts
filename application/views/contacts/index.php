<?=render('includes.header'); ?>
<?=render('includes.navbar'); ?>
<div class="container">
<div class="content">
  <div class="page-header">
    <h1>Your Contacts</h1>
  </div>
  <div class="row">
    <div class="span9 offset1">
      <table class="table table-striped table-bordered tablesorter" id="tcontacts">
        <thead>
          <tr>
            <th><i class="icon-tags"></i> ID</th>
            <th><i class="icon-user"></i> Name</th>
            <th><i class="icon-envelope"></i> Email</th>
            <th><i class="icon-phone"></i> Phone</th>
          </tr>
        </thead>
        <tbody>
        <? foreach ($contacts as $contact): ?>
          <tr>
            <td><?=$contact->id; ?></td>
            <td><?=$contact->name; ?></td>
            <td><?=$contact->email; ?></td>
            <td><?=$contact->phone; ?></td>
          </tr>
        <? endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?=render('includes/footer'); ?>
</div>
<?=HTML::script('js/jquery.js'); ?>
<?=HTML::script('js/jquery.tablesorter.js'); ?>
<script>
$(document).ready(function(){

  $('#tcontacts').tablesorter();

  $('#nav-contacts').addClass('active');

  $('.content').fadeIn(1000);
});
</script>
</body>
</html>
