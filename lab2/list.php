<?php
$uploads_dir = 'uploads';

// Перевірка наявності папки 'uploads'
if (is_dir($uploads_dir)) {
    $files = scandir($uploads_dir);

    // Фільтруємо лише файли
    $files = array_diff($files, ['.', '..']);

    if (count($files) > 0) {
        echo "<h2>Список файлів у папці 'uploads':</h2><ul>";
        foreach ($files as $file) {
            echo "<li><a href='$uploads_dir/$file'>$file</a></li>";
        }
        echo "</ul>";
    } else {
        echo "Файли відсутні у папці 'uploads'.";
    }
} else {
    echo "Папка 'uploads' ще не створена.";
}
?>
