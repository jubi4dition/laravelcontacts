<?=render('includes.header'); ?>
<?=render('includes.navbar', array('active' => 'no')); ?>
<div class="container">
	<div class="content" style="display: none">
		<div class="page-header">
			<h1>Change Your Password</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formPassword" class="well" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span>
						<input type="text" name="curpwd" class="input-large" placeholder="Current Password" required maxlength="20" autofocus />
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span>
						<input type="text" name="newpwd" class="input-large" placeholder="New Password" required maxlength="20" />
					</div>
					<button type="submit" class="btn btn-danger btn-large" data-loading-text="Sending...">
					<i class="icon-refresh icon-white"></i> Change Password</button>
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
		
		$("#formPassword").submit(function(){
			
			$("#formPassword button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=Url::to('user/profile_password'); ?>";
			var fdata = $("#formPassword").serialize();

			$.post(faction, fdata, function(json){

				if (json.success) {
					$("#successMessage").html(json.message);
					$("#success").show();
					$("#formPassword input[name='curpwd']").val("");
					$("#formPassword input[name='newpwd']").val("");
					$("#formPassword input").blur();
				} else {
					$("#errorMessage").html(json.message);
					$("#error").show();
					$("#formPassword input[name='curpwd']").select();
				}
				
				$("#formPassword button").button('reset');
			});
				
			return false;
		});

		$(".content").fadeIn(1000);
	});
	</script>
<?=render('includes.footer'); ?>
