<?php

namespace IdnoPlugins\Notification\Pages {

    class Notification extends \Idno\Common\Page {

        function getContent() {

            $this->gatekeeper();
            $user = \Idno\Core\site()->session()->currentUser();

            $t = \Idno\Core\site()->template();
            $body = $t->__(array(
                        'objects' => \Idno\Core\site()->db()->getObjects('IdnoPlugins\Notification\Notification', ['subscription' => $user->getUrl()])
                    ))->draw('entity/Notification/list');

            $title = 'Your Friend\'s Activity';

            if (!empty($this->xhr)) {
                echo $body;
            } else {
                $t->__(array('body' => $body, 'title' => $title))->drawPage();
            }
            
            // Time mark when we last read notifications
            $user->notifications_last_read = time();
            $user->save();
            
        }


    }

}