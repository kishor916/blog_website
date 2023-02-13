<x-layout>
    <div class="container py-md-5 container--narrow">
        <div class="d-flex justify-content-between">
            <h2>{{$post->title}}</h2>
            
            @can('update', $post)
            {{-- this spane will only be shown i the user can update the post, which i sbeonmg defined in the policy --}}
            <span class="pt-2">
                <a href="#" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i
                        class="fas fa-edit"></i></a>
                <form class="delete-post-form d-inline" action="/post/{{$post->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top"
                        title="Delete"><i class="fas fa-trash"></i></button>
                </form>
            </span>
            @endcan

        </div>

        <p class="text-muted small mb-4">
            <a href="#"><img class="avatar-tiny"
                    src="https://gravatar.com/avatar/f64fc44c03a8a7eb1d52502950879659?s=128" /></a>
            Posted by <a href="#">{{$post->momo->username}}</a> on {{$post->created_at->format('n/j/Y')}}
        </p>

        <div class="body-content">
                <p>{!!$post->body!!}</p>
        </div>
    </div>

</x-layout>
