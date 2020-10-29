<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl()?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>My Parlours List</h2>
		</div>
	</section>
	<!-- Page info section end -->


	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
	<?php 	$session = \Config\Services::session();	?>
	<?php if($session->getFlashdata('error') != null){ ?>
            <div class="alert alert-danger"><?php echo $session->getFlashdata('error')?></div>
    <?php } ?>
    <?php if($session->getFlashdata('success') != null){ ?>
          	<div class="alert alert-success"><?php echo $session->getFlashdata('success')?></div>
    <?php } ?>

			<center>
				<div class="table">
<table>
	<thead>
		<tr>
			<th>S.no</th>
			<th>Title</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Id</th>
			<th>Action</th>
			
			
		</tr>
	</thead>

	<tbody>
		<?php if(count($allParlours)) : 

				$count = 1;
 foreach ($allParlours as $art) : ?>

<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $art['title']; ?></td>
			<td><?php echo $art['phone']; ?></td>
			<td><?php echo $art['email']; ?></td>
			<td><?php echo $art['id']; ?></td>
			<td>

				<?=  anchor("branches/{$art['id']}",'View Branches',['class'=>'btn btn-primary btn-sm']);  ?>
				<?=  anchor("add-branch/{$art['id']}",'Add Branch',['class'=>'btn btn-primary btn-sm']);  ?>
			</td>
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
</div>

			</center>
        </div>
	</section>
<?php echo $this->endSection() ?>