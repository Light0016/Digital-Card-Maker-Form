<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital_cards";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$education = $_POST['education'];
$description = $_POST['description'];


$photo = $_FILES['photo']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($photo);

if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
    $photo_path = $target_file;
} else {
    $photo_path = "default.jpg"; 
}


$sql = "INSERT INTO cards (name, age, gender, address, education, description, photo)
VALUES ('$name', '$age', '$gender', '$address', '$education', '$description', '$photo_path')";

if ($conn->query($sql) === TRUE) {
    echo "<html><head>";
    echo "<style>
        body {
            background: linear-gradient(135deg, #e66465, #9198e5);
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
        }
        .notification-container {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            color: #f7f7f7;
            font-size: 22px;
            font-weight: bold;
            width: 100%;
            max-width: 400px;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        .card-container {
            width: 400px;
            padding: 25px;
            border-radius: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            color: #f7f7f7;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .card-container:before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15), rgba(0, 0, 0, 0));
            z-index: 0;
        }
        .card-photo img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            margin-top: 10px;
            z-index: 1;
            position: relative;
        }
        .card-details {
            margin-top: 20px;
            z-index: 1;
            position: relative;
        }
        .card-details h3 {
            font-size: 24px;
            margin: 10px 0;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }
        .card-details p {
            margin: 5px 0;
            font-size: 16px;
            line-height: 1.4;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }
        .card-description {
            margin-top: 20px;
            padding: 15px;
            font-size: 15px;
            line-height: 1.5;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            z-index: 1;
            position: relative;
        }
        .card-social {
            margin-top: 15px;
            z-index: 1;
            position: relative;
        }
        .card-social a {
            margin: 0 8px;
            transition: transform 0.3s;
        }
        .card-social img {
            width: 28px;
            height: 28px;
        }
        .card-social a:hover {
            transform: scale(1.1);
        }
    </style>";
    echo "</head><body>";
    echo "<div class='notification-container'>Card Created Successfully!</div>";
    echo "<div class='card-container'>";
    echo "<div class='card-photo'>";
    echo "<img src='$photo_path' alt='Photo of $name'>";
    echo "</div>";
    echo "<div class='card-details'>";
    echo "<h3>$name</h3>";
    echo "<p>Age: $age</p>";
    echo "<p>Gender: $gender</p>";
    echo "<p>Address: $address</p>";
    echo "<p>Education: $education</p>";
    echo "</div>";
    echo "<div class='card-description'>";
    echo "<p>$description</p>";
    echo "</div>";
    echo "<div class='card-social'>";
    echo "<a href='#'><img src='icons/facebook.png' alt='Facebook'></a>";
    echo "<a href='#'><img src='icons/instagram.png' alt='Instagram'></a>";
    echo "<a href='#'><img src='icons/twitter.png' alt='Twitter'></a>";
    echo "</div>";
    echo "</div>";
    echo "</body></html>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
