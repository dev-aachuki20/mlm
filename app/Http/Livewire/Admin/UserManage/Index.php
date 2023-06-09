<?php

namespace App\Http\Livewire\Admin\UserManage;

use Gate;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false, $viewDetails = null;

    public $user_id=null,$first_name,$last_name;

    protected $users = null;

    protected $listeners = [
        'confirmedToggleAction','deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function render()
    {
        $this->users = User::query()
        ->where('name', 'like', '%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate(10);

        $allUser = $this->users;
        return view('livewire.admin.user-manage.index',compact('allUser'));
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
        $model = User::find($deleteId);
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
            'inputAttributes' => ['userId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $userId = $event['data']['inputAttributes']['userId'];
        $model = User::find($userId);
        $model->update(['is_active' => !$model->status]);
        $this->alert('success', trans('messages.change_status_success_message'));
    }

    public function changeStatus($statusVal){
        $this->status = (!$statusVal) ? 1 : 0;
    }
    
}
