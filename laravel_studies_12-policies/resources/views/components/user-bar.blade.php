<div class="d-flex bg-black text-wite justify-content-between p-3">
    <div>
        Username: <strong>{{ Auth::user()->name }}</strong>
    </div>

    <div>
        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger">Logout</a>
    </div>
</div>