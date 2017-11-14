<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
        // DB::table('members')->truncate();
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
        /*
        DB::table('member_category')->truncate();
        DB::table('member_commission')->truncate();
        DB::table('member_degree')->truncate();
        DB::table('member_duty')->truncate();
        DB::table('member_service')->truncate();
        DB::table('member_status')->truncate();
        DB::table('member_type')->truncate();
        DB::table('user_privilege')->truncate();
        DB::table('user_role')->truncate();
        DB::table('user_status')->truncate();
        */
        factory(App\Zone::class, 1)->create();
        factory(App\Chapelle::class, 1)->create();
        factory(App\Parish::class, 1)->create();
        factory(App\Diocese::class, 1)->create();
        // factory(App\Village::class, 1)->create();
        // factory(App\Cell::class, 1)->create();
        // factory(App\Sector::class, 1)->create();
        // factory(App\District::class, 1)->create();
        // factory(App\Province::class, 1)->create();
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
        factory(App\Registration::class, 2)->create();
        // factory(App\Member::class, 1)->create();
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

        $time = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('provinces')->insert(['code' => 1, 'name' => 'Kigali', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('provinces')->insert(['code' => 2, 'name' => 'South', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('provinces')->insert(['code' => 3, 'name' => 'West', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('provinces')->insert(['code' => 4, 'name' => 'North', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('provinces')->insert(['code' => 5, 'name' => 'East', 'created_at' => $time, 'updated_at' => $time]);

        DB::table('districts')->insert(['province_id' => '1', 'code' => 101, 'name' => 'Nyarugenge', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('districts')->insert(['province_id' => '1', 'code' => 102, 'name' => 'Gasabo', 'created_at' => $time, 'updated_at' => $time]);

        DB::table('districts')->insert(['province_id' => '2', 'code' => 201, 'name' => 'Nyanza', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('districts')->insert(['province_id' => '2', 'code' => 202, 'name' => 'Gisagara', 'created_at' => $time, 'updated_at' => $time]);

        DB::table('districts')->insert(['province_id' => '3', 'code' => 301, 'name' => 'Karongi', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('districts')->insert(['province_id' => '3', 'code' => 302, 'name' => 'Rutsiro', 'created_at' => $time, 'updated_at' => $time]);

        DB::table('districts')->insert(['province_id' => '4', 'code' => 401, 'name' => 'Rulindo', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('districts')->insert(['province_id' => '4', 'code' => 402, 'name' => 'Gakenke', 'created_at' => $time, 'updated_at' => $time]);        
        DB::table('districts')->insert(['province_id' => '5', 'code' => 501, 'name' => 'Rwamagana', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('districts')->insert(['province_id' => '5', 'code' => 502, 'name' => 'Nyagatare', 'created_at' => $time, 'updated_at' => $time]);        

        DB::table('sectors')->insert(['district_id' => '1', 'code' => 10101, 'name' => 'Gitega', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('sectors')->insert(['district_id' => '2', 'code' => 10201, 'name' => 'Bumbogo', 'created_at' => $time, 'updated_at' => $time]);

        DB::table('sectors')->insert(['district_id' => '3', 'code' => 20101, 'name' => 'Busasamana', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('sectors')->insert(['district_id' => '4', 'code' => 20201, 'name' => 'Gikonko', 'created_at' => $time, 'updated_at' => $time]);        
        DB::table('sectors')->insert(['district_id' => '5', 'code' => 30101, 'name' => 'Bwishyura', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('sectors')->insert(['district_id' => '6', 'code' => 30201, 'name' => 'Boneza', 'created_at' => $time, 'updated_at' => $time]);

        DB::table('sectors')->insert(['district_id' => '7', 'code' => 40101, 'name' => 'Base', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('sectors')->insert(['district_id' => '8', 'code' => 40201, 'name' => 'Busengo', 'created_at' => $time, 'updated_at' => $time]);

        DB::table('sectors')->insert(['district_id' => '9', 'code' => 50101, 'name' => 'Fumbwe', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('sectors')->insert(['district_id' => '10', 'code' => 50201, 'name' => 'Gatunda', 'created_at' => $time, 'updated_at' => $time]);


        DB::table('cells')->insert(['sector_id' => '1', 'code' => 1010101, 'name' => 'Cyahafi', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('villages')->insert(['cell_id' => '1', 'code' => 1010101, 'name' => 'Akarwa', 'created_at' => $time, 'updated_at' => $time]);
        
        /*
        DB::table('member_category')->insert(
            [
                'registration_id' => App\Registration::select('id')->first()->id,
                'category_id' => App\Category::select('id')->first()->id,
                'user_id' => App\User::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );

        DB::table('member_commission')->insert(
            [
                'registration_id' => App\Registration::select('id')->first()->id,
                'commission_id' => App\Commission::select('id')->first()->id,
                'user_id' => App\User::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );

        DB::table('member_degree')->insert(
            [
                'registration_id' => App\Registration::select('id')->first()->id,
                'degree_id' => App\Degree::select('id')->first()->id,
                'school' => 'NUR',
                'user_id' => App\User::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')                
            ]
        );

        DB::table('member_duty')->insert(
            [
                'registration_id' => App\Registration::select('id')->first()->id,
                'duty_id' => App\Duty::select('id')->first()->id,
                'user_id' => App\User::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')                
            ]
        );

        DB::table('member_service')->insert(
            [
                'registration_id' => App\Registration::select('id')->first()->id,
                'service_id' => App\Service::select('id')->first()->id,
                'user_id' => App\User::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')                
            ]
        );

        DB::table('member_status')->insert(
            [
                'registration_id' => App\Registration::select('id')->first()->id,
                'status_id' => App\Status::select('id')->first()->id,
                'user_id' => App\User::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')                
            ]
        );

        DB::table('member_type')->insert(
            [
                'registration_id' => App\Registration::select('id')->first()->id,
                'type_id' => App\Type::select('id')->first()->id,
                'user_id' => App\User::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')                
            ]
        );

        DB::table('user_privilege')->insert(
            [
                'user_id' => App\User::select('id')->first()->id,
                'privilege_id' => App\Privilege::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')                
            ]
        );

        DB::table('user_role')->insert(
            [
                'user_id' => App\User::select('id')->first()->id,
                'role_id' => App\Role::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')                
            ]
        );

        DB::table('user_status')->insert(
            [
                'user_id' => App\User::select('id')->first()->id,
                'status_id' => App\Status::select('id')->first()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')                
            ]
        );
        */                                                
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Eloquent::reguard();
    }
}
