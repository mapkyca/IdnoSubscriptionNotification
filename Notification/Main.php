<?php

/**
 * @file
 * Get notifications from new friend posts.
 */

namespace IdnoPlugins\Notification {

    class Main extends \Idno\Common\Plugin {

        function registerPages() {

            // Register endpoint
            \Idno\Core\site()->addPageHandler('/notifications/?', '\IdnoPlugins\Notification\Pages\Notifications');




        }

        function registerEventHooks() {
            \Idno\Core\site()->addEventHook('save', function(\Idno\Core\Event $event) {
                        $object = $event->data()['object'];

                    });


            // TODO: Send deletes
        }

    }
    
}
