<?php

require 'JsonPlaceholderAPI.php';

$api = new JsonPlaceholderAPI();

// Получение пользователей
$users = $api->getUsers();
echo "Пользователи:\n";
foreach ($users as $user) {
    echo "ID: {$user['id']}, Имя: {$user['name']}, Email: {$user['email']}\n";
}

// Получение постов для пользователя с ID=1
$userId = 1;
$userPosts = $api->getUserPosts($userId);
echo "\nПосты пользователя с ID={$userId}:\n";
foreach ($userPosts as $post) {
    echo "ID: {$post['id']}, Заголовок: {$post['title']}\n";
}

// Получение заданий для пользователя с ID=1
$userTodos = $api->getUserTodos($userId);
echo "\nЗадания пользователя с ID={$userId}:\n";
foreach ($userTodos as $todo) {
    echo "ID: {$todo['id']}, Задание: {$todo['title']}, Завершено: " . ($todo['completed'] ? 'Да' : 'Нет') . "\n";
}

// Добавление нового поста
$newPostData = [
    "title" => "Новый пост",
    "body" => "Это содержимое нового поста",
    "userId" => $userId,
];
$newPost = $api->addPost($newPostData);
echo "\nДобавлен новый пост с ID={$newPost['id']}\n";

// Редактирование поста с ID=1
$postIdToEdit = 1;
$editedPostData = [
    "title" => "Отредактированный пост",
    "body" => "Это отредактированное содержимое поста",
];
$editedPost = $api->editPost($postIdToEdit, $editedPostData);
echo "\nОтредактирован пост с ID={$postIdToEdit}\n";

// Удаление поста с ID=1
$postIdToDelete = 1;
$deleted = $api->deletePost($postIdToDelete);
if ($deleted) {
    echo "\nПост с ID={$postIdToDelete} удален\n";
} else {
    echo "\nНе удалось удалить пост с ID={$postIdToDelete}\n";
}
