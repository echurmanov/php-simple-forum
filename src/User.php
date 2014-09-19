<?php

class User extends AbstractModel
{
    protected $userId;

    protected $userName;

    protected $registryDate;


    /**
     * Соотвнощение между полями в базе и свойствами класса
     *
     * @var array
     */
    protected $fieldMap = array(
        'userId' => 'userId',
        'userName' => 'userName',
        'registryDate' => 'registryDate',
    );

    /**
     * Имя таблицы
     *
     * @var string
     */
    protected $tableName = 'users';

    /**
     * Ключевое поле
     *
     * @var string
     */
    protected $keyField = 'userId';

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getRegistryDate()
    {
        return $this->registryDate;
    }

    /**
     * @param mixed $registryDate
     */
    public function setRegistryDate($registryDate)
    {
        $this->registryDate = $registryDate;
    }

    static public function getByName($name)
    {
        $db = Connection::getConnection();
        $obj = new User();
        $stmt = $db->prepare("SELECT * FROM {$obj->tableName} WHERE userName = :name");
        $stmt->bindParam('name', $name);
        $stmt->execute();
        $row =$stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $obj->fromArray($row);
        return $obj;
    }

}