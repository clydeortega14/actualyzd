<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Http\Traits\RandomClass;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{

    use RandomClass;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create roles first
        // $this->createRoles();


    	// Create Superadmin
        $this->superadmin();

        // Create sanmiguel_admin
        // $this->sanmiguel_admin();
        // Create lalamove_admin
        // $this->lalamove_admin();
        // Create lalamove_admin
        // $this->concentrix_admin();
        // psychologist
        $this->psychologists();  
    }
    public function psychologists()
    {
        $psychologists = [

            [
                'name' => 'Psychologist One', 
                'email' => 'psychologist1@actualyzd.com',
                'username' => 'psychologist1', 
                'password' => 'password', 
            ],
            [
                'name' => 'Psychologist Two', 
                'email' => 'psychologist2@actualyzd.com', 
                'username' => 'psychologist2',
                'password' => 'password', 
            ],
            [
                'name' => 'Psychologist Three', 
                'email' => 'psychologist3@actualyzd.com', 
                'username' => 'psychologist3',
                'password' => 'password', 
            ],
            [
                'name' => 'Psychologist Four', 
                'email' => 'psychologist4@actualyzd.com',
                'username' => 'psychologist4', 
                'password' => 'password', 
            ],
            [
                'name' => 'Psychologist Five', 
                'email' => 'psychologist5@actualyzd.com',
                'username' => 'psychologist5',
                'password' => 'password', 
            ],

        ];


        $role = Role::where('name', 'psychologist')->first();

        foreach($psychologists as $psycho){
            $user = $this->createUser([
                'name' => $psycho['name'],
                'email' => $psycho['email']
            ]);

           $user->roles()->attach($role->id); 
        }
    }


    public function superadmin()
    {
        $user = $this->createUser([

            'name' => 'Superadmin',
            'email' => 'superadmin@actualyzd.com',
        ]);

        $superadmin = Role::where('name', 'superadmin')->first();

        $user->roles()->attach($superadmin);
    }

    public function createUser(array $data){

        return User::firstOrCreate([

            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['email'],
            'password' => Hash::make('password'),
            'is_active' => true
        ]);
    }
}
