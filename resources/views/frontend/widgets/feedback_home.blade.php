@php
    $title = data_get($widget, 'title', 'ĐÁNH GIÁ CỦA KHÁCH HÀNG');
    $subTitle = data_get($widget, 'sub_title', 'trên Google Maps');
@endphp
<section class="testimonial-section">
    <div class="container">
        <div class="testimonial-heading">
            <h2>{{ $title }}</h2>
            <p>{{ $subTitle }}</p>
        </div>
        <div class="testimonial-wrap">
            <article class="testimonial-card">
                <span class="testimonial-quote">”</span>
                <img class="testimonial-avatar" src="/image/Rectangle 2.png" alt="Khách hàng Hoàng Trang">
                <p class="testimonial-role">Khách hàng</p>
                <h3 class="testimonial-name">Hoàng Trang</h3>
                <p class="testimonial-text">Thịt bò Vaca Maxi thật sự chất lượng. Bò mềm, tươi và được nêm nếm rất vừa miệng.</p>
            </article>
            <article class="testimonial-card">
                <span class="testimonial-quote">”</span>
                <img class="testimonial-avatar" src="/image/Rectangle 3.png" alt="Khách hàng Tùng Phan">
                <p class="testimonial-role">Khách hàng</p>
                <h3 class="testimonial-name">Tùng Phan</h3>
                <p class="testimonial-text">Đúng chuẩn quán bò cho người mê thịt. Không gian đẹp, nhân viên thân thiện, tư vấn món rất có tâm.</p>
            </article>
        </div>
    </div>
</section>