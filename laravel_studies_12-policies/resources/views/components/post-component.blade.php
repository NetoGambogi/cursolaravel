<div class="card bg-dark p-3 mt-3">
    
    <div class="d-flex justify-content-between">
        <div class="text-info">
            Autor: <strong>{{ $post->user->name }}</strong>
        </div>

        <div class="text-end text-light">
            {{ $post->created_at }}
        </div>
    </div>

    <div class="mt-3">
        <h4>{{ $post->title }}</h4>
        <p>{{ $post->content }}</p>
    </div>

    <div class="d-flex justify-content-end gap-5">
        @can('update', $post)
            <a href="#" class="btn btn-primary">Editar</a>
        @endcan

        @can('delete', $post)
            <a href="#" class="btn btn-danger">Deletar</a>
        @endcan
    </div>

</div>