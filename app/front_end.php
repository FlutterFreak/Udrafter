<?php
		session_start();
	
		if (!isset ($_SESSION["username"])) {
			header( 'Location: example_login.html' ) ;
			exit;
		}
?>

<html>

  <head>
    <title>Assessment Calendar</title>
  </head>  
  <body onLoad="setupAjax()">   
    <h1>Assessment List</h1>

    <script language="JavaScript">    

	function validate (txt) {
		var ele = document.getElementById (txt);
		
		if (!ele) {
			return false;
		}
		
		if (ele.value != "") {
			return true;
		}
	}


      function validateDate (form) {
        var bing;
        var desc;
		
        if (!validate ("due")) {
          alert ("Please enter a date");
          return;
        }
            
        if (window.XMLHttpRequest) {
        // Code for modern browsers
          request=new XMLHttpRequest();
        }
        else {
          // code for older versions of Internet Explorer
          request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        request.onreadystatechange=function() {
          if (request.readyState==4 && request.status==200) {     
            setupAjax();  
        }
      }      
      
	  desc = document.getElementById ("description");
	  	  
      bing = "update_content.php?action=new&description=" + desc.value + "&due=" + due.value;
     
      request.open ("GET", bing, true);
      request.send();      
  }   


  function updateDone (num) {
      var val;
	  var url;
      
      if (window.XMLHttpRequest) {
      // Code for modern browsers
        request=new XMLHttpRequest();
      }
      else {
        // code for older versions of Internet Explorer
        request = new ActiveXObject("Microsoft.XMLHTTP");
      }

      request.onreadystatechange=function() {
        if (request.readyState==4 && request.status==200) {     
          setupAjax();  
      }
    }      
    
    if (document.getElementById("chk" + num).checked) {
      val = 1;
    }
    else {
      val = 0;
    }
	
	url = "update_content.php?action=done&id=" + num + "&done=" + val;
    	
	request.open ("GET", url, true);
    request.send();      

  }
  
  function createTable (XML) {
      var table;
      var elements;
      var id, description, done, wdone, wdue;
      var check, idNum;
      elements = XML.documentElement.getElementsByTagName("entry");
      
      table = "<table border = \"1\">";
      
      table += "<tr>";
      table += "<th>ID</th>";
      table += "<th>Done</th>";
      table += "<th>Description</th>";
      table += "<th>When Due</th>";
      table += "<th>When Done</th>";
      table += "</tr>";
      for (i = 0; i < elements.length; i++) {
        id = elements[i].getElementsByTagName ("ID");
        done = elements[i].getElementsByTagName ("Done");
        description = elements[i].getElementsByTagName ("Description");
        wdue = elements[i].getElementsByTagName ("WhenDue");
        wdone = elements[i].getElementsByTagName ("WhenDone");
        
        table +=  "<tr>";

        idNum = id[0].firstChild.nodeValue;
        
        table +=  "<td>" + idNum + "</td>";
  
        check = done[0].firstChild.nodeValue;
                
          
        if (check == 1) {        
          table +=  "<td><input type=\"checkbox\" id=\"chk" + idNum + "\" onClick=\"updateDone(" + idNum + ")\" checked/></td>";
        }
        else {
          table +=  "<td><input type=\"checkbox\" id=\"chk" + idNum + "\" onClick=\"updateDone(" + idNum + ")\"/></td>";
        }
                
        table +=  "<td>" + description[0].firstChild.nodeValue + "</td>";
        
        if (wdue && wdue[0].firstChild) {
          table +=  "<td>" + wdue[0].firstChild.nodeValue + "</td>";
        }
        else {
          table +=  "<td>Unset</td>";
        }

        if (wdone && wdone[0].firstChild) {
          table +=  "<td>" + wdone[0].firstChild.nodeValue + "</td>";
        }
        else {
          table +=  "<td>Unset</td>";
        }

        table += "</tr>";      
      }       
      
      table += "</table>";
      return table;
    }
      
    function setupAjax() {
      var url;
      
      
      if (window.XMLHttpRequest) {
        // Code for modern browsers
        request=new XMLHttpRequest();
      }
      else {
        // code for older versions of Internet Explorer
        request = new ActiveXObject("Microsoft.XMLHTTP");
      }

      request.onreadystatechange=function() {
        if (request.readyState==4 && request.status==200) {     
            if (request.responseXML) {
              document.getElementById("results").innerHTML= createTable (request.responseXML);
            }
        }
      }      
      
      request.open ("GET", "query_content.php", true);
      request.send();
            
    }

  function query_due () {
		var due = document.getElementById ("query");
        if (!validate ("query")) {
          alert ("Please enter a date");
          return;
        }
            
        if (window.XMLHttpRequest) {
        // Code for modern browsers
          request=new XMLHttpRequest();
        }
        else {
          // code for older versions of Internet Explorer
          request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        request.onreadystatechange=function() {
          if (request.readyState==4 && request.status==200) {     
              
              document.getElementById("results").innerHTML= createTable (request.responseXML);
        }
      }      
      
      bing = "query_content.php?action=bydate&date=" + due.value;
            
      request.open ("GET", bing, true);
      request.send();      
      }
  
  
      </script>

      <p id = "results"></p>

    <hr />
        
    <form name = "newAssessment">
    
     <h2>Add New Assessment</h2>
     
     <p>Enter Description</p>
     <input type = "text" id = "description">
     <p>When Due</p>
     <input type = "text" id = "due">
     
     <input type = "button" value = "add" onClick="validateDate()">
    </form>

    <h2>Query Due Assessments</h2>
     
    <form name = "querybydate">
     <p>Date After</p>
     <input type = "text" id = "query">
     
     <input type = "button" value = "query" onClick="query_due()">
    </form>
|          
  
  </body>
</html>    