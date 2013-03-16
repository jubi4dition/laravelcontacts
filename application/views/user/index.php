<?=render('includes.header'); ?>
<?=render('includes.navbar'); ?>
<div class="container">
<div class="content">
  <div class="page-header">
    <h1>Welcome</h1>
  </div>
  <div class="row">
    <div class="span5">
      <div class="alert alert-info">
      <h4>Hello, you can manage your contacts now!</h4>
      </div>
    </div>
  </div>
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
