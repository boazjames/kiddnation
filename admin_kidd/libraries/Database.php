<?php

class Database{
    public $host=DB_HOST;
    public $db_user=DB_USER;
    public $db_password=DB_PASS;
    public $db_name=DB_NAME;
    
    public $link;
    public $error;
    
    public function __construct() {
         $this->connect();
    }
    private function connect(){
        $this->link=new mysqli($this->host, $this->db_user, $this->db_password, $this->db_name);
        if(!$this->link){
            $this->error="Connection failed:".$this->link->connection_error;
            return false;
        }
    }
    
    public function select($query){
        $result= $this->link->query($query)or die($this->link->error.__LINE__);
        if($result->num_rows>0){
            return $result;
        }else{
            return false;
        }
    }
    public function count($query){
        $result= $this->link->query($query)or die($this->link->error.__LINE__);
        if($result->num_rows>0){
            return $result;
        }else{
            return false;
        }
    }
    
        public function insert($query){
            $insert_row=$this->link->query($query)or die($this->link->error.__LINE__);
            
    }
    
     public function update($query){
            $update_row=$this->link->query($query)or die($this->link->error.__LINE__); 
    }
    
     public function delete($query){
            $delete_row=$this->link->query($query)or die($this->link->error.__LINE__);
    }

}

