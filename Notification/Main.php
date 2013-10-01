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
            \Idno\Core\site()->addEventHook('subscription/post/update', function(\Idno\Core\Event $event) {

                        $permalink = $event->data()['permalink'];
                        $data = $event->data()['data'];
                        $subscription = $event->data()['subscription'];
                        
                        if ((!empty($permalink)) && (!empty($subscription)))
                        {
                            $notification = new Notification();
                            $notification->permalink = $permalink;
                            $notification->subscription = $subscription;
                            if (!empty($data))
                                $notification->data = $data;
                         
                            $notification->save();
                        }
                        
                    });
        }

    }

}
