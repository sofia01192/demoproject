<?php echo $this->extend('admin-layout') ?>

<?php echo $this->section('content') ?>
<?php 
  $session = \Config\Services::session();
?>
<h2>
  &nbsp;List of <i><?php echo ucwords(str_replace('_', ' ', $table));?></i>
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
        <th width="100">
          Action          
          <a href="<?php echo base_url('admin-add/'.strtolower($table));?>" style="float: right;">
            <img src="<?php echo base_url();?>/public/admin/img/add.png">
          </a>
          <div class="clearfix"></div>
        </th>
        <th>Id</th>
        <?php $fields = array();
            foreach($schema as $s){ ?>
          <?php if($s['null'] != 'YES'){ ?>
            <?php if($s['name'] == 'title'){ ?>
              <th>
                <div class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <?php echo strtoupper(str_replace('_', ' ', $s['name']));?> <img width="20" src="<?php echo base_url();?>/admin/img/down-arrow.png" alt=""> </a>
                  <ul class="dropdown-menu">
                      <form class="table-search" role="search" method="get">
                          <input type="hidden" name="action" value="search">
                          <div class="input-group add-on">
                              <input type="text" class="form-control" placeholder="Search..." name="title" id="title">
                              <div class="input-group-btn">
                                  <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                              </div>
                          </div>
                      </form>
                  </ul>
                </div>
              </th> 
            <?php }else if($s['name'] != 'id' && $s['name'] != 'status'){ ?>
              <th><?php echo strtoupper(str_replace('_', ' ', str_replace('id', '', $s['name'])));?></th>
            <?php } ?>
          <?php } ?>
        <?php } ?>
        
      </tr>
    </thead>
    <tbody>
      <?php foreach($results as $r){ ?>
        <tr>
          <td>
            <a href="<?php echo base_url('/admin-update/'.strtolower($table).'/'.$r->id);?>"><img src="<?php echo base_url();?>/public/admin/img/edit.png"></a>
            <a class="delete" href="<?php echo base_url('/admin-delete/'.strtolower($table).'/'.$r->id);?>"><img src="<?php echo base_url();?>/public/admin/img/delete.png"></a>
            <img src="<?php echo base_url();?>/public/admin/img/<?php echo ($r->status == '1')?'status.png':'in-status.png';?>">
            <?php if(isset($r->profile_url) && $r->profile_url != ''){ ?>
            <a href="<?php echo $r->profile_url;?>" target="_blank"><img src="<?php echo base_url();?>/admin/img/linkedin.png"></a>
            <?php } ?>
            <?php if(strtolower($table) == 'users'){ ?>
              <a title="Update Roles" href="<?php echo base_url('admin-updateRoles/'.$r->id)?>"><img src="<?php echo base_url();?>/public/admin/img/options.png" width="16"></a>
              <a title="Reset Password" href="<?php echo base_url('admin-setPassword/'.$r->id)?>"><img src="<?php echo base_url();?>/public/admin/img/permissions.png" width="16"></a>
            <?php } ?>
            <?php if(strtolower($table) == 'userroles'){ ?>
              <a title="List of Users" href="<?php echo base_url('admin-listusers/'.$r->id)?>"><img src="<?php echo base_url();?>/public/admin/img/list.png" width="16"></a>
            <?php } ?>
            <?php if(strtolower($table) == 'campaigns'){ ?>
              <a title="List of Users" href="<?php echo base_url('admin-campaignusers/'.$r->id)?>"><img src="<?php echo base_url();?>/public/admin/img/list.png" width="16"></a>
            <?php } ?>

          </td>
          <td><?php echo $r->id?></td>
        <?php foreach($schema as $s){ ?>
            <?php if($s['null'] != 'YES' && $s['name'] != 'id' && $s['name'] != 'status'){ ?>
            <td>
                <?php $field = $s['name'];
                     if($field == 'created_by'){ ?>
                  <?php echo @getRecordOnId('users', ['id' => $r->created_by])->title;?>
                <?php  }else if(strpos($field, '_id') > -1){ 

                      $foriegnTable = str_replace('_id', '', $field);
                      $lastChar     = substr($foriegnTable, -1);
                        if($lastChar == 'y'){
                          $foriegnTable = str_replace(substr($foriegnTable, strlen($foriegnTable)-1, 1), 'ies', $foriegnTable);
                        }elseif($lastChar != 's'){
                          $foriegnTable .= 's';
                        }else{
                            $foriegnTable .= 'es';
                        }
                        
                        if($foriegnTable == 'parents'){
                          $foriegnTable = $table;
                        }
                        
                      ?>
                  <?php echo @getRecordOnId($foriegnTable, ['id' => $r->$field])->title;?>
                <?php }else if($field == 'content' || $field == 'value'){ ?>
                  <?php echo substr(strip_tags($r->$field), 0, $settings['lettersInAdmin'])?>
                <?php }else if(strpos($field, '_at') > -1 || strpos($field, '_date') > -1){ ?>
                  <?php echo dateConverter($r->$field, 'd-M-Y h:i:s a');?>
                <?php }else if($field == 'flag'){ ?>
                  <img width="32" src="<?php echo base_url();?>/countries/<?php echo $r->flag;?>" alt="<?php echo $r->title;?>">
                <?php }else { 
                        if(strpos($field, 'is_') > -1){
                            if($r->$field == '0'){
                              echo 'No';
                            }else if($r->$field == '1'){
                              echo 'Yes';
                            }
                        }else{
                          if($field == 'priority'){
                            switch($r->$field){
                              case 0:
                                echo 'High';
                              break;
                              case 1:
                                echo 'Normal';
                              break;
                              case 2:
                                echo 'Low';
                              break;
                            }
                          }else{
                            echo $r->$field;
                          }
                        }
                      } ?>
            </td>
            <?php } ?>
        <?php } ?>
        
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <center>
    <?php echo $pager->links();?>
  </center>
  <a href="<?php echo base_url();?>/admin-dashboard" class="btn btn-secondary">Back</a>
  <button onclick="exportToExcel()" class="btn btn-primary">Export To CSV/Excel</button>
  <script src="<?php echo base_url('public/admin/vendor/jquery/jquery.min.js');?>"></script>
  <script>
    $(document).ready(function(){
      $('a.delete').click(function(){
        var res = confirm("Are you sure to delete this record ?");
        if(res === false){
          return false;
        }
      });
    });
  </script>
<?php echo $this->endSection() ?>