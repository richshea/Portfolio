<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Blog</title>
</head>
<body>

<?php
require_once ('helper/classes.php');


$dbhandle = mysql_connect("localhost", "briarmoss", "fourastwojsonel");
$ok = mysql_select_db("portfolio");


//get all the posts from the blog table
$blog_post_array = mysql_query("select * from blog;");

//create a constant so it can be used in the for loop instead of running mysql_num_rows every time
$numposts = mysql_num_rows($blog_post_array); 

//for loop for displaying all posts
for ($i = 0; $i < $numposts; $i++) {
    $blog_post = mysql_fetch_row($blog_post_array);

    $post_object = new pageObject($blog_post);

    $post_object->toHtml();
}

mysql_close($dbhandle);

?>

</body>
</html>
