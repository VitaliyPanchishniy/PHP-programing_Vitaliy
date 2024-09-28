<?php
// Перевірка, чи був файл завантажений
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Перевірка, чи це дійсно файл, завантажений користувачем
    if (is_uploaded_file($file['tmp_name'])) {
        // Перевірка типу файлу
        $allowed_types = ['image/png', 'image/jpg', 'image/jpeg'];
        if (in_array($file['type'], $allowed_types)) {
            // Перевірка розміру файлу (не більше 2 МБ)
            if ($file['size'] <= 2 * 1024 * 1024) {
                $uploads_dir = 'uploads';
                // Перевірка, чи існує папка 'uploads', якщо ні - створюємо
                if (!is_dir($uploads_dir)) {
                    mkdir($uploads_dir, 0777, true);
                }

                $file_name = basename($file['name']);
                $target_file = $uploads_dir . '/' . $file_name;

                // Перевірка, чи файл з таким іменем вже існує
                if (file_exists($target_file)) {
                    // Додавання унікального суфіксу (дата та час) до імені файлу
                    $file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                    $target_file = $uploads_dir . '/' . $file_name;
                }

                // Переміщення файлу до папки 'uploads'
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    echo "Файл успішно завантажено.<br>";
                    echo "Ім'я файлу: " . $file_name . "<br>";
                    echo "Тип файлу: " . $file['type'] . "<br>";
                    echo "Розмір файлу: " . round($file['size'] / 1024, 2) . " KB<br>";
                    echo "<a href='$target_file'>Завантажити файл</a><br>";
                } else {
                    echo "Помилка під час завантаження файлу.";
                }
            } else {
                echo "Файл занадто великий. Максимальний розмір 2 МБ.";
            }
        } else {
            echo "Дозволено завантажувати лише зображення (png, jpg, jpeg).";
        }
    } else {
        echo "Файл не був завантажений.";
    }
} else {
    echo "Файл не вибраний.";
}
?>
