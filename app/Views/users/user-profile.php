<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl()?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>My Profile</h2>
		</div>
	</section>
	<!-- Page info section end -->

<?php 
  $session = \Config\Services::session();
?>
		 <?php if($session->getFlashdata('error') != null){ ?>
                    <div class="alert alert-danger"><?php echo $session->getFlashdata('error')?></div>
                  <?php } ?>
                  <?php if($session->getFlashdata('success') != null){ ?>
                    <div class="alert alert-success"><?php echo $session->getFlashdata('success')?></div>
                  <?php } ?>
	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<center>
				<div class="table">
<table>
	

	<tbody>
		<?php if(count($user)) : 
				$count = 1;
 foreach ($user as $us) : ?>
<tr>
			<td><B>Name</B></td>
			<td><?php echo $us['title']; ?></td>
		</tr>
		<tr>
			<td><B>Email</B></td>
			<td><?php echo $us['email']; ?></td>
		</tr>
		<tr>
			<td><B>Phone</B></td>
			<td><?php echo $us['telephone']; ?></td>
		</tr>
		<tr>
			<td><B>Address</B></td>
			<td><?php echo $us['address']; ?></td>
		</tr>
		<tr>
			<td><B>Identity Number</B></td>
			<td><?php echo $us['identity_no']; ?></td>
		</tr>

	<?php	endforeach; ?>

	<?php 
			else : ?>
				<tr>
					<td colspan="3">No data Available</td>
				</tr>

		<?php	endif; ?>
	

	</tbody> 
</table>
<?=  anchor("edit-userInfo/{$us['id']}",'Edit Info',['class'=>'btn btn-primary btn-sm']);  ?>
<?=  anchor("password-change/{$us['id']}",'Change Password',['class'=>'btn btn-primary btn-sm']);  ?>
</div>

			</center>
        </div>
	</section>
<?php echo $this->endSection() ?>