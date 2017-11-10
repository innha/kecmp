<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eloquent::unguard();

        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('privileges')->truncate();
        DB::table('photos')->truncate();
        DB::table('provinces')->truncate();
        DB::table('districts')->truncate();
        DB::table('sectors')->truncate();
        DB::table('cells')->truncate();
        DB::table('villages')->truncate();
        DB::table('dioceses')->truncate();
        DB::table('parishes')->truncate();
        DB::table('chapelles')->truncate();
        DB::table('zones')->truncate();
        DB::table('categories')->truncate();
        DB::table('duties')->truncate();
        DB::table('services')->truncate();
        DB::table('types')->truncate();
        DB::table('commissions')->truncate();
        DB::table('choirs')->truncate();
        DB::table('statuses')->truncate();
        DB::table('degrees')->truncate();
        DB::table('registrations')->truncate();
        DB::table('baptisms')->truncate();
        DB::table('bridals')->truncate();
        DB::table('burials')->truncate();
        DB::table('kids')->truncate();
        DB::table('literacies')->truncate();
        DB::table('marriages')->truncate();
        DB::table('preachings')->truncate();
        DB::table('receptions')->truncate();
        DB::table('recommendations')->truncate();
        DB::table('repentings')->truncate();
        DB::table('suspensions')->truncate();
        DB::table('teachings')->truncate();

        factory(App\Zone::class, 1)->create();
        factory(App\Chapelle::class, 1)->create();
        factory(App\Parish::class, 1)->create();
        factory(App\Diocese::class, 1)->create();
        factory(App\Village::class, 1)->create();
        factory(App\Cell::class, 1)->create();
        factory(App\Sector::class, 1)->create();
        factory(App\District::class, 1)->create();
        factory(App\Province::class, 2)->create();
        factory(App\Photo::class, 1)->create();
        factory(App\Privilege::class, 2)->create();
        factory(App\Role::class, 2)->create();
        factory(App\User::class, 1)->create();
        factory(App\Category::class, 2)->create();
        factory(App\Duty::class, 2)->create();
        factory(App\Service::class, 2)->create();
        factory(App\Type::class, 3)->create();
        factory(App\Commission::class, 2)->create();
        factory(App\Choir::class, 1)->create();
        factory(App\Status::class, 1)->create();
        factory(App\Degree::class, 2)->create();
        factory(App\Registration::class, 15)->create();
        factory(App\Baptism::class, 1)->create();
        factory(App\Bridal::class, 1)->create();
        factory(App\Burial::class, 1)->create();
        factory(App\Kid::class, 1)->create();
        factory(App\Literacy::class, 1)->create();
        factory(App\Marriage::class, 1)->create();
        factory(App\Preaching::class, 1)->create();
        factory(App\Reception::class, 1)->create();
        factory(App\Recommendation::class, 1)->create();
        factory(App\Repenting::class, 1)->create();
        factory(App\Suspension::class, 1)->create();
        factory(App\Teaching::class, 1)->create();

        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Eloquent::reguard();
    }
}
