<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Role::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Administrator', 'User']),
	];
});

$factory->define(App\Privilege::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Diocese', 'Parish']),		
	];
});

$factory->define(App\Photo::class, function (Faker\Generator $faker) {
	return [
		'file' => '1509887158_1461425126me_udemy.jpg',
	];
});

/*
$factory->define(App\Province::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Kigali']),
		'code' => 1,
	];
});

$factory->define(App\District::class, function (Faker\Generator $faker) {
	return [
		'province_id' => 1,
		'name' => $faker->randomElement(['Nyarugenge']),
		'code' => 101,
	];
});

$factory->define(App\Sector::class, function (Faker\Generator $faker) {
	return [
		'district_id' => 1,
		'name' => $faker->randomElement(['Gitega']),
		'code' => 10101,
	];
});

$factory->define(App\Cell::class, function (Faker\Generator $faker) {
	return [
		'sector_id' => 1,
		'name' => $faker->randomElement(['Cyahafi']),
		'code' => 1010101,
	];
});

$factory->define(App\Village::class, function (Faker\Generator $faker) {
	return [
		'cell_id' => 1,
		'name' => $faker->randomElement(['Bannyahe']),
		'code' => 101010101,
	];
});
*/
$factory->define(App\Diocese::class, function (Faker\Generator $faker) {
	return [
		'code' => '1',
		'name' => $faker->randomElement(['Kigali']),
	];
});

$factory->define(App\Parish::class, function (Faker\Generator $faker) {
	return [
		'diocese_id' => 1,
		'district_id' => 1,
		'code' => '101',
		'name' => $faker->randomElement(['Gasabo']),
	];
});

$factory->define(App\Chapelle::class, function (Faker\Generator $faker) {
	return [
		'parish_id' => 1,
		'code' => '10101',
		'name' => $faker->randomElement(['Gisozi']),
	];
});

$factory->define(App\Zone::class, function (Faker\Generator $faker) {
	return [
		'chapelle_id' => 1,
		'code' => '1010101',
		'name' => $faker->randomElement(['Gakinjiro']),
	];
});
/*
$factory->define(App\Category::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Men', 'Women']),
	];
});
*/
$factory->define(App\Duty::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Pastor', 'Teacher']),
	];
});
/*
$factory->define(App\Task::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Christian', 'Representative']),
	];
});
*/
/*
$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Baptism']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Bridal']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Burial']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Kid']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Literacy']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Marriage']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Repenting']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Suspension']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Teaching']),
	];
});
*/

$factory->define(App\Type::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Christian', 'Visitor', 'Other']),
	];
});
/*
$factory->define(App\Commission::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Development', 'Construction']),
	];
});
*/
$factory->define(App\Choir::class, function (Faker\Generator $faker) {
	return [
		'chapelle_id' => 1,
		'name' => $faker->randomElement(['Rehoboth']),
		'equipment' => $faker->randomElement(['2 Piono, 3 Guitars, Drums']),
	];
});


