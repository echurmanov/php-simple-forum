<?php
    if (!empty($this->threads)):
?>
<table class="threads">
    <thead>
        <th>Темы</th>
        <th>Кол-во.<br/>ответов</th>
        <th>Автор</th>
        <th>Последний ответ</th>
    </thead>
    <tbody>
<?php
    foreach ($this->threads as $thread):
        /** @var Thread $thread */
?>
    <tr>
        <td><a href="/index.php?thread=<?php echo $thread->getThreadId(); ?>"><?php echo htmlentities($thread->getThreadTitle());?></a></td>
        <td><?php echo $thread->getPostNumber(); ?></td>
        <td><?php echo htmlentities($thread->getAuthorName()); ?></td>
        <td><?php echo htmlentities($thread->getLastPost()->getAuthor()->getUserName()) . '(' .
            $thread->getLastPost()->getDate()->format('H:i Y.m.d')
                . ')';
        ?></td>
    </tr>
<?php
    endforeach;
?>
    </tbody>
</table>
<hr>
<?php
    for($i = 1; $i <= $this->pageNumber; $i++):
        if ($this->page == $i):?>
<b><?php echo $i;?></b>
<?php
        else:?>
<a href="/index.php?page=<?php echo $i;?>"><?php echo $i;?></a>
<?php
        endif;
    endfor;
else:?>
Пока пусто
<?php
endif;
?>
<hr>
<h2>Создать новую тему</h2>
<form action="/index.php?action=newThread" method="post">
    <label>Ваше имя</label><input name="userName" type="text"/><br/>
    <label>Название темы:</label><input name="threadTitle" type="text"/><br/>
    <label>Текст:</label><br/>
    <textarea name="content" style="width:500px; height 300px;"></textarea>
    <br/>
    <input type="submit" value="Создать тему"/>
</form>