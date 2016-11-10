 <!DOCTYPE html>
<html>
<head>
<?php
	// Define our username/password for our db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "school_board";

	session_start(); 
	
	// Create connection
    $conn = new mysqli($servername, $username, $password, $database);
		
	// Check connection
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
			
?>
<title>School Database System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script src="script.js"></script>
<!-- Including  jQuery Dialog UI Here-->
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet" style="">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<link href="css/dialog.css" rel="stylesheet">
<link href="mystyles.css" rel="stylesheet" media="screen">
</head>
<body>
    
<nav class="navbar"> <!-- Start NavBar -->
  <div class="navbar-header">
    <a class="navbar-brand" href="#">School Database System</a>
  </div>
  <div class="navbar-body">
    <ul class="nav navbar-nav">
      <li><a href="index.php"><strong>Dashboard</strong></a></li>
      <li><a href="about.php"><strong>About</strong></a></li>
      <li class="active"><a href="students.php"><strong>Students</strong></a></li>
      <li><a href="teachers.php"><strong>Teachers</strong></a></li>
      <li><a href="courses.php"><strong>Courses</strong></a></li>
    </ul>
  </div>
</nav>    <!-- end NavBar -->
    
<div class="container dashboard"> <!-- Start Dashboard -->
    <div id="test" class="container">
    <div id="dialog" title="Dialog Form">
        <form action='students.php'>
            <input id='type' type='' name='type' value='insert' hidden=true>
            <label>ID:</label>
            <input type='text' name='ID' id='num'/>
            <label>First Name:</label>
            <input type='text' name='First_Name' id='First_Name'/>
            <label>Last Name:</label>
            <input type='text' name='Last_Name' id='Last_Name'/>
            <label>GPA:</label>
            <input type='text' name='GPA' id='GPA'/>
            <button class='btn insert'>Submit</button>
        </form>
    </div>
    </div>
    <div class="row text-center">
        <h1>Students</h1>
        <div class="row search">
            <form action="students.php">
                <input class="d_search" type="text" name="query" placeholder="Search Students">
                <button class="submit btn btn-primary">Search</button>
            </form>
        </div>
        <div class="row">
            <form action='students.php'>
                <input type='' name='type' value='insert' hidden=true>
                <table id="Table" class="table">
                  <thead class="thead-inverse">
                    <tr>
                      <th>SID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>GPA</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
                //If anything was searched from the input field create the query
                if(!empty($_GET['query'])) {
                    $query = "Select * from student where first_name = '" . $_GET['query'] . "' or last_name =  '" . $_GET['query'] . "' or num =  '" . $_GET['query'] . "' or gpa =  '" . $_GET['query'] . "'";
                }  else if(!empty($_GET['type']) && (!strcasecmp('insert', $_GET['type']))) {
                    $query = "INSERT INTO student (num, first_name, last_name, gpa) VALUES ('" . $_GET['ID'] . "','" . $_GET['First_Name']. "','" . $_GET['Last_Name'] ."','" . $_GET['GPA']."')";
                    $result = $conn->query($query);

                    if(!$result)
                        echo "<br>" . $conn->error;
                        $query = "Select * from student";

                } else if(!empty($_GET['type']) && (!strcasecmp('update', $_GET['type']))) {
                    $query = "UPDATE student SET first_name = '" . $_GET['First_Name'] .  "', last_name = '" . $_GET['Last_Name'] . "', gpa = '" . $_GET['GPA']."' WHERE student . num = " . $_GET['ID'];
                    $result = $conn->query($query);
                    if(!$result)
                        echo "<br>" . $conn->error; 
                    $query = "Select * from student";
                } else {
                    $query = "Select * from student";
                }
                 //execute the query
                $result = $conn->query($query);

                // if the query is not empty
                if($result) {                
                    if(!strcasecmp('select', substr($query, 0, 6))) {
                        //display the result in a table
                        if($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);

                            //print the attribute names
                            foreach ($row as $attr => $value)
                                while ($row) {
                                    echo "<tr>";
                                    foreach($row as $value)
                                        echo "<td>$value</td>";
                                    echo "</tr>";
                                    $row = mysqli_fetch_assoc($result);
                                }
                            }
                        }
                    }
                    else
                        echo $conn->error . "<br>";		
                ?>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="row tools" id="tools">
            <button class="btn delete" onclick="deleteRow(this)">-</button>
            <button class="btn add">+</button>
            <button class="btn edit">EDIT</button>
        </div>
        
        <?php
           $a =isset($_POST['ind'])?$_POST['ind']:'';
           if($a) {
            $query = "DELETE FROM student where NUM = '" . $a . "'";
            $result = $conn->query($query);
           }
       ?>
        
    </div>
</div> <!-- End Dashboard -->
    
</body>
</html> 