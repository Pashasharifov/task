<?php
include("php/config.php");

           if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST['name'];
            
        
            // Use prepared statements to prevent SQL injection
            $stmt = $con->prepare("INSERT INTO paymentcategoryname (cat_name) VALUES (?)");
            $stmt->bind_param("s", $name);
        
            if ($stmt->execute()) {
                echo "New record created successfully";
            } 
        };
            

            
           
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   </head>
<body>



<form  method="post" id="myForm" action="users.php">
     <div class="mb-3">
    <label for="name" class="form-label ">Currency Name :</label>
    <input type="text" class="form-control" id="name" name="name" >
  </div>
  <br><br>
    <input type="submit" name="submit" onclick="start()" value="Add Currency Name">
</form> 

<script>
    function start(){
    var inp=$('#name').val();

       
        $.ajax({
            url: "users.php", // URL of the PHP script
            type: "POST",
            dataType:'JSON',
            data: {
                name:inp
            },
            success:function(response){

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown); // Handle errors
            }
        });
    };

       
    </script>


        

            
           

            

   
</body>
</html>