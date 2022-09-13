<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <title>Devices Manager</title>
</head>
<body>
    

    <!-- Header con navbar -->
    <header>
        <nav>
            <div class="container">
                <div class="logo"><img src="/icons/device.svg" alt=""><span>DevicesManager</span></div>
                <div class="buttons-menu">
                    <div class="left">
                        <div class="menu-button">
                            <a href="/"><img src="/icons/home.svg" alt="home">Home</a>
                        </div>
                        @auth
                            <div class="welcome">
                                <span>Welcome, <b>{{ auth()->user()->name }}</b></span>
                            </div>
                            
                        @endauth
                    </div>
                    <div class="right">
                        <form action="#" method="get">
                            <input class="search" type="text" name="search" placeholder="Cerca seriale">
                            <button><img src="/icons/search.svg" alt=""></button>
                        </form>
                        @auth
                            @if ((auth()->user()->is_admin) != 0)
                                <div class="menu-button">
                                    <a href="/register"><img src="/icons/plus.svg" alt="">Manutentore</a>
                                </div>
                                <div class="menu-button">
                                    <a href="/department/create"><img src="/icons/plus.svg" alt="">Reparto</a>
                                </div>
                                <div class="menu-button">
                                    <a href="/typology/create"><img src="/icons/plus.svg" alt="">Tipo</a>
                                </div>
                                <div class="menu-button">
                                    <a href="/utilizer/create"><img src="/icons/plus.svg" alt="">User</a>
                                </div>

                            @endif

                                <div class="menu-button">
                                    <a href="/device/create"><img src="/icons/plus.svg" alt="">Dispositivo</a>
                                </div>
                                <div class="menu-button">
                                    <a href="/logout"><img src="/icons/logout.svg" alt="">Logout</a>
                                </div>
                            
                        @else
                            <div class="menu-button">
                                <a href="/login"><img src="/icons/login.svg" alt="">Login</a>
                            </div>
                            
                        @endauth
                    </div>
                    
                </div>
                
            </div>
        </nav>
    </header>

    <main>

        <div class="container">
            <!-- Messaggi -->
            @if (session()->has('success'))
                <div>
                    <p style="color: green"><strong>{{session('success')}}</strong></p>
                </div>
            @endif
            @if (session()->has('message'))
                <div>
                    <p style="color: red"><strong>{{session('message')}}</strong></p>
                </div>
            @endif
        </div>

        <!-- Contenuto dinamico -->
        <section class="content">
            <div class="container">
                @yield('content')
            </div>
        </section>
    
    </main>
    

</body>
</html>


