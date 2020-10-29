<!DOCTYPE html>
<html>
<head>
	<title>jquery timepicker plugin</title>
	<!---jQuery library-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!---time picker library--->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/jquery-timepicker/jquery.timepicker.min.css') ?>">
	<script src="<?php echo base_url('/public/jquery-timepicker/jquery.timepicker.min.js') ?>"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#time').timepicker({
				
				timeFormat :'h:i:s',
				step : 5,
			});
		});
	</script>

</head>
<body>
<input type="text" id="time" name="" placeholder="Duration" />

</body>
</html>