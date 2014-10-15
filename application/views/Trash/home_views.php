<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php  
session_start();
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
<title>Pemilihan Gubernur Sumatera Selatan</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/fullcalendar.css" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/colorpicker.css" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/datepicker.css" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/maruti-style.css" />
<link rel="stylesheet" href="<?php echo base_url()."themes/admin/";?>css/maruti-media.css" class="skin-color" />
</head>
<body>
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Maruti Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
    <li class=""><a href="<?php echo site_url('login/logout');?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

<div id="sidebar">
    <ul>
        <li><a href="<?php echo base_url()."index.php/home/tokoh" ?>"><span>Dashboard</span></a></li> 
        <li><a href="<?php echo base_url()."index.php/home/tokoh" ?>"><span>Kita & Kompetitor</span></a></li> 
        <li><a href="<?php echo base_url()."#" ?>"><span>Data Strategis</span></a></li> 
        <li><a href="<?php echo base_url()."#" ?>"><span>Administrator</span></a></li> 
        <?php
		$html = '';
		
		/***
            $html = '';
            foreach ($session_data['menu'] as $key=>$value_root) {
                foreach ($value_root as $value) {
                    if(trim($value['param'])){
                        $html.='<li ><a href="'.site_url($value['param']).'"><span>'.$value['menu_name'].'</span></a>';
                    } else {
                        $html.='<li class="submenu"><a href="'.site_url($value['param']).'"><span>'.$value['menu_name'].'</span></a>';
                    }
                    if(isset ($value['level_1'])){
                        $html.='<ul>';
                        foreach ($value['level_1'] as $level_1) {
                            $html.='<li><a href="'.site_url($level_1['param']).'"><span>'.$level_1['menu_name'].'</span></a>';
                            if(isset($level_1['level_2'])){
                                foreach ($level_1['level_2'] as $level_2) {
                                    $html.='<ul>';
                                    foreach ($level_2 as $det_level_2){
                                        $html.='<li><a href="'.site_url($det_level_2['param']).'"><span>'.$det_level_2['menu_name'].'</span></a>';
                                    }
                                    $html.='</ul>';
                                }
                            }
                            $html.='</li>';
                        }
                        $html.='</ul>';
                    }
                    $html.='</li>';
                }
            }
            echo $html;
		***/
		
        ?>
			
		

        <li><a href="<?php echo site_url('login/logout');?>"><span>Logout</span></a></li>
    </ul>
</div></div>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
	<a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
	<a href="#" class="tip-bottom">Adminstrator</a> 
	<!--<a href="#" class="current">User Management</a> </div>-->
	<a href="#" class="current">Form</a> </div>
    <h1>Common Form Elements</h1>
  </div>
	<div style='height:20px;'></div>  
    <div style="width:100%; margin-left:10px;">
	
	<a href='<?php echo site_url('home/tokoh')?>'><span>tokoh</span> ||
	<a href='<?php echo site_url('home/kabupaten')?>'><span>Kabupaten</span></a> ||
	<a href='<?php echo site_url('home/hasil_pilgub')?>'><span>Hasil Pilgub</span> ||
	<a href='<?php echo site_url('home/daftar_pemilih')?>'><span>Daftar Pemilih</span></a> ||
	<a href='<?php echo site_url('home/hasil_survey')?>'><span>Hasil Survey</span></a>
	</div>	
		<?php echo $output; ?>
    </div>



    <div class="row-fluid">
      <div id="footer" class="span12"> 2012 &copy; Yunarto Wijaya</div>
    </div>

</div>	
</body>
</html>
