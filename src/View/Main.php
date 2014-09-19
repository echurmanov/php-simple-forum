<?php

class View_Main extends View
{
    /**
     * Список тем для показа
     *
     * @var array
     */
    public $threads;

    /**
     * Количество страниц
     *
     * @var int
     */
    public $pageNumber;

    protected $view = 'main.php';

    /**
     * Текущая страница
     *
     * @var int
     */
    public $page;

    public function action()
    {
        $page = 1;
        if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
        }
        $forum = new Forum();
        $pages = ceil(Thread::getCount() / $forum->getItemsPerPage());

        $this->threads = $forum->getThreadList($page);
        $this->pageNumber = $pages;
        $this->page = $page;
    }


}