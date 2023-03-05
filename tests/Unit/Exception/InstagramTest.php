<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Exception;

use Exception;
use Illuminate\Database\QueryException;
use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class InstagramTest extends Instagram
{
    public function test_exception_reached()
    {
        $exception = (new InstagramException)->render(new Exception('', 403));
        $this->assertEquals(
            '{"message":"Instagram API usage cap reached, please wait"}',
            $exception->content()
        );

        $this->assertEquals(403, $exception->getStatusCode());
    }

    public function test_exception_query()
    {
        $exception = (new InstagramException)->render(
            new QueryException(null, null, [], new \PDOException())
        );

        $this->assertEquals(500, $exception->getStatusCode());

    }

    public function test_exception_unknown()
    {
        $exception = (new InstagramException)->render(new Exception('What are you doing bro ?', 0));

        $this->assertEquals(500, $exception->getStatusCode());
        $this->assertEquals(
            '{"message":"What are you doing bro ?"}',
            $exception->content()
        );
    }

    public function test_exception_others()
    {
        $exception = (new InstagramException)->render(
            new Exception('The server cannot process your request', 422)
        );

        $this->assertEquals(422, $exception->getStatusCode());
        $this->assertEquals(
            '{"message":"The server cannot process your request"}',
            $exception->content()
        );
    }

    /**
     * @throws Exception
     */
    public function test_exception_production_is_authenticated()
    {
        self::fakeProfile();

        $exception = new InstagramException;
        $exception->testing = true;
        $myExeption = new Exception('Code 0 without trace', 0);
        $render = $exception->render($myExeption);
        $content = json_decode($render->content());

        $expected = [
            'message' => 'Code 0 without trace',
            'profile' => self::$instagram::getProfile(),
            'traces' => $content->traces
        ];

        $this->assertEquals(500, $render->getStatusCode());
        $this->assertEquals(json_encode($expected), $render->content());
    }

    /**
     * @throws Exception
     */
    public function test_exception_production_no_authenticated()
    {
        $exception = new InstagramException;
        $exception->testing = true;
        $myExeption = new Exception('Code 0 without trace', 0);
        $render = $exception->render($myExeption);
        $content = json_decode($render->content());

        $expected = [
            'message' => 'Code 0 without trace',
            'authorizeUrl' => self::$instagram::authorizeUrl(),
            'traces' => $content->traces
        ];

        $this->assertEquals(500, $render->getStatusCode());
        $this->assertEquals(json_encode($expected), $render->content());
    }
}