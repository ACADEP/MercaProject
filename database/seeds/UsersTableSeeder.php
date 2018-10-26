<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
      DB::table('users')->insert([
          'username'    => 'admin',
          'email'       => 'admin@hotmail.com',
          'password'    => Hash::make('123123'),
          'verified'    => 1,
          'admin'       => 1,
      ]);

      DB::table('users')->insert([
          'username'    => 'John',
          'email'       => 'john@hotmail.com',
          'password'    => Hash::make('d1erere66'),
          'verified'    => 1,
          'admin'       => 0,
      ]);

      DB::table('users')->insert([
          'username'    => 'samula4544',
          'email'       => 'sam@hotmail.com',
          'password'    => Hash::make('d16331ere3'),
          'verified'    => 1,
          'admin'       => 0,
      ]);

      DB::table('users')->insert([
          'username'    => 'jonces',
          'email'       => 'jonces94@outlook.com',
          'password'    => Hash::make('jonatan9402'),
          'verified'    => 1,
          'admin'       => 0,
      ]);

      DB::table('users')->insert([
          'username'    => 'Jonatan',
          'email'       => 'jonces94@hotmail.com',
          'password'    => Hash::make('jonatan9402'),
          'verified'    => 1,
          'admin'       => 1,
      ]);

      DB::table('users')->insert([
        'username'    => 'Bernardo',
        'email'       => 'luis_ber_27@hotmail.com',
        'password'    => Hash::make('123123'),
        'verified'    => 1,
        'admin'       => 2,
    ]);

    DB::table('users')->insert([
        'username'    => 'Jon',
        'email'       => 'jonatan1994@yahoo.com',
        'password'    => Hash::make('jonatan9402'),
        'verified'    => 1,
        'admin'       => 2,
    ]);
    DB::table('users')->insert([
        'username'    => 'Luis_Bernardo',
        'email'       => '13310577@itlp.edu.mx',
        'password'    => Hash::make('456456'),
        'verified'    => 1,
        'admin'       => 0,
    ]);
    

    DB::table('users')->insert([
        'username'    => 'Cliente',
        'email'       => 'cliente@acadep.com',
        'password'    => Hash::make('acadep01'),
        'verified'    => 1,
        'admin'       => 0,
    ]);

    DB::table('users')->insert([
        'username'    => 'Administrador',
        'email'       => 'administrador@acadep.com',
        'password'    => Hash::make('acadep01'),
        'verified'    => 1,
        'admin'       => 1,
    ]);

    DB::table('users')->insert([
        'username'    => 'Proveedor',
        'email'       => 'proveedor@acadep.com',
        'password'    => Hash::make('acadep01'),
        'verified'    => 1,
        'admin'       => 2,
    ]);

    }
}
