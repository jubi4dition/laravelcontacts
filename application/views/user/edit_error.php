<?=render('includes.header'); ?>
<?=render('includes.navbar', array('active' => 'edit')); ?>
<div class="container">
	<div class="content" style="display:none">
		<div class="page-header">
			<h1>Edit A Contact</h1>
		</div>
		<div id="error" class="row">
			<div class="span4">
				<div id="errorMessage" class="alert alert-error">
				<strong>There are no contacts for editing!</strong>
				</div>
			</div>
		</div>
	</div>
	<?=HTML::script('js/jquery.js'); ?>
	<script>
	$(document).ready(function() {		
		$(".content").fadeIn(1000);
	});
	</script>
<?=render('includes.footer'); ?>
