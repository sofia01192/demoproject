<?php echo $this->extend('admin-layout') ?>

<?php echo $this->section('content') ?>
<?php 
  $session = \Config\Services::session();
?>
<h2>
  &nbsp;Update Userroles for <i><?php echo $userRecord->title;?></i>
</h2>
<form method="post">
  <ul class="no-list-style">
    <?php foreach($listOfRoles as $lor){ ?>
    <li><input type="checkbox" <?php echo ($selectedRoles && in_array($lor->id, $selectedRoles))?'checked="checked"':'';?> name="roles[]" value="<?php echo $lor->id;?>"><?php echo $lor->title;?></li>
  <?php } ?>
  </ul>
  <div class="form-group">
    &nbsp;<a href="<?php echo base_url();?>/admin-showlist/users" class="btn btn-secondary">Back</a>
    &nbsp;<button type="submit" class="btn btn-primary submit-btn">Save</button>
  </div>
</form>
<?php echo $this->endSection() ?>