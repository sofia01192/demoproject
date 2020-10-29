<?php echo $this->extend('admin-layout') ?>

<?php echo $this->section('content') ?>
<?php 
  $session = \Config\Services::session();
?>
<h2>
  &nbsp;Add Record for <i><?php echo ucwords(str_replace('_', ' ', $table));?></i>
</h2>
<form method="post">
  <table width="80%">
      <?php foreach($schema as $s){ 
        if(!in_array($s['name'], ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_at', 'status'])){
          $title = ucwords(str_replace('_', ' ', str_replace('_id', ' ', $s['name'])));
          $attributes['class'] = 'form-control';
          $attributes['placeholder'] = 'Enter '.$title;

          $required = '';
          if($s['null'] === false){
            $required = 'yes';
          }
          if($required == 'yes'){
            $attributes['required'] = 'required';
          }
          ?>
          <tr class="form-group">
            <td align="right"><label><?php echo $title;?></label> : </td>
            <td>
              <?php 
                switch($s['type']){ 
                  case 'int':
                    if(strpos($s['name'], '_id') > -1){
                      $field = $s['name'];
                      $foriegnTable = str_replace('_id', '', $field);
                      $lastChar     = substr($foriegnTable, -1);
                      
                      if($lastChar == 'y'){
                        $foriegnTable = str_replace(substr($foriegnTable, strlen($foriegnTable)-1, 1), 'ies', $foriegnTable);
                      }elseif($lastChar != 's'){
                        $foriegnTable .= 's';
                      }else{
                          $foriegnTable .= 'es';
                      }
                      // debug($foriegnTable, $s['name'], $attributes);
                      echo getCombo($foriegnTable, '', $s['name'], $attributes);
                    }else{
                      echo form_input($s['name'], '', $attributes);
                    }
                    
                    break;
                  case 'text':
                    echo form_textarea($s['name'], '', $attributes);
                    break;
                  default:
                    echo form_input($s['name'], '', $attributes);
                    break;
                }
              ?>
            </td>
          </tr>
        <?php unset($attributes);
              } //if condition?>
      <?php } //foreach ?>
      <tr class="form-actions">
        <td align="right"><a href="<?php echo base_url();?>/admin-showlist/<?php echo $table;?>" class="btn btn-secondary">Back</a></td>
        <td><button type="submit" class="btn btn-primary submit-btn">Save</button></td>
      </tr>
  </table>
</form>
<?php echo $this->endSection() ?>