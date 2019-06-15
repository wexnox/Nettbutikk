<!-- ----------Scroll up knapp -------------->
        <button onclick="topFunction()" id="myBtn" title="GÅ til toppen"><span class="glyphicon glyphicon-arrow-up"></span></button>

<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>

<!-- --------------- scroll up knapp ferdig --------------- -->

<!-- <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.Laravel', 'Nettbutikk') }}</a>-->
<nav class="navbar navbar-expand-md" style="">
    <div class="container" style="">
        <!-- Logo-->
        <div class="col-sm-6">
            <a class="navigation-header-logo" href="/" tabindex="20" title="G&#229; til forsiden.">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="G&#229; til forsiden.">
            </a>
        </div>

        <div class="col-sm-6">
            <form class="navbar-form navbar-right" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Søk">
                </div>
                <button type="submit" class="btn btn-default">Søk</button>
            </form>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-md" style="margin-top: -1.6%; border-bottom: 1px solid grey;">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a style="font-size: 120%; color: #00244d;" class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" >
                        <span class="glyphicon glyphicon-th-list"></span>  Alle produkter</a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#"><i class="material-icons">&#xe338;</i> Link 1</a></li>
                        <li><a class="nav-link" href="#"><i class="material-icons">&#xe32c;</i> Link 2</a></li>
                        <li><a class="nav-link" href="#"><i class="material-icons">&#xe30a;</i> Link 3</a></li>
                    </ul>
                </li>
                <br/>

                <li class="nav-item">
                    <a style="font-size: 120%; color: #00244d;" class="nav-link" href="#">Våre beste kupp!</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-right">
                <li><a  style="font-size: 120%; color: #00244d;" href="{{ route('product.shoppingCart') }}"><i class="fas fa-shopping-cart"></i> Handlekurv  <span class="badge"> {{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span> </a></li> <!-- Her kommer handlekurv linken -->

                <li class="nav-item dropdown">
                    @guest
                        <a style="font-size: 120%; color: #00244d;" class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" ><i class="fas fa-user"></i> Brukerkonto</a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Logg inn') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        </ul>
                    @endguest
                    @auth
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"  aria-expanded="false"><i class="fas fa-user"></i> {{ Auth::user()->name }} </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/profile') }}"><i class="fas fa-user-circle"></i> Bruker konto</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
