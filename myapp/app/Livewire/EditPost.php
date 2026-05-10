<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EditPost extends Component
{
    public Post $post;

    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('required')]
    public $body = '';

    #[Validate('required')]
    public $category = '未分類';

    #[Validate('required')]
    public $status= 'published';

    public function mount(Post $post) {
        if($post->user_id !== Auth::id()){
            abort(403);
        }

        $this->post = $post;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->category = $post->category;
        $this->status = $post->status;
    }

    public function update($status = null) {
        $this->validate();

        if($this->post->user_id !== Auth::id()){
            abort(403);
        }

        $this->post->update([
            'title' => $this->title,
            'body' => $this->body,
            'category' => $this->category,
            'status' => $status ?? $this->status,
        ]);

        session()->flash('status', '記事を更新しました！');

        return $this->redirect('/my-posts', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}