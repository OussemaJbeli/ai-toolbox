<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="
        AI-Toolbox is part of this innovative dynamic, offering an avant-garde SaaS (Software as a Service) platform that democratizes access to OpenAI's most sophisticated AI technologies for the generation of textual, visual, and hearing in a variety of languages.
        AI- Toolbox is designed to transform the way people and businesses create and manage content, leveraging the power of cutting-edge AI models like GPT-4 for text, DALL-E for images, and Whisper for audio transcription. Our platform not only provides unparalleled flexibility and efficiency in creating original and engaging content, but it also serves as a catalyst for innovation, allowing users to transcend traditional boundaries of creativity."
    >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/blogs.css')}}">
    <link rel="stylesheet" href="{{ asset('css/animation.css')}}">
    <meta name="author" content="Grayrids">
    <title>AI-TOOLBOX</title>
</head>
<body>
    <div class="header">
        <a href="/" class="navbar left_visible">
            <span>ai</span>
            <p>-toolbox</p>
        </a>  
        <div class="btn-item">
            <a class="btn btn-singin" href="/register">sign in</a>
            <a class="btn btn-singup" href="/login">sign up</a>
        </div>  
    </div>
    <div id="bloge_content">
        <div class="details">
            <i class="fa-solid fa-circle-user"></i><span>{{$blog->name}}</span><span>{{date('d F, Y', strtotime($blog->created_at))}}</span>
        </div>
        <div class="title up_animatedElement up_hidden">{{ $blog->title }}</div>
        <div class="image up_animatedElement up_hidden">
            <img src="{{ asset($blog->image_path)}}" class="img-fluid" alt="">   
        </div>
        <div class="text up_animatedElement up_hidden">{!! $blog->continue !!}</div>
    </div>
    <footer>
            <!-- Footer Area Start -->
            <section id="footer-Content">
                <div class="container">
                <!-- Start Row -->
                <div class="row footer_Subcontent">
                    <h1 class="title_footer up_animatedElement up_hidden">Save time. Get Started Now.</h1>
                    <p class="title_footer up_animatedElement up_hidden">Unleash the most advanced AI creator<br>and boost your productivity</p>
                    <a href="/" class="navbar up_animatedElement up_hidden">
                        <span>ai</span>
                        <p>-toolbox</p>
                    </a>  
                </div>
                <!-- End Row -->
                </div>
                <!-- Copyright Start  -->

                <div class="copyright">
                    <div class="container">
                        <!-- Star Row -->
                        <div class="row">
                        <div class="col-md-12">
                            <div class="site-info text-center">
                            <p>
                                &copy; 2024 - AI-TOOLBOX
                            </p>
                            </div>              
                            
                        </div>
                        <!-- End Col -->
                        </div>
                        <!-- End Row -->
                    </div>
                </div>
            <!-- Copyright End -->
            </section>
            <!-- Footer area End -->
            
    </footer>


    <div class="cursor" id="cursor"></div>
    <script>
        const cursor = document.querySelector('.cursor');
        document.addEventListener('mousemove', (e)=>{
            cursor.style.left = e.pageX + 'px';
            cursor.style.top = e.pageY + 'px';
        });
    </script>
    <script src="{{ asset('js/animation.js')}}"></script>
</body>
</html>