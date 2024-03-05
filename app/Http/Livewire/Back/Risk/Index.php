<?php

namespace App\Http\Livewire\Back\Risk;

use App\Models\Risk;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $paginate = 6;
    public $risk;
    public $name;
    public $description;
    public $isUpdate = false;
    public $task;
    protected $listeners = [
        'deleteRisk' => 'destroyRisk',
        'taskSelected' => 'handleTaskSelected',
    ];

    public function handleTaskSelected($id)
    {
        $this->task = Task::find($id);
    }
    public function render()
    {
        return view('livewire.back.risk.index')->with('risks', $this->search());
    }
    public function openModal($id = null)
    {
        $this->name = '';
        $this->description = '';
        if ($id) {
            $this->isUpdate = true;
            $this->risk = Risk::find($id);
            $this->name = $this->risk->name ?? '';
            $this->description = $this->risk->description ?? '';
        }
    }
    public function search()
    {
        if ($this->task) {
            return $this->task
                ->risks()
                ->orderBy('id', 'desc')
                ->when($this->search, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate($this->paginate);
        } else {
            return new LengthAwarePaginator([], 0, $this->paginate);
        }
    }
    public function storeRiskData()
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

        DB::beginTransaction();
        if ($this->isUpdate) {
            $this->risk->update($validatedData);
        } else {
            Risk::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'task_id' => $this->task->id,
            ]);
        }
        DB::commit();
        $this->dispatchBrowserEvent('close:modal');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => $this->isUpdate ? 'risque modifiée avec succès' : 'risque ajoutée avec succès',
        ]);

        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => $this->isUpdate ? 'Impossible de modifier ce risque veuillez réessayer' : "Impossible d'ajouter ce risque veuillez réessayer",
            ]);
        }
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Suppression',
            'text' => "Vous-êtes sur le point de supprimer la risque $nom",
            'type' => 'warning',
            'method' => 'deleteRisk',
            'id' => $id,
        ]);
    }
    public function destroyRisk($id)
    {
        DB::beginTransaction();
        $data = Risk::find($id);
        try {
            $data->delete();
            DB::commit();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'risque supprimé avec succès',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Impossible de supprimer la risque',
            ]);
        }
    }
    public function show($id)
    {
        $this->risk = Risk::find($id);
        return redirect()->route('risks.show', $this->risk);
    }
}
