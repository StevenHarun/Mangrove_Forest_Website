<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReportTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function test_example(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Log In')
                    ->press('LOG IN')
                    ->assertPathIs('/login')
                    ->type('email', 'pemda@example.com')
                    ->type('password', 'password')
                    ->press('LOG IN')
                    ->assertPathIs('/home');
        });
    }
}
