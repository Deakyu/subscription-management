<?php 

    class Subscription extends Model{

        protected $hidden = [];

        public function __construct() {
            parent::__construct();
        }

        public function byPeriod() {
            $subscriptions = $this->all();
            $weekly = [];
            $monthly = [];
            $yearly = [];
            $others = [];
            foreach($subscriptions as $subscription) {
                $period = $subscription->period;
                switch ($period) {
                    case 'w':
                        $weekly[] = $subscription;
                        break;
                    case 'm':
                        $monthly[] = $subscription;
                        break;
                    case 'y':
                        $yearly[] = $subscription;
                        break;
                    default:
                        $others[] = $subscription;
                        break;
                }
            }
            $subscriptions = compact('weekly', 'monthly', 'yearly', 'others');
            return $subscriptions;
        }

    }