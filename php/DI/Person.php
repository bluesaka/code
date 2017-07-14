<?php

namespace DI;

class Person
{
    private $attrs;

    /**
     * 这就是DI依赖注入的雏形
     * 没有内部依赖（比如初始化、构造函数等方法中直接去new另外一个对象）
     * 由外部以参数或者其他形式注入，都属于依赖注入
     * @param PersonInterface $person
     */
    public function __construct(PersonInterface $person)
    {
        $this->attrs[] = $person;
    }

    public function addAttr(PersonInterface $person)
    {
        $this->attrs[] = $person;
    }

    public function getAttrs()
    {
        return $this->attrs;
    }

    public function printAttrs()
    {
        foreach ($this->attrs as $attr) {
            /**@var PersonInterface $attr */
            $attr->create();
        }
    }
}