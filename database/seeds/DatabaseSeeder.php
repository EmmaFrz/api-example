<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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

        $categories = factory(App\Category::class,10)->create();

        $users->each(function(App\User $user) use ($users){
        	factory(App\Job::class, 5)->create([
        		'user_id' => $user->id,
                'category_id' => random_int(1, 10),
        	]);
        });

        $reviews = factory(App\Review::class,30)->create();

         Model::unguard();

            $this->call('PermissionsTableSeeder');
            $this->call('RolesTableSeeder');
            $this->call('ConnectRelationshipsSeeder');
            //$this->call('UsersTableSeeder');

        Model::reguard();
    }
}
