@extends('layouts.app')

@section('content')
    <main class="py-5">
        <div class="main-home">
            @yield('content')
        </div>
    </main>
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>Bulgaria
                            <br>8000 Burgas , sssss</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <!-- some social networks -->
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About Car1bg</h3>
                        <p> <a href="http://http://car1burgas.co.uk/">Car1bg</a>.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Author
                        <?php echo date( "Y"); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

