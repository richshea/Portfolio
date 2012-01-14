<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>*****</title>

<?php 
require_once ('helper/classes.php');

if (isset($_POST["password"])) {
    
    $password = md5(htmlspecialchars($_POST["password"], ENT_NOQUOTES));
    $professor = htmlspecialchars($_POST["professor"], ENT_NOQUOTES);
    $quote = htmlspecialchars($_POST["quote"], ENT_NOQUOTES);
    $passwordcheck = "e709a3ef2d76055bbb39fb90d14822a4";
    if ($password == $passwordcheck) {

        
?> 
     <script type="text/javascript">
        
            function submit_post() {
                
                var xmlhttp;
                var post_values;

                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                }
                else {// code for IE6, IE5  
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }


                post_values = "author=";
                post_values += document.getElementById("author").value;
                post_values += "&title=";
                post_values += document.getElementById("title").value;
                post_values += "&preview=";
                post_values += document.getElementById("preview").value;
                post_values += "&content=";
                post_values += document.getElementById("content").value;


                xmlhttp.onreadystatechange=function() {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    if (xmlhttp.responseText==1) {
                      document.getElementById("post_status").innerHTML="post added";
                      get_post_list();
                    } else {
                      document.getElementById("post_status").innerHTML="error: pageObject.store() returned false";
                    }
                  }
                }

                xmlhttp.open("POST", "helper/submit_post.php", true);
  
                //Send the proper header information along with the request
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.setRequestHeader("Content-length", post_values.length);
                xmlhttp.setRequestHeader("Connection", "close");

                /**
                 * xmlhttp.open("GET","helper/submit_post.php?"+post_values,true);
                 */
                xmlhttp.send(post_values);

            }

            function get_post_list() {
                var xmlhttp;

                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                xmlhttp.onreadystatechange=function() {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("post_list").innerHTML=xmlhttp.responseText;
                  }
      
                }

                xmlhttp.open("GET","helper/get_post_list.php",true);
                xmlhttp.send(); 
            }

            function delete_post(id) {
                var xmlhttp;
                var post_values;

                post_values = "date_array="+id;

                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                xmlhttp.onreadystatechange=function() {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById(id).innerHTML = "";
                      if (xmlhttp.responseText==1) {
                        document.getElementById("post_status").innerHTML = "post destroyed!";
                      } else {
                        document.getElementById("post_status").innerHTML = "destruction unsuccessful";
                      }
                  }
      
                }
                xmlhttp.open("POST", "helper/delete_posts.php", true);
  
                //Send the proper header information along with the request
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.setRequestHeader("Content-length", post_values.length);
                xmlhttp.setRequestHeader("Connection", "close");

                
                xmlhttp.send(post_values);

                //xmlhttp.open("GET","helper/delete_posts.php?date_array="+id,true);
                //xmlhttp.send();
                
            }
            
            function toggle_content(id) {
              
              if (document.getElementById('content_'+id).style.display == "none") { 
                document.getElementById('content_'+id).style.display = "block";
              }
              else { 
                document.getElementById('content_'+id).style.display = "none";
              }
            }
            
    </script>
</head>
<body onload="get_post_list();">

<table><tr><td>
    <form name="frm_post" id="frm_post"> 
        <label for="author">Author</label>
        <input type="text" name="author" id="author" maxlength="64" /> 

        <br/>

        <label for="title">Title</label>
        <input type="text" name="title" id="title" maxlength="124" />  

        <br/>

        <label for="preview">Preview</label>
        <textarea name="preview" id="preview" rows="3" cols="42">Type a 124 character preview here</textarea> 

        <br/>

        <label for="content">Content</label>
        <textarea name="content" id="content" rows="20" cols="42">Unlimited.</textarea>

        <br/>

        <input type="button" value="post" onclick="submit_post();" />
        <input type="button" value="list" onclick="get_post_list();" />
    </form>
    <div id="post_status">
    </div>
</td>
<td>

    <div id="post_list">
    </div>

</td></tr></table>

    <?php
       

    } else { //need to add head and body tags so we could include the scripts in the password check
        ?>  
        
</head>
<body>
<?php
    $feedback = "Password Incorrect: Please try again";
        
    }
} 
else {  //if password is not set then the login form is displayed below    

?>
    


    <form action="admin.php" method="post">
        <input type="password" name="password" /></br>
        <input type="submit" value="Access" style="display: none;" />
    </form>


<?php 
}  //end login form conditional from above

//give information if password was incorrect
if (isset($_POST["password"])) {
   echo $feedback;
}
?>

    
    <div name="extra" id="extra">
    </div>

</body>
</html>
