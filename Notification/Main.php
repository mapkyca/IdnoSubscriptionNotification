<?php

/**
 * @file
 * Get notifications from new friend posts.
 */

namespace IdnoPlugins\Notification {

    class Main extends \Idno\Common\Plugin {

        function registerPages() {

            // Register endpoint
            \Idno\Core\site()->addPageHandler('/notifications/?', '\IdnoPlugins\Notification\Pages\Notification');
            
            // Extend 
            \Idno\Core\site()->template()->extendTemplate('entity/Subscription/edit', 'entity/Notification/Subscription/edit');
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
        
        /** 
         * Count new notifications
         * @return type
         */
        static function countNewNotifications() {
            $time = \Idno\Core\site()->session()->currentUser()->notifications_last_read;
            if (empty($time))
                $time = 0;
            $notify = \Idno\Core\site()->db()->countObjects('IdnoPlugins\Notification\Notification', ['subscription' => \Idno\Core\site()->session()->currentUser()->getUrl(), 'created' => ['$gte' => $time]]);
            
            return $notify;
        }

    }

}
