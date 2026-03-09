<div class="carousel-header">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @if(isset($banners) && $banners->count() > 0)
                @foreach($banners as $index => $banner)
                    <li data-bs-target="#carouselId" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            @else
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            @endif
        </ol>
        <div class="carousel-inner" role="listbox">
            @if(isset($banners) && $banners->count() > 0)
                @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset($banner->imageURL) }}" class="img-fluid" alt="Banner Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            @if($banner->title)
                                <h1 class="display-1 text-capitalize text-white mb-4 text-center">
                                    <span class="bounce-text">{{ $banner->title }}</span>
                                </h1>
                            @endif
                            @if($banner->description)
                                <p class="mb-5 fs-5">{{ $banner->description }}</p>
                            @endif
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="{{ $banner->link ?? '#packages' }}">Khám phá ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Fallback nếu không có banner nào trong DB -->
                <div class="carousel-item active">
                    <img src="clients/img/carousel-2.jpg" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 text-capitalize text-white mb-4 text-center">
                                <span class="bounce-text">Tour & Travel</span>
                            </h1>
                            <p class="mb-5 fs-5">Chúng tôi cung cấp những tour du lịch hấp dẫn, mang lại trải nghiệm đáng nhớ cho mỗi hành trình khám phá của bạn.</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#packages">Khám phá ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="clients/img/carousel-1.jpg" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 text-capitalize text-white mb-4 text-center">
                                <span class="bounce-text">Tour & Travel</span>
                            </h1>
                            <p class="mb-5 fs-5">Khám phá những điểm đến tuyệt đẹp trong và ngoài nước với dịch vụ chuyên nghiệp và uy tín từ đội ngũ của chúng tôi.</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#packages">Khám phá ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="clients/img/carousel-3.jpg" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 text-capitalize text-white mb-4 text-center">
                                <span class="bounce-text">Tour & Travel</span>
                            </h1>
                            <p class="mb-5 fs-5">Đặt tour nhanh chóng, giá cả hợp lý và nhiều ưu đãi hấp dẫn đang chờ đón bạn tại Tour & Travel.</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#packages">Khám phá ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<style>
.bounce-text {
    display: inline-block;
    animation: bounce 1.2s infinite alternate;
}
@keyframes bounce {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-20px);
    }
}
</style>
