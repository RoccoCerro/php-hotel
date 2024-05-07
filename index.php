<?php

$hotels = [

  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4
  ],
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2
  ],
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1
  ],
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5
  ],
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50
  ],

];

$get_parcking = $_GET["parcheggio"] ?? null;
var_dump($get_parcking);
$get_vote = $_GET["voto"] ?? "";
var_dump($get_vote);

var_dump($_GET);

// $filter = [$get_vote, $get_parcking];

$array_filtered = array_filter($hotels, function ($hotel) use ($get_parcking, $get_vote) {
  // list ($get_parcking, $get_vote) = $filter;
  
  // Trasformo la stringa vote in number
  $vote_filter = (int)$get_vote; 
  echo "Vote";

  $passed = false;

  // Controllo del parking
  if ($get_parcking !== 'no' && $get_parcking !== 'si' && $get_vote === 'Voto' || isset($get_vote) === false || $get_vote === '') {
    $passed = true;
  } else {
    if ($get_parcking === 'si' && $hotel['parking'] === true && $get_vote === 'Voto' || isset($get_vote) === false || $get_vote === '') {
      $passed = true;
    } else if($get_parcking === "no" && $hotel['parking'] === false && $get_vote === 'Voto' || isset($get_vote) === false || $get_vote === ''){
      $passed = true;
    } else if($get_parcking === 'si' && $hotel['parking'] === true && $hotel["vote"] >= $vote_filter){
      $passed = true;
    } else if($get_parcking === "no" && $hotel['parking'] === false && $hotel["vote"] >= $vote_filter){
      $passed = true;
    } else if($get_parcking !== 'no' && $get_parcking !== 'si' && $hotel["vote"] >= $vote_filter){
      $passed = true;
    }
  }

  return $passed;
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <main>
    <div class="container p-3">
      <form action="./index.php" method="GET" class="row flex-nowrap align-content-center">
        <div class="form-check form-switch d-inline-block me-3 col-sm-3">
          <label class="form-check-label" for="flexSwitchCheckChecked">Hotel con parcheggio:</label>
          <select class="form-select d-inline-block col-auto w-50" aria-label="Default select example"
            name="parcheggio">
            <option>...</option>
            <option <?php echo $get_parcking === "si" ? "selected" : "" ?> value="si">SI</option>
            <option <?php echo $get_parcking === "no" ? "selected" : "" ?> value="no">NO</option>
          </select>
        </div>
        <select class="form-select d-inline-block col-auto w-25" aria-label="Default select example" name="voto">
          <option>Voto</option>
          <option <?php echo $get_vote === "1" ? "selected" : "" ?> value="1">Uno</option>
          <option <?php echo $get_vote === "2" ? "selected" : "" ?> value="2">Due</option>
          <option <?php echo $get_vote === "3" ? "selected" : "" ?> value="3">Tre</option>
          <option <?php echo $get_vote === "4" ? "selected" : "" ?> value="4">Quattro</option>
          <option <?php echo $get_vote === "5" ? "selected" : "" ?> value="5">Cinque</option>
        </select>
        <button class="btn btn-dark col-2 ms-auto">Filtra</button>
      </form>
    </div>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Parcheggio</th>
            <th scope="col">Voto</th>
            <th scope="col">Distanza dal centro</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($array_filtered as $index => $hotel) {
            ?>
            <tr>
              <th scope='row'><?php echo $index + 1 ?></th>
              <td><?= $hotel["name"] ?></td>
              <td><?= $hotel["description"] ?></td>
              <td><?= $hotel["parking"] === true ? "SI" : "NO" ?></td>
              <td><?= $hotel["vote"] ?></td>
              <td><?php echo $hotel["distance_to_center"] ?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>