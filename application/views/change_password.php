<?php
    header_app($userinfo);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Change Password</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="<?php echo site_url('admin/management_admin/change_password_save/'.$userinfo['user_info']->id);?>" method="post" class="form-horizontal">
              <div class="control-group">
                <label class="control-label">Name :</label>
                <div class="controls">
                    <input type="text" class="span11" value="<?php echo $userinfo['user_info']->name;?>" readonly/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Position :</label>
                <div class="controls">
                  <input type="text" class="span11"  value="<?php echo $userinfo['user_info']->notes;?>" readonly/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email :</label>
                <div class="controls">
                  <input type="text" class="span11"  value="<?php echo $userinfo['user_info']->email;?>" readonly/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">New Password</label>
                <div class="controls">
                  <input type="text" name="password" class="span11" placeholder="Enter New Password"  />
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
    footer_app($userinfo);
?>