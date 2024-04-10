<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    @vite(['resources/css/styles.css','resources/js/scripts.js','resources/js/captcha.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">

        <!-- Comments section-->
        <section class="mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    <!-- Comment form-->
                    <form method="POST" action="{{route('comments.store')}}" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" id="username" name="username">
                            @error('username')
                            <label for="" class="text-danger">{{$message}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" >
                            @error('email')
                            <label for="" class="text-danger">{{$message}}</label>
                            @enderror
                        </div>

                        <div class="form-group mt-2  mb-2">
                         <div class="captcha">
                             <span>{!! captcha_img() !!}</span>
                             <button type="button" class="btn btn-danger reload" id="reload">  &#x21bb;</button>
                         </div>
                        </div>

                        <div class="form-group mt-2">
                                <input type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                @error('captcha')
                                <label for="" class="text-danger">{{$message}}</label>
                                @enderror
                        </div>


                        <div class="form-group">
                            <label for="text">Text</label>
                            <textarea class="form-control" id="text" name="text" ></textarea>
                            @error('text')
                            <label for="" class="text-danger">{{$message}}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-3 mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </section>

    </div>



    <div class="row">
        <div class="col-md-12">
            <!-- Кнопки сортування -->
            <div class="d-flex mb-3">
                <a href="{{ route('comments.index', ['sortBy' => 'username', 'sortDirection' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="btn btn-sm btn-primary me-2">Сортувати за ім'ям</a>
                <!-- Кнопка для сортування за E-mail -->
                <a href="{{ route('comments.index', ['sortBy' => 'email', 'sortDirection' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="btn btn-sm btn-primary me-2">Сортувати за E-mail</a>
                <!-- Кнопка для сортування за датою додавання -->
                <a href="{{ route('comments.index', ['sortBy' => 'created_at', 'sortDirection' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="btn btn-sm btn-primary me-2">Сортувати за датою додавання</a>
            </div>

            <!-- Секція з коментарями -->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Виведення коментарів та їх дочірніх коментарів -->
                        @foreach($comments as $comment)
                            <div class="comment">
                                <!-- Батьківський коментар -->
                                <div class="comment-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">

                                            <div class="fw-bold">{{ $comment->username }}</div>
                                            <div class="fw-bold">{{ $comment->email }}</div>
                                            <div class="fw-bold">{{ $comment->created_at }}</div>
                                            {{ $comment->text }}
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <form action="{{ route('reply.form', ['comment' => $comment->id]) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">Відповісти</button>
                                        </form>
                                    </div>

                                    <div class="mt-3">
                                        <button type="button" class="btn btn-sm btn-link toggle-replies">...</button>
                                    </div>

                                    <div class="nested-comments d-none">
                                        @if(count($comment->replies) > 0)
                                            @foreach($comment->replies as $reply)
                                                <div class="nested-comment ms-5">
                                                    <div class="comment-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                            <div class="ms-3">
                                                                <div class="fw-bold">{{ $comment->username }}</div>
                                                                <div class="fw-bold">{{ $comment->email }}</div>
                                                                <div class="fw-bold">{{ $comment->created_at }}</div>
                                                                {{ $reply->text }}
                                                            </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            <form action="{{ route('reply.form', ['comment' => $reply->id]) }}" method="GET">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-primary">Відповісти</button>
                                                            </form>
                                                        </div>

                                                        @foreach($reply->replies as $nestedReply)
                                                            <div class="nested-comment ms-5">
                                                                <div class="comment-body">
                                                                    <div class="d-flex">
                                                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                                        <div class="ms-3">
                                                                            <div class="fw-bold">{{ $comment->username }}</div>
                                                                            <div class="fw-bold">{{ $comment->email }}</div>
                                                                            <div class="fw-bold">{{ $comment->created_at }}</div>
                                                                            {{ $nestedReply->text }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="mt-3">
                                                                        <form action="{{ route('reply.form', ['comment' => $nestedReply->id]) }}" method="GET">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-sm btn-primary">Відповісти</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    {{ $comments->links() }}
                </div>
            </section>
        </div>
    </div>



</div>

</body>
</html>
