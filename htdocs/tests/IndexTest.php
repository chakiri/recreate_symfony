<?php

use  PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{

    public function testHello()
    {
        $_GET['name'] = 'Fabien';

        ob_start();
        include 'hello.php';
        $content = ob_get_clean();

        $this->assertEquals('Hello Fabien', $content);
    }
}