<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
      <section class="page-info-section set-bg" data-setbg="<?php echo assetUrl();?>img/page-top-bg/3.jpg" >
            <div class="container text-center">
                  <h2>Change Password</h2>
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

<?php 
 $user_id = $session->userData['id']; ?>

<section class="contact-section spad">
            <div class="container">
                  <?php echo form_open('Users/updatePassword', ['class' => 'contact-form', 'method' => 'post']);?>
                   <?php echo form_hidden('id', $user_id); ?> 

                  <div class="row branches">
                        <div class="col-lg-6 ">
                              <div class="row">
                                    <div class="col-md-12">
                                          <label>Current password</label>
                                          <?php echo form_password('currentpass', '', ['type' => 'password', 'required' => 'required']);?>
                                    </div>
                                    <div class="col-md-12">
                                          <label>New password</label>
                                          <?php echo form_password('newpass', '', ['type' => 'password', 'required' => 'required']);?>
                                    </div>
                                    
                                    <div class="col-md-12">
                                          <label>Confirm password</label>
                                          <?php echo form_password('confirmpass', '', ['type' => 'password', 'required' => 'required']);?>
                                    </div>
                                    
                                    <div class="col-md-12 margin-top-20px" >
          <button class="site-btn" type="submit">Update</button>
          <button class="btn btn-primary" onclick="redirect('Users/userProfile')">Cancel</button>
                                    </div>  
                              </div>      
                        </div>
                  </div>
<?php echo form_close();?>
</div>

</section>

<?php echo $this->endSection() ?>

