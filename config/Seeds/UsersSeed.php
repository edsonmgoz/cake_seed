<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $hasher = new DefaultPasswordHasher();
        $password = $hasher->hash('secret');

        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 200; $i++)
        {
            $data[] = [
                'first_name' => $faker->firstName(),
                'last_name'  => $faker->lastName(),
                'username'   => $faker->userName,
                'email'      => $faker->email,
                'password'   => $password,
                'role'       => $faker->randomElement($array = array ('user','editor')),
                'active'     => $faker->boolean,
                'created'    => date("Y-m-d H:i:s"),
                'modified'   => date("Y-m-d H:i:s")
            ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
