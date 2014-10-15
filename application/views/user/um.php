<?php header_app($userinfo);?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Adminstrator</a> <a href="#" class="current">User Management</a> </div>
    <h1>Common Form Elements</h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Personal-info</h5>
          </div>
            <div class="widget-content nopadding">
                <?php
                    $USERNAME = array(
                        'name'		  =>'username',
                        'id'		  =>'username',                            	
                        'size'		  =>'32',
                        'value'           => $user['username'],
                        'required'        => true
                    );
                    $PASSWORD = array(
                        'name'		  =>'password',
                        'id'		  =>'password',                            	
                        'size'		  =>'64',
                        'value'           => $user['password'],
                        'required'        => true
                    );
                    $REPASSWORD = array(
                        'name'		  =>'repassword',
                        'id'		  =>'repassword',                            	
                        'size'		  =>'64',
                        'value'           => $user['password'],
                        'required'        => true
                    );
                    $NAME_OF_USER = array(
                        'name'		  =>'name_of_user',
                        'id'		  =>'name_of_user',                            	
                        'size'		  =>'64',
                        'value'           => $user['name_of_user'],
                        'required'        => true
                    );
                    $POSITION = array(
                        'name'		  =>'position',
                        'id'		  =>'position',                            	
                        'size'		  =>'64',
                        'value'           => $user['position'],
                        'required'        => true
                    );
                    $EMAIL = array(
                        'name'		  =>'email',
                        'id'		  =>'email',                            	
                        'size'		  =>'100',
                        'value'           => $user['email'],
                        'required'        => true
                    );
                    $HANDPHONE = array(
                        'name'		  =>'handphone',
                        'id'		  =>'handphone',                            	
                        'size'		  =>'64',
                        'value'           => $user['handphone'],
                        'required'        => true
                    );
                    $FAX = array(
                        'name'		  =>'fax',
                        'id'		  =>'fax',                            	
                        'size'		  =>'64',
                        'value'           => $user['fax'],
                        'required'        => true
                    );
                    $OFFICE_PHONE = array(
                        'name'		  =>'office_phone',
                        'id'		  =>'office_phone',                            	
                        'size'		  =>'64',
                        'value'           => $user['office_phone'],
                        'required'        => true
                    );

                    if($user['user_status'] == 1){
                        $checked = true;
                    } else {
                        if($user['user_status'] == null){
                            $checked = true;
                        } else {
                            $checked = false;
                        }
                    }
                    $USER_STATUS = array(
                        'name'		  =>'user_status',
                        'id'		  =>'user_status', 
                        'checked'	  => $checked,
                        'value'           => '1'
                    );
                ?>
                <form action="<?php site_url('user/management/save_user/'.$user['id_user']);?>" method="POST" class="form-horizontal">
                    <?php echo validation_errors(); ?>
                    <label class="control-label">Username :</label>
                    <div class="controls"><?php echo form_input($USERNAME);?>
                    </div>
                    <label class="control-label">Password :</label>
                    <div class="controls"><?php echo form_password($PASSWORD);?>
                    </div>
                    <label class="control-label">Re-Password :</label>
                    <div class="controls"><?php echo form_password($REPASSWORD);?>
                    </div>
                    <label class="control-label">Role User :</label>
                    <div class="controls">
                        <?php 
                            $data_roles = array();
                            foreach ($roles as $value){
                                $data_roles[$value->id_role] = $value->name;
                            }
                            echo form_dropdown('id_modul_role', $data_roles);
                        ?>
                    </div>
                    <label class="control-label">Name Of User :</label>
                    <div class="controls"><?php echo form_input($NAME_OF_USER);?>
                    </div>
                    <label class="control-label">Position :</label>
                    <div class="controls"><?php echo form_input($POSITION);?>
                    </div>
                    <label class="control-label">E-mail :</label>
                    <div class="controls"><?php echo form_input($EMAIL);?>
                    </div>
                    <label class="control-label">Handphone :</label>
                    <div class="controls"><?php echo form_input($HANDPHONE);?>
                    </div>
                    <label class="control-label">Office :</label>
                    <div class="controls"><?php echo form_input($OFFICE_PHONE);?>
                    </div>
                    <label class="control-label">Fax :</label>
                    <div class="controls"><?php echo form_input($FAX);?>
                    </div>
                    <label class="control-label">Status :</label>
                    <div class="controls"><?php echo form_checkbox($USER_STATUS);?>
                    </div>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
          
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Static table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID USER</th>
                        <th>USERNAME</th>
                        <th>NAME OF USER</th>
                        <th>EMAIL</th>
                        <th>HANDPHONE</th>
                        <th>OFFICE PHONE</th>
                        <th>FAX</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($mitra_user_access)) : foreach ($mitra_user_access as $user_access) : ?>
                    <tr>
                        <td><?php echo $user_access->id_user;?></td>
                        <td><?php echo $user_access->username;?></td>
                        <td><?php echo $user_access->name_of_user;?></td>
                        <td><?php echo $user_access->email;?></td>
                        <td><?php echo $user_access->handphone;?></td>
                        <td><?php echo $user_access->office_phone;?></td>
                        <td><?php echo $user_access->fax;?></td>
                        <td><?php echo (($user_access->user_status == '1') ? "Active":"Non Active");?></td>
                        <td><?php echo anchor('user/management/user/'.$user_access->id_user,'EDIT');?></td>
                    </tr>
                    <?php endforeach; else : ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
      </div>
      </div>
    </div>
</div>
</div>
<?php
    footer_app($userinfo);
?>