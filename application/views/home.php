<?php
    header_app($userinfo);
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <?php
                foreach ($list_user as $value) {
                    if($value['role'] == 1){
                        ?>
                            <li> <a href="<?php echo site_url('data/progress/first/'.$value['id']."/".$value['notes']);?>"> <i class="icon-people"></i> <?php echo $value['notes'];?> </a> </li>
                        <?php
                    } else {
                        ?>
                            <li> <a href="<?php echo site_url('home/index/'.$value['id']);?>"> <i class="icon-people"></i> <?php echo $value['notes'];?> </a> </li>
                        <?php
                    }
                }
            ?>
        </ul>
    </div>
  </div>
</div>
<?php
    footer_app($userinfo);
?>