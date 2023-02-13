<!-- Footer
		============================================= -->
		<footer id="footer" class="dark border-top-0">

			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap">

					<div class="row clearfix">

						<div class="col-lg-4">

						<div class="widget subscribe-widget clearfix">
								<h4>{{($aplikasi->nama??'').' '.($aplikasi->daerah ?? '')}}</h4>
								<p>{!!($kontak->alamat?$kontak->filterkontak('alamat')->isi:'')!!}</p>
								<div class="widget-subscribe-form-result"></div>
								
							</div>

						</div>

						<div class="w-100 d-block d-md-block d-lg-none line"></div>

						<div class="col-lg-4">
						
						</div>

						<div class="w-100 d-block d-md-block d-lg-none line"></div>

						<div class="col-lg-4">
						
							<div class="widget subscribe-widget clearfix">
								<h4>Maps</h4>
								<!-- <p>Get Important Offers and Deals directly to your Email Inbox. <em>We never send spam!</em></p> -->
								<div class="widget-subscribe-form-result"></div>
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15958.61789625205!2d101.44403117670213!3d0.5192551939386219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aec1876043d5%3A0x331684eb54aa6060!2sBadan%20Kesatuan%20Bangsa%20dan%20Politik%20Provinsi%20Riau!5e0!3m2!1sid!2sid!4v1668441824442!5m2!1sid!2sid" width="100" height="60" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
							</div>

						</div>

					</div>

					<div class="line"></div>

					<div class="row clearfix">

						<div class="col-lg-7 col-md-6">
							<div class="widget">
								<div class="row col-mb-30 mb-0">

									<div class="col-lg-6">
										<div class="footer-big-contacts">
											<span>Telepon:</span>
											<b>{!!($kontak->telp?$kontak->filterkontak('telp')->isi : '')!!}</b>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="footer-big-contacts">
											<span>Email:</span>
											<b>{!!($kontak->email?$kontak->filterkontak('email')->isi : '')!!}</b>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="col-lg-5 col-md-6">

							<div class="clearfix" data-class-xl="float-end" data-class-lg="float-end" data-class-md="float-end" data-class-sm="" data-class-xs="">
								<a href="{{$kontak->facebook?$kontak->filterkontak('facebook')->link : ''}}" class="social-icon si-rounded si-small si-colored si-facebook">
									<i class="icon-facebook"></i>
								</a>

								<a href="{{$kontak->twitter?$kontak->filterkontak('twitter')->link : ''}}" class="social-icon si-rounded si-small si-colored si-twitter">
									<i class="icon-twitter"></i>
								</a>

								<a href="{{$kontak->instagram?$kontak->filterkontak('instagram')->link : ''}}" class="social-icon si-rounded si-small si-colored si-instagram">
									<i class="icon-instagram"></i>
								</a>
								
								<a href="{{$kontak->youtube?$kontak->filterkontak('youtube')->link : ''}}" class="social-icon si-rounded si-small si-colored si-youtube">
									<i class="icon-youtube"></i>
								</a>
							</div>

						</div>

					</div>

				</div><!-- .footer-widgets-wrap end -->

			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container text-center text-uppercase">

					Copyrights &copy; 2022 {{($aplikasi->nama??'').' '.($aplikasi->daerah ?? '')}}.

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->