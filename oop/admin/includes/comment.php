<?php

    class Comment extends Db_object{ 
        
        protected static $db_table = "comments";
        protected static $db_table_fields = array('id', 'photo_id', 'user_id', 'body');
        public $id;
        public $photo_id;
        public $user_id;
        public $body;

        public static function create_comment($photo_id, $user_id, $body=""){
            
            if(!empty($photo_id) && !empty($body) && !empty($user_id)){
                
                $comment = new Comment();
                
                $comment->photo_id  = $photo_id;
                $comment->user_id   = $user_id;
                $comment->body      = $body;
                
                return $comment;
                
            }else{
                return false;
            }
        }
        
        public static function find_the_comments($photo_id=0){
            
            global $database;
            
            $sql = "SELECT * FROM " .self::$db_table;
            $sql.= " WHERE photo_id = ". $database->escape_string($photo_id);
            $sql.= " ORDER BY photo_id ASC";
            
            return self::find_by_query($sql);
        }
        
        
        
        

        
    } // END OF USER CLASS




?>