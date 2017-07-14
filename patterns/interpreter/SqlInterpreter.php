<?php

namespace interpreter;

class SqlInterpreter
{
    private $tableName = '';
    private static $instance;

    public static function table($tableName = '')
    {
        if (!self::$instance instanceof self) { // instanceof运算符的优先级高于!
            self::$instance = new self();
        }
        self::$instance->setTable($tableName);
        return self::$instance;
    }

    private function setTable($tableName = '')
    {
        $this->tableName = $tableName;
    }

    public function insert($data = [])
    {
        $fields = array_map([$this, "tweak"], array_keys($data));
        $values = array_map([$this, "tweak"], array_values($data));
        $filedString = join(', ', $fields);
        $valueString = join(', ', $values);

        $sql = "insert into `{$this->tableName}` ({$filedString}) values ({$valueString})";
        echo $sql . PHP_EOL;
    }

    public function delete($data = [])
    {
        $where = [];
        foreach ($data as $k => $v) {
            $where[] = "`{$k}` = '{$v}'";
        }
        $whereString = join(' and ',$where);

        $sql = "delete from `{$this->tableName}` where ({$whereString})";
        echo $sql . PHP_EOL;
    }

    public function update($data = [])
    {
        $set = [];
        foreach ($data as $k => $v) {
            $set[] = "`{$k}` = '{$v}'";
        }
        $setString = join(' and ',$set);

        $sql = "update `{$this->tableName}` set ({$setString})";
        echo $sql . PHP_EOL;
    }

    public function find($data = [])
    {
        $where = [];
        foreach ($data as $k => $v) {
            $where[] = "`{$k}` = '{$v}'";
        }
        $whereString = join(' and ',$where);

        $sql = "select * from `{$this->tableName}` where ({$whereString})";
        echo $sql . PHP_EOL;
    }

    private function tweak($s)
    {
        return '`' . $s . '`';
    }
}