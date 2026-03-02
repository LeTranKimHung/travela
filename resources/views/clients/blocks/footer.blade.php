<!-- Footer Start -->
    <div class="container-fluid footer py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Liên hệ</h4>
                        <a href=""><i class="fas fa-home me-2"></i> 10/80c Song Hành Xa Lộ Hà Nội, P. Tân Phú, Thủ Đức, TP.HCM</a>
                        <a href=""><i class="fas fa-envelope me-2"></i> hungltk2004@gmail.com</a>
                        <a href=""><i class="fas fa-phone me-2"></i> +84 123 456 789</a>
                        <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +84 123 456 789</a>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-share fa-2x text-white me-2"></i>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Khám phá</h4>
                        <a href="{{ route('home') }}"><i class="fas fa-angle-right me-2"></i> Trang chủ</a>
                        <a href="{{ route('about') }}"><i class="fas fa-angle-right me-2"></i> Về chúng tôi</a>
                        <a href="{{ route('services') }}"><i class="fas fa-angle-right me-2"></i> Dịch vụ</a>
                        <a href="{{ route('tours') }}"><i class="fas fa-angle-right me-2"></i> Danh sách Tour</a>
                        <a href="{{ route('destination') }}"><i class="fas fa-angle-right me-2"></i> Điểm đến</a>
                        <a href="{{ route('blog') }}"><i class="fas fa-angle-right me-2"></i> Bài viết (Blog)</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Hỗ trợ</h4>
                        <a href="{{ route('contact') }}"><i class="fas fa-angle-right me-2"></i> Liên hệ với chúng tôi</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <div class="row gy-3 gx-2 mb-4">
                            <div class="col-xl-6">
                                <form>
                                    <div class="form-floating">
                                        <select class="form-select bg-dark border notranslate" id="lang-switcher">
                                            <option value="vi">Tiếng Việt</option>
                                            <option value="en">English</option>
                                        </select>
                                        <label for="lang-switcher">Ngôn ngữ</label>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xl-6">
                                <form>
                                    <div class="form-floating">
                                        <select class="form-select bg-dark border notranslate" id="currency-switcher">
                                            <option value="VND">VND</option>
                                            <option value="USD">USD</option>
                                        </select>
                                        <label for="currency-switcher">Tiền tệ</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <h4 class="text-white mb-3">Thanh toán</h4>
                        <!-- <div class="footer-bank-card d-flex align-items-center gap-2">
                            <span class="bg-white p-1 rounded d-inline-block" style="width: 50px; height: 35px; display: flex !important; align-items: center; justify-content: center;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_VNPAY.svg/2083px-Logo_VNPAY.svg.png" alt="VNPAY" style="width:100%; height:auto">
                            </span>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Chatbox AI -->
    @include('clients.blocks.chatbox')

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('clients/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('clients/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('clients/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('clients/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('clients/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('clients/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('clients/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('clients/js/main.js') }}"></script>

    <div style="display:none;" id="google_translate_element"></div>
    <script type="text/javascript">
        function loadGoogleTranslate() {
            new google.translate.TranslateElement({
                pageLanguage: 'vi', 
                includedLanguages: 'en,vi',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>

    <style>
        body { top: 0 !important; }
        .goog-te-banner-frame { display: none !important; }
        .skiptranslate { display: none !important; }
    </style>

    <script>
        $(document).ready(function() {
            $('#currency-switcher').val('{{ session('currency', 'VND') }}');

            $('#currency-switcher').on('change', function() {
                var currency = $(this).val();
                $.post('{{ route('set.preferences') }}', {
                    _token: '{{ csrf_token() }}',
                    currency: currency
                }, function(data) {
                    location.reload();
                });
            });

            function setCookie(name, value) {
                var domain = window.location.hostname;
                document.cookie = name + "=" + value + "; path=/;";
                document.cookie = name + "=" + value + "; domain=" + domain + "; path=/;";
                document.cookie = name + "=" + value + "; domain=." + domain + "; path=/;";
            }

            function clearCookie(name) {
                var domain = window.location.hostname;
                document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=" + domain + "; path=/;";
                document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=." + domain + "; path=/;";
            }

            $('#lang-switcher').on('change', function() {
                var lang = $(this).val();
                clearCookie('googtrans');
                if (lang !== 'vi') {
                    setCookie('googtrans', '/vi/' + lang);
                }
                location.reload();
            });

            // Set current value from cookie
            let match = document.cookie.match(/(?:^|;\s*)googtrans=([^;]+)/);
            if (match) {
                let decoded = decodeURIComponent(match[1]);
                let code = decoded.split('/')[2];
                if (code === 'en') {
                    $('#lang-switcher').val('en');
                } else {
                    $('#lang-switcher').val('vi');
                }
            } else {
                $('#lang-switcher').val('vi');
            }
        });
    </script>
</body>

</html>