<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
function header_app($session_data) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Task Management</title>
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
  <h1><a href="<?php echo site_url('marketing/progress');?>">Maruti Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <!--<li class=""><a title="" href="<?php echo site_url('login/logout');?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>-->
  </ul>
</div>
<!--close-top-Header-menu-->

<div id="sidebar">
    <ul>
        <li><a href="<?php echo site_url('home');?>"><span>Dashboard</span></a></li> 
        <?php
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
        ?>
        <li><a href="<?php echo site_url('login/logout');?>"><span>Logout</span></a></li>
    </ul>
</div>
    <?php
}

function footer_crud_app($userinfo) {
    ?>
    </div>
    </div>
    <div class="row-fluid">
      <div id="footer" class="span12"> 2012 &copy; Fergaco</div>
    </div>
    <script src="<?php echo base_url()."themes/admin/";?>js/excanvas.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/bootstrap.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/jquery.flot.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/jquery.flot.resize.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/jquery.peity.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/fullcalendar.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/maruti.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/maruti.dashboard.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/maruti.chat.js"></script> 
    <script type="text/javascript">
        function goPage (newURL) {
            if (newURL != "") {
                if (newURL == "-" ) {
                    resetMenu();            
                } 
                else {  
                  document.location.href = newURL;
                }
            }
        }

        function resetMenu() {
           document.gomenu.selector.selectedIndex = 2;
        }
    </script>
</body>
</html>

    <?php
}
function footer_app($userinfo) {
    ?>
    </div>
    </div>
    <div class="row-fluid">
      <div id="footer" class="span12"> 2012 &copy; Fergaco</div>
    </div>
    <script src="<?php echo base_url()."themes/admin/";?>js/excanvas.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/jquery.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/jquery.ui.custom.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/bootstrap.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/jquery.flot.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/jquery.flot.resize.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/jquery.peity.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/fullcalendar.min.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/maruti.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/maruti.dashboard.js"></script> 
    <script src="<?php echo base_url()."themes/admin/";?>js/maruti.chat.js"></script> 
    <script type="text/javascript">
        function goPage (newURL) {
            if (newURL != "") {
                if (newURL == "-" ) {
                    resetMenu();            
                } 
                else {  
                  document.location.href = newURL;
                }
            }
        }

        function resetMenu() {
           document.gomenu.selector.selectedIndex = 2;
        }
    </script>
</body>
</html>

    <?php
}

function setup_page_admin($uri_segment=4){
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li class="next">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li class="previous">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><b>';
    $config['cur_tag_close'] = '</b></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['uri_segment'] = $uri_segment;
    return $config;
}

function array_to_obj($array, &$obj){
    foreach ($array as $key => $value){
        if (is_array($value)){
            $obj->$key = new stdClass();
            array_to_obj($value, $obj->$key);
        } else {
            $obj->$key = $value;
        }
    }
    return $obj;
}

function pdf_create($html, $filename='') 
{
    require_once("dompdf/dompdf_config.inc.php");
//    echo $html;
//    die();

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);

    $dompdf->render();
    $dompdf->stream($filename.".pdf", array("Attachment" => 0));
}
?>