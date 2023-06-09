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

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null;

    public $page_id=null, $title;

    protected $pages = null;

    protected $listeners = [
        'confirmedToggleAction','deleteConfirm'
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
        dd('working..');
        $this->resetInputFields();
        $this->formMode = true;
    }

    private function resetInputFields(){
        $this->first_name = '';
        $this->last_name = '';
    }

    public function store(){
       
    }

    public function edit($id){
        dd('working..');

    }

    public function update(){

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
        dd('working..');
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
            'onCancelled' => function () {
                // Do nothing or perform any desired action
            },
            'inputAttributes' => ['pageId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $pageId = $event['data']['inputAttributes']['pageId'];
        $model = Page::find($pageId);
        $model->update(['status' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }
    

}
