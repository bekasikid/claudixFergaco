<?php header_app($userinfo);?>
<div class="container" id="actualbody">
    <div class="row clearfix">
        <div class="col_12">
            <div class="widget clearfix">
                <h2>Access Management</h2>
                <div class="widget_inside">
                    <div class="form">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#role").change(function (){
                                    var url = "<?php echo site_url('user/management/access');?>/"+$(this).val();   
                                    window.location.href = url;
                                })
                            });
                        </script>
                        <form class="forms" id="catalogForm" method="post" action="<?php echo site_url('user/management/save_access/');?>">
                            <div class="clearfix">
                                <label>Role</label>
                                <div class="input">
                                    <?php 
                                        $data_roles = array();
                                        $data_roles[] = "";
                                        foreach ($roles as $value){
                                            $data_roles[$value->id_role] = $value->name;
                                        }
                                        echo form_dropdown('id_role', $data_roles,$id_role,"id='role'");
                                    ?>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label>Menu</label>
                                <div class="input">
                                    <select name="id_menu[]" multiple size="15" id="menus">
                                    <?php 
                                        $html = '';
                                        $data_menus = array();
                                        if(isset($menus)){
                                            $no = 1;
                                            foreach ($menus as $key => $value) {
                                                $html.='<option value="'.$value->id_menu.'" '.(isset($menus_select[$value->id_menu]) ? "selected":"").'>'.$value->menu_name.'</option>';
                                                $level_1 = $model_mitra->get_user_menu($value->id_menu);
                                                if(isset ($level_1)){
                                                    $no_1 = 1;
                                                    foreach ($level_1 as $value_level_1) {
                                                        $html.='<option value="'.$value_level_1->id_menu.'" '.(isset($menus_select[$value_level_1->id_menu]) ? "selected":"").' style="padding-left:20px;"> '.$value_level_1->menu_name.'</option>';
                                                        $level_2 = $model_mitra->get_user_menu($value_level_1->id_menu);
                                                        if(isset ($level_1)){
                                                            $no_2 = 1;
                                                            foreach ($level_2 as $value_level_2) {
                                                                $html.='<option value="'.$value_level_2->id_menu.'" '.(isset($menus_select[$value_level_2->id_menu]) ? "selected":"").' style="padding-left:40px;">  '.$value_level_2->menu_name.'</option>';
                                                                $no_2++;
                                                            }
                                                        }
                                                        $no_1++;
                                                    }
                                                }
                                                $no++;
                                            }
                                        }
                                        echo $html;
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix grey-highlight">
                                <div class="input no-label ">
                                    <input class="submit" type="submit" value="Submit"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="widget clearfix">
            <h2>List Access</h2>
            <div class="widget_inside">
                <div class="col_12">
                <table cellspacing="0" class="regular" id="userMenuList">
                  <thead>
                    <tr>
                      <td width="50">No</td>
                      <td style="text-align: left;">Role</td>
                      <td style="text-align: left;">Access</td>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        if(isset($roles)){
                            $no = 1;
                            foreach ($roles as $key => $value) {
                                ?>
                                  <tr>
                                      <td style="vertical-align: top;"><?php echo $no;?>. </td>
                                      <td style="vertical-align: top;"><?php echo $value->name;?></td>
                                      <td>
                                          <ul>
                                            <?php 
                                                $data = array();
                                                $data_unknown = array();
                                                $access = $model_mitra->get_menu_role($value->id_role);
                                                foreach ($access as $menu) {
                                                    $menux = $model_mitra->get_user_menu_by_id($menu->id_menu);
                                                    if($menux->id_parent == 0){
                                                        // level 0
                                                        $data[0][$menux->id_menu] = (array) $menux;
                                                    } else {
                                                        // level 1
                                                        if(isset($data[0][$menux->id_parent])){
                                                            $data[0][$menux->id_parent]['level_1'][$menux->id_menu] = (array) $menux;
                                                        } else {
                                                            $data_unknown[$menux->id_parent][$menux->id_menu] = (array) $menux;
                                                        }
                                                    }
                                                }

                                                foreach ($data[0] as $key => $value) {
                                                    if(isset($value['level_1'])){
                                                        foreach ($value['level_1'] as $key_det => $level_1_det) {
                                                            // level 2
                                                            if(isset ($data_unknown[$key_det])){
                                                                $data[0][$key]['level_1'][$key_det]['level_2'][$key_det] = (array) $data_unknown[$key_det];
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                                $html = '';
                                                foreach ($data[0] as $key=>$value_root) {
                                                    $html.='<li>'.anchor($value_root['param'], $value_root['menu_name']);
                                                    if(isset($value_root['level_1'])){
                                                        foreach ($value_root['level_1'] as $level_1) {
                                                            $html.='<li style="padding-left:20px;">'.anchor($level_1['param'], $level_1['menu_name']);
                                                            if(isset($level_1['level_2'])){
                                                                foreach ($level_1['level_2'] as $level_2) {
                                                                    $html.='<ul>';
                                                                    foreach ($level_2 as $det_level_2){
                                                                        $html.='<li style="padding-left:40px;">'.anchor($det_level_2['param'], $det_level_2['menu_name']);
                                                                    }
                                                                    $html.='</ul>';
                                                                }
                                                            }
    //                                                        if(isset ($value['level_1'])){
    //                                                            print_r($value['level_1']);
    //                                                            $html.='<ul>';
    //                                                            foreach ($value['level_1'] as $level_1) 
    //                                                                $html.='</li>';
    //                                                            }
    //                                                            $html.='</ul>';
    //                                                        }
                                                        }
                                                    }
                                                    $html.='</li>';
                                                }
                                                echo $html;
                                            ?>
                                          </ul>
                                      </td>
                                  </tr>
                                <?php
                                $no++;
                            }
                        }
                      ?>
<!--                       <tr> -->
<!--                           <td></td> -->
<!--                       </tr> -->
                  </tbody>
                </table>
                <?php echo $page;?>
            </div>
        </div>
    </div>
</div>
<?php footer_app($userinfo);?>

<!-- created by aris -->

<script type="text/javascript">
		$(function () {
			$("input:submit").button();
		});
		$(document).ready(function() {
		    oTable = $('#userMenuList').dataTable({
		        "bJQueryUI": true,
		        "sPaginationType": "full_numbers",
		
		        "bPaginate": false,
		        "bLengthChange": false,
		        "bFilter": false,
		        "bSort": false,
		        "bInfo": false,
		        "bAutoWidth": true
		    });
		} );
		$(function () {
			$("input:submit").button();		
		});
</script>