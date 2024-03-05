<?php

namespace App\Http\Livewire\Back\Task;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $paginate = 6;
    public $task;
    public $name;
    public $description;
    public $isUpdate = false;
    public $activity;
    public $firstTask = false;
    public function mount($activity)
    {
        $this->activity = $activity;
    }
    protected $listeners = [
        'deleteTask' => 'destroyTask',
    ];
    public function render()
    {
        return view('livewire.back.task.index')->with('tasks', $this->search());
    }
    public function openModal($id = null)
    {
        $this->name = '';
        $this->description = '';
        if ($id) {
            $this->isUpdate = true;
            $this->task = Task::find($id);
            $this->name = $this->task->name ?? '';
            $this->description = $this->task->description ?? '';
        }
    }
    public function search()
    {
        return $this->activity
            ->tasks()
            ->orderBy('id', 'desc')
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })
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
                $this->task->update($validatedData);
            } else {
                Task::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'activity_id' => $this->activity->id,
                ]);
            }
            DB::commit();
            $this->dispatchBrowserEvent('close:modal');
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => $this->isUpdate ? 'Tâche modifiée avec succès' : 'Activite ajoutée avec succès',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => $this->isUpdate ? 'Impossible de modifier cette tâche veuillez réessayer' : "Impossible d'ajouter cette tâche veuillez réessayer",
            ]);
        }
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Suppression',
            'text' => "Vous-êtes sur le point de supprimer la tâche $nom",
            'type' => 'warning',
            'method' => 'deleteTask',
            'id' => $id,
        ]);
    }
    public function destroyTask($id)
    {
        DB::beginTransaction();
        $data = Task::find($id);

        $data->delete();
        DB::commit();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Tâche supprimé avec succès',
        ]);
        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Impossible de supprimer la tâche',
            ]);
        }
    }
    public function show($id)
    {
        $this->task = Task::find($id);
        return redirect()->route('tasks.show', $this->task);
    }
    public function dispatchTaskSelected($id)
    {
        $this->dispatchBrowserEvent('task:selected', [
            'method' => 'taskSelected',
            'id' => $id,
        ]);
    }
}
