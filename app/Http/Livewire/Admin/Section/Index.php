<?php

namespace App\Http\Livewire\Admin\Section;

use App\Models\Section;
use Livewire\Component;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination,LivewireAlert,WithFileUploads;
    protected $layout = null;
    public $search = '', $formMode = false , $updateMode = false, $viewMode = false;
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $section_id = null,$section_key = null, $removeImage = false,$name,$description,$year_experience,$short_description,$features ,$image,$originalImage,$status = 1;

    protected $listeners = [
        'cancel','updatePaginationLength', 'updateStatus', 'confirmedToggleAction','deleteConfirm',
    ];

    public function mount(){
        abort_if(Gate::denies('section_access'),Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function updatePaginationLength($length){
        $this->paginationLength = $length;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
       $this->search = '';
    }

    public function sortBy($columnName)
    {
        $this->resetPage();

        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        $statusSearch = null;
        $searchValue = $this->search;
        if(Str::contains('active', strtolower($searchValue))){
            $statusSearch = 1;
        }else if(Str::contains('inactive', strtolower($searchValue))){
            $statusSearch = 0;
        }

        $allSections = Section::query()->where(function ($query) use($searchValue,$statusSearch) {
            $query->where('name', 'like', '%'.$searchValue.'%')
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);
        return view('livewire.admin.section.index',compact('allSections'));
    }

    public function create()
    {
        $this->resetPage('page');
        $this->resetInputFields();
        $this->formMode = true;
        $this->initializePlugins();
    }

    public function store(){
        //dd($this->all());
        $validatedData = $this->validate([
            'name'        => 'required|'.Rule::unique('sections')->whereNull('deleted_at'),
            'year_experience'  => 'nullable',
            'short_description' => 'nullable',
            'description' => 'required|strip_tags',
            'features' => 'nullable',
            'status'      => 'required',
            'image'       => 'required|image|max:'.config('constants.img_max_size'),
        ],[
           'description.strip_tags'=> 'The description field is required',
        ]);

        $validatedData['status'] = $this->status;

        DB::beginTransaction();
        try{

            $section = Section::create($validatedData);

            //Upload Image
            uploadImage($section, $this->image, 'section/image/',"section-image", 'original', 'save', null);


            DB::commit();

            $this->formMode = false;

            $this->reset(['name','description','year_experience','short_description','features','status','image','originalImage']);

            $this->flash('success',trans('messages.add_success_message'));

            return redirect()->route('admin.section');

        }catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage().'->'.$e->getLine());
            $this->alert('error',trans('messages.error_message'));

        }
    }

    public function update(){
        $validatedArray = [
            'name'        => 'required|'.Rule::unique('sections')->ignore($this->section_id)->whereNull('deleted_at'),
            'year_experience'  => 'nullable',
            'short_description' => 'nullable',
            'description' => 'required|strip_tags',
            'features' => 'nullable',
            'status'      => 'required',
        ];

        if($this->image || $this->removeImage){
            $validatedArray['image'] = 'required|image|max:'.config('constants.img_max_size');
        }
        
        $validatedData = $this->validate(
            $validatedArray,[
                'description.strip_tags'=> 'The description field is required',
            ]
        );
        $validatedData['status'] = $this->status;
        $section = Section::find($this->section_id);
        
        // Check if the photo has been changed
        $uploadId = null;
        if ($this->image) {
            $uploadId = $section->sectionImage1 ? $section->sectionImage1->id : '';

            if($uploadId != ''){
                uploadImage($section, $this->image, 'section/image/',"section-image", 'original', 'update', $uploadId);
            }else{
                uploadImage($section, $this->image, 'section/image/',"section-image", 'original', 'save', null);
            }
        }

        $updateRecord = $this->except(['search','formMode','updateMode','section_id','image','originalImage','page','paginators']);

        $section->update($updateRecord);

        $this->formMode = false;
        $this->updateMode = false;

        $this->flash('success',trans('messages.edit_success_message'));
        $this->resetInputFields();
        return redirect()->route('admin.section');
    }

    public function show($id){
        $this->resetPage('page');
        $this->section_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
        $this->initializePlugins();
    }

    public function edit($id)
    {
        $this->resetPage('page');
        $section = Section::findOrFail($id);
        $this->section_id = $id;
        $this->section_key = $section->key;
        $this->name  = $section->name;
        $this->year_experience  = $section->year_experience;
        $this->short_description  = $section->short_description;
        $this->description = $section->description;
        $this->features    = $section->features;
        $this->status = $section->status;
        $this->originalImage = $section->image1_url;
        $this->formMode = true;
        $this->updateMode = true;
        $this->initializePlugins();
    }

    private function resetInputFields(){
        $this->name = '';
        $this->short_description = '';
        $this->year_experience = '';
        $this->description = '';
        $this->features = '';
        $this->status = 1;
        $this->image1 = null;
        $this->image2 = null;
    }

    public function cancel(){
        $this->formMode = false;
        $this->updateMode = false;
        $this->viewMode = false;

    }

    public function toggle($id){
        $this->confirm('Are you sure?', [
            'text'=>'You want to change the status.',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes Confirm!',
            'cancelButtonText' => 'No Cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['sectionId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $sectionId = $event['data']['inputAttributes']['sectionId'];
        $model = Section::find($sectionId);
        $model->update(['status' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }

    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }
}