$factory->define(App\Degree::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Masters', 'Graduate']),
	];
});
/*
$factory->define(App\Status::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->randomElement(['Active']),
	];
});
*/
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->unique()->randomElement(['Inn Ha']),
        'role_id' => 1,
        'privilege_id' => $faker->numberBetween(1, 1),
        'photo_id' => 1,
        'email' => $faker->unique()->randomElement(['innha@example.com']),
        'phone' => $faker->phoneNumber, //$faker->unique()->randomElement(['250785447722', '250722776655']),
        'password' => $password ?: $password = bcrypt('123456'),
        'province_id' => 1,
        'district_id' => 1,
        'sector_id' => 1,
        'cell_id' => 1,
        'village_id' => 1,
        'diocese_id' => 1,
        'parish_id' => 1,
        'chapelle_id' => 1,
        'zone_id' => 1,
        'status_id' => 1,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Registration::class, function (Faker\Generator $faker) {
	return [
    	// 'type_id' => 1,
    	'degree_id' => 1,    	
    	'category_id' => 1,
    	// 'service_id' => 1,
    	'commission_id' => 1,
    	//'duty_id' => 1,
    	'task_id' => 1,
    	'user_id' => 1,
    	'status_id' => 1,		
    	'regNumber' => '10101010100001',
    	'lastName' => $faker->randomElement(['RUGEMA']),
    	'firstName' => $faker->randomElement(['Charles']),
    	'fLastName' => $faker->randomElement(['BAGARAGAZA']),
    	'fFirstName' => $faker->randomElement(['Thomas']),
    	'mLastname' => $faker->randomElement(['MUKAMANA']),
    	'mFirstName' => $faker->randomElement(['Dorothy']),
    	'dob' => $faker->randomElement(['1981-01-10']), 
    	'birthPlace' => $faker->randomElement(['Nyakinama']),
    	'phoneOne' => '250788556633',
    	'phoneTwo' => '250722334466',
    	'gender' => 'Male',
    	'idNumber' => '119818002233',
    	'maritalStatus' => 'Married',
    	'legallyMarried' => 1,
    	'email' => 'crugema@sorasvie.rw',
    	'village_id' => 1,
    	'cell_id' => 1,
    	'sector_id' => 1,
    	'district_id' => 1,
    	'province_id' => 1,
    	'zone_id' => 1,
    	'chapelle_id' => 1,
    	'parish_id' => 1,
    	'diocese_id' => 1,
    	'ownsHouse' => true,
    	// 'job' => $faker->randomElement(['IT Manager', 'Network Administrator']),
    	'job_id' => 1,
    	// 'employer' => $faker->randomElement(['SORAS VIE Ltd', 'SORAS AG Ltd']),
    	// 'jobLocation' => 'Kigali',
    	'baptismDate' => $faker->randomElement(['1981-12-25', '1982-01-26']),
    	'baptismParish' => $faker->randomElement(['Nyakinama', 'Nyagatare']),
    	'origin_cell' => 'Nyakizu',
    	'origin_parish' => 'Nyakinama',
    	'choir_id' => 1,
    	'user_id' => 1,
    	'confirmed' => true,
    	'notes' => 'Using fake data',
	];
});
/*
$factory->define(App\Member::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,
    	'type_id' => $faker->numberBetween(1, 2),
    	'degree_id' => 1,
    	'duty_id' => 1,
    	'category_id' => 1,
    	'service_id' => 1,
    	'commission_id' => 1,
    	'user_id' => 1,
    	'status_id' => 1,
	];
});
*/

$factory->define(App\Bridal::class, function (Faker\Generator $faker) {
	return [
		'm_bridal_id' => 1,
		'f_bridal_id' => 2,
		'origin' => 'Nyakinama',
		'user_id' => 1,
	];
});

$factory->define(App\Marriage::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,
		'bridal_id' => 2,
		'date_married' => '2017-11-15',
		'marriagePlace' => 'Kicukiro',
		'user_id' => 1,
	];
});

$factory->define(App\Burial::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 2,
		'date_died' => '2010-10-20',
		'date_buried' => '2010-10-22',
		'burialPlace' => 'Heaven',
		'user_id' => 1,
	];
});

$factory->define(App\Kid::class, function (Faker\Generator $faker) {
	return [
		'child_names' => 'KEZA Kevin',
		'registration_id' => 1, //parent id
		'date_prayed' => '2010-10-20',
		'user_id' => 1,
	];
});

$factory->define(App\Literacy::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,
		'period' => 'Summer',
		'user_id' => 1,
	];
});

$factory->define(App\Preaching::class, function (Faker\Generator $faker) {
	return [
		'visitor_names' => 'Pastor Pius',		
		'topic' => 'Faith and life',
		'date_preached' => '2017-11-15',
		// 'hasRepented' => false,
		'num_repented' => 10,
		'user_id' => 1,
	];
});

$factory->define(App\Reception::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,		
		'cell_id' => 1,
		'parish_id' => 1,
		'user_id' => 1,
	];
});

$factory->define(App\Recommendation::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,
		// 'type' => 'out',
		'origin_parish' => 'Burera',
		'destination_parish' => 'Kinamba',
		'date_issued' => '2017-10-25',
		'date_arrived' => '2017-10-30',
		'user_id' => 1,
	];
});

$factory->define(App\Suspension::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,		
		'reason' => 'Resistence to Repenting',
		'suspendor' => 'Bishop X',
		'date_suspended' => '2017-01-05',
		'user_id' => 1,
	];
});

$factory->define(App\Repenting::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,		
		'date_returned' => '2017-10-26',
		'reinstator' => 'Pastor Y',
		'user_id' => 1,
	];
});

$factory->define(App\Teaching::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,		
		'cell_id' => 1,
		'parish_id' => 1,
		'date_started' => '2018-01-02',
		'date_ended' => null,
		'user_id' => 1,
	];
});

$factory->define(App\Baptism::class, function (Faker\Generator $faker) {
	return [
		'teaching_id' => 1,
		'date_baptized' => '1981-12-25',
		'user_id' => 1,
	];
});