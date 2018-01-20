<?php 
    /*
     * Databasea Class
     * Connect to database
     * Create prepared statements
     * Bind Values
     * Return rows and results
    */
    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        /**
         * Create a connection to database
         * If failed, show a flash message to end users and redirect to home page
         */
        public function __construct() {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            try {
                $this->dbh = new mysqli(
                    $this->host,
                    $this->user,
                    $this->pass,
                    $this->dbname
                );
            } catch(mysqli_sql_exception $e) {
                flash('connection_error', 'We have noticed a minor error at the moment and will fix it as soon as possible, We are sorry for your inconvenience', 'flash flash--error');
                redirect('page/index');
            }
        }

        /**
         * Prepare statement with query
         * 
         * $this->db->query("SELECT * FROM users WHERE id = ?");
         * 
         * @param string $sql
         */
        public function query($sql) {
            $this->stmt = $this->dbh->prepare($sql);
        }

        /**
         * Bind parameters to the prepared statement
         * 
         * $this->db->bind("i", 1)
         * 
         * @param string $type
         * @param array $params
         */
        public function bind($type, $params=[]) {
            $args = $params;
            array_unshift($args, $type);
            call_user_func_array([$this->stmt, 'bind_param'],refValues($args));
        }

        /**
         * Executes prepared statement
         * 
         * $result = $this->stmt->execute();
         * 
         * @return mysqli containing results
         */
        public function execute() {
            return $this->stmt->execute();
        }

        /**
         * Get the results and return an array of objects
         * 
         * $this->db->resultSet();
         * 
         * @return array $results
         */
        public function resultSet() {
            $this->stmt->execute();
            $this->stmt = $this->stmt->get_result();
            $results = [];
            while($obj = $this->stmt->fetch_object()) {
                $results[] = $obj;
            }
            return $results;
        }

        // Get a single result object
        /**
         * Get a single result and return an array of objects (with only one element in it)
         * 
         * @return array $results;
         */
        public function single() {
            $this->stmt->execute();
            $this->stmt = $this->stmt->get_result();
            $results = [];
            while($obj = $this->stmt->fetch_object()) {
                $results[] = $obj;
                break;
            }
            return $results;
        }
    }
