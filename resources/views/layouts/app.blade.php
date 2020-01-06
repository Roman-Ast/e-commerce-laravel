<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <title> @yield('title') </title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    </head>
    <body>
   
    @yield('content') 
        


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <!--<script src="https://js.stripe.com/v3/"></script>-->
        <script src="{{ URL::asset('js/checkout.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/main.js') }}"></script>
        <script src="{{ URL::asset('js/jquery_min.js') }}"></script>
        <script type="text/javascript">
            $(function () {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.thumbsUp').on('click', function (e) {
                e.preventDefault();

                
            })
            $('#save-as-draft').on('click', function(e) {
                e.preventDefault();
                
                const data = {
                    author_id: $('#author_id').val(),
                    author_name: $('#author_name').val(),
                    status: 'черновик',
                    title: $('#article-title').val(),
                    body: $('#article-body').val(),
                };
                
                $.ajax({
                    data: data,
                    url: "{{ route('articles.saveAsDraft') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('.container').prepend(
                            `<div class="alert alert-success">
                                Статья сохранена как черновик.
                            </div>`
                        );
                        console.log(data);
                        setTimeout(() => {
                            $(location).attr('href', '/myarticles');
                        }, 3000);
                    },
                    error: function (data) {
                        console.log('error');
                        console.log(data);
                    }
                });
              });

              $('#update-draft').on('click', function(e) {
                e.preventDefault();
                
                const data = {
                    article_id: $('#article_id').val(),
                    author_id: $('#author_id').val(),
                    author_name: $('#author_name').val(),
                    status: 'черновик',
                    title: $('#article-title').val(),
                    body: $('#article-body').val(),
                };
                
                $.ajax({
                    data: data,
                    url: `{{ route('articles.updateDraft', $article->id ?? '') }}`,
                    type: "PATCH",
                    dataType: 'json',
                    success: function (data) {
                        $('.container').prepend(
                            `<div class="alert alert-success">
                                Черновик обновлен.
                            </div>`
                        );
                        
                        setTimeout(() => {
                            $(location).attr('href', '/myarticles');
                        }, 3000);
                    },
                    error: function (data) {
                        $('.container').prepend(
                            `<div class="alert alert-danger">
                                Упс, что-то пошло не так! Попробуйте еще...
                            </div>`
                        );
                    }
                });
              });

              $('#to-like').on('click', function(e) {
                e.preventDefault();
                const thisBtn = $(this);
                const data = {
                    article_id: $('#article_id').val(),
                    user_id: $('#user_id').val(),
                };
                
                $.ajax({
                    data: data,
                    url: `{{ route('article.like', $article->id ?? '') }}`,
                    type: "PATCH",
                    dataType: 'json',
                    success: function (data) {
                        if (data.likesCountOfArticle == 0) {
                            $('#dynamicLikesCount').html('');
                            $('#to-like').children().last().hide(100);
                                $('#to-like').children().first().show(100);
                        } else {
                            if (data.likedByMe) {
                                $('#to-like').children().last().show(100);
                                $('#to-like').children().first().hide(100);
                            } else {
                                $('#to-like').children().last().hide(100);
                                $('#to-like').children().first().show(100);
                            }
                            $('#dynamicLikesCount').html(data.likesCountOfArticle);
                        }
                        console.log(data);
                    },
                    error: function (data) {
                        console.log('error');
                        console.log(data);
                    }
                });
              });
            });

            $('.product-section-thumbnail').first().addClass('product-selected');
            $('.product-section-thumbnail').on('click', function (e) {
                $('#currentImage').attr('src', $(this).children().first().attr('src'));
                $('.product-section-thumbnail').removeClass('product-selected');
                $(this).addClass('product-selected');
            });
        </script>
    </body>
</html>