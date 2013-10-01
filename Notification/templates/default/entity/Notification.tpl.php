<?php
$object = $vars['object'];
$owner = IdnoPlugins\Subscribe\Main::getAuthorFromMF2($object->data);

?>
<div class="row idno-entry idno-entry-<?php
    if (preg_match('@\\\\([\w]+)$@', get_class($object), $matches)) {
        echo strtolower($matches[1]);
    }?>">

    <div class="span1 offset1 owner h-card hidden-phone">
        <p>
            <?php if (!empty($owner)) { ?>
            
            <a href="<?=$owner['url']?>" class="u-url icon-container"><img class="u-photo" src="<?=$owner['photo']?>" /></a><br />
            <a href="<?=$owner['url']?>" class="p-name u-url"><?=$owner['name'];?></a>
            
            <?php } ?>
            
        </p>
    </div>
    <div class="span8 <?=$object->getMicroformats2ObjectType()?> idno-object idno-content">
        <div class="visible-phone">
            <p class="p-author author h-card vcard">
            
                <?php if (!empty($owner)) { ?>
                
                <a href="<?=$owner['url']?>"><img class="u-logo logo u-photo photo" src="<?=$owner['photo']?>" /></a>
                <a class="p-name fn u-url url" href="<?=$owner['url']?>"><?=$owner['name'];?></a>
                <a class="u-url" href="<?=$owner['url']?>"><!-- This is here to force the hand of your MF2 parser --></a>
            
                <?php } ?>
                
            </p>
        </div>
        
        <div class="e-content entry-content">
            
            <h2 class="p-name"><a class="icon-globe" href="<?= $object->permalink;?>" target="_blank"> <?= $object->permalink;?></a></h2>
            <?php 
                $data = $object->data;
                
                if (empty($data)) { 
                    
                    foreach ($data->items as $item) {
                                
                        // Find the entry
                        if (in_array('h-entry', $item->type)) {
                            if (!$content)
                                $content = strip_tags($item->properties->content[0], '<p><br><a>');
                        }
                        
                    }
                    
                    if (empty($content))
                        $this->autop($this->parseHashtags($content)); 
                }?>
            
            
            
        </div>
        <div class="footer">
            <?php
                if ($object->canEdit()) {
                  //  echo $this->draw('content/edit');
                }
            ?>
            
            
            <?=$this->draw('content/end')?>
        </div>
    </div>

</div>