<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
function header_popup($session_data) {
    ?>
<html lang="en-us">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta charset="utf-8" />

        <link rel="apple-touch-con" href="#" />

	<title>PERTAMINA EP</title>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<!-- The Columnal Grid and mobile stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url();?>themes/admin/assets/styles/columnal/columnal.css" type="text/css" media="screen" />
	<!-- Now that all the grids are loaded, we can move on to the actual styles. --> 
        <link rel="stylesheet" href="<?php echo base_url();?>themes/admin/assets/scripts/jqueryui/jqueryui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url();?>themes/admin/assets/styles/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url();?>themes/admin/assets/styles/global.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url();?>themes/admin/assets/styles/config.css" type="text/css" media="screen" />
        
        <!-- Use CDN on production server -->
         <script src="<?php echo base_url();?>themes/admin/assets/scripts/jquery.min.js"></script> 
         <script src="<?php echo base_url();?>themes/admin/assets/scripts/jquery-ui.min.js"></script> 
         
        <!-- Menu -->
        <link rel="stylesheet" href="<?php echo base_url();?>themes/admin/assets/scripts/superfish/superfish.css" type="text/css" media="screen" />
        <script src="<?php echo base_url();?>themes/admin/assets/scripts/superfish/superfish.js"></script>
        
        <!-- Sortable, searchable DataTable -->
        <script src="<?php echo base_url();?>themes/admin/assets/scripts/jquery.dataTables.min.js"></script>

            
        <script src="<?php echo base_url()."themes/admin/";?>assets/scripts/hc/js/highcharts.js"></script> 
        <script src="<?php echo base_url()."themes/admin/";?>assets/scripts/hc/js/modules/exporting.js"></script> 
        <script type="text/javascript">
            Highcharts.theme = {
               colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
               chart: {
                  backgroundColor: {
                     linearGradient: [0, 0, 500, 500],
                     stops: [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(240, 240, 255)']
                     ]
                  },
                  borderWidth: 2,
                  plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                  plotShadow: true,
                  plotBorderWidth: 1
               },
               title: {
                  style: {
                     color: '#000',
                     font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                  }
               },
               subtitle: {
                  style: {
                     color: '#666666',
                     font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                  }
               },
               xAxis: {
                  gridLineWidth: 1,
                  lineColor: '#000',
                  tickColor: '#000',
                  labels: {
                     style: {
                        color: '#000',
                        font: '11px Trebuchet MS, Verdana, sans-serif'
                     }
                  },
                  title: {
                     style: {
                        color: '#333',
                        fontWeight: 'bold',
                        fontSize: '12px',
                        fontFamily: 'Trebuchet MS, Verdana, sans-serif'

                     }
                  }
               },
               yAxis: {
                  minorTickInterval: 'auto',
                  lineColor: '#000',
                  lineWidth: 1,
                  tickWidth: 1,
                  tickColor: '#000',
                  labels: {
                     style: {
                        color: '#000',
                        font: '11px Trebuchet MS, Verdana, sans-serif'
                     }
                  },
                  title: {
                     style: {
                        color: '#333',
                        fontWeight: 'bold',
                        fontSize: '12px',
                        fontFamily: 'Trebuchet MS, Verdana, sans-serif'
                     }
                  }
               },
               legend: {
                  itemStyle: {
                     font: '9pt Trebuchet MS, Verdana, sans-serif',
                     color: 'black'

                  },
                  itemHoverStyle: {
                     color: '#039'
                  },
                  itemHiddenStyle: {
                     color: 'gray'
                  }
               },
               labels: {
                  style: {
                     color: '#99b'
                  }
               }
            };

            // Apply the theme
            var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
        </script>
</head>
<body>

<div id="wrap">
	<div id="main">
            <!-- 
            <header class="container">
                <div class="row clearfix">
                    <div class="left">
                        <a href="<?php echo base_url()."home/" ?>" id="logo">CSE Aviation</a>
                    </div>
                    <div class="right">
                        <ul id="toolbar">
                            <li><span>Logged in as</span> <a href="#" title="<?php echo $session_data['user_info']->NAME_OF_USER;?>"><?php echo $session_data['user_info']->NAME_OF_USER;?></a></li>
                        </ul>
                    </div>  
                </div>
            </header>
             -->
            
    <?php
}

function footer_popup($userinfo) {
    ?>
            
    </div>
</div>

<footer>
    <div class="container">
		<div class="row clearfix">
			<div class="col_12">
				<span class="left">&copy; 2012 PERTAMINA EP.</span>
			</div>
		</div>
    </div>
    
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/demo/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/demo/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/mitra-pep.js"></script>
</footer>

</body>

</html>
    <?php
}

// function setup_page_admin($uri_segment=4){
//     $config['full_tag_open'] = '<ul class="pagination">';
//     $config['full_tag_close'] = '</ul>';
//     $config['first_link'] = 'First';
//     $config['first_tag_open'] = '<li>';
//     $config['first_tag_close'] = '</li>';
//     $config['last_link'] = 'Last';
//     $config['last_tag_open'] = '<li>';
//     $config['last_tag_close'] = '</li>';
//     $config['next_link'] = '&gt;';
//     $config['next_tag_open'] = '<li class="next">';
//     $config['next_tag_close'] = '</li>';
//     $config['prev_link'] = '&lt;';
//     $config['prev_tag_open'] = '<li class="previous">';
//     $config['prev_tag_close'] = '</li>';
//     $config['cur_tag_open'] = '<li class="active"><b>';
//     $config['cur_tag_close'] = '</b></li>';
//     $config['num_tag_open'] = '<li>';
//     $config['num_tag_close'] = '</li>';
//     $config['uri_segment'] = $uri_segment;
//     return $config;
// }

// function array_to_obj($array, &$obj){
//     foreach ($array as $key => $value){
//         if (is_array($value)){
//             $obj->$key = new stdClass();
//             array_to_obj($value, $obj->$key);
//         } else {
//             $obj->$key = $value;
//         }
//     }
//     return $obj;
// }

?>