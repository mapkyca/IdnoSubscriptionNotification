<?php
$counted = \IdnoPlugins\Notification\Main::countNewNotifications();

?>

<div class="row">

    <div class="span10 offset1">

        <p><a href="/notifications/">View my notifications... <?php if ($counted > 0) { ?><span class="badge badge-important"><?= $counted; ?></span><?php } ?></a></p>
    </div>

</div>

