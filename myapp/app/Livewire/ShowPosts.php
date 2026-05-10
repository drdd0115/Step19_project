<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("components.layouts.guest")]
#[Title("記事一覧ページ")]
class ShowPosts extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public function updatedSearch(){
        $this->resetPage();
    }

    public function clearSearch() {
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::with('user')
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('body', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }
}
