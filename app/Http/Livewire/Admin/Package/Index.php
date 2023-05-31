<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $layout = null;

    public $search = '';

    public function render()
    {
        $packages = Package::query()
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('title')
            ->paginate(10);

        return view('livewire.admin.package.index', compact('packages'));
    }
}
