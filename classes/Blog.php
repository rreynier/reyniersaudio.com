<?php

class Blog {

    function __construct() {

        require_once($_SERVER['DOCUMENT_ROOT'] . '/constants.php');

        $this->conn = new mysqli(BLOG_DB_SERVER, BLOG_DB_USER, BLOG_DB_PASSWORD, BLOG_DB_NAME) or die('There was a problem connecting to the blog database.');
        $this->latest_blog_posts = array();
    }

    function getLatestBlogPosts() {	


        $query = "SELECT `post_title`, `post_content`,`post_date`,`post_name` FROM `wp_posts` WHERE `post_status` = 'publish' ORDER BY `post_date` DESC LIMIT 4";
        if($result = $this->conn->query($query)) {
            while($row = $result->fetch_array()) {
                $this->latest_blog_posts[] = $row;
            }
        }
    }
 

}