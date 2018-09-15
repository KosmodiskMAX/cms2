<?php

    class Db_object{
        
    public $type;
    public $size;
    
    public $filename;
    public $tmp_path;
    public $upload_directory = "images";
        
    public $errors = array();
    public $upload_errors_array = array(
    UPLOAD_ERR_OK               => "There is no error",
    UPLOAD_ERR_INI_SIZE         => "The uploaded file exceeds the upload_max_filesize directive",
    UPLOAD_ERR_FORM_SIZE        => "The uploaded file exceeds the MAX_FILE_SIZE directive",
    UPLOAD_ERR_PARTIAL          => "The uploaded file was only partialy uploaded",
    UPLOAD_ERR_NO_FILE          => "No file was uploaded",
    UPLOAD_ERR_NO_TMP_DIR       => "Missing a temporary folder",
    UPLOAD_ERR_CANT_WRITE       => "Failed to write file to disk",
    UPLOAD_ERR_EXTENSION        => "A PHP extension stopped the file upload"
    );
        
        public static function find_all(){      
            return static::find_by_query("SELECT * FROM ".static::$db_table );
        }
        
        public static function find_by_id($id){       
            $result = static::find_by_query("SELECT * FROM ".static::$db_table ." WHERE id = $id LIMIT 1");
            return !empty($result) ? array_shift($result) : false;   
        } 
        
        public static function find_by_query($sql){
            global $database;
            $result = $database->query($sql);
            $object_array = array();
            while($row = mysqli_fetch_assoc($result)){
                $object_array[] = static::instantation($row);
            }
            return $object_array;
        }
        
        public static function instantation($the_record){ 
            $calling_class = get_called_class(); 
            $object = new $calling_class;
            foreach($the_record as $the_attribute => $value){
                if($object->has_the_attribute($the_attribute)){
                    $object->$the_attribute = $value;
                }
            }  
            return $object;
        }
        
        private function has_the_attribute($the_attribute){
            $object_properties = get_object_vars($this);
            return array_key_exists($the_attribute, $object_properties);
        }
        
        protected function properties(){
            global $database;

            $properties = array();
            foreach(static::$db_table_fields as $db_field){
                if(property_exists($this, $db_field)){
                    $properties[$db_field] = $this->$db_field;
                }
            }
            // Clean all strings
            foreach($properties as $key => $value){
                $properties[$key] = $database->escape_string($value);
            }
            return $properties;
        }
        
        
        public function save(){
            return isset($this->id) ? $this->update() : $this->create();
        }
        
        public function create(){
            global $database;        
            $properties = $this->properties();
            
            $sql = "INSERT INTO ".static::$db_table . "(". implode(",",array_keys($properties)) .") ";
            $sql.= "VALUES ('". implode("','", array_values($properties)) ."')";
            
            
            if($database->query($sql)){
                $this->id = $database->the_insert_id();
                return true;
            }else{
                return false;
            }    
        } //CREATE METHOD
        
        public function update(){
            global $database;
            $properties = $this->properties();
            $properties_pairs = array();
            
            foreach ($properties as  $key => $value){
                $properties_pairs[]= "{$key}='{$value}'";
            }
            
            $sql = "UPDATE ".static::$db_table ." SET ";
            $sql.= implode(", ", $properties_pairs);
            $sql.= " WHERE id = {$database->escape_string($this->id)}";
            
            $database->query($sql);
            
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        } //UPDATE METHOD
        
        public function delete(){
            global $database;
            $sql = "DELETE FROM ".static::$db_table ." ";
            $sql.= "WHERE id =  {$database->escape_string($this->id)}";
            $database->query($sql);
            
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        } //DELETE METHOD
        
        public function set_file($file){
        
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return false;
        }elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }
        $this->filename = basename($file['name']);
        $this->tmp_path = $file['tmp_name'];
        $this->type = $file['type'];
        $this->size = $file['size'];
        return true;
    }
        
        public function picture_path(){
            return $this->upload_directory.DS.$this->filename;
        }
        
        public static function count_all(){
            global $database;
            
            $sql = "SELECT COUNT(*) FROM " . static::$db_table;
            $result_set = $database->query($sql);
            $row = mysqli_fetch_array($result_set);
            
            return array_shift($row);
        }
         
    }

?>