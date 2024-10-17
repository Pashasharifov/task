<?php
include("php/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SERVER["REQUEST_METHOD"])) {

 $payment_cash = $_POST['payment_cash'];
 $payment_category = $_POST['payment_category'];
 $payment_currency = $_POST['payment_currency'];
 $payment_type = $_POST['payment_type'];
 $user = $_POST['user'];
 $notes = $_POST['notes'];
 $currentDateTime = date("Y-m-d");
 
 


 $stmt = $con->prepare("INSERT INTO payment (payment_cash, payment_category, payment_currency, payment_type, user, notes, payment_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("sssssss", $payment_cash, $payment_category, $payment_currency, $payment_type, $user, $notes, $currentDateTime);

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
<?php
    $categories = $con->query("SELECT DISTINCT payment_category FROM payment");
    $customers = $con->query("SELECT DISTINCT user FROM payment");
    $currencies = $con->query("SELECT DISTINCT payment_currency FROM payment");
    

    $filter_query = "SELECT user, payment_category, payment_cash, payment_currency, payment_type, notes FROM payment WHERE 1=1 ";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
            $start_date = $con->real_escape_string($_GET['start_date']);
    $end_date = $con->real_escape_string($_GET['end_date']);
            $filter_query .= " AND payment_date BETWEEN '$start_date' AND '$end_date'";
        }
        if (!empty($_GET['category'])) {
            $category = $con->real_escape_string($_GET['category']);
            $filter_query .= " AND payment_category = '$category'";
        }
        if (!empty($_GET['customer'])) {
            $customer = $con->real_escape_string($_GET['customer']);
            $filter_query .= " AND user = '$customer'";
        }
        if (!empty($_GET['currency'])) {
            $currency = $con->real_escape_string($_GET['currency']);
            $filter_query .= " AND payment_currency = '$currency'";
        }
    }
     $result = $con->query($filter_query);
    ?>
        <form method="get" action="table.php">
        <label for="start_date">Başlanğıc Tarixi:</label>
        <input type="date" name="start_date" id="start_date">

        <label for="end_date">Son Tarixi:</label>
        <input type="date" name="end_date" id="end_date">

        <label for="category">Kateqoriya:</label>
        <select name="category" id="category">
            <option value="">Seçin</option>
            <?php while ($row = $categories->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['payment_category']); ?>">
                    <?php echo htmlspecialchars($row['payment_category']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="customer">Müştəri:</label>
        <select name="customer" id="customer">
            <option value="">Seçin</option>
            <?php while ($row = $customers->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['user']); ?>">
                    <?php echo htmlspecialchars($row['user']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="currency">Valyuta:</label>
        <select name="currency" id="currency">
            <option value="">Seçin</option>
            <?php while ($row = $currencies->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['payment_currency']); ?>">
                    <?php echo htmlspecialchars($row['payment_currency']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="submit" value="Filtrlə">
    </form>
    
  

  

    <?php
      $result = $con->query($filter_query);
  
    if ($result) {
       
        if ($result->num_rows > 0) {
            echo '<table class="table table-hover">';
            echo '<tr>
                    <th>Müştəri Adı</th>
                    <th>Kateqoriya</th>
                    <th>Mədaxil</th>
                    <th>Məxaric</th>
                    <th>Rəy</th>
                      
                  </tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['user']) . '</td>';
                echo '<td>' . htmlspecialchars($row['payment_category']) . '</td>';

                if ($row['payment_type'] === 'income') {
                    echo '<td>' . htmlspecialchars($row['payment_cash']) . ' ' . htmlspecialchars($row['payment_currency']) . '</td>';
                    echo '<td></td>'; // Məxaric üçün boş
                } elseif ($row['payment_type'] === 'expense') {
                    echo '<td></td>'; // Mədaxil üçün boş
                    echo '<td>' . htmlspecialchars($row['payment_cash']) . ' ' . htmlspecialchars($row['payment_currency']) . '</td>';
                }

                echo '<td>' . htmlspecialchars($row['notes']) . '</td>';
                $user = $con->real_escape_string($row['user']);
                  if(isset($_POST['start_date']) && $_POST['end_date']){
                     $start_date = $con->real_escape_string($_POST['start_date']);
                $end_date = $con->real_escape_string($_POST['end_date']);
                }else{
                    $start_date=date("Y-m-d");
                    $end_date=date("Y-m-d");
                  
                }
              
              
               
                
              
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Heç bir nəticə tapılmadı.</p>';
        }
    } else {
        echo "Xəta: " . $con->error;
    }

    
    ?>

    <?php

    //Second Filter
    $categories = $con->query("SELECT DISTINCT payment_category FROM payment");
    $customers = $con->query("SELECT DISTINCT user FROM payment");
    $currencies = $con->query("SELECT DISTINCT payment_currency FROM payment");
    

    $filter_query = "SELECT user, payment_category, payment_cash, payment_currency, payment_type, notes FROM payment WHERE 1=1 ";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
       


        if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
            $start_date = $con->real_escape_string($_GET['start_date']);
    $end_date = $con->real_escape_string($_GET['end_date']);
            $filter_query .= " AND payment_date BETWEEN '$start_date' AND '$end_date'";
        }
        if (!empty($_GET['category'])) {
            $category = $con->real_escape_string($_GET['category']);
            $filter_query .= " AND payment_category = '$category'";
        }

        // Müştəri
        if (!empty($_GET['customer'])) {
            $customer = $con->real_escape_string($_GET['customer']);
            $filter_query .= " AND user = '$customer'";
        }

        // Valyuta
        if (!empty($_GET['currency'])) {
            $currency = $con->real_escape_string($_GET['currency']);
            $filter_query .= " AND payment_currency = '$currency'";
        }
    }
   
     $result = $con->query($filter_query);

    ?>
    <?php
      $result = $con->query($filter_query);
  
    if ($result) {
       
        if ($result->num_rows > 0) {
            echo '<table class="table table-hover">';
            echo '<tr>
                    <th>Müştəri Adı</th>
                  

                      <th>Umumi Mədaxil</th>
                    <th>Umumi Məxaric</th>
                    <th>Qalıq</th>
                  </tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['user']) . '</td>';
                $user = $con->real_escape_string($row['user']);
                  if(isset($_GET['start_date']) && $_GET['end_date']){
                     $start_date = $con->real_escape_string($_GET['start_date']);
                $end_date = $con->real_escape_string($_GET['end_date']);
                }else{
                 
                    $start_date=date("Y-m-d", strtotime('-100 year'));
                    $end_date=date("Y-m-d", strtotime('+100 year'));
                  
                }
                $filter_query_income = "SELECT SUM(payment_cash) as sum, payment_currency  FROM payment WHERE user='$user' && payment_type='income' && payment_date BETWEEN '$start_date' AND '$end_date'";
                $result = $con->query($filter_query_income);
                $row = $result->fetch_assoc();
                echo '<td>' . htmlspecialchars($row['sum']) . '</td>';
              
               
                $filter_query_income = "SELECT SUM(payment_cash) as sum  FROM payment WHERE user='$user' && payment_type='expense' && payment_date BETWEEN '$start_date' AND '$end_date' ";
                $result = $con->query($filter_query_income);
                $row2 = $result->fetch_assoc();
                echo  '<td>' .  htmlspecialchars($row2['sum']) . '</td>';
                echo  '<td>' . $row['sum']-$row2['sum'] . htmlspecialchars($row['payment_currency'])  .'</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Heç bir nəticə tapılmadı.</p>';
        }
    } else {
        echo "Xəta: " . $con->error;
    }
  
    $con->close();
    ?>
   <a href="lastpage.php"> <button class="btn btn-primary" type="submit" >Go to last page</button></a>
</body>
</html>
