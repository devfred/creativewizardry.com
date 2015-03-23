<?php

use Laracasts\TestDummy\DbTestCase;
use Laracasts\TestDummy\Factory;
use \App\Repositories\ContentItemRepository;

class ContentControllerTest extends DbTestCase {

    public function setUp()
    {
        parent::setUp();
        $this->repository = new ContentItemRepository;
    }

    public function testContentApiRoutesExists()
	{
        $response = $this->call('GET', '/API/content/');

        $this->assertEquals(200, $response->getStatusCode());
	}

    public function testGetContentByUserId()
    {
        $user = Factory::create('App\User');

        $contentItems = Factory::times(2)->create('App\ContentItem', ['user_id'=> $user->id]);

        Factory::times(3)->create('App\ContentItem');

        $threads = $this->repository->getContentByUserId($user->id);

        $this->assertCount(2,$threads);

    }

}
