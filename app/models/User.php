<?php 

    class User extends Model{

        protected $hidden = ['password'];

        public function __construct() {
            parent::__construct();
        }

        public function register($data) {
            $this->db->query("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $this->db->bind("sss", [
                $data['name'], 
                $data['email'], 
                $data['password']
            ]);
            if($this->db->execute()) {
                return true;
            }
            return false;
        }

        // Find user by email
        public function userExists($email) {
            $this->db->query("SELECT * FROM users WHERE email=?");
            $this->db->bind("s", [$email]);
            $results = $this->db->single();

            return count($results) > 0 ? true : false;
        }

        public function login($email, $password) {
            $storedHidden = $this->hidden;
            $this->hidden = [];
            $user = $this->where(['email'], [], [$email]);
            $hashed = $user[0]->password;
            if(password_verify($password, $hashed)) {
                unset($user[0]->password);
                $this->hidden = $storedHidden;
                return $user[0];
            } else {
                $this->hidden = $storedHidden;
                return false;
            }
        }
    }