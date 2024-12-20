<div class="container-fluid fixed-top">
    <div class="container topbar d-none d-lg-block">
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="" class="navbar-brand"><h1 class="text-primary display-6">HDFarms</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('customer.showIndex') }}" class="nav-item nav-link active">Trang chủ</a>
                    <a href="{{ route('customer.showProduct') }}" class="nav-item nav-link">Sản phẩm</a>
                    <a href="{{ route('customer.showContact') }}" class="nav-item nav-link">Liên lạc</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <a href="{{ route('customer.showCart') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                    </a>
                    <a href="{{ route('customer.showYourOrder') }}" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
