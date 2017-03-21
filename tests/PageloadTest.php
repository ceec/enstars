<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageloadTest extends TestCase
{
    /**
     * Test the load of the home page
     *
     * @return void
     */
    public function testIndex()
    {
        $this->visit('/')
             ->see('enstars.info');
    }

    /**
     * Test the load of the translation page
     *
     * @return void
     */
    public function testTranslationDisplay()
    {
        $this->visit('/story/1/1')
             ->see('The Scrolls of Wind and Clouds');
    }


    //////events//////

    /**
     * Test the load of the event list
     *
     * @return void
     */
    public function testEventAllDisplay()
    {
        $this->visit('/event/all')
             ->see('All Events');
    }


    /**
     * Test the load of one event
     *
     * @return void
     */
    public function testEventOneDisplay()
    {
        $this->visit('/event/chocolate-fest-2')
             ->see('Melty Sweet Chocolate Fest');
    }

    ///scouts//////


    /**
     * Test the load of the scout list
     *
     * @return void
     */
    public function testScoutAllDisplay()
    {
        $this->visit('/scout/all')
             ->see('All Scouts');
    }


    /**
     * Test the load of one scout
     *
     * @return void
     */
    public function testScoutOneDisplay()
    {
        $this->visit('/scout/salon-de-the')
             ->see('Salon de Th');
    }

    ////////tags/////////////

    /**
     * Test the load of tags page - tums
     *
     * @return void
     */
    public function testTagDisplay()
    {
        $this->visit('/tag/tums')
             ->see('tums');
    }






}
