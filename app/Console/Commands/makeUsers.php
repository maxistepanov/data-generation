<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;


class makeUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Faker $faker
     * @return mixed
     */
    public function handle(Faker $faker)
    {

        $builder = DB::table((new User)->getTable());
        for ($number = 20; $number < 30; $number++){
            for ($part = 0; $part < 2500; $part++){
                $fileName = 'dump/'. $number .'/part_'. str_random(6) . '.sql';
                Storage::disk('local')->put($fileName,'');

                $this->info("start $part $fileName "  . now());
                $array = collect();
                for ($i = 0; $i < 4000; $i++) {

                    $array->push([
                        'name' => $faker->name,
                        'email' => $faker->email,
                        'password' =>  str_random(20), // secret
                        'remember_token' => str_random(12),
                        'city' => $faker->city,
                        'street' => $faker->streetName,
                        'postcode' => $faker->postcode,
                        'country' => $faker->country,
                        'latitude' => $faker->longitude,
                        'longitude' => $faker->latitude,
                        'phoneNumber' => $faker->phoneNumber,
                        'company' => $faker->company,
                        'jobTitle' => $faker->jobTitle,
                        'locale' => $faker->locale,

                    ]);

                }
                $sql = $builder->getGrammar()->compileInsert($builder, $array->toArray());
                Storage::append($fileName, $sql . ";");

                $this->info("end  $part " . now());
            }
        }


    }
}
