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
        $this->createRoles();
    	// Create Superadmin
        $this->superadmin();
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
                'is_active' => true 
            ],
            [
                'name' => 'Psychologist Two', 
                'email' => 'psychologist2@psychline.ph', 
                'username' => 'psychologist2',
                'password' => 'password', 
                'is_active' => true 
            ],
            [
                'name' => 'Psychologist Three', 
                'email' => 'psychologist3@psychline.ph', 
                'username' => 'psychologist3',
                'password' => 'password', 
                'is_active' => true 
            ],
            [
                'name' => 'Psychologist Four', 
                'email' => 'psychologist4@psychline.ph',
                'username' => 'psychologist4', 
                'password' => 'password', 
                'is_active' => true 
            ],
            [
                'name' => 'Psychologist Five', 
                'email' => 'psychologist5@psychline.ph',
                'username' => 'psychologist5',
                'password' => 'password', 
                'is_active' => true 
            ],

        ];


        $role = Role::where('name', 'psychologist')->first();

        foreach($psychologists as $psycho){
            $user = User::create([

                'name' => $psycho['name'],
                'email' => $psycho['email'],
                'username' => $psycho['username'],
                'password' => Hash::make($psycho['password']),
                'is_active' => $psycho['is_active']

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
            'is_active' => true
        ]);

        $superadmin = Role::where('name', 'superadmin')->first();

        $user->roles()->attach($superadmin->id);
    }
}
