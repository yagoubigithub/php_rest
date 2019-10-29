<?php

class Post {

    //DB stuff
    private $conn;
    private $table = "posts";


//   Post properties

public $id;

public $category_id;
public $category_name;
public $title;
public $body;
public $author;
public $created_at;


//Constructor with db;

public function __construct($db){
    $this->conn = $db;
}

// get Posts
public function read(){

    //create query
    $query = 'SELECT 
    c.name as category_name,
    p.id,
    p.category_id,
    p.title,
    p.body,
    p.author,
    p.created_at
    FROM  
    ' . $this->table . ' p 
     LEFT JOIN 
     categories c ON p.category_id = c.id 
     ORDER BY 
     p.created_at DESC
     ';

     // Prepare Statement
     $stm = $this->conn->prepare($query);

     //Execute query
     $stm->execute();


     return $stm;
}
  // GET single post

  public function read_single(){
 //create query
 $query = 'SELECT 
 c.name as category_name,
 p.id,
 p.category_id,
 p.title,
 p.body,
 p.author,
 p.created_at
    FROM  
    ' . $this->table . ' p 
    LEFT JOIN 
    categories c ON p.category_id = c.id 
    WHERE 
    p.id = ?
    LIMIT 0,1
    ';

  // Prepare Statement
  $stm = $this->conn->prepare($query);

  $stm->bindParam(1,$this->id);

  //Execute query
  $stm->execute();

  $row = $stm->fetch(PDO::FETCH_ASSOC);

  $this->title= $row['title'];
  $this->body= $row['body'];
  $this->author= $row['author'];
  $this->category_id= $row['category_id'];
  $this->category_name= $row['category_name'];


  }

}
?>