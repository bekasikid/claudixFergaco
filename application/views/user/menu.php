<?php header_app($userinfo);?>
<div class="container" id="actualbody">
    <div class="row clearfix">
        <div class="col_12">
            <div class="widget clearfix">
                <h2>Menu Management</h2>
                <div class="widget_inside">
                    <div class="form">
                        <form class="forms" id="catalogForm" method="post" action="<?php echo site_url('user/management/save_menu/'.$form->id_menu);?>">
                            <input type="hidden" name="id_parent" value="<?php echo isset($form->menu_name) ? $form->menu_name : $id_parent;?>"/>
                            <div class="clearfix">
                                <label>Parent Id</label>
                                <div class="input">
                                    <input id="firstname" class="xlarge" name="id_parent" value="<?php echo $form->id_parent;?>" required/>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label>Menu</label>
                                <div class="input">
                                    <input id="firstname" class="xlarge" name="menu_name" value="<?php echo $form->menu_name;?>" required/>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label>Parameter</label>
                                <div class="input">
                                    <input id="firstname" class="xlarge" name="param" value="<?php echo $form->param;?>"/>
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
            <h2>List Menu</h2>
             <div class="widget_inside"> 
                 <div class="col_12"> 
                <table cellspacing="0" class="regular" id="userMenuList">
                  <thead>
                    <tr>
                      <th width="50">No</td>
                      <th style="text-align: left;">Parent Id</th>
                      <th style="text-align: left;">Menu Id</th>
                      <th style="text-align: left;">Menu</th>
                      <th style="text-align: left;">Parameter</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        if(isset($results)){
                            $no = 1;
                            foreach ($results as $key => $value) {
                                ?>
                                  <tr>
                                      <td><?php echo $no;?>. </td>
                                      <td><?php echo $value->id_parent;?></td>
                                      <td><?php echo $value->id_menu;?></td>
                                      <td><?php echo $value->menu_name;?></td>
                                      <td><?php echo $value->param;?></td>
                                      <td><?php echo anchor('user/management/edit_menu/'.$value->id_menu, 'Edit').' | '.anchor('user/management/delete_menu/'.$value->id_menu, 'Delete');?></td>
                                  </tr>
                                <?php
                                $level_1 = $model_mitra->get_user_menu($value->id_menu);
                                if(isset ($level_1)){
                                    $no_1 = 1;
                                    foreach ($level_1 as $value_level_1) {
                                        ?>
                                          <tr>
                                              <td><?php echo $no;?>. <?php echo $no_1;?></td>
                                              <td><?php echo $value_level_1->id_parent;?></td>
                                              <td><?php echo $value_level_1->id_menu;?></td>
                                              <td><?php echo $value_level_1->menu_name;?></td>
                                              <td><?php echo $value_level_1->param;?></td>
                                              <td><?php echo anchor('user/management/edit_menu/'.$value_level_1->id_menu, 'Edit').' | '.anchor('user/management/delete_menu/'.$value_level_1->id_menu, 'Delete');?></td>
                                          </tr>
                                        <?php
                                        $level_2 = $model_mitra->get_user_menu($value_level_1->id_menu);
                                        if(isset ($level_1)){
                                            $no_2 = 1;
                                            foreach ($level_2 as $value_level_2) {
                                                ?>
                                                  <tr>
                                                      <td><?php echo $no;?>. <?php echo $no_1.". ".$no_2;?></td>
                                                      <td><?php echo $value_level_2->id_parent;?></td>
                                                      <td><?php echo $value_level_2->id_menu;?></td>
                                                      <td><?php echo $value_level_2->menu_name;?></td>
                                                      <td><?php echo $value_level_2->param;?></td>
                                                      <td><?php echo anchor('user/management/edit_menu/'.$value_level_2->id_menu, 'Edit').' | '.anchor('user/management/delete_menu/'.$value_level_2->id_menu, 'Delete');?></td>
                                                  </tr>
                                                <?php
                                                $no_2++;
                                            }
                                        }
                                        $no_1++;
                                    }
                                }
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
		
		        "bPaginate": true,
		        "bLengthChange": false,
		        "bFilter": false,
		        "bSort": true,
		        "bInfo": true,
		        "bAutoWidth": true
		    });
		} );
		$(function () {
			$("input:submit").button();		
		});
</script>