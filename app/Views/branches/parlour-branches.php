<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl()?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>Branches List</h2>
		</div>
	</section>
	<!-- Page info section end -->


	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<center>
				<div class="table">
<table>
	<thead>
		<tr>
			<th>S.no</th>
			<th>Title</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Contact Person</th>
			<th>Address</th>
			<th>Longitude</th>
			<th>Latitude</th>
			<th>Services</th>
			<th>Action</th>
			
			
		</tr>
	</thead>

	<tbody>
		<?php if(count($branches)) : 
				$count = 1;
 foreach ($branches as $art) : ?>
<tr>
			
			<td><?php echo $count++; ?></td>
			<td><?php echo $art['title']; ?></td>
			<td><?php echo $art['phone']; ?></td>
			<td><?php echo $art['email']; ?></td>
			<td><?php echo $art['contact_person']; ?></td>
			<td><?php echo $art['address']; ?></td>
			<td><?php echo $art['longitude']; ?></td>
			<td><?php echo $art['latitude']; ?></td>
			<td><?php echo $art['services']; ?></td>

			<td>
				
				<?=  anchor("branch-edit/{$art['id']}",'Edit',['class'=>'btn btn-primary btn-sm']);  ?>
				<?=  anchor("branch-delete/{$art['id']}",'Delete',['class'=>'btn btn-danger btn-sm']);  ?>
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