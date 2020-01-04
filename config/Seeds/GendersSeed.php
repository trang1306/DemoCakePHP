<?php
use Migrations\AbstractSeed;

/**
 * Genders seed.
 */
class GendersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'idGENDER' => '1',
                'NAME' => 'Male',
            ],
            [
                'idGENDER' => '2',
                'NAME' => 'Female',
            ],
        ];

        $table = $this->table('genders');
        $table->insert($data)->save();
    }
}
