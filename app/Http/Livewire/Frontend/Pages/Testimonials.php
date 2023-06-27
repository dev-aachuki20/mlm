<?php

namespace App\Http\Livewire\Frontend\Pages;

use Livewire\Component;
use App\Models\Testimonial;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Testimonials extends Component
{
    use LivewireAlert;

    public $rating, $description;

    public $count=9, $testimonials;

    public function mount(){
        $this->testimonials = Testimonial::where('status',1)->take($this->count)->get();
    }

    public function loadMore()
    {
        $this->count += 9;
    }

    public function render()
    {
        return view('livewire.frontend.pages.testimonials');
    }

    public function updatedDescription(){
        $validatedData = $this->validate([
            'description' => ['required','max:'.config('constants.max_review_length')],
        ],[
            'description.required' => 'The review field is required.',
            'description.max' => 'The review must be at least '.config('constants.max_review_length').' characters long.'
        ]);
    }

    public function storeReview(){
        $validatedData = $this->validate([
            'rating'      => ['required'],
            'description' => ['required','max:'.config('constants.max_review_length')],
        ],[
            'description.required' => 'The review field is required.',
            'description.max' => 'The review must not be longer than '.config('constants.max_review_length').' characters.'
        ]);

      
        Testimonial::create($validatedData);

        $this->reset(['rating','description']);

        $this->alert('success', 'Your review added successfully!');
    }

    
        
}
