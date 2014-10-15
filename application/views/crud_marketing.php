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
	<a href="#" title="" class="tip-bottom"><i class="icon-book"></i> Data </a>
        <a href="#"><?php echo $notes;?></a>
  </div>
  <div class="container-fluid">
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