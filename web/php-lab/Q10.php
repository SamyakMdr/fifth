<?php
// Define the file path
$filePath = 'sample.txt';

// Read the original content
$originalContent = file_get_contents($filePath);

// Create the updated content by adding a new line
$updatedContent = $originalContent . "\nThis line was added by the PHP script.";

// Write the updated content back to the file
file_put_contents($filePath, $updatedContent);

// Display both versions for comparison
echo "<h2>Original Content:</h2>";
echo "<pre>" . htmlspecialchars($originalContent) . "</pre>";

echo "<h2>Updated Content:</h2>";
echo "<pre>" . htmlspecialchars($updatedContent) . "</pre>";

echo "<p>File has been successfully updated.</p>";
echo "<pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>";
?>