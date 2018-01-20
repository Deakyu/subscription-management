<?php 

    class Post extends Model{

        protected $hidden = ['user_id'];

        public function __construct() {
            parent::__construct();
        }

    }