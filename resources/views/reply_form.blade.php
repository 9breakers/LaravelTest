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
                    <form method="POST" action="{{ route('comments.reply', ['comment' => $comment->id]) }}" class="mt-3">

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
</div>

</body>
</html>
