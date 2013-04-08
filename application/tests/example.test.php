<?php

class TestExample extends PHPUnit_Framework_TestCase {

    /**
     * Test that a given condition is met.
     *
     * @return void
     */
    public function testSomething()
    {
        //$this->assertTrue(true);
        $response = Controller::call('login@index');
        //var_dump($response);
        $this->assertEquals('200', $response->status());

        $response = Controller::call('login@check');
        $this->assertTrue($response->foundation->isRedirect('http://:/index.php/login/error'));
        //$this->assertEquals('200', $response->status());

        $response = Controller::call('user@index');
        $this->assertTrue($response->foundation->isRedirect('http://:/index.php/login'));

        //echo $response->content;
        //$this->assertNotNull($response);
        //var_dump($response);  
        //echo $response->content->view;
        //echo $response->foundation->
        //$response = Controller::call('login@fuck');
        //$this->assertEquals('404', $response->status());
        
    }

}