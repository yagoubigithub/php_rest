<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();


// Instantiate blog post object

$post = new Post($db);


//  Get id

if( isset($_GET['id'])){
    $post->id = $_GET['id'];
}else{
    echo (json_encode(array(
        'message' => "id is required"
    )));
    die();

}
 


// get post
$post->read_single();

$post_arr= array(
    'id'=>$post->id,
    'title'=>$post->title,
    'body'=>html_entity_decode($post->body),
    'author'=>$post->author,
    'category_id'=>$post->category_id,
    'category_name'=>$post->category_name,
    "created_at"=>$post->created_at
    
);

print_r(json_encode($post_arr))
?>