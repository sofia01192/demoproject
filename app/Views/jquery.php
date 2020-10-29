<head>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!---time picker library--->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/jquery-timepicker/jquery.timepicker.min.css') ?>">
	<script src="<?php echo base_url('/public/jquery-timepicker/jquery.timepicker.min.js') ?>"></script>

<!-- 	<script type="text/javascript">
		$(document).ready(function(){
			$(`input[name="duration-${id}"]`).timepicker({
				
				timeFormat :'h:i:s',
				step : 5,
			});
		});
	</script> -->


<style type="text/css">
	*{
		margin: 0;
		padding:0;
	}
	.cb {

margin-top: 7px;
	}
	.tb {
		float: left;
	}
#table li {
	list-style: none;
margin-left: 0;
    padding: 4px;

}
#table {
	border: 1px solid #ccc;
    min-width: 360px;
    position: absolute;
}
#select {
	    width: 360px;
    border-radius: 2px;
    display: block;
    padding: 4px;
    text-decoration: none;
    color: #000;
    border: 1px solid #ccc;
    text-align: center;

}

.label {
	display: none;
}

.label {
	font-size: 12;

}


</style>
</head>
<body>


<?php  echo assetUrl();?>

<?php echo form_open('multi', ['class' => 'contact-form', 'method' => 'post'])?>
<div class="container">
<a href="#" id="select">
	<span>Select Services  <i class="fa fa-caret-down" aria-hidden="true"></i></span>
</a>
<ul id='table' style="display: none;">
	<?php foreach ($services as $key) : ?>
	<li>
		<div class="td" >
			<input class="cb" name="checkbox[]" type="checkbox" value="<?php echo $key->id ?>" > <?= $key->title ?></input>
			<!---price-->
			<span id="<?= 'pricelbl-'.$key->id ?>" name="<?= 'pricelbl-'.$key->id ?>" class = "label" >
				Price 
			</span>
			<input type="text" id="<?= 'price-'.$key->id ?>" name="<?= 'price-'.$key->id ?>" style="display: none; "></input>
			<!---duration-->
			<span id="<?= 'durationlbl-'.$key->id ?>" name="<?= 'durationlbl-'.$key->id ?>" class = "label" >
				Duration 
			</span> 
			<input type="text" id="<?= 'duration-'.$key->id ?>" name="<?= 'duration-'.$key->id ?>" style="display: none; "></input>
		</div>
	</li>
	<?php
	endforeach;
	?>

</ul>

</div>
<div>
<button class="site-btn">Submit</button>
</div>
</body>

 <script type="text/javascript">
	$(document).ready(function(){
			$('#select').click(function() {
				$('#table').toggle();
			})

			$('body').on('change', 'input[type="checkbox"]', function(cb) {
				//console.log('changed' + $(this).val());
				let id = $(this).val().substring($(this).val().indexOf('-') + 1);
				console.log(id);
				console.log(cb.checked);

				if ($(this).prop("checked") == true) {
					$(`span[name="pricelbl-${id}"]`).show();
					$(`span[name="durationlbl-${id}"]`).show();
					$(`input[name="price-${id}"]`).show();
					$(`input[name="duration-${id}"]`).show();
					$(`input[name="duration-${id}"]`).timepicker({

						timeFormat :'H:i:s',
						step : 5,
					});

				}
				else {
					$(`span[name="durationlbl-${id}"]`).hide();
					$(`span[name="pricelbl-${id}"]`).hide();
					$(`input[name="price-${id}"]`).hide();
					$(`input[name="duration-${id}"]`).hide();
				}
				
			});

	

	}); //document.ready


	
</script>
 