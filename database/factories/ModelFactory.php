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
        'remember_token' => str_random(10),
    ];
});

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

$factory->define(App\Province::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Kigali', 'South']),
		'code' => $faker->numberBetween(1, 2),
	];
});

$factory->define(App\District::class, function (Faker\Generator $faker) {
	return [
		'province_id' => 1,
		'name' => $faker->randomElement(['Gasabo']),
		'code' => $faker->numberBetween(102, 102),
	];
});

$factory->define(App\Sector::class, function (Faker\Generator $faker) {
	return [
		'district_id' => 1,
		'name' => $faker->randomElement(['Gisozi']),
		'code' => $faker->numberBetween(10201, 10201),
	];
});

$factory->define(App\Cell::class, function (Faker\Generator $faker) {
	return [
		'sector_id' => 1,
		'name' => $faker->randomElement(['Kinamba']),
		'code' => $faker->numberBetween(1020101, 1020101),
	];
});

$factory->define(App\Village::class, function (Faker\Generator $faker) {
	return [
		'cell_id' => 1,
		'name' => $faker->randomElement(['Gakinjiro']),
		'code' => $faker->numberBetween(102010101, 102010101),
	];
});

$factory->define(App\Diocese::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->randomElement(['Kigali']),
	];
});

$factory->define(App\Parish::class, function (Faker\Generator $faker) {
	return [
		'diocese_id' => 1,
		'name' => $faker->randomElement(['Gasabo']),
	];
});

$factory->define(App\Chapelle::class, function (Faker\Generator $faker) {
	return [
		'parish_id' => 1,
		'name' => $faker->randomElement(['Gisozi']),
	];
});

$factory->define(App\Zone::class, function (Faker\Generator $faker) {
	return [
		'chapelle_id' => 1,
		'name' => $faker->randomElement(['Gakinjiro']),
	];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Men', 'Women']),
	];
});

$factory->define(App\Duty::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Pastor', 'Teacher']),
	];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Preaching', 'Baptism']),
	];
});

$factory->define(App\Type::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Christian', 'Visitor', 'Other']),
	];
});

$factory->define(App\Commission::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Development', 'Construction']),
	];
});

$factory->define(App\Choir::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->randomElement(['Rehoboth']),
		'equipment' => $faker->randomElement(['2 Piono, 3 Guitars, Drums']),
	];
});


$factory->define(App\Degree::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['Masters', 'Graduate']),
	];
});

$factory->define(App\Status::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->randomElement(['Active']),
	];
});

$factory->define(App\Registration::class, function (Faker\Generator $faker) {
	return [
    	'type_id' => $faker->numberBetween(1, 2),
    	'regNumber' => $faker->unique()->numberBetween(102010101, 102010115),
    	'lastName' => $faker->randomElement(['RUGEMA', 'NSHUTI']),
    	'firstName' => $faker->randomElement(['Charles', 'Tresor']),
    	'fLastName' => $faker->randomElement(['BAGARAGAZA', 'HABIMANA']),
    	'fFirstName' => $faker->randomElement(['Thomas', 'Bosco']),
    	'mLastname' => $faker->randomElement(['MUKAMANA', 'NYIRAMANA']),
    	'mFirstName' => $faker->randomElement(['Dorothy', 'Betty']),
    	'dob' => $faker->randomElement(['1981-01-10', '1982-02-11']), 
    	'birthPlace' => $faker->randomElement(['Nyakinama', 'Nyagatare']),
    	'phoneOne' => '250788556633',
    	'phoneTwo' => '250722334466',
    	'gender' => 'Male',
    	'idNumber' => '119818002233',
    	'degree_id' => 1,
    	'school' => 'NUR',
    	'maritalStatus' => 'Married',
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
    	'job' => $faker->randomElement(['IT Manager', 'Network Administrator']),
    	'employer' => $faker->randomElement(['SORAS VIE Ltd', 'SORAS AG Ltd']),
    	'jobLocation' => 'Kigali',
    	'baptismDate' => $faker->randomElement(['1981-12-25', '1982-01-26']),
    	'baptismParish' => $faker->randomElement(['Nyakinama', 'Nyagatare']),
    	'duty_id' => 1,
    	'category_id' => 1,
    	'service_id' => 1,
    	'commission_id' => 1,
    	'choir_id' => 1,
    	'user_id' => 1,
    	'status_id' => 1,
    	'confirmed' => true,
    	'notes' => 'Using fake data',
	];
});

$factory->define(App\Baptism::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,
		'date_baptized' => '1981-12-25',
		'user_id' => 1,
	];
});

$factory->define(App\Bridal::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,
		'bridalName' => 'MUKESHIMANA',
		'origin' => 'Nyakinama',
		'user_id' => 1,
	];
});

$factory->define(App\Burial::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 2,
		'date_died' => '2010-10-20',
		'burialPlace' => 'Heaven',
		'user_id' => 1,
	];
});

$factory->define(App\Kid::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,
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

$factory->define(App\Marriage::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,
		'date_married' => '2017-11-15',
		'marriagePlace' => 'Kicukiro',
		'user_id' => 1,
	];
});

$factory->define(App\Preaching::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,		
		'topic' => 'Faith and life',
		'date_preached' => '2017-11-15',
		'hasRepented' => false,
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
		'registration_id' => 2,		
		'date_issued' => '2017-10-25',
		'ownerName' => 'NSHUTI Tresor',
		'destination' => 'Kinamba',
		'holderName' => 'KAYUMBA Jules',
		'date_arrived' => '2017-10-30',
		'user_id' => 1,
	];
});

$factory->define(App\Repenting::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 2,		
		'date_returned' => '2017-10-26',
		'authRegNum' => 102010102,
		'user_id' => 1,
	];
});

$factory->define(App\Suspension::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 2,		
		'reason' => 'Resistence to Repenting',
		'authRegNum' => 102010102,
		'user_id' => 1,
	];
});


$factory->define(App\Teaching::class, function (Faker\Generator $faker) {
	return [
		'registration_id' => 1,		
		'cell_id' => 1,
		'parish_id' => 1,
		'user_id' => 1,
	];
});