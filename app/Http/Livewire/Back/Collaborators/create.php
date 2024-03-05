<?php

namespace App\Http\Livewire\Back\Collaborators;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Collaborator;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use WithPagination;
    public $search;
    public $paginate = 6;
    public $collaborator;
    public $activities;
    public $activity_id;
    public $name;
    public $phone;
    public $isUpdate = false;
    protected $listeners = [
        'delete' => 'destroyData',
    ];
    public function render()
    {
        return view('livewire.back.collaborators.create');
    }
    public function mount()
    {
        $this->activities = Activity::orderBy('name', 'asc')->get();
    }
    public function openModal($id = null)
    {
        $this->name = '';
        $this->phone = '';
        if ($id) {
            $this->isUpdate = true;
            $this->collaborator = Collaborator::find($id);
            $this->name = $this->collaborator->name ?? '';
            $this->phone = $this->collaborator->phone ?? '';
            $this->activity_id = $this->collaborator->activity_id ?? '';
        }
    }
    public function search()
    {
        return Collaborator::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->paginate);
    }
    public function storeData()
    {
        $validatedData = $this->validate(
            [
                'name' => 'required',
                'phone' => 'nullable',
                'activity_id' => 'required',
            ],
            [
                'name.required' => 'Veuillez renseigner le nom',
                'activity_id.required' => 'Veuillez renseigner l\'activité',
            ],
        );
        try {
            DB::beginTransaction();
            if ($this->isUpdate) {
                $this->collaborator->update($validatedData);
            } else {
                Collaborator::create($validatedData);
            }
            DB::commit();
            $this->dispatchBrowserEvent('close:modal');
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => $this->isUpdate ? 'collaborateur modifiée avec succès' : 'Collaborateur ajoutée avec succès',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => $this->isUpdate ? 'Impossible de modifier cet collaborateur veuillez réessayer' : "Impossible d'ajouter cet collaborateur veuillez réessayer",
            ]);
        }
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Suppression',
            'text' => "Vous-êtes sur le point de supprimer le collaborateur $nom",
            'type' => 'warning',
            'method' => 'delete',
            'id' => $id,
        ]);
    }
    public function destroyData($id)
    {
        DB::beginTransaction();
        $data = Collaborator::find($id);
        try {
            $data->delete();
            DB::commit();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Collaborateur supprimé avec succès',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Impossible de supprimer le collaborateur',
            ]);
        }
    }
    public function show($id)
    {
        $this->collaborator = Collaborator::find($id);
        return redirect()->route('collaborators.show', $this->collaborator);
    }
}
