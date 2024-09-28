<?php
$log_file = 'log.txt';

// Якщо є введений текст - записуємо у файл
if (isset($_POST['text'])) {
    $text = htmlspecialchars($_POST['text']);
    file_put_contents($log_file, $text . PHP_EOL, FILE_APPEND);
    echo "Текст успішно записано у файл.<br>";
}

// Читання та виведення вмісту файлу log.txt
if (file_exists($log_file)) {
    echo "<h3>Вміст файлу log.txt:</h3>";
    echo nl2br(file_get_contents($log_file));
} else {
    echo "Файл log.txt ще не створений.";
}
?>
