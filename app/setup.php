<html>
  <head>
    <title>Udrafter Setup</title>
  </head>
  
  <body>
    <?php

   include 'db_connect.php';


    $query = "DROP TABLE  Rating";
    $ret = $connection->query ($query);

    $query = "DROP TABLE Chat";
    $ret = $connection->query ($query);

   /* $query = "DROP TABLE  Student";
	$ret = $connection->query ($query);

    $query = "DROP TABLE Employer";
	$ret = $connection->query ($query);

    $query = "DROP TABLE  Job";
    $ret = $connection->query ($query);
*/
    $query = "DROP TABLE  Application";
    $ret = $connection->query ($query);

    $query = "DROP TABLE  Feedback";
    $ret = $connection->query ($query);


    $query = "CREATE TABLE Student( studentId INT(10) NOT NULL AUTO_INCREMENT,, name Varchar (100) NOT NULL, password varchar (10) NOT NULL, uniEmail Varchar (100) NOT NULL, profilePic LONGBLOB, PRIMARY KEY (studentId))";
	$ret = $connection->query ($query);

    $query = "CREATE TABLE Employer( employerId INT(10) NOT NULL AUTO_INCREMENT,  name Varchar (100) NOT NULL, password varchar (10) NOT NULL, email Varchar (100) NOT NULL, company Varchar (100) NOT NULL,  profilePic LONGBLOB,  PRIMARY KEY (employerId))";
	$ret = $connection->query ($query);

    $query = "CREATE TABLE Job( jobId INT(10) NOT NULL AUTO_INCREMENT,  employerId INT NOT NULL, title Varchar (100) NOT NULL, description varchar (1000) NOT NULL, category VARCHAR (50),wages Varchar (10), company Varchar (100), location varchar (100), date DATE, 
               jobPic LONGBLOB,  PRIMARY KEY (jobId),  FOREIGN KEY (employerId) REFERENCES Employer(employerId) ON DELETE CASCADE  ON UPDATE CASCADE)";
    $ret = $connection->query ($query);

    $query = "CREATE TABLE Application( applicationId INT(10) NOT NULL AUTO_INCREMENT, jobId INT NOT NULL, studentId INT NOT NULL ,employerId INT NOT NULL, isCompleted BOOLEAN NOT NULL, PRIMARY KEY (applicationId),
               FOREIGN KEY (employerId) REFERENCES Employer(employerId) ON DELETE CASCADE  ON UPDATE CASCADE,
                FOREIGN KEY (studentId) REFERENCES Student(studentId) ON DELETE CASCADE  ON UPDATE CASCADE,
                FOREIGN KEY (jobId) REFERENCES Job(jobId) ON DELETE CASCADE  ON UPDATE CASCADE)";
    $ret = $connection->query ($query);

    $query = "CREATE TABLE Feedback( feedbackId INT(10) NOT NULL AUTO_INCREMENT, studentId INT NOT NULL ,employerId INT NOT NULL, comments VARCHAR (1000), isStudent BOOLEAN NOT NULL, PRIMARY KEY (feedbackId),
              FOREIGN KEY (employerId) REFERENCES Employer(employerId) ON DELETE CASCADE  ON UPDATE CASCADE,
                FOREIGN KEY (studentId) REFERENCES Student(studentId) ON DELETE CASCADE  ON UPDATE CASCADE)";
    $ret = $connection->query ($query);

    $query = "CREATE TABLE Rating(rateId INT(10) NOT NULL AUTO_INCREMENT, studentId INT NOT NULL ,employerId INT NOT NULL, starRank INT(10) NOT NULL,PRIMARY KEY (rateId), 
                FOREIGN KEY (employerId) REFERENCES Employer(employerId) ON DELETE CASCADE  ON UPDATE CASCADE,
                FOREIGN KEY (studentId) REFERENCES Student(studentId) ON DELETE CASCADE  ON UPDATE CASCADE)";
    $ret = $connection->query ($query);

    $query = "CREATE TABLE Chat(chatId INT(10) NOT NULL AUTO_INCREMENT,studentId INT NOT NULL ,employerId INT NOT NULL, timestamp TIMESTAMP  NOT NULL,
               message VARCHAR (2000),PRIMARY KEY (chatId),
               FOREIGN KEY (employerId) REFERENCES Employer(employerId) ON DELETE CASCADE  ON UPDATE CASCADE,
                FOREIGN KEY (studentId) REFERENCES Student(studentId) ON DELETE CASCADE  ON UPDATE CASCADE )";
 $ret = $connection->query ($query);

    $query = "insert into Student (name, password, uniEmail) values (\"nirdesh\", \"showtime\",\"abc@rgu.ac.uk\")";
           $ret = $connection->query ($query);
    /*
                 $query = "INSERT INTO Employer( employerId, name, password, email, company,) VALUES ('E001','michael', 'comeon', 'klhr@abc.com', 'rgu')";
                 $ret = $connection->query ($query);

                 $query = "INSERT INTO Job (jobId, title, description, category, wages, company, location, date) VALUES ('J001','House Cleaning', 'clean the whole house', 'cleaning', '8.20/hr', 'scg', 'aberdeen', '12/13/2017')";
                 $ret = $connection->query ($query);

                 $query = "INSERT INTO Feedback (feedbackId,comments) VALUES ('F001','michael ' )";
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