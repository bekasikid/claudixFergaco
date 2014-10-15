<?php header_app($userinfo);?>
<div class="container" id="actualbody">
    <div class="row clearfix">
        <div class="col_12">
            <div class="widget clearfix">
                <h2>Role Management</h2>
                <div class="widget_inside">
                    <div class="form">
                        <form class="forms" id="catalogForm" method="post" action="<?php echo site_url('user/management/save_role/'.$form->id_role);?>">
                            <div class="clearfix">
                                <label>Menu</label>
                                <div class="input">
                                    <input id="firstname" class="xlarge" name="name" value="<?php echo $form->name;?>" required/>
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
            <h2>List Role</h2>
            <div class="widget_inside">
                <div class="col_12">
                <table cellspacing="0" class="regular" id="userMenuList">
                  <thead>
                    <tr>
                      <td width="50">No</td>
                      <td style="text-align: left;">Role</td>
                      <td>Options</td>
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
                                      <td><?php echo $value->name;?></td>
                                      <td><?php echo anchor('user/management/edit_role/'.$value->id_role, 'Edit').' | '.anchor('user/management/delete_role/'.$value->id_role, 'Delete');?></td>
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