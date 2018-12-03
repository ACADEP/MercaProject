<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
     
      $user=new User;
      $user->username="Admin";
      $user->email="admin@hotmail.com";
      $user->password=Hash::make('123123');
      $user->verified=1;
      $user->admin=1;
      $user->save();

      //Asignar todos los permisos al administrador
      $role=Role::find(1);
      $permissions=Permission::pluck('name');
      $role->givePermissionTo($permissions);
      $user->assignRole("Admin");


      $user=new User;
      $user->username="John";
      $user->email="john@hotmail.com";
      $user->password=Hash::make('d1erere66');
      $user->verified=1;
      $user->admin=0;
      $user->save();

      $user->assignRole("Client");

      
      $user=new User;
      $user->username="samula4544";
      $user->email="sam@hotmail.com";
      $user->password=Hash::make('d16331ere3');
      $user->verified=1;
      $user->admin=0;
      $user->save();

      $user->assignRole("Client");

     
      $user=new User;
      $user->username="jonces";
      $user->email="jonces94@outlook.com";
      $user->password=Hash::make('jonatan9402');
      $user->verified=1;
      $user->admin=0;
      $user->save();

      $user->assignRole("Client");
      

    
      $user=new User;
      $user->username="Jonatan";
      $user->email="jonces94@hotmail.com";
      $user->password=Hash::make('jonatan9402');
      $user->verified=1;
      $user->admin=1;
      $user->save();

      $user->assignRole("Seller");


    $user=new User;
    $user->username="Bernardo";
    $user->email="luis_ber_27@hotmail.com";
    $user->password= Hash::make('123123');
    $user->verified=1;
    $user->admin=1;
    $user->save();

    $user->assignRole("Seller");

   

    $user=new User;
    $user->username="Jon";
    $user->email="jonatan1994@yahoo.com";
    $user->password=  Hash::make('jonatan9402');
    $user->verified=1;
    $user->admin=1;
    $user->save();

    $user->assignRole("Seller");


    $user=new User;
    $user->username="Luis_Bernardo";
    $user->email="13310577@itlp.edu.mx";
    $user->password=  Hash::make('456456');
    $user->verified=1;
    $user->admin=0;
    $user->save();

    $user->assignRole("Client");

    $users=User::all();
    foreach($users as $user)
    {
        $user->company_id=1;
        $user->save();
    }
    
    

    }
}
