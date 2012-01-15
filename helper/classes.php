
<?php

class pageObject {
    
}

class blogObject {
    
    public $timestamp; 
    public $title;
    public $author;
    public $content;
    public $preview;

    //the $array should have five members in the order: author, title, preview, content, date
    //maybe you can abuse this by not giving it a date. If you then run the store function then date gets updated.
    function __construct ($array) {
        $this->author =   $array[0];
        $this->title =    $array[1];
        $this->preview =  $array[2];
        $this->content =  $array[3];
        $this->timestamp = $array[4];
    }

  
    //echos the data in this blogObject in html format. 
    function toHtml() {
        echo "<h1>".$this->title."</h1>
              <h2>".$this->author."</h2>
              <p><i>".$this->preview."</i></p>
              <p>".$this->content."</p>
              <h3>".$this->timestamp."</h3>";
    }    

    //writes the data in this object to the blog table as a new post
    function store() {
        
        $dbhandle = mysql_connect("localhost", "briarmoss", "fourastwojsonel");
        $ok = mysql_select_db("portfolio");

        if ($this->timestamp == 0) {
          $update_bool = mysql_query(
            "Insert into blog (author, title, preview, content) VALUES (\"$this->author\", \"$this->title\", \"$this->preview\", \"$this->content\");"
          );   
        } else {
          $update_bool = mysql_query(
            "update blog set author=\"$this->author\", title=\"$this->title\", preview=\"$this->preview\", content=\"$this->content\" where date=\"$this->timestamp\";"
          );
        }

        mysql_close($dbhandle);
        return $update_bool;
    }
   /* Rendered obsolete by POST method
    function mysql_date() {
        $new_date = str_replace(":", "-", str_replace(" ", "-", $this->date));
        return $new_date;
    }

    */
    
    /* echos html that holds a post's entire data set but only displays some information. The content is hidden at first
       The code produced uses the javascript functions delete_post and toggle_content defined in admin.php
       Code produced contains a delete button that triggers an Ajax function to delete the post with the same timestamp in the blog table
    */
    function html_delete() {
        $date_key = $this->timestamp;
        $html = "<div id=\"wrapper_$date_key\" style=\"border: dotted; border-width:1px;\">
                  <div id=\"$date_key\" onclick=\"toggle_content(this.id);\">
                  $this->title by $this->author on $this->timestamp</h3>
                  <p id=\"preview_$date_key\">$this->preview</p> 
                  <div id=\"content_$date_key\" style=\"display: none;\">$this->content</div>
                  </div>
                  <input type=\"button\" value=\"delete\" onclick=\"delete_post('$date_key');\" />
                  <input type=\"button\" value=\"edit\" onclick=\"edit_post('$date_key');\" />
                  </div>";
        return $html;
    }

}

 ?>
    

    


