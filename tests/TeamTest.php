<?php

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_team_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);
    }

    /** @test */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function has_been_riched_max_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user);
        $team->add($user2);

        $this->expectException(\Exception::class);

        $user3 = factory(User::class)->create();
        $team->add($user3);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_can_remove_a_member()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());

        $team->remove($users->first());

        $this->assertEquals(1, $team->count());
    }

    /** @test **/
    public function a_team_can_remove_a_few_members_at_once(){
        $team = factory(Team::class)->create(['size' => 3]);

        $users = factory(User::class, 3)->create();

        $team->add($users);

        $team->removeMany($users->slice(0, 2));

        $this->assertEquals(1, $team->count());
    }

    /** @test */
    public function a_team_can_remove_members_at_once()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());

        $team->restart();

        $this->assertEquals(0, $team->count());
    }
}
