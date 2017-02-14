<!DOCTYPE html>
<html lang="en">
<head>
  <title>API Client | Altaf</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"auth-key: test\r\n" .
              "auth-secret: test\r\n"
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents('http://localhost/api/rest/get_user', false, $context);

$company1 = json_decode($file);

// Create a stream
$comp_opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"auth-key: test1\r\n" .
              "auth-secret: test1\r\n"
  )
);

$comp_context = stream_context_create($comp_opts);

// Open the file using the HTTP headers set above
$comp_file = file_get_contents('http://localhost/api/rest/get_user', false, $comp_context);

$company2 = json_decode($comp_file);
?>
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#company1">Company 1</a></li>
    <li><a data-toggle="tab" href="#company2">Company 2</a></li>
  </ul>
<div class="tab-content">
    <div id="company1" class="tab-pane fade in active">            
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Given Name</th>
            <th>Surname</th>
            <th>Middle Name</th>
            <th>Email</th>
            <th>Birthdate</th>
          </tr>
        </thead>
        <tbody>
        <?php
            if ($company1 != '') {
                for ($i=0; $i < count($company1->msg); $i++) { 
                 echo "<tr>";
                 echo "<td>" . $company1->msg[$i]->givenname . "</td>";
                 echo "<td>" . $company1->msg[$i]->surname . "</td>";
                 echo "<td>" . $company1->msg[$i]->middlename . "</td>";
                 echo "<td>" . $company1->msg[$i]->email . "</td>";
                 echo "<td>" . $company1->msg[$i]->birthdate . "</td>";
                 echo "</tr>";
                }
            }
        ?>
        </tbody>
      </table>
    </div>
    <div id="company2" class="tab-pane fade">            
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Given Name</th>
            <th>Surname</th>
            <th>Middle Name</th>
            <th>Email</th>
            <th>Birthdate</th>
          </tr>
        </thead>
        <tbody>
        <?php
            if ($company2 != '') {
                for ($i=0; $i < count($company2->msg); $i++) { 
                 echo "<tr>";
                 echo "<td>" . $company2->msg[$i]->givenname . "</td>";
                 echo "<td>" . $company2->msg[$i]->surname . "</td>";
                 echo "<td>" . $company2->msg[$i]->middlename . "</td>";
                 echo "<td>" . $company2->msg[$i]->email . "</td>";
                 echo "<td>" . $company2->msg[$i]->birthdate . "</td>";
                 echo "</tr>";
                }
            }
        ?>
        </tbody>
      </table>
    </div>
</div>
</body>
</html>