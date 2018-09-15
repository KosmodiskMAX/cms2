<?php

    class User extends Db_object{ 
        
        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'firstname', 'lastname', 'user_image');
        public $id;
        public $username;
        public $password;
        public $firstname;
        public $lastname;
        public $user_image;
        
        public $upload_directory = "images";
        public $image_placeholder = "https://via.placeholder.com/400x400&text=image";
        
        public function image_path_and_placeholder(){
            return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
        }
        
        public static function verify_user($username, $password){
            global $database;
            $username = $database->escape_string($username);
            $password = $database->escape_string($password);
            
            $sql = "SELECT * FROM ".self::$db_table ." WHERE ";
            $sql.= "username = '{$username}' AND ";
            $sql.= "password = '{$password}' ";
            $sql.= "LIMIT 1";
            
            $result = self::find_by_query($sql);
            return !empty($result) ? array_shift($result) : false;
        }
        
        public function delete_user(){
        if($this->delete()){
            $target_path = $this->upload_directory.DS.$this->user_image;
            return unlink($target_path) ? true : false;
            }else{
                return false;
            }
        }
        // Save method verovatno moze da se sredi
        public function save(){
            $target_path = SITE_ROOT .DS. 'admin' .DS. $this->picture_path();
            if($this->id){
                $this->update();
                if(empty($this->filename) || empty($this->tmp_path)){
                    $this->errors[] = "The file was not available";
                    return false;
                }
                if(file_exists($target_path)){
                    $this->errors[] = "The file {$this->filename} already exists";
                        return false;
                }
                if(move_uploaded_file($this->tmp_path, $target_path)){
                    unset($this->tmp_path);
                    return true;
                }
            }else{
                if(!empty($this->errors)){
                    return false;
                }
                if(empty($this->filename) || empty($this->tmp_path)){
                    $this->errprs[] = "The file was not available";
                    return false;
                }
                if(file_exists($target_path)){
                    $this->errors[] = "The file {$this->filename} already exists";
                        return false;
                }
                if(move_uploaded_file($this->tmp_path, $target_path)){
                    if($this->create()){
                        unset($this->tmp_path);
                        return true;
                    }
                }else{
                    $this->errors[] = "File directory probably dosent have rifht premissions";
                    return false;
                }

            }
        
        }
        
        

        
    } // END OF USER CLASS




?>