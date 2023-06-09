<?php

namespace App\Http\Livewire\Admin\Faq;

use Gate;
use Livewire\Component;
use App\Models\Faq;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '', $formMode = false , $updateMode = false, $viewMode = false,$viewDetails = null;

    public $faq_id = null, $question, $answer,$status = 1;

    protected $faqs = null;

    protected $listeners = [
        'confirmedToggleAction','deleteConfirm'
    ];

    public function mount(){
        abort_if(Gate::denies('faq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }

    public function render()
    {
        $this->faqs = Faq::query()
        ->where('question', 'like', '%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate(10);

        $allFaqs = $this->faqs;

        return view('livewire.admin.faq.index',compact('allFaqs'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->initializePlugins();
        $this->formMode = true;
    }


    public function store()
    {
        $validatedDate = $this->validate([
            'question' => 'required',
            'answer'   => 'required',
            'status'  => 'required',
        ]);

        $validatedDate['status'] = $this->status;
    
        Faq::create($validatedDate);
  
        $this->formMode = false;

        $this->resetInputFields();

        $this->flash('success',trans('messages.add_success_message'));
      
        return redirect()->route('admin.faq');
    }

    public function edit($id)
    {
        $this->initializePlugins();
        $faq = Faq::findOrFail($id);
        $this->faq_id = $id;
        $this->question     = $faq->question;
        $this->answer       = $faq->answer;
        $this->status       = $faq->status;

        $this->formMode = true;
        $this->updateMode = true;
    }

    public function update(){
        $validatedDate = $this->validate([
            'question' => 'required',
            'answer'   => 'required',
            'status'  => 'required',
        ]);
  
        $validatedDate['status'] = $this->status;

        $faq = Faq::find($this->faq_id);
        $faq->update($validatedDate);
  
        $this->formMode = false;
        $this->updateMode = false;
  
        $this->flash('success',trans('messages.edit_success_message'));
        $this->resetInputFields();
        return redirect()->route('admin.faq');
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
        $model = Faq::find($deleteId);
        $model->delete();
        $this->alert('success', trans('messages.delete_success_message'));
    }

    public function show($id){
        $this->faq_id = $id;
        $this->formMode = false;
        $this->viewMode = true;
    }

    private function resetInputFields(){
        $this->question = '';
        $this->answer = '';
        $this->status = 1;
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
            'inputAttributes' => ['faqId' => $id],
        ]);
    }

    public function confirmedToggleAction($event)
    {
        $faqId = $event['data']['inputAttributes']['faqId'];
        $model = Faq::find($faqId);
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
