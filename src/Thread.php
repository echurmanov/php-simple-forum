<?php


class Thread extends AbstractModel
{
    /**
     * @var number
     */
    protected $threadId;

    /**
     * @var number
     */
    protected $userId;

    /**
     * @var string
     */
    protected $authorName;

    /**
     * @var string
     */
    protected $threadTitle;

    /**
     * @var number
     */
    protected $lastPostId;

    /**
     * @var Post
     */
    protected $lastPost;

    /**
     * @var number
     */
    protected $postNumber;

    protected $created;

    /**
     * Имя таблицы
     *
     * @var string
     */
    protected $tableName = 'threads';

    /**
     * Ключевое поле
     *
     * @var string
     */
    protected $keyField = 'threadId';


    /**
     * @var array
     */
    protected  $fieldMap = array(
        'threadId' => 'threadId',
        'userId' => 'userId',
        'threadTitle' => 'threadTitle',
        'created' => 'created',
    );


    /**
     * @return mixed
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * @param mixed $threadId
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;
    }

    /**
     * @return mixed
     */
    public function getThreadTitle()
    {
        return $this->threadTitle;
    }

    /**
     * @param mixed $threadTitle
     */
    public function setThreadTitle($threadTitle)
    {
        $this->threadTitle = $threadTitle;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return number
     */
    public function getLastPostId()
    {
        return $this->lastPostId;
    }

    /**
     * @param number $lastPostId
     */
    public function setLastPostId($lastPostId)
    {
        $this->lastPostId = $lastPostId;
    }

    /**
     * @return number
     */
    public function getPostNumber()
    {
        return $this->postNumber;
    }

    /**
     * @param number $postNumber
     */
    public function setPostNumber($postNumber)
    {
        $this->postNumber = $postNumber;
    }

    /**
     * @return Post
     */
    public function getLastPost()
    {
        if ($this->lastPost == null) {
            $this->lastPost = Post::getById($this->lastPostId);
        }
        return $this->lastPost;
    }

    /**
     * Получить количество тем
     *
     * @return int
     */
    static public function getCount()
    {
        $obj = new self();
        $db = Connection::getConnection();
        $res = $db->query("SELECT count(*) as cnt FROM " . $obj->tableName);
        $number = intval($res->fetchColumn());
        return $number;
    }

    /**
     * @return number
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param number $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }


    /**
     * Заполнение полей объекта
     *
     * @param array $array
     */
    public function fromArray($array = array()) {
        $fieldMap = array(
            'threadId' => 'threadId',
            'userId' => 'userId',
            'authorName' => 'authorName',
            'threadTitle' => 'threadTitle',
            'lastPostId' => 'lastPostId',
            'postNumber' => 'postNumber',
            'created' => 'created',
        );
        foreach ($fieldMap as $field => $prop) {
            if (array_key_exists($field, $array)) {
                $this->$prop = $array[$field];
            }
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();
        foreach ($fieldMap as $field => $prop) {
            $result[$field] = $this->$prop;
        }
        return $result;
    }

}