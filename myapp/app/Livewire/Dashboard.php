<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $total_posts = Post::count();
        $total_my_posts = Post::where('user_id', Auth::id())->count();
        $total_users = User::count();

        $latest_posts = Post::with('user')
            ->where('status', 'published')
            ->latest()
            ->limit(5)
            ->get();

        $latest_my_posts = Post::where('user_id', Auth::id())
            ->latest()
            ->limit(5)
            ->get();

        $my_draft_count = Post::where('user_id', Auth::id())
            ->where('status', 'draft')
            ->count();

        return view('livewire.dashboard', [
            'total_posts' => $total_posts,
            'total_my_posts' => $total_my_posts,
            'total_users' => $total_users,
            'latest_posts' => $latest_posts,
            'latest_my_posts' => $latest_my_posts,
            'my_draft_count' => $my_draft_count,
        ]);
    }
}