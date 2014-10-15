<?php header_app($userinfo);?>
<div class="container" id="actualbody">
    <div class="row clearfix">
        <div class="widget clearfix">
            <h2>Change Password</h2>
            <div class="widget_inside">
                <div class="col_12">
                    <div id="tabs-6" class="hastable">
                        <?php
                            $PASSWORD_OLD = array(
                                'name'		  =>'PASSWORD_OLD',
                                'id'		  =>'PASSWORD_OLD',                            	
                                'size'		  =>'32',
                                'required'        => true
                            );
                            $PASSWORD = array(
                                'name'		  =>'PASSWORD',
                                'id'		  =>'PASSWORD',                            	
                                'size'		  =>'64',
                                'required'        => true
                            );
                            $REPASSWORD = array(
                                'name'		  =>'REPASSWORD',
                                'id'		  =>'REPASSWORD',                            	
                                'size'		  =>'64',
                                'required'        => true
                            );
                        ?>
                        <?php echo form_open('user/management/save_password/'.$user->ID_USER, 'class=form');?>  
                        <?php 
                            echo validation_errors();
                            if($ok == "ok"){
                                echo '<span class="notification done">NEW PASSWORD HAS BEEN SAVED</span>';
                            } elseif ($ok == "invalid") {
                                echo '<span class="notification undone">INVALID OLD PASSWORD</span>';
                            }
                        ?>
                        
                        <table class="hastable">
                            <tbody>
                                <tr>
                                    <td>OLD PASSWORD</td>
                                    <td><?php echo form_password($PASSWORD_OLD);?></td>
                                </tr>
                                <tr>
                                    <td>PASSWORD</td>
                                    <td><?php echo form_password($PASSWORD);?></td>
                                </tr>
                                <tr>
                                    <td>RE-PASSWORD</td>
                                    <td><?php echo form_password($REPASSWORD);?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php echo form_submit("save","save");?></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#OPR_TEXT" ).autocomplete({
            source: "<?php echo site_url('user/list_datamaster/ajax_mitra');?>/"+$(this).val(),
            minLength: 2,
            select: function( event, ui ) {
                $("#OPERATOR_CODE").val(ui.item.id);
            },
            search : function (){
            }
        });
    });
</script>
<?php footer_app($userinfo);?>