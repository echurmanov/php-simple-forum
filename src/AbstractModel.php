<?php

abstract class AbstractModel
{

    /**
     * Соотвнощение между полями в базе и свойствами класса
     *
     * @var array
     */
    protected $fieldMap = array();

    /**
     * Имя таблицы
     *
     * @var string
     */
    protected $tableName = '';

    /**
     * Ключевое поле
     *
     * @var string
     */
    protected $keyField = '';

    /**
     * @param $id
     * @return null|static
     */
    static public function getById($id)
    {
        $db = Connection::getConnection();
        $obj = new static();
        $stmt = $db->prepare("SELECT * FROM {$obj->tableName} WHERE {$obj->keyField} = :id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $obj->fromArray($row);
        return $obj;
    }

    public function insert()
    {
        $data = $this->toArray();
        print_r ($data);
        $fields = array_keys($this->fieldMap);
        unset($fields[array_search($this->keyField, $fields)]);

        $fieldHolders = [];
        foreach ($fields as $field) {
            $fieldHolders[] = ":{$field}";
        }

        $db = Connection::getConnection();
        $sql = "INSERT INTO {$this->tableName} (" . implode(', ', $fields) . ") "
                . "VALUES (" . implode(', ', $fieldHolders) . ")";
echo $sql;
        $stmt = $db->prepare($sql);
        foreach ($fields as $field) {
            $prop = $this->fieldMap[$field];
            $stmt->bindParam(":{$field}", $this->$prop);
        }

        $stmt->execute();
        $keyField = $this->keyField;
        $keyProp = $this->fieldMap[$keyField];
        $this->$keyProp = $db->lastInsertId();

    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();
        foreach ($this->fieldMap as $field => $prop) {
            $result[$field] = $this->$prop;
        }
        return $result;
    }

    /**
     * Заполнение полей объекта
     *
     * @param array $array
     */
    public function fromArray($array = array()) {
        foreach ($this->fieldMap as $field => $prop) {
            if (array_key_exists($field, $array)) {
                $this->$prop = $array[$field];
            }
        }
    }
}