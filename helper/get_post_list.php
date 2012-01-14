<?php
require_once('classes.php');

    $dbhandle = mysql_connect("localhost", "briarmoss", "fourastwojsonel");
    $ok = mysql_select_db("portfolio");


    //get all the posts from the blog table
    $blog_post_array = mysql_query("select * from blog;");

    
    //create a constant so it can be used in the for loop instead of running mysql_num_rows every time
    $numposts = mysql_num_rows($blog_post_array); 
 
    //need a form element
    echo "<form name=\"frm_delete\" id=\"frm_delete\">";

    //for loop for displaying all posts
    for ($i = 0; $i < $numposts; $i++) {
        
        $blog_post = mysql_fetch_row($blog_post_array);

        $post_object = new pageObject($blog_post);

        echo $post_object->html_delete();
/*
        $date_key = $post_object->mysql_date();
        //create a checkbox for each post with the name as the date for deletion purposes
        $option = "<input id=\"$date_key\" type=\"checkbox\" name=\"date\" value=\"$date_key\" />
                   <label for=\"$date_key\" > \"$post_object->title\" by $post_object->author on $post_object->date </label>
                   <br />";
        
        $option = "<div id=\"$date_key\" onclick=\"toggle_content(this.id);\">
                  <>\"$post_object->title\" by $post_object->author on $post_object->date</h3>
                  <input type=\"button\" value=\"delete\" onclick=\"delete_post(this.parentNode.id);\" />
                  <p>$post_object->preview</p> 
                  <p id=\"content_$date_key\" style=\"display: none;\">$post_object->content</p>
                  </div>";

        echo $option; 
        */

    }

    mysql_close($dbhandle);

    //<input type="button" value="delete" onclick="delete_posts();" />
?>
    </form>



