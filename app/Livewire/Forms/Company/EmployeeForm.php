<?php

namespace App\Livewire\Forms\Company;

use App\Enums\EmployeeTypeEnum;
use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;
use Illuminate\Validation\Rule;

class EmployeeForm extends Form
{
    public ?string $name = null;

    public ?string $email = null;

    public ?string $role = null;

    public ?string $phone = null;
    
    public ?string $position = null;

    public ?string $temp_password = null;

    public ?string $temp_password_confirmation = null;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => ['required', Rule::enum(EmployeeTypeEnum::class)],
            'phone' => 'required|string|max:100',
            'position' => 'required|string|max:255',
            'temp_password' => 'required|confirmed',
        ];
    }

    public function store()
    {
        $this->validate(); 

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => in_array($this->role, [UserTypeEnum::ADMIN->value, UserTypeEnum::MANAGER->value]) 
                    ? UserTypeEnum::from($this->role)
                    : UserTypeEnum::EMPLOYEE->value,
            'password' => bcrypt($this->temp_password)
        ]);

        Employee::create([
            'user_id' => $user->id,
            'company_id' => Auth::user()->company_id, 
            'role' => $this->role,
            'phone' => $this->phone,
            'position' => $this->position,
            'status' => 'active',
        ]);
    }
    
    
}
