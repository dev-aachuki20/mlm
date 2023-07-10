<?php

namespace App\Http\Livewire\Auth\Profile;


use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ChangePassword extends Component
{
    use LivewireAlert;

    protected $layout = null;
    
    public $userId;
    
    public $oldPassword,$checkOldPassword;

    public $old_password, $new_password, $confirm_password;

    public function mount(){
        $this->userId = auth()->user()->id;
        $this->oldPassword = auth()->user()->password;
    }

    protected function rules() 
    {
        return [
            'old_password'  => ['required', 'string','min:8',new MatchOldPassword],
            'new_password'   => ['required', 'string', 'min:8', /*'confirmed',*/ 'different:old_password'],
            'confirm_password' => ['required','min:8','same:new_password'],
        ];
    }

    protected function messages() 
    {
        // return getCommonValidationRuleMsgs();
        return [
            'confirm_password.same' => 'The confirm password and new password must match.'
        ];
    }
  
   
    public function render()
    {
        return view('livewire.auth.profile.change-password');
    }

    public function updatePassword(){
        $validated = $this->validate($this->rules(),$this->messages());
        
        User::find($this->userId)->update(['password'=> Hash::make($this->new_password)]);

        $this->resetInputFields();

        // $this->dispatchBrowserEvent('close-modal',['element'=>'#changePasswordModal']);

        // Set Flash Message
        $this->alert('success', 'Your password has been changed!');

    }

    private function resetInputFields(){
        $this->old_password = '';
        $this->new_password = '';
        $this->confirm_password = '';
    }
    
}