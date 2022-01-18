<?php
namespace Tests\unit;

use SocialPost\Dto\SocialPostTo;
use Statistics\Builder\ParamsBuilder;
use Statistics\Calculator\AveragePostsPerUser;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @package Tests\unit
 */
class StatisticTest extends TestCase
{

    /**
     * @test
     */
    public function test_average_number_of_user_posts_per_month()
    {
        $params = ParamsBuilder::reportStatsParams(new DateTime());

        $calculator = (new AveragePostsPerUser())->setParameters($params[0]);

        $post1 = (new SocialPostTo())
            ->setId("post1")
            ->setAuthorId("user-1")
            ->setText("my first post")
            ->setDate(new DateTime());
        $calculator->accumulateData($post1);

        $post2 = (new SocialPostTo())
            ->setId("post2")
            ->setAuthorId("user-2")
            ->setText("Next first post")
            ->setDate(new DateTime());
        $calculator->accumulateData($post2);

       $post3 = (new SocialPostTo())
           ->setId("post3")
           ->setAuthorId("user-3")
           ->setText("longer message")
           ->setDate(new DateTime());
       $calculator->accumulateData($post3);

       $post4 = (new SocialPostTo())
        ->setId("post4")
        ->setAuthorId("user-1")
        ->setText("longer message")
        ->setDate(new DateTime());
      $calculator->accumulateData($post4);

      $post5 = (new SocialPostTo())
        ->setId("post5")
        ->setAuthorId("user-2")
        ->setText("longer message")
        ->setDate(new DateTime());
        $calculator->accumulateData($post5);

     $post6 = (new SocialPostTo())
        ->setId("post6")
        ->setAuthorId("user-3")
        ->setText("longer message")
        ->setDate(new DateTime());
        $calculator->accumulateData($post6);

        $average_length = $calculator->calculate();

        $this->assertEquals(2, $average_length->getValue());
    }
}
