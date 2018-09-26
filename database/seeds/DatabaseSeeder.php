<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class,10)->create();

        $users->each(function(App\User $user) use ($users){
        	factory(App\Job::class, 5)->create([
        		'user_id' => $user->id,
        	]);
        });
    }
}
