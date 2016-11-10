 <!DOCTYPE html>
<html>
<head>
    
<title>School Database System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link href="mystyles.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script src="script.js"></script>
</head>
<body>
<nav class="navbar"> <!-- Start NavBar -->
  <div class="navbar-header">
    <a class="navbar-brand" href="#">School Database System</a>
  </div>
  <div class="navbar-body">
    <ul class="nav navbar-nav">
      <li><a href="index.php"><strong>Dashboard</strong></a></li>
      <li class="active"><a href="about.php"><strong>About</strong></a></li>
      <li><a href="students.php"><strong>Students</strong></a></li>
      <li><a href="teachers.php"><strong>Teachers</strong></a></li>
      <li><a href="courses.php"><strong>Courses</strong></a></li>
    </ul>
  </div>
</nav>    <!-- end NavBar -->
    
<div class="container dashboard about"> <!-- Start Dashboard -->
    <div class="row text-center">
        <h1>About</h1>
        <p class="info">All the table information you will need.</p>
        <div class="row ">
            <table class="table">
              <thead class="thead-inverse">
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
        </div>
        
    </div>
</div> <!-- End Dashboard -->
    
</body>
</html> 