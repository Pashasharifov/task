<?php
include("php/config.php");
$customers = $con->query("SELECT DISTINCT user FROM payment");
$filter_query = "SELECT user, payment_category, payment_cash, payment_currency, payment_type, notes FROM payment WHERE 1=1 ";
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
          

        while ($distinctuser = $customers->fetch_assoc()) {
          
            echo '<tr>';
            echo '<td>' . htmlspecialchars($distinctuser['user']) . '</td>';


            $user = $con->real_escape_string($distinctuser['user']);
             
            $filter_query_income = "SELECT SUM(payment_cash) as sum, payment_currency  FROM payment WHERE user='$user' && payment_type='income' ";
            $result = $con->query($filter_query_income);
            $row = $result->fetch_assoc();
            echo '<td>' . htmlspecialchars($row['sum']) . '</td>';
          
           
            $filter_query_income = "SELECT SUM(payment_cash) as sum   FROM payment WHERE user='$user' && payment_type='expense'";
            $result = $con->query($filter_query_income);
            $row2 = $result->fetch_assoc();
            echo  '<td>' .  htmlspecialchars($row2['sum']) . '</td>';
            echo  '<td>' . $row['sum']-$row2['sum']  .htmlspecialchars($row['payment_currency']). '</td>';
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

</body>
</html>
