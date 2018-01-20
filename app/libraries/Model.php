<?php 

    class Model {
        protected $db;
        protected $childClass;
        protected $table;
        // Set hidden fields for each model
        protected $hidden = [];

        public function __construct() {
            $this->db = new Database;
            $this->childClass = get_class($this);
            $this->table = strtolower($this->childClass) . 's';
        }

        // ex) In controller
        //     $this->yourModel->all()
        /**
         * Returns all records of a model in the database as an array of objects
         * 
         * $this->yourModel->all();
         * @return array $results
         */
        public function all() {
            $this->db->query("SELECT * FROM {$this->table}");
            $results = $this->db->resultSet();

            // Remove hidden properties
            foreach($results as $result) {
                foreach($this->hidden as $prop) {
                    unset($result->$prop);
                }
            }
            return $results;
        }

        // ex) In controller
        //     $this->yourModel->where(['field1', 'field2'], [default='=', '<'], ['value1', 'value2'])
        /**
         * Returns records of a model that match conditions as an array of objects
         * 
         * $this->yourModel->where(['id', 'email'], ['>', '='], [1, 'lee5250@fredonia.edu']);
         * $this->yourModel->where(['email', 'name'], [], ['lee5250@fredonia.edu', 'deakyu']);
         * 
         * @param array $fields
         * @param array $operators
         * @param array $values
         * 
         * @return array $results
         * @return boolean false
         */
        public function where($fields = [], $operators = [], $values = []) {
            $conditions = "";
            if(count($operators) < 1) {
                for($i=0 ; $i < count($fields) ; $i++) {
                    $operators[] = '=';
                }
            }
            if(count($fields) == count($operators)) {
                if(count($fields) == count($operators)) {
                    if(count($fields) > 0) {
                        for($i=0 ; $i < count($fields) ; $i++) {
                            $conditions .= "{$fields[$i]} {$operators[$i]} ? AND ";
                        }
                        $types = [];
                        foreach($values as $value) {
                            switch (gettype($value)) {
                                case 'integer':
                                    $types[] = 'i';
                                    break;
                                case 'double':
                                    $types[] = 'd';
                                    break;
                                case 'string':
                                    $types[] = 's';
                                    break;
                            }
                        }
                        $types = implode('', $types);
                        $conditions = explode(" AND ", $conditions);
                        array_pop($conditions);
                        $conditions = implode(" AND ", $conditions);
                        $sql = "SELECT * FROM {$this->table} WHERE {$conditions}";
                        $this->db->query($sql);
                        $this->db->bind($types, $values);
                        $results = $this->db->resultSet();

                        // Remove hidden properties
                        foreach($results as $result) {
                            foreach($this->hidden as $prop) {
                                unset($result->$prop);
                            }
                        }
                        return $results;
                    }
                }
            }
            return false;
        }
    }