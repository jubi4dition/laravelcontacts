<?=render('includes.header'); ?>
<?=render('includes.navbar', array('active' => 'add')); ?>
<div class="container">
	<div class="content" style="display:none">
		<div class="page-header">
			<h1>Add A Contact</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formAdd" class="well" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<input type="text" name="name" class="input-large" placeholder="Username" required maxlength="40" autofocus />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i></span>
						<input type="email" name="email" class="input-large" placeholder="Email" required maxlength="40" />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-phone"></i></span>
						<input type="text" name="phone" class="input-large" placeholder="Phone" required maxlength="15" />
					</div>
					<button type="submit" class="btn btn-success btn-large" data-loading-text="Sending...">
					<i class="icon-file icon-white"></i> Add Contact</button>
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
	<script>
	$(document).ready(function() {
		
		$("#formAdd").submit(function(){
			
			$("#formAdd button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=URL::to('user/add_contact'); ?>";
			var fdata = $("#formAdd").serialize();
			
			$.post(faction, fdata, function(json) {
				
				if (json.success) {
					$("#successMessage").html(json.message);
					$("#success").show();
				} else {
					$("#errorMessage").html(json.message);
					$("#error").show();
				}
				
				$("#formAdd button").button('reset');
				$("#formAdd input[name='name']").select();
			});
				
			return false;
		});

		$(".content").fadeIn(1000);
	});
	</script>
<?=render('includes.footer'); ?>
