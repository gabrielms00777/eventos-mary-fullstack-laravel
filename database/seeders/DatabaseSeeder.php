<?php

namespace Database\Seeders;

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
        Company::factory(3)->create()->each(function ($company) {
            // Criando 5 funcionários por empresa
            Employee::factory(5)->create(['company_id' => $company->id]);

            // Criando 3 eventos por empresa
            Event::factory(3)->create(['company_id' => $company->id])->each(function ($event) {
                // Criando 10 visitantes por evento
                Visitor::factory(10)->create()->each(function ($visitor) use ($event) {
                    // Criando inscrição dos visitantes no evento
                    EventRegistration::factory()->create([
                        'event_id' => $event->id,
                        'visitor_id' => $visitor->id,
                    ]);
                });
            });
        });
    }
}
