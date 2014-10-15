<?php
    header_app($userinfo);
?>
<?php  
#session_start();
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<!--<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>-->
        
<div id="content">
  <div id="content-header">
    <div id="breadcrumb" style="text-transform: capitalize;"> 
	<a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <?php
            $url_arr = explode("/",uri_string());
            foreach ($url_arr as $key=>$value) {
                if((count($url_arr) - 1) == $key){
                    echo '<a href="#" class="tip-bottom">'.$value.'</a>';
                } else {
                    echo '<a href="#" class="current">'.$value.'</a>';
                }
            }
        ?>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-content">
              <form method="POST" action="<?php echo site_url('marketing/progress');?>">
                  <label class="control-label">User : </label>
                  <select name="user">
                      <option value="0"></option>
                      <?php
                        foreach ($users as $value) {
                            echo '<option value="'.$value['id'].'" '.(($sel_user == $value['id']) ? "selected":"").'>'.$value['name'].'</option>';
                        }
                      ?>
                  </select>
                  <input name="cmdAction" id="viewChart" type="submit" class="btn btn-primary" value="View Data" style="width: 150px;"/>
              </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-content nopadding">
            <?php echo $output; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
    footer_crud_app($userinfo);
?>