<?php

class Forum
{
    /**
     * @var int
     */
    protected $itemsPerPage = 10;

    /**
     * Получить список тем
     *
     * @param int $page
     * @return array
     */
    public function getThreadList($page = 1)
    {
        $db = Connection::getConnection();
        $offset = intval(($page - 1) * $this->itemsPerPage);
        $limit = intval($this->itemsPerPage);
        $query = <<<SQL
SELECT t.*, a.userName as authorName, c.postId as lastPostId, c.cnt as postNumber FROM threads t
INNER JOIN users a ON (t.userId = a.userId)
INNER JOIN (SELECT threadId, max(postId) as postId, count(*) as cnt FROM posts  GROUP BY threadId) c ON (c.threadId = t.threadId)
LIMIT $offset, $limit
SQL;
        $stmt = $db->query($query);
        $threads = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $thread = new Thread();
            $thread->fromArray($row);
            $threads[] = $thread;
        }


        return $threads;
    }

    /**
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
    }


}