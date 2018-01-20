<?php 

    use PHPUnit_Framework_TestCase as TestCase;

    require_once './app/bootstrap.php';

    require_once './app/models/User.php';

    class UserTest extends TestCase {

        protected $user;

        public function setUp() {
            $this->user = new User;
        }

        /** @test */
        public function true_if_user_exists() {
            $this->assertTrue($this->user->userExists('lee5250@fredonia.edu'));
        }
    }