<?php

namespace App\Http\Livewire\Frontend\Pages;

use Livewire\Component;
use App\Models\Testimonial;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Testimonials extends Component
{
    use LivewireAlert;

    public $rating, $description;

    public $perPage = 6;

    public function mount(){
    }

    public function loadMore()
    {
        $this->perPage = $this->perPage + 6;
    }

    public function render()
    {
        $testimonials = Testimonial::where('status',1)->latest()->paginate($this->perPage);
        return view('livewire.frontend.pages.testimonials',compact('testimonials'));
    }

    public function updatedDescription(){
        $validatedData = $this->validate([
            'description' => ['required','min:'.config('constants.min_review_length')],
        ],[
            'description.required' => 'The review field is required.',
            'description.min' => 'The review must be at least '.config('constants.min_review_length').' characters long.'
        ]);
    }

    public function storeReview(){
        $validatedData = $this->validate([
            'rating'      => ['required'],
            'description' => ['required','min:'.config('constants.min_review_length')],
        ],[
            'description.required' => 'The review field is required.',
            'description.min' => 'The review must be at least '.config('constants.min_review_length').' characters long.'
        ]);

      
        Testimonial::create($validatedData);

        $this->reset(['rating','description']);

        $this->alert('success', 'Your review added successfully!');
    }

    
        
}
