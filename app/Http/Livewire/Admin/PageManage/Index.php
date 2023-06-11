<?php

namespace App\Http\Livewire\Admin\PageManage;

use Gate;
use App\Models\Page;
use Livewire\WithPagination;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null, $status = 1;

    public $page_id=null, $parent_page ,$title, $description, $template_name;

    protected $pages = null;

    protected $listeners = [
        'confirmedToggleAction','deleteConfirm', 'cancelledToggleAction','refreshComponent' => 'render',
    ];

    public function mount(){
        abort_if(Gate::denies('page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function render()
    {
        $this->pages = Page::query()
        ->where('title', 'like', '%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate(10);

        $allPage = $this->pages;

        return view('livewire.admin.page-manage.index',compact('allPage'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->initializePlugins();
        $this->formMode = true;
    }

    private function resetInputFields(){
        $this->parent_page = '';
        $this->title = '';
        $this->description = '';
        $this->template_name = '';
        $this->status = 1;
    }

    public function store(){

        $validatedDate = $this->validate([
            'title'           => ['required', 'regex:/^[A-Za-z]+( [A-Za-z]+)?$/u', 'max:255','unique:pages,title'],
            'template_name'   => ['required', 'alpha', 'max:255'],
            'description'     => 'required',
            'status'          => 'required',
        ]);

        $validatedDate['status'] = $this->status;
    
        Page::create($validatedDate);
  
        $this->formMode = false;

        $this->resetInputFields();

        $this->flash('success',trans('messages.add_success_message'));
      
        return redirect()->route('admin.page-manage');
    }

    public function edit($id){
        $this->initializePlugins();
        $page = Page::findOrFail($id);
        $this->page_id = $id;
        $this->title           = $page->title;
        $this->template_name   = $page->template_name;
        $this->description     = $page->description;
        $this->status          = $page->status;
        $this->formMode = true;
        $this->updateMode = true;
    }

    public function update(){
        $validatedDate = $this->validate([
            'title'           => ['required', 'regex:/^[A-Za-z]+( [A-Za-z]+)?$/u','max:255','unique:pages,title,'.$this->page_id],
            'template_name'   => ['required', 'alpha', 'max:255'],
            'description'     => 'required',
            'status'          => 'required',
        ]);
  
        $validatedDate['status'] = $this->status;

        $page = Page::find($this->page_id);
        $page->update($validatedDate);
  
        $this->formMode = false;
        $this->updateMode = false;
  
        $this->flash('success',trans('messages.edit_success_message'));
        $this->resetInputFields();
        return redirect()->route('admin.page-manage');
    }

    public function delete($id)
    {
        $this->confirm('Are you sure you want to delete it?', [
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => 'Yes, change it!',
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
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
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
        $this->confirm('Are you sure you want to change the status?', [
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
