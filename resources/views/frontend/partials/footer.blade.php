<footer class="luna-footer" id="luna-footer">

    <div class="container">

        <div class="row g-4">

            {{-- SHOP --}}
            <div class="col-6 col-md-3">

                <h6>Shop</h6>

                <a href="{{ route('shop') }}">New Arrivals</a>
                <a href="{{ route('shop') }}">Clothing</a>
                <a href="{{ route('shop') }}">Dresses</a>
                <a href="{{ route('shop') }}">Accessories</a>
                <a href="{{ route('shop') }}">Sale</a>

            </div>

            {{-- CUSTOMER CARE --}}
            <div class="col-6 col-md-3">

                <h6>Customer Care</h6>

                <a href="#">Contact Us</a>
                <a href="#">Shipping & Returns</a>
                <a href="#">Size Guide</a>
                <a href="#">FAQs</a>
                <a href="#">Track Order</a>

            </div>

            {{-- ABOUT --}}
            <div class="col-6 col-md-3">

                <h6>About Luna</h6>

                <a href="#">Our Story</a>
                <a href="#">Our Philosophy</a>
                <a href="#">Store Location</a>

                <h6 class="mt-4">Follow Us</h6>

                <div class="d-flex gap-3">

                    <a href="#" aria-label="Instagram">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>

                    <a href="#" aria-label="Facebook">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>

                    <a href="#" aria-label="Pinterest">
                        <i class="bi bi-pinterest fs-5"></i>
                    </a>

                </div>

            </div>

            {{-- NEWSLETTER --}}
            <div class="col-6 col-md-3">

                <h6>Stay In The Know</h6>

                <p class="small text-muted">
                    Sign up for new arrivals, style updates, and exclusive offers.
                </p>

                <form action="#" method="POST">

                    <div class="input-group input-group-sm">

                        <input type="email" class="form-control rounded-0" placeholder="Enter your email" aria-label="Email address">

                        <button class="btn btn-luna rounded-0" type="button">
                            JOIN
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <p class="small text-muted mb-0">
                © {{ date('Y') }} kATHIRAZHAGI Boutique. All Rights Reserved.
            </p>

            <div class="d-flex gap-3">

                <a href="#" class="mb-0">Privacy Policy</a>
                <a href="#" class="mb-0">Terms & Conditions</a>

            </div>

        </div>

    </div>

</footer>
