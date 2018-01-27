<?php 

    use Carbon\Carbon;

    class Subscription extends Model{

        protected $hidden = [];

        public function __construct() {
            parent::__construct();
        }

        public function save($data) {
            $this->db->query("INSERT INTO subscriptions (user_id, name, period, amount, due, card_id, logo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $this->db->bind("issdsis", [
                $data['user_id'],
                $data['subscription_name'],
                $data['period'],
                $data['amount'],
                $data['due'],
                $data['card_id'],
                $data['logo']
            ]);
            if($this->db->execute()) {
                return true;
            }
            return false;
        }

        public function byPeriod() {
            $subscriptions = $this->all();
            foreach($subscriptions as &$subscription) {
                $subscription->due = Carbon::parse($subscription->due);
            }
            unset($subscription);
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