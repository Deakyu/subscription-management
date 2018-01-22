<?php 

    class Card extends Model{

        protected $hidden = [];

        public function __construct() {
            parent::__construct();
        }

        public function save($data) {
            $this->db->query("INSERT INTO cards (user_id, card_name, company, last_digits, expire) VALUES (?, ?, ?, ?, ?)");
            $this->db->bind("issss", [
                $data['user_id'],
                $data['card_name'],
                $data['company'],
                $data['last_digit'],
                $data['expire']
            ]);
            if($this->db->execute()) {
                return true;
            }
            return false;
        }

        public function update($data) {
            $this->db->query("UPDATE cards SET card_name = ?, company = ? , last_digits = ?, expire = ? WHERE id = ?");
            $this->db->bind("ssssi", [
                $data['card_name'],
                $data['company'],
                $data['last_digit'],
                $data['expire'],
                $data['id'],
            ]);
            if($this->db->execute()) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            $this->db->query("DELETE FROM cards WHERE id = ?");
            $this->db->bind("i", [$id]);
            if($this->db->execute()) {
                return true;
            }
            return false;
        }

    }