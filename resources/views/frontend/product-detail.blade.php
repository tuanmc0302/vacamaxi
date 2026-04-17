<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thá»‹t bÃ² Vaca - A - VACA MAXI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/frontend/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/base-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/product-detail.css') }}">
</head>

<body>
    @php
        $frontendData = json_decode(file_get_contents(resource_path('data/frontend.json')), true);
    @endphp
    @include('frontend.partials.header', ['active' => 'product', 'nav' => $frontendData['nav']])

    <main>
        <section class="page-hero">
            <div>
                <h1>Thá»‹t bÃ² Vaca - A</h1>
                <div class="breadcrumb-line">Trang chá»§ / Thá»‹t bÃ² Vaca - A</div>
            </div>
        </section>

        <section class="product-detail">
            <div class="container">
                <div class="row g-4 align-items-start">
                    <div class="col-lg-5">
                        <div class="product-gallery">
                            <img class="main-product-image" src="/image/Rectangle 11.png" alt="Thá»‹t bÃ² Vaca - A">
                            <div class="thumb-grid">
                                <img src="/image/Rectangle 11.png" alt="Thá»‹t bÃ² Vaca - A">
                                <div class="thumb-placeholder"></div>
                                <div class="thumb-placeholder"></div>
                                <div class="thumb-placeholder"></div>
                            </div>
                        </div>
                        <div class="share-row">
                            <span>Chia sáº»:</span>
                            <a class="share-pill share-zalo" href="#">Zalo</a>
                            <a class="share-pill share-facebook" href="#">f</a>
                            <a class="share-pill share-youtube" href="#">â–¶</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-info">
                            <h2>Thá»‹t BÃ² Vaca - A</h2>
                            <div class="meta-line">
                                MÃ£: 006 | ThÆ°Æ¡ng hiá»‡u Vaca Maxi
                                <span class="rating">â˜…â˜…â˜…â˜…â˜…</span>
                                0 ÄÃ¡nh giÃ¡
                            </div>
                            <div class="status">LiÃªn há»‡</div>
                            <ul>
                                <li>Thá»‹t BÃ² nháº­p theo khá»‘i VUSAID táº¡i Vaca - A gr diem Äƒn cá» cao,</li>
                                <li>giÃ u sÄƒn pháº©m cÃ³ giÃ¡ trá»‹ cao trÃªn thá»‹ trÆ°á»ng. Dá»… cháº¿ biáº¿n, thÃ­ch há»£p cho nhÃ  hÃ ng.</li>
                                <li>Sáº£n pháº©m Ä‘á»‹nh danh riÃªng máº¹ vá»£t.</li>
                            </ul>
                            <div class="quantity-row">
                                <span>Sá»‘ LÆ°á»£ng</span>
                                <div class="quantity-box" aria-label="Sá»‘ lÆ°á»£ng">
                                    <button type="button">âˆ’</button>
                                    <span>01</span>
                                    <button type="button">+</button>
                                </div>
                            </div>
                            <div class="action-row">
                                <button class="btn-buy" type="button">Mua ngay</button>
                                <button class="btn-cart" type="button">ThÃªm vÃ o giá» hÃ ng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-tabs">
            <div class="container">
                <div class="tab-buttons">
                    <button class="tab-button active" type="button">ThÃ´ng tin sáº£n pháº©m</button>
                    <button class="tab-button" type="button">HÆ°á»›ng dáº«n mua hÃ ng</button>
                    <button class="tab-button" type="button">Giao HÃ ng</button>
                </div>
                <div class="tab-content-box">
                    <p>KhÃ´ng dÃ¹ng cÃ´ng nghiá»‡p</p>
                    <p>KhÃ´ng cháº¥t táº¡o mÃ¹i - táº¡o ngá»t</p>
                    <p>ÄÆ°á»£c kiá»ƒm nghiá»‡m Ä‘á»‹nh ká»³ theo tiÃªu chuáº©n an toÃ n thá»±c pháº©m</p>
                    <p>
                        TRÄ‚NG TÃ‚M Cá»C lÃ  dÃ²ng rÆ°á»£u tráº¯ng truyá»n thá»‘ng do VACA MAXI phÃ¡t triá»ƒn, Ä‘Æ°á»£c náº¥u tá»« 3 loáº¡i ngÅ©
                        cá»‘c quen thuá»™c vá»›i ngÆ°á»i Viá»‡t: RÆ°á»£u Ä‘Æ°á»£c náº¥u theo cÃ´ng thá»©c gia truyá»n, nhÆ°ng sáº£n xuáº¥t trÃªn dÃ¢y
                        chuyá»n hiá»‡n Ä‘áº¡i, giÃºp giá»¯ Ä‘Æ°á»£c cháº¥t rÆ°á»£u truyá»n thá»‘ng mÃ  váº«n Ä‘áº£m báº£o Ä‘á»™ trong, an toÃ n vÃ  á»•n Ä‘á»‹nh.
                    </p>
                    <p>TRÄ‚NG TÃ‚M Cá»C khÃ´ng chá»‰ lÃ  rÆ°á»£u Ä‘á»ƒ uá»‘ng, mÃ  cÃ²n lÃ  má»™t pháº§n kÃ½ á»©c quÃª nhÃ , lÃ  hÃ¬nh áº£nh cá»§a báº¿p lá»­a, mÃ¢m cÆ¡m, vÃ  sá»± sum váº§y.</p>
                    <a class="more-link" href="#">Xem thÃªm</a>
                </div>
            </div>
        </section>

        <section class="related-products" aria-labelledby="relatedProductsTitle">
            <div class="container">
                <h2 class="related-title" id="relatedProductsTitle">RÆ°á»£u Vaca Maxi</h2>
                <div class="related-grid">
                    @foreach ($frontendData['relatedWines'] as $item)
                        @include('frontend.components.related-card', ['item' => $item])
                    @endforeach
                </div>
            </div>
        </section>

        <section class="comparison-contact" aria-labelledby="comparisonTitle">
            <div class="container">
                <div class="comparison-box">
                    <h2 class="comparison-title" id="comparisonTitle">Táº¡i Vaca maxi, ChÃºng TÃ´i Chá»n Lá»c VÃ  NhÃ¢n Giá»‘ng 4 DÃ²ng BÃ² Chá»§ Lá»±c</h2>
                    @include('frontend.components.comparison-table', ['comparison' => $frontendData['comparison']])
                </div>

                @include('frontend.components.partner-form')
            </div>
        </section>
    </main>

        @include('frontend.partials.floating-contact')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>






