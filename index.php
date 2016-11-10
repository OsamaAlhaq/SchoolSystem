 <!DOCTYPE html>
<html>
<head>
    <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
		
		// Create connection
        $conn = new mysqli($servername, $username, $password);

		// Check connection
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);


        //start initialization of the database if it doesn't exist
        $conn->query("CREATE DATABASE school_board");
        $conn->query("use school_board");
        $conn->query("create table Student (
                        NUM 		integer primary key,
                        first_name	varchar(20),
                        last_name	varchar(30),
                        gpa 		real
                        );
                    ");
        $conn->query("create table Course (
                        CID		integer,
                        year	integer,
                        room	varchar(20),
                        average	real,
                      	Primary key(CID, year)
                      );
                    ");
        $conn->query("create table Staff (
                        SFID		integer primary key,
                        first_name	varchar(20),
                        last_name	varchar(20),
                        department	varchar(30),
                        salary		float
                      );
                    ");
        $conn->query("create table School (
                        SID 		integer primary key,
                        name		varchar(20),
                        location	varchar(40),
                        type		varchar(20)
                      );
                  ");
        
        $conn->query("create trigger `valid average update` before update on `course`
                      for each row begin
                      if new.average < 0 or new.average > 100 then
                      set new.average = old.average;
                      end if;
                      end");
        $conn->query("create trigger `valid average` before insert on `course`
                      for each row begin
                      if new.average < 0 or new.average > 100 then
                      set new.average = null;
                      end if;
                      end");
        $conn->query("create trigger `valid salary update` before update on `staff`
                      for each row begin
                      if new.salary < 0 then
                      set new.salary = old.salary;
                      end if;
                      end");
        $conn->query("create trigger `valid salary` before insert on `staff`
                      for each row begin
                      if new.salary < 0 then
                      set new.salary = null;
                      end if;
                      end");
        $conn->query("create trigger `valid gpa` before insert on `student`
                      for each row begin
                      if new.gpa < 0 and new.gpa > 4 then
                      set new.gpa = null;
                      end if;
                      end");
        $conn->query("create trigger `valid gpa update` before update on `student`
                      for each row begin
                      if new.gpa < 0 and new.gpa > 4 then
                      set new.gpa = old.gpa;
                      end if;
                      end");

        //finish initialization of the database if it doesn't exist

		
	?>
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
      <li class="active"><a href="#"><strong>Dashboard</strong></a></li>
      <li><a href="about.php"><strong>About</strong></a></li>
      <li><a href="students.php"><strong>Students</strong></a></li>
      <li><a href="teachers.php"><strong>Teachers</strong></a></li>
      <li><a href="courses.php"><strong>Courses</strong></a></li>
    </ul>
  </div>
</nav>    <!-- end NavBar -->
    
<div class="container dashboard"> <!-- Start Dashboard -->
    <div class="row text-center">
        <h1>School System</h1>
        <div class="row search">
            <form action="index.php">
                <input class="d_search" type="text" name="query" placeholder="Enter a Query">
                <button class="submit btn btn-primary">Search</button>
            </form>
        </div>
        <div class="row">
            <p class="info">(Visit <strong class="green-text">About</strong> to view table information)</p>
        </div>
        <div class="row">
        <?php

			if(empty($_GET))
                $query = '';
            else
                $query = $_GET['query'];
      	
            if($query != '') {

                //execute the query
                $result = $conn->query($query);

                if($result) {
                    if(!strcasecmp('select', substr($query, 0, 6))) {

                        //display the result in a table
                        if($result->num_rows > 0) {
                            echo "<br><table id='Table' class='table'><thead class='thead-inverse'><tr>";
                            $row = mysqli_fetch_assoc($result);

                            //print the attribute names
                            foreach ($row as $attr => $value)
                                echo "<th>$attr</th>";

                            //print the returned rows
                            echo "</tr>";
                            echo "</thead>";
                            while ($row) {
                                echo "<tr>";
                                foreach($row as $value)
                                    echo "<td>$value</td>";

                                echo "</tr>";
                                $row = mysqli_fetch_assoc($result);
                            }
                            echo "</table><br>";
                        }
                    }
                }
                else
                    echo $conn->error . "<br>";

                $conn->close();
            }		
			
        ?>
        </div>
    </div>
</div> <!-- End Dashboard -->
</body>
</html> 