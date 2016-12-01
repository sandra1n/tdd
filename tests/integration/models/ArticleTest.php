<?php
use App\Article;

use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Created by SmashingTeam.
 * User: sandra1n
 * Date: 11/28/16
 * Time: 11:57 AM
 */
class ArticleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_fetches_trending_articles()
    {
        factory(Article::class, 2)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        $articles = Article::trending();

        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(3, $articles);
    }
}