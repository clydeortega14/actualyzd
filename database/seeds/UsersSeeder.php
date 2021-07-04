<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Http\Traits\RandomClass;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $this->createRoles();
    	// Create Superadmin
        $this->superadmin();
        // Create sanmiguel_admin
        $this->sanmiguel_admin();
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
                'email' => 'psychologist1@psychline.ph',
                'username' => 'psychologist1', 
                'password' => 'password', 
            ],
            [
                'name' => 'Psychologist Two', 
                'email' => 'psychologist2@psychline.ph', 
                'username' => 'psychologist2',
                'password' => 'password', 
            ],
            [
                'name' => 'Psychologist Three', 
                'email' => 'psychologist3@psychline.ph', 
                'username' => 'psychologist3',
                'password' => 'password', 
            ],
            [
                'name' => 'Psychologist Four', 
                'email' => 'psychologist4@psychline.ph',
                'username' => 'psychologist4', 
                'password' => 'password', 
            ],
            [
                'name' => 'Psychologist Five', 
                'email' => 'psychologist5@psychline.ph',
                'username' => 'psychologist5',
                'password' => 'password', 
            ],

        ];


        $role = Role::where('name', 'psychologist')->first();

        foreach($psychologists as $psycho){
            $user = User::create([
                'name' => $psycho['name'],
                'email' => $psycho['email'],
                'username' => $psycho['username'],
                'password' => Hash::make($psycho['password']),
                'api_token' => Str::random(60),
                'is_active' => true,
            ]);

           $user->roles()->attach($role->id); 
        }
    }
    public function createRoles()
    {
        $roles = [

            ['name' => 'superadmin', 'display_name' => 'Superadmin'],
            ['name' => 'psychologist', 'display_name' => 'Psychologist'],
            ['name' => 'admin', 'display_name' => 'Admin'],
            ['name' => 'member', 'display_name' => 'Member'],
        ];

        foreach($roles as $role){
            Role::create([
                'name' => $role['name'], 
                'display_name' => $role['display_name'], 
                'class' => array_rand($this->classes()) 
            ]);
        }
    
    }
    public function superadmin()
    {
        $user = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@actualyzd.ph',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60),
            'is_active' => true
        ]);

        $superadmin = Role::where('name', 'superadmin')->first();

        $user->roles()->attach($superadmin->id);
    }
    public function sanmiguel_admin()
    {
        $user = User::create([
            'name' => 'San Miguel Corporation',
            'email' => 'sanmiguel@gmail.com',
            'username' => 'sanmiguel_admin',
            'password' => Hash::make('password'),
            'is_active' => true
        ]);

        $sanmiguel_admin = Role::where('name', 'admin')->first();

        $user->roles()->attach($sanmiguel_admin->id);
    }
}
