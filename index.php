<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛР №4</title>
</head>
<body>

<?php

function readTextFile($filename) { // Приймає ім'я файлу як параметр, перевіряє існування.
    if (file_exists($filename)) { 
        return file_get_contents($filename);
    } else {
        return "Файл не знайдено.";
    }
}


function writeTextFile($filename, $content) { // Приймає ім'я файлу та його вміст як параметри.
    file_put_contents($filename, $content); // Запис вмісту у файл.
}
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_POST['filename'] . '.txt'; 
    $content = $_POST['content']; 

    writeTextFile($filename, $content);
}

$files = glob("code.txt"); 
foreach ($files as $file) { // Генерація веб-сторінки на основі коду в файлі
    $filename = pathinfo($file, PATHINFO_FILENAME); 
    $content = readTextFile($file); 

    echo "<p>$content</p>";

    echo "<form action='#' method='post'>";
    echo "<input type='hidden' name='filename' value='$filename'>";
    echo "<textarea name='content' rows='25' cols='60'>$content</textarea><br>";
    echo "<input type='submit' value='submit'>";
    echo "</form>";
}
?>

</body>
</html>
