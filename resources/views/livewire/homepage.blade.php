<main>
    	<section id="billboard">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<button class="prev slick-arrow">
						<i class="icon icon-arrow-left"></i>
					</button>

					<div class="main-slider pattern-overlay">
                        @if($banner->isNotEmpty())
                        @foreach ($banner as $data)
						<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title">{{$data->title}}</h2>
								<p>{!!$data->content!!}</p>
								<div class="btn-wrap">
									<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i
											class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div><!--banner-content-->
							<img src="{{ asset('storage/' . $data->image) }}" alt="banner" class="banner-image" style="width: 250px;">
						</div><!--slider-item-->
                           @endforeach
                        @endif
					</div><!--slider-->

					<button class="next slick-arrow">
						<i class="icon icon-arrow-right"></i>
					</button>

				</div>
			</div>
		</div>

	</section>

	<section id="client-holder" data-aos="fade-up">
		<div class="container">
			<div class="row">
				<div class="inner-content">
					<div class="logo-wrap">
						<div class="grid">
							<a href="#"><img src="{{asset('front/images/client-image1.png')}}" alt="client"></a>
							<a href="#"><img src="{{asset('front/images/client-image2.png')}}" alt="client"></a>
							<a href="#"><img src="{{asset('front/images/client-image3.png')}}" alt="client"></a>
							<a href="#"><img src="{{asset('front/images/client-image4.png')}}" alt="client"></a>
							<a href="#"><img src="{{asset('front/images/client-image5.png')}}" alt="client"></a>
						</div>
					</div><!--image-holder-->
				</div>
			</div>
		</div>
	</section>

	<section id="featured-books" class="py-5 my-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="section-header align-center">
						<div class="title">
							<span>Some quality items</span>
						</div>
						<h2 class="section-title">Featured Books</h2>
					</div>

					<div class="product-list" data-aos="fade-up">
						<div class="row">
                            @if($book->isNotEmpty())
                            @foreach ($book->take(4) as $item)
							<div class="col-md-3">
								<div class="product-item">
									<figure class="product-style">
										<img src="{{ asset('storage/' . $item->image) }}" alt="Books" class="product-item">
										<button type="button" class="add-to-cart" data-product-tile="add-to-cart" data-file="{{ asset('storage/' . $item->filebook) }}">Download</button>
									</figure>
									<figcaption>
										<h3>{{$item->name}}</h3>
										<span>{{$item->author}}</span>
									</figcaption>
								</div>
							</div>
                            @endforeach
                            @endif

						</div><!--ft-books-slider-->
					</div><!--grid-->


				</div><!--inner-content-->
			</div>
		</div>
	</section>

	<section id="best-selling" class="leaf-pattern-overlay">
		<div class="corner-pattern-overlay"></div>
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-md-8">
                    @if($fire->isNotEmpty())
                    @foreach ($fire as $value)
					<div class="row">
						<div class="col-md-6">
							<figure class="products-thumb">
								<img src="{{ asset('storage/' . $value->cover) }}" alt="book" class="single-image">
							</figure>
						</div>

						<div class="col-md-6">
							<div class="product-entry">
								<h2 class="section-title divider">Best Book On This {{$value->month}}</h2>
								<div class="products-content">
									<div class="author-name">By {{$value->by}}</div>
									<h3 class="item-title">{!!$value->content!!}</h3>
									<div class="btn-wrap">
										<a href="{{ asset('storage/' . $item->filebook) }}" class="btn-accent-arrow">Download Now <i
												class="icon icon-ns-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>

					</div>
                    @endforeach
                    @endif
					<!-- / row -->

				</div>

			</div>
		</div>
	</section>

	

	<section id="quotation" class="pb-5 mb-5 align-center">
		<div class="inner-content">
			<h2 class="section-title divider">Quote of the day</h2>
			<blockquote data-aos="fade-up">
				<q>“The more that you read, the more things you will know. The more that you learn, the more places
					you’ll go.”</q>
				<div class="author-name">Dr. Seuss</div>
			</blockquote>
		</div>
	</section>

	<section id="special-offer" class="pb-5 mb-5 bookshelf">

		<div class="section-header align-center">
			<div class="title">
				<span>Grab your opportunity</span>
			</div>
			<h2 class="section-title">Books with offer</h2>
		</div>

		<div class="container">
			<div class="row">
				<div class="inner-content">
					<div class="product-list" data-aos="fade-up">
						<div class="grid product-grid">

                            @if($book->isNotEmpty())
                            @foreach ($book as $data)
							<div class="product-item">
								<figure class="product-style">
									<img src="{{ asset('storage/' . $data->image) }}" alt="Books" class="product-item">
									<button type="button" class="add-to-cart" data-product-tile="add-to-cart" data-file="{{ asset('storage/' . $data->filebook) }}">Download</button>
								</figure>
								<figcaption>
									<h3>{{$data->name}}</h3>
									<span>{{$data->author}}</span>
								</div>
							</figcaption>

                            @endforeach
                            @endif
							</div>
						</div><!--grid-->
					</div>
				</div><!--inner-content-->
			</div>
		</div>
	</section>

	<section id="subscribe">
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-md-8">
					<div class="row">

						<div class="col-md-6">

							<div class="title-element">
								<h2 class="section-title divider">Subscribe to our newsletter</h2>
							</div>

						</div>
						<div class="col-md-6">

							<div class="subscribe-content" data-aos="fade-up">
								<p>Sed eu feugiat amet, libero ipsum enim pharetra hac dolor sit amet, consectetur. Elit
									adipiscing enim pharetra hac.</p>
								<form id="form">
									<input type="text" name="email" placeholder="Enter your email addresss here">
									<button class="btn-subscribe">
										<span>send</span>
										<i class="icon icon-send"></i>
									</button>
								</form>
							</div>

						</div>

					</div>
				</div>

			</div>
		</div>
	</section>

	<section id="latest-blog" class="py-5 my-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="section-header align-center">
						<div class="title">
							<span>Read our articles</span>
						</div>
						<h2 class="section-title">Latest Articles</h2>
					</div>

					<div class="row">

                    @if($article->isNotEmpty())
                    @foreach ($article as $value)


						<div class="col-md-4">

							<article class="column" data-aos="fade-up" data-aos-delay="200">
								<figure>
									<a href="#" class="image-hvr-effect">
										<img src="{{ asset('storage/' . $value->image) }}" alt="post" class="post-image">
									</a>
								</figure>
								<div class="post-item">
									<div class="meta-date">{{$value->day}}</div>
									<h3><a href="#">{{$value->title}}</a></h3>

									<div class="links-element">
										<div class="categories">inspiration</div>
										<div class="social-links">
											<ul>
												<li>
													<a href="#"><i class="icon icon-facebook"></i></a>
												</li>
												<li>
													<a href="#"><i class="icon icon-twitter"></i></a>
												</li>
												<li>
													<a href="#"><i class="icon icon-behance-square"></i></a>
												</li>
											</ul>
										</div>
									</div><!--links-element-->

								</div>
							</article>

						</div>
                        @endforeach
                    @endif
					</div>

					<div class="row">

						<div class="btn-wrap align-center">
							<a href="#" class="btn btn-outline-accent btn-accent-arrow" tabindex="0">Read All Articles<i
									class="icon icon-ns-arrow-right"></i></a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</main>
