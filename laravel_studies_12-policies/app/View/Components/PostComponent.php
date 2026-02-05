<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostComponent extends Component
{
    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function render(): View|Closure|string
    {
        return view('components.post-component');
    }
}
