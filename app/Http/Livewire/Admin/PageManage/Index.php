<?php

namespace App\Http\Livewire\Admin\PageManage;

use Gate;
use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null, $status = 1;

    public $sortColumnName = 'created_at', $sortDirection = 'desc', $paginationLength = 10;

    public $page_id=null, $parent_page ,$title, $sub_title, $type, $description, $template_name, $slider_image=null, $originalsliderImage, $image=null, $originalImage,$link;

    protected $listeners = [
        'updatePaginationLength','confirmedToggleAction','deleteConfirm', 'cancelledToggleAction','refreshComponent' => 'render',
    ];

    public function mount(){
        abort_if(Gate::denies('page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function updatePaginationLength($length){
        $this->paginationLength = $length;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedType($pageType)
    {
        $this->type = (int)$pageType;
        $this->initializePlugins();
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

        $typeSearch = null;
        foreach(config('constants.page_types') as $key=>$typeName){
            if(Str::contains($typeName, strtolower($searchValue))){
                $typeSearch =  $key;
            }
        }

        $allPage = Page::query()->where(function ($query) use($searchValue,$statusSearch,$typeSearch) {
            $query->where('title', 'like', '%'.$searchValue.'%')
            ->orWhere('type', $typeSearch)
            ->orWhere('status', $statusSearch)
            ->orWhereRaw("date_format(created_at, '".config('constants.search_datetime_format')."') like ?", ['%'.$searchValue.'%']);
        })
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->paginationLength);


        return view('livewire.admin.page-manage.index',compact('allPage'));
    }

    public function create()
    {
        $this->resetPage('page');
        $this->resetInputFields();
        $this->initializePlugins();
        $this->formMode = true;
    }

    private function resetInputFields(){
        $this->parent_page = '';
        $this->title = '';
        $this->sub_title = '';
        $this->type = '';
        $this->description = '';
        $this->template_name = '';
        $this->status = 1;
        $this->slider_image = null;
        $this->image = null;
        $this->link = '';

    }

    public function store(){

        if(in_array($this->type,array(1,2,3))){
            $validatedData = $this->validate([
                'title'           => ['required', /*'regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',*/ 'max:255','unique:pages,title'],
                'sub_title'       => ['required'],
                // 'template_name'   => ['required', 'alpha', 'max:255'],
                'description'     => '',
                'type'            => 'required',
                'status'          => 'required',
                'slider_image'     => 'required|image|max:'.config('constants.img_max_size'),
    
            ]);
        }else{
            $validatedData = $this->validate([
                'title'           => ['required', /*'regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',*/ 'max:255','unique:pages,title'],
                'description'     => '',
                'link'            => '',
                'type'            => 'required',
                'status'          => 'required',
                'image'           => 'required|image|max:'.config('constants.img_max_size'),
            ]);
        }
        
        $validatedData['status'] = $this->status;

        $page = Page::create($validatedData);
  
        if(in_array($this->type,array(1,2,3))){
            //Slider Image
            uploadImage($page, $this->slider_image, 'page/slider/',"page-slider", 'original', 'save', null);
        }else{
            uploadImage($page, $this->image, 'page/image/',"page-image", 'original', 'save', null);
        }

        $this->formMode = false;

        $this->resetInputFields();

        $this->flash('success',trans('messages.add_success_message'));
      
        return redirect()->route('admin.page-manage');
    }

    public function edit($id){
        $this->resetPage('page');
        $this->initializePlugins();
        $page = Page::findOrFail($id);
        $this->page_id = $id;
        $this->title           = $page->title;
        $this->sub_title       = $page->sub_title;
        $this->type            = $page->type;
        // $this->template_name   = $page->template_name;
        $this->description     = $page->description;
        $this->status          = $page->status;
        $this->originalsliderImage = $page->slider_image_url;
        $this->originalImage   = $page->image_url;
        $this->link            = $page->link;
        $this->formMode = true;
        $this->updateMode = true;
    }

    public function update(){
        if(in_array($this->type,array(1,2,3))){
            $validatedArray =[
                'title'           => ['required', /*'regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',*/'max:255','unique:pages,title,'.$this->page_id],
                'sub_title' => ['required'],
                'type'  => 'required',
                // 'template_name'   => ['required', 'alpha', 'max:255'],
                'description'     => '',
                'status'          => 'required',
            ];
        }else{
            $validatedArray =[
                'title'           => ['required', /*'regex:/^[A-Za-z]+( [A-Za-z]+)?$/u',*/'max:255','unique:pages,title,'.$this->page_id],
                'type'  => 'required',
                'description'     => '',
                'link'            => '',
                'status'          => 'required',
            ];
        }
        
        if($this->slider_image && in_array($this->type,array(1,2,3))){
            $validatedArray['slider_image'] = 'required|image|max:'.config('constants.img_max_size');
        }elseif($this->slider_image && in_array($this->type,array(4,5))){
            $validatedArray['image'] = 'required|image|max:'.config('constants.img_max_size');
        }

        $validatedData = $this->validate($validatedArray);
        $validatedData['status'] = $this->status;

        $page = Page::find($this->page_id);

        // Check if the image has been changed
        $uploadId = null;
        if ($this->slider_image && in_array($this->type,array(1,2,3))) {
            if($page->sliderImage){
                $uploadId = $page->sliderImage->id;
                uploadImage($page, $this->slider_image, 'page/slider/',"page-slider", 'original', 'update', $uploadId);
            }else{
                uploadImage($page, $this->slider_image, 'page/slider/',"page-slider", 'original', 'save', null);
            }
           
        }elseif($this->image && in_array($this->type,array(4,5))) {
            if($page->image){
                $uploadId = $page->image->id;
                uploadImage($page, $this->image, 'page/image/',"page-image", 'original', 'update', $uploadId);
            }else{
                uploadImage($page, $this->image, 'page/image/',"page-image", 'original', 'save', null);
            }
        }

        $page->update($validatedData);
  
        $this->formMode = false;
        $this->updateMode = false;
  
        $this->flash('success',trans('messages.edit_success_message'));
        $this->resetInputFields();
        return redirect()->route('admin.page-manage');
    }

    public function delete($id)
    {
        $this->confirm('Are you sure?', [
            'text'=>'You want to delete it.',
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'deleteConfirm',
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['deleteId' => $id],
        ]);
    }

    public function deleteConfirm($event){
        $deleteId = $event['data']['inputAttributes']['deleteId'];
        $model = Page::find($deleteId);
        if($model->sliderImage){
            $uploadImageId = $model->sliderImage->id;
        }

        if($model->image){
            $uploadImageId = $model->image->id;
        }

        deleteFile($uploadImageId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
        $this->resetPage('page');
        $this->page_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
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
            'confirmButtonText' => 'Yes, change it!',
            'cancelButtonText' => 'No, cancel!',
            'onConfirmed' => 'confirmedToggleAction',
            'onDismissed' => 'cancelledToggleAction',
            'inputAttributes' => ['pageId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $pageId = $event['data']['inputAttributes']['pageId'];
        $model = Page::find($pageId);
        $statusVal = $model->status ? 0 : 1;
        $model->status = $statusVal;
        $model->save();
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function cancelledToggleAction(){
        $this->emit('refreshComponent');
        // $this->dispatchBrowserEvent('updateStatusCancel');
        // return redirect()->route('admin.page-manage');
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }

    
    public function initializePlugins(){
        $this->dispatchBrowserEvent('loadPlugins');
    }
    

}
