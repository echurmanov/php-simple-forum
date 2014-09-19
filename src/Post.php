<?php

class Post extends AbstractModel
{
    /**
     * @var number
     */
    protected $postId;

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
    protected $content;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var array
     */
    protected $fieldMap = array(
        'postId' => 'postId',
        'threadId' => 'threadId',
        'userId' => 'userId',
        'content' => 'content',
        'created' => 'created',
    );

    /**
     * Имя таблицы
     *
     * @var string
     */
    protected $tableName = 'posts';

    /**
     * Ключевое поле
     *
     * @var string
     */
    protected $keyField = 'postId';

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return number
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param number $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return number
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * @param number $threadId
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;
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
     *
     *
     * @return DateTime
     */
    public function getDate()
    {
        $date = new DateTime($this->created);
        return $date;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        if ($this->user == null) {
            $this->user = User::getById($this->userId);
        }
        return $this->user;
    }

}