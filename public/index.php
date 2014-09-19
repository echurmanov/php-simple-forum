<?php

include_once (__DIR__ . '/../src/bootstrap.php');

if (isset($_GET['action']) && $_GET['action'] = 'newThread') {
    $thread = new Thread();
    $thread->setThreadTitle(trim($_POST['threadTitle']));
    $userName = trim($_POST['userName']);
    $user = User::getByName($userName);
    if ($user == null) {
        $user = new User();
        $user->setUserName($userName);
        $user->setRegistryDate(date('Y-m-d H:i:s'));
        $user->insert();
    }
    $thread->setUserId($user->getUserId());
    $thread->setCreated(date('Y-m-d H:i:s'));
    $thread->insert();

    $post = new Post();
    $post->setUserId($user->getUserId());
    $post->setThreadId($thread->getThreadId());
    $post->setCreated(date('Y-m-d H:i:s'));
    $post->setContent(trim($_POST['content']));
    $post->insert();
    header("Location: /index.php?thread=" . $thread->getThreadId());
    die();

}

?>
<html>
    <head>
        <title>Форум</title>
        <meta charset="utf-8"/>
    </head>
    <body> <?php
$view = View::getView(View::VIEW_MAIN);
$view->show();
?>
    </body>
</html>