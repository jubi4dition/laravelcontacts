<?=render('includes.header'); ?>
<?=render('includes.navbar', array('active' => 'delete')); ?>
<div class="container">
	<div class="content" style="display:none">
		<div class="page-header">
			<h1>Delete A Contact</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formDelete" class="well" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<select id="formSelect" name="name" class="input-large">
						<? foreach ($contacts as $contact): ?>
							<option value="<?=$contact->name; ?>">
								<?=$contact->name; ?>
							</option>
						<? endforeach; ?>
						</select>
					</div>
					<button type="submit" class="btn btn-danger btn-large" data-loading-text="Sending...">
					<i class="icon-trash icon-white"></i> Delete Contact</button>
				</form>
			</div>
		</div>
		<div id="success" class="row" style="display: none">
			<div class="span4">
				<div id="successMessage" class="alert alert-success"></div>
			</div>
		</div>
		<div id="error" class="row" style="display: none">
			<div class="span4">
				<div id="errorMessage" class="alert alert-error"></div>
			</div>
		</div>
	</div>
	<?=HTML::script('js/jquery.js'); ?>
	<?=HTML::script('js/bootstrap-button.js'); ?>
	<script type="text/javascript">
	$(document).ready(function() {
		
		$("#formDelete").submit(function(){
			
			$("#formDelete button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=Url::to('user/delete_contact'); ?>";
			var fdata = $("#formDelete").serialize();
			
			$.post(faction, fdata, function(json){

				if (json.success) {
					$("#successMessage").html(json.message);
					$("#success").show();
					$("#formSelect option[value='"+ json.name + "']").remove();
				} else {
					$("#errorMessage").html(json.message);
					$("#error").show();
				}
				
				$("#formDelete button").button('reset');
			});
				
			return false;
		});

		$(".content").fadeIn(1000);
	});
	</script>
<?=render('includes.footer'); ?>
