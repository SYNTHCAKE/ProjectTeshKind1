<?php
  If(isset($_POST['submit'])){
    try {
    $conn = new PDO("mysql:host=h904139105.mysql;dbname=h904139105_s0", "h904139105_u0", "2BTCBmQ_");
    $conn->query("SET NAMES 'utf8'");
    if ($_POST['submit']) {
  if ( !$_POST['g-recaptcha-response'])
    exit('заполните каптчу');

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $key = '6Lf02Z8UAAAAAJuiEwJCE24zrlLao3R3bMExOJxf';
    $query = $url. '?secret='.$key. '&response'.$_POST['g-recaptcha-response'].'&remoteip'.$_SERVER['REMOTE_ADDR']; 

    $data = json_decode(file_get_contents($query));

    if ( $data->succes == true)
      exit('Капчу пройди');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $stmt = $conn->prepare("INSERT INTO tab2 (name, tel, cena, prob)
    VALUES (:name, :tel, :cena, :prob)");
    $stmt->bindParam(':name', $name);
   $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':cena', $cena);
    $stmt->bindParam(':prob', $prob);
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $cena = $_POST['cena'];
    $prob = $_POST['prob'];
    $stmt->execute();
    exit("Заявка успешно отправлена");
    }
}catch(PDOException $e){
  echo "Error: " . $e->getMessage();
}
$conn = null;
}
?>
