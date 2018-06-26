<?php

use Illuminate\Database\Seeder;

class ProfileAccess extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfileAccess::create([
            'group'  => 'admin'
        ]);

        ProfileAccess::create([
            'group'  => 'site'
        ]);
    }
}
