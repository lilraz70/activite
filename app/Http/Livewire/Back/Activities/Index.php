<?php

namespace App\Http\Livewire\Back\Activities;

use Livewire\Component;
use App\Models\Activity;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $paginate = 6;
    public $activity;
    public $name;
    public $description;
    public $isUpdate = false;
    protected $listeners = [
        'delete' => 'destroyData',
    ];
    public function render()
    {
        return view('livewire.back.activities.index')->with('activities', $this->search());
    }
    public function openModal($id = null)
    {
        $this->name = '';
        $this->description = '';
        if ($id) {
            $this->isUpdate = true;
            $this->activity = Activity::find($id);
            $this->name = $this->activity->name ?? '';
            $this->description = $this->activity->description ?? '';
        }
    }
    public function search()
    {
        return Activity::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->paginate);
    }
    public function storeData()
    {
        $validatedData = $this->validate(
            [
                'name' => 'required',
                'description' => 'nullable',
            ],
            [
                'name.required' => 'Veuillez renseigner le nom',
            ],
        );
        try {
            DB::beginTransaction();
            if ($this->isUpdate) {
                $this->activity->update($validatedData);
            } else {
                Activity::create($validatedData);
            }
            DB::commit();
            $this->dispatchBrowserEvent('close:modal');
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => $this->isUpdate ? 'Activité modifiée avec succès' : 'Activite ajoutée avec succès',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => $this->isUpdate ? 'Impossible de modifier cette Activité veuillez réessayer' : "Impossible d'ajouter cette Activité veuillez réessayer",
            ]);
        }
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Suppression',
            'text' => "Vous-êtes sur le point de supprimer l'activité $nom",
            'type' => 'warning',
            'method' => 'delete',
            'id' => $id,
        ]);
    }
    public function destroyData($id)
    {
        DB::beginTransaction();
        $data = Activity::find($id);
        try {
            $data->delete();
            DB::commit();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Activité supprimé avec succès',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Impossible de supprimer l'activité",
            ]);
        }
    }
    public function show($id)
    {
        $this->activity = Activity::find($id);
        return redirect()->route('activities.show', $this->activity);
    }
}
