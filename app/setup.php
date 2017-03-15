<html>
  <head>
    <title>Udrafter Setup</title>
  </head>
  
  <body>
    <?php

    $host = "eu-cdbr-azure-west-d.cloudapp.net";
    $user = "b46b41d46340e3";
    $pass = "95f0622b";
    $database = "udrafter_db";

    $connection  = mysqli_connect($host, $user, $pass, $database)
    or die ("Error is " . $mysqli_error ($connection));


    $query = "DROP TABLE  user";
    $ret = $connection->query ($query);

    $query = "DROP TABLE assessmententry";
    $ret = $connection->query ($query);

    $query = "DROP TABLE  Student";
	$ret = $connection->query ($query);

    $query = "DROP TABLE Employer";
	$ret = $connection->query ($query);

    $query = "DROP TABLE  Job";
    $ret = $connection->query ($query);

    $query = "DROP TABLE  Application";
    $ret = $connection->query ($query);

    $query = "DROP TABLE  Feedback";
    $ret = $connection->query ($query);

    
    $query = "CREATE TABLE Student( studentId INT(10) NOT NULL AUTO_INCREMENT, name Varchar (100) NOT NULL, password varchar (10) NOT NULL, uniEmail Varchar (100) NOT NULL, profilePic LONGBLOB, resume LONGBLOB, PRIMARY KEY (studentId))";
	$ret = $connection->query ($query);

    $query = "CREATE TABLE Employer( employerId INT(10) NOT NULL AUTO_INCREMENT, name Varchar (100) NOT NULL, password varchar (10) NOT NULL, email Varchar (100) NOT NULL, company Varchar (100) NOT NULL,  profilePic LONGBLOB,  PRIMARY KEY (employerId))";
	$ret = $connection->query ($query);

    $query = "CREATE TABLE Job( jobId INT(10) NOT NULL AUTO_INCREMENT,  employerId INT NOT NULL, title Varchar (100) NOT NULL, description varchar (1000) NOT NULL, category VARCHAR (50),wages Varchar (10), company Varchar (100), location varchar (100), date DATE, 
               jobPic LONGBLOB,  PRIMARY KEY (jobId),  FOREIGN KEY (employerId) REFERENCES Employer(employerId) ON DELETE CASCADE  ON UPDATE CASCADE)";
    $ret = $connection->query ($query);

    $query = "CREATE TABLE Application( applicationId INT(10) NOT NULL AUTO_INCREMENT, jobId INT NOT NULL, studentId INT NOT NULL ,employerId INT NOT NULL, completed BOOLEAN, PRIMARY KEY (applicationId),
               FOREIGN KEY (employerId) REFERENCES Employer(employerId) ON DELETE CASCADE  ON UPDATE CASCADE,
                FOREIGN KEY (studentId) REFERENCES Student(studentId) ON DELETE CASCADE  ON UPDATE CASCADE,
                FOREIGN KEY (jobId) REFERENCES Job(jobId) ON DELETE CASCADE  ON UPDATE CASCADE)";
    $ret = $connection->query ($query);

    $query = "CREATE TABLE Feedback( feedbackId INT(10) NOT NULL AUTO_INCREMENT, studentId INT NOT NULL ,employerId INT NOT NULL, comments VARCHAR (1000), PRIMARY KEY (feedbackId),
              FOREIGN KEY (employerId) REFERENCES Employer(employerId) ON DELETE CASCADE  ON UPDATE CASCADE,
                FOREIGN KEY (studentId) REFERENCES Student(studentId) ON DELETE CASCADE  ON UPDATE CASCADE)";
    $ret = $connection->query ($query);
/*
    $query = "INSERT INTO Student(name, password, uniEmail, ) VALUES ('nirdesh', 'rgu@1', 'abc@123.com')";
	$ret = $connection->query ($query);

    $query = "INSERT INTO Employer(name, password, email, company,) VALUES ('michael', 'comeon', 'klhr@abc.com', 'rgu')";
	$ret = $connection->query ($query);

    $query = "INSERT INTO Job (title, description, category, wages, company, location, date) VALUES ('House Cleaning', 'clean the whole house', 'cleaning', '8.20/hr', 'scg', 'aberdeen', '12/13/2017')";
	$ret = $connection->query ($query);

    $query = "INSERT INTO Feedback (comments) VALUES ('michael ' )";
	$ret = $connection->query ($query);
*/
    if ($ret) {
      echo "<p>Table created!</p>";
    }
    else {
      echo "<p>Something went wrong: " . mysqli_error($connection); + "</p>";
    }    
    ?>  
  </body>
</html>