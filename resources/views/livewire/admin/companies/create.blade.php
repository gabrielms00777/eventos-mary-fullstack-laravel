// <?php use Livewire\Volt\Component;
// use Livewire\Attributes\Layout;

// new #[Layout('components.layouts.admin')] #[Title('Cadastro Empresa')] class extends Component {
//     public $empresa = [
//         'nome' => '',
//         'cnpj' => '',
//         'email' => '',
//         'telefone' => '',
//         'endereco' => [
//             'rua' => '',
//             'numero' => '',
//             'cidade' => '',
//             'estado' => '',
//         ],
//     ];

//     public function salvarEmpresa()
//     {
//         $this->validate([
//             'empresa.nome' => 'required|string|min:3',
//             'empresa.cnpj' => 'required|string|size:18',
//             'empresa.email' => 'required|email',
//             'empresa.telefone' => 'nullable|string',
//             'empresa.endereco.rua' => 'required|string',
//             'empresa.endereco.numero' => 'required|string',
//             'empresa.endereco.cidade' => 'required|string',
//             'empresa.endereco.estado' => 'required|string',
//         ]);

//         // Simula salvamento no banco
//         session()->flash('success', 'Empresa cadastrada com sucesso!');
//         $this->reset('empresa');
//     }
// };
?>

<div>
    <x-header title="Cadastrar Empresa" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Voltar" icon="o-plus" :link="route('admin.companies.index')" class="btn-primary" />
        </x-slot:actions>
    </x-header>


    <x-card>
        <form wire:submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Nome da Empresa" wire:model="empresa.nome" required />
                <x-input label="CNPJ" wire:model="empresa.cnpj" mask="##.###.###/####-##" required />
                <x-input label="E-mail" type="email" wire:model="empresa.email" required />
                <x-input label="Telefone" wire:model="empresa.telefone" mask="(##) #####-####" />
            </div>


            <x-header title="Endereço" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Rua" wire:model="empresa.endereco.rua" required />
                <x-input label="Número" wire:model="empresa.endereco.numero" required />
                <x-input label="Cidade" wire:model="empresa.endereco.cidade" required />
                <x-input label="Estado" wire:model="empresa.endereco.estado" required />
            </div>


            <x-button label="Salvar Empresa" icon="o-check" primary spinner wire:click="salvarEmpresa" class="mt-4" />
        </form>
    </x-card>
</div>
