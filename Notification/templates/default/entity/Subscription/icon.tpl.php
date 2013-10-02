<i class="icon-group"><?php 
$counted = \IdnoPlugins\Notification\Main::countNewNotifications();
if ($counted) {
    ?>
    <span class="badge badge-important"><?= $counted; ?></span>
    <?php
}
?></i>