<?php

namespace App\Http\Livewire\Back\Measures;

use App\Models\Measure;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $paginate = 6;
    public $measure;
    public $name;
    public $description;
    public $isUpdate = false;
    public $risk;
    protected $listeners = [
        'delete' => 'destroyMesureData',
    ];
    public function render()
    {
        return view('livewire.back.measure.index')->with('measures', $this->search());
    }
    public function openModal($id = null)
    {
        $this->name = '';
        $this->description = '';
        if ($id) {
            $this->isUpdate = true;
            $this->measure = Measure::find($id);
            $this->name = $this->measure->name ?? '';
            $this->description = $this->measure->description ?? '';
        }
    }
    public function search()
    {
        if ($this->risk) {
            return $this->risk
                ->measures()
                ->orderBy('id', 'desc')
                ->when($this->search, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate($this->paginate);
        } else {
            return new LengthAwarePaginator([], 0, $this->paginate);
        }
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

        DB::beginTransaction();
        if ($this->isUpdate) {
            $this->measure->update($validatedData);
        } else {
            Measure::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'risk_id' => $this->risk->id,
            ]);
        }
        DB::commit();
        $this->dispatchBrowserEvent('close:modal');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => $this->isUpdate ? 'mesure modifiée avec succès' : 'mesure ajoutée avec succès',
        ]);

        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => $this->isUpdate ? 'Impossible de modifier ce mesure veuillez réessayer' : "Impossible d'ajouter ce mesure veuillez réessayer",
            ]);
        }
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Suppression',
            'text' => "Vous-êtes sur le point de supprimer la mesure $nom",
            'type' => 'warning',
            'method' => 'delete',
            'id' => $id,
        ]);
    }
    public function destroyMesureData($id)
    {
        DB::beginTransaction();
        $data = Measure::find($id);
        try {
            $data->delete();
            DB::commit();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'mesure supprimé avec succès',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Impossible de supprimer la mesure',
            ]);
        }
    }
    public function show($id)
    {
        $this->measure = Measure::find($id);
        return redirect()->route('measures.show', $this->measure);
    }
}
