<?php echo $this->extend('admin-layout') ?>

<?php echo $this->section('content') ?>
<?php 
  $session = \Config\Services::session();
?>
<h2>
  &nbsp;List of <i>Users</i> as <i><?php echo $userroleRecord->title?></i>
  <a class="btn btn-secondary" href="<?php echo base_url('admin-showlist/'.strtolower($table));?>">View All</a>
</h2>
<?php if($session->getFlashdata('error') != null){ ?>
  <div class="alert alert-danger"><?php echo $session->getFlashdata('error')?></div>
<?php } ?>
<?php if($session->getFlashdata('success') != null){ ?>
  <div class="alert alert-success"><?php echo $session->getFlashdata('success')?></div>
<?php } ?>
  <table class="table " width="100%" id="headerTable">
    <thead>
      <tr>
        <th>User Name</th>
        <th>User Email</th>
        <th>Created At</th>        
      </tr>
    </thead>
    <tbody>
      <?php foreach($results as $r){ 
        $userData = getRecordOnId('users', ['id' => $r->user_id]);
        ?>
        <tr>
          <td><?php echo $userData->title?></td>
          <td><?php echo $userData->email?></td>
          <td><?php echo dateConverter($userData->created_at);?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <center>
    <?php echo $pager->links();?>
  </center>
  &nbsp;
  <a href="<?php echo base_url();?>/admin-showlist/userroles" class="btn btn-secondary">Back</a>
  <button onclick="exportToExcel()" class="btn btn-primary">Export To CSV/Excel</button>

<?php echo $this->endSection() ?>