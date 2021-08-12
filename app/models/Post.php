<?php

class Post{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Add Post to Database Function
    public function addPost($data){
        $this->db->query("INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)");
        $this->db->bind(":user_id", $data['user_id']);
        $this->db->bind(":title", $data['title']);
        $this->db->bind(":body", $data['body']);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Update Post 
    public function updatePost($data){
        $this->db->query("UPDATE posts SET  title = :title, body =:body WHERE id =:id");
        $this->db->bind(":id", $data['post_id']);
        $this->db->bind(":title", $data['title']);
        $this->db->bind(":body", $data['body']);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    // get All Posts Function
    public function getPosts(){
        $this->db->query("SELECT *, 
        u.id as userId,
        p.id as postId,
        p.created_at as postDate, 
        u.created_at as userDate
                FROM
                    users u
                INNER JOIN posts p ON
                    u.id = p.user_id
                ORDER BY p.created_at DESC" );
        return $this->db->resultSet();
    }

    // get All Posts Function
    public function getPostDetails($postId){
        $this->db->query("SELECT *, p.id as postId, p.created_at as postDate
                FROM 
                    posts p
                WHERE
                    p.id = :postId
                ORDER BY p.created_at DESC" );

        $this->db->bind(':postId', $postId);
        return $this->db->singleSet();
    }

    public function deletePost($postId){
        $this->db->query("DELETE FROM posts WHERE id = :postId" );

        $this->db->bind(':postId', $postId);

        if( $this->db->execute() ){
            return true;
        }else{
            return false;
        }
    }


}