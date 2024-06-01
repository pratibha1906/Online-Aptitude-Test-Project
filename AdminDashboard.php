<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="AdminDashboard.css">
  <!-- Include Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<ul class="menu">
  <li><a href="#" onclick="toggleSection('home')">Home</a></li>
  <li><a href="#" onclick="toggleSection('addTest')">Add Test</a></li>
  <li><a href="#" onclick="toggleSection('setTest')">Set Test</a></li>
  <li><a href="FrontPage.php" >Logout</a></li>
</ul>

<div id="home" class="section active">
  <img src="Home1.jpg" alt="Home Image" style="width: 100%; height: 515px;">
</div>
<!-- Sections -->
<div id="setTest" class="section">
  <!-- First Row -->
  <div class="row">
    <div><b>Add Questions</b></div>
    <div class="buttons">
      <button class="add" onclick="AddQuestion()"><i class="fas fa-plus"></i></button>
    </div>
  </div>
  <!-- Second Row -->
  <div class="row">
    <div><b>Edit Questions</b></div>
    <div class="buttons">
      <button class="edit" onclick="EditQuestion()"><i class="fas fa-edit"></i></button>
    </div>
  </div>
  <!-- Third Row -->
  <div class="row">
    <div><b>Delete Questions</b></div>
    <div class="buttons">
      <button class="delete" onclick="DeleteQuestion()"><i class="fas fa-trash-alt"></i></button>
    </div>
  </div>
</div>

<div id="addTest" class="section">
  <h2>Add Test</h2>
  <form id="AddTestForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Test Name: <input type="text" name="testname">
    <input type="submit" value="Save">
    <button type="button" class="btn-clear" onclick="clearForm()">Clear</button>
  </form>
  <!-- Display added tests -->
  <?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "onlineaptitudetest";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        echo "Connection Failed";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tname = $_POST['testname'];
        $sql = "INSERT INTO addtest(tname) VALUES ('$tname')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Test added successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Fetch added tests
    $sql = "SELECT tname FROM addtest";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Added Tests:</h3>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row['tname'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No tests added yet.</p>";
    }

    mysqli_close($conn);
  ?>
</div>

<div id="logout" class="section">
  
  
</div>

<script>
  function toggleSection(id, closeOthers = true) {
    var section = document.getElementById(id);
    var isActive = section.classList.contains('active');
    
    if (!isActive) {
      section.classList.add('active');
      if (closeOthers) {
        var sections = document.querySelectorAll('.section');
        sections.forEach(function(sec) {
          if (sec.id !== id) {
            sec.classList.remove('active');
          }
        });
      }
    }
  }

  function AddQuestion() {
    window.location.href = "AddNewQuestion.php"; 
  }
  
  function DeleteQuestion() {
    window.location.href = "DeleteQuestion.html"; 
  }
  function EditQuestion() {
    window.location.href = "EditQuestion.php"; 
  }
  function clearForm() {
    document.getElementById("AddTestForm").reset();
  }

  </script>
</body>
</html>
