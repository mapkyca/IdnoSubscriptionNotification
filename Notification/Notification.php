<?php

namespace IdnoPlugins\Notification {

    class Notification extends \Idno\Common\Entity {

        function getActivityStreamsObjectType() {
            return 'false';
        }

        function getURL() {
            if (!empty($this->permalink))
                return $this->permalink;
            
            return parent::getURL();
        }
    }

}
