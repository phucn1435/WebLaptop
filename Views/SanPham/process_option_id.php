<?php

if (isset($_POST['optionId'])) {
  $selectedId = $_POST['optionId'];

  // Replace with your actual logic to fetch and process data based on $selectedId
  // This could involve database access, calculations, etc.
  $attributeData = [
    "Thuộc tính 1" => "Giá trị 1",
    "Thuộc tính 2" => "Giá trị 2",
    "Thuộc tính 3" => "Giá trị 3",
    // Add more attributes and values as needed
  ];

  // Convert attribute data to HTML format
  $attributeHTML = "<ul>";
  foreach ($attributeData as $key => $value) {
    $attributeHTML .= "<li>" . $key . ": " . $value . "</li>";
  }
  $attributeHTML .= "</ul>";

  echo $attributeHTML; // Send the HTML-formatted attribute data back to the JavaScript
} else {
  echo "Error: No option ID received";
}
