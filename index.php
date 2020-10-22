<html>
<head>
	<title>Friends</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function copyStringToClipboard (str) {
      var el = document.createElement('textarea');
      el.value = str;
      el.setAttribute('readonly', '');
      el.style = {position: 'absolute', left: '-9999px'};
      document.body.appendChild(el);
      el.select();
      document.execCommand('copy');
      document.body.removeChild(el);
    }
  </script>
</head>
<body>
  <?php
    $config = parse_ini_file("config.ini");
  ?>
  <?php
    if($_POST["name"] && $_POST["code"]){
      $code = preg_replace('/\s+/', '', $_POST["code"]);
      $name = $_POST["name"];
      if(preg_match('/\d{12}/', $code)){
        $conn1 = mysqli_connect($config["host"], $config["user"], $config["password"], $config["dbname"]);
        $name = mysqli_real_escape_string($conn1, $name);
        $code = mysqli_real_escape_string($conn1, $code);
        $sql1 = "SELECT * FROM users WHERE name = '$name'";
        $result1 = mysqli_query($conn1, $sql1);
        if (mysqli_num_rows($result1) > 0){
          echo "<script> alert('Kod dla tego nicku już istnieje!') </script>";
        }
        else{
          $time = time();
          $sql2 = "INSERT INTO users (name, code, created_at) VALUES ('$name', '$code', '$time')";
          if(mysqli_query($conn1, $sql2)){
            echo "<script> alert('Kod dodany pomyślnie!') </script>";
          }
        }
        mysqli_close($conn1);
      }
      else{
        echo "<script> alert(`NIEPOPRAWNY KOD`); </script>";
      }
    }
  ?>
  <div class="container">
    <h1>Dodaj swój kod</h1>
    <form action="index.php" method="post">
      <div class="fields">
        <span>
         <input placeholder="Nick" type="text" name="name" />
      </span>
      <br />
       <span>
         <input placeholder="0000 0000 0000" type="text" name="code"/>
      </span>
      </div>
      <div class="submit">
        <input class="submit" value="Dodaj" type="submit" />
      </div>
    </form>
  </div>
  <br>
  <table class="table-fill">
  <thead>
  <tr>
  <th class="text-left">Nick</th>
  <th class="text-left">Kod</th>
  <th class="text-left">Dodano</th>
  <th class="text-left">Kopiuj</th>
  </tr>
  </thead>
  <tbody class="table-hover">
  <?php
    $conn = mysqli_connect($config["host"], $config["user"], $config["password"], $config["dbname"]);
    $sql = "SELECT * FROM users ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=`text-left`>" . $row["name"]. " </td> <td class=`text-left`> " . wordwrap($row["code"] , 4 , ' ' , true ) . "</td> <td class=`text-left`>" . date('d.m.Y H:i', $row["created_at"]) . "</td> <td class=`text-left`> <button type=`button`  onclick='copyStringToClipboard(`" . $row["code"] . "`)'>Kopiuj</button></td>";
      }
    }
    mysqli_close($conn);
  ?>
  </tbody>
  </table>


</script>

</body>
</html>
