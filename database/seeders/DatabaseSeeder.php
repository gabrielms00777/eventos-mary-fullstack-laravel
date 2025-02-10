<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Enums\EmployeeTypeEnum;
use App\Models\User;
use App\Models\Event;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Visitor;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use App\Models\EventRegistration;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'role' => UserTypeEnum::ADMIN,
            'email' => 'admin@admin',
            'password' => 'admin',
        ]);

        Company::factory(3)->create()->each(function ($company) {
            Employee::factory(2)->create(['company_id' => $company->id, 'role' => EmployeeTypeEnum::ADMIN]);
            Employee::factory(5)->create(['company_id' => $company->id, 'role' => EmployeeTypeEnum::MANAGER]);
            Employee::factory(10)->create(['company_id' => $company->id, 'role' => EmployeeTypeEnum::STAFF]);

            Event::factory(3)->create(['company_id' => $company->id])->each(function ($event) {
                Visitor::factory(10)->create()->each(function ($visitor) use ($event) {
                    EventRegistration::factory()->create([
                        'event_id' => $event->id,
                        'visitor_id' => $visitor->id,
                    ]);
                });
            });
        });
    }
}
