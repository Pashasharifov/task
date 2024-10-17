<?php
include("php/config.php");

              if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                
               
                
                $stmt = $con->prepare("INSERT INTO users (username, phone) VALUES (?, ?)");
                $stmt->bind_param("ss", $name, $phone);
            
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
  
<form method="post" action="table.php">

  <div class="mb-3">
    <label for="payment_cash" class="form-label">CASH :</label>
    <input type="text" class="form-control" name="payment_cash" >
  </div>

  <div class="mb-3">
    <label for="payment_category" class="form-label">CATEGORY :</label>
    <input type="text" class="form-control" name="payment_category" value=<?php 
    $stm = $con->prepare("SELECT cat_name FROM paymentcategoryname ORDER BY id DESC LIMIT 1");
    $stm->execute(); 
    $result = $stm->get_result();
    $row = $result->fetch_assoc(); 
    echo htmlspecialchars($row['cat_name']);

    ?>>
  </div>

  <div class="mb-3">
    <label for="payment_currency" class="form-label">CURRENCY :</label>
    <input type="text" class="form-control"  name="payment_currency" value="
    <?php 
   
    $stm = $con->prepare("SELECT currency_name FROM currency ORDER BY id DESC LIMIT 1");
    $stm->execute(); 
    $result = $stm->get_result();
    $row = $result->fetch_assoc();
      echo htmlspecialchars($row['currency_name']);
    ?>">
  </div>

  <div class="mb-3">
  <label for="payment_type" class="form-label">PAYMENT TYPE :</label>
      <select name="payment_type" required>
            <option value="income">Mədaxil</option>
            <option value="expense">Məxaric</option>
        </select>
  </div>

  <div class="mb-3">
  <label for="user" class="form-label">USER :</label>
  <input type="text" class="form-control" id="user" name="user" value="<?php 
  
  $stm = $con->prepare("SELECT username FROM users ORDER BY id DESC LIMIT 1");
    $stm->execute(); 
    $result = $stm->get_result();
    $row = $result->fetch_assoc();
      echo htmlspecialchars($row['username']);
  
  ?>">
  </div>
  
  <div class="mb-3">
    <textarea name="notes" placeholder="Rəy (boş qala bilər)"></textarea>
       
  </div>
  <button type="submit" class="btn btn-primary">Ödənişi Əlavə Et</button>
</form>

<script>
     function start(){
      var payment_cash=$('.payment_cash').val();
      var payment_category=$('.payment_category').val();
      var payment_currency=$('.payment_currency').val();
      var payment_type=$('.payment_type').val();
      var user=$('.user').val();
      var notes=$('.notes').val();
        $.ajax({
            url: "table.php", // URL of the PHP script
            type: "POST",
            dataType:'JSON',
            data: {
              payment_cash:payment_cash,
              payment_category:payment_category,
              payment_currency:payment_currency,
              payment_type:payment_type,
              user:user,
              notes:notes,
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