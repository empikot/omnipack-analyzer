<?php

class HealthCheckTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/health');

        $this->assertEquals(
            'OK', $this->response->getContent()
        );
    }
}
