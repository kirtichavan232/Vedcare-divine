/**
 * Accessible mobile navigation enhancement.
 */
( function () {
	'use strict';

	const toggle = document.querySelector( '.menu-toggle' );
	const navigation = document.querySelector( '.primary-navigation' );

	if ( ! toggle || ! navigation ) {
		return;
	}

	toggle.addEventListener( 'click', function () {
		const isOpen = navigation.classList.toggle( 'is-open' );
		toggle.setAttribute( 'aria-expanded', String( isOpen ) );
	} );
}() );

/** VedCare Gold transformation carousels and shared viewer. */
( function () {
	'use strict'; const first = document.querySelector( '.transformations-carousel' ), lightbox = document.querySelector( '.transformations-lightbox' ); if ( ! first || ! lightbox ) { return; }
	const firstTrack = first.querySelector( '.transformations-carousel__track' ), allSlides = Array.from( firstTrack.children ), second = first.cloneNode( true ), secondTrack = second.querySelector( '.transformations-carousel__track' ); secondTrack.innerHTML = ''; allSlides.slice( Math.ceil( allSlides.length / 2 ) ).forEach( slide => secondTrack.appendChild( slide ) ); first.after( second );
	const reduce = matchMedia( '(prefers-reduced-motion: reduce)' ).matches; let lightboxIndex = 0, lightboxStart = 0;
	const allImages = () => Array.from( document.querySelectorAll( '.transformations-carousel__slide img' ) );
	const open = next => { const images = allImages(); lightboxIndex = ( next + images.length ) % images.length; lightbox.querySelector( 'img' ).src = images[lightboxIndex].src; document.body.classList.add( 'transformations-lightbox-open' ); lightbox.showModal(); };
	[ first, second ].forEach( ( carousel, carouselIndex ) => { const track = carousel.querySelector( '.transformations-carousel__track' ), slides = Array.from( track.children ); let index = carouselIndex; let timer; let startX = 0; const perView = () => matchMedia( '(max-width: 52rem)' ).matches ? 3 : 6; const show = next => { const max = Math.max( 0, slides.length - perView() ); index = next < 0 ? max : next > max ? 0 : next; track.style.transform = 'translateX(-' + index * ( slides[0].offsetWidth + ( parseFloat( getComputedStyle( track ).gap ) || 0 ) ) + 'px)'; }; const stop = () => clearInterval( timer ); const play = () => { if ( ! reduce ) { stop(); timer = setInterval( () => show( index + 1 ), 1100 + carouselIndex * 100 ); } }; carousel.querySelector( '.transformations-carousel__button--previous' ).addEventListener( 'click', () => { show( index - 1 ); play(); } ); carousel.querySelector( '.transformations-carousel__button--next' ).addEventListener( 'click', () => { show( index + 1 ); play(); } ); carousel.addEventListener( 'mouseenter', stop ); carousel.addEventListener( 'mouseleave', play ); carousel.addEventListener( 'focusin', stop ); carousel.addEventListener( 'focusout', play ); carousel.addEventListener( 'touchstart', e => { startX = e.changedTouches[0].screenX; }, { passive: true } ); carousel.addEventListener( 'touchend', e => { const delta = e.changedTouches[0].screenX - startX; if ( Math.abs( delta ) > 35 ) { show( index + ( delta < 0 ? 1 : -1 ) ); play(); } }, { passive: true } ); slides.forEach( slide => slide.addEventListener( 'click', () => open( allImages().indexOf( slide.querySelector( 'img' ) ) ) ) ); show( index ); play(); } );
	lightbox.querySelector( '.transformations-lightbox__close' ).addEventListener( 'click', () => lightbox.close() ); lightbox.querySelector( '.transformations-lightbox__previous' ).addEventListener( 'click', () => open( lightboxIndex - 1 ) ); lightbox.querySelector( '.transformations-lightbox__next' ).addEventListener( 'click', () => open( lightboxIndex + 1 ) ); lightbox.addEventListener( 'close', () => document.body.classList.remove( 'transformations-lightbox-open' ) ); lightbox.addEventListener( 'keydown', e => { if ( e.key === 'ArrowLeft' ) { open( lightboxIndex - 1 ); } if ( e.key === 'ArrowRight' ) { open( lightboxIndex + 1 ); } } ); lightbox.addEventListener( 'touchstart', e => { lightboxStart = e.changedTouches[0].screenX; }, { passive: true } ); lightbox.addEventListener( 'touchend', e => { const delta = e.changedTouches[0].screenX - lightboxStart; if ( Math.abs( delta ) > 35 ) { open( lightboxIndex + ( delta < 0 ? 1 : -1 ) ); } }, { passive: true } );
}() );

/** Hindi complete-benefits companion. */
( function () {
	const list = document.querySelector( '.product-details .product-list' );
	const items = window.vedcareProductGallery && Array.isArray( window.vedcareProductGallery.hindi_benefits ) ? window.vedcareProductGallery.hindi_benefits : [];
	if ( ! list || ! items.length ) { return; }
	const block = document.createElement( 'div' ); block.className = 'product-benefits--hindi'; block.innerHTML = '<h3>संपूर्ण लाभ</h3><ul class="product-list product-list--compact"></ul>'; items.forEach( item => { const li = document.createElement( 'li' ); li.textContent = item; block.querySelector( 'ul' ).appendChild( li ); } ); list.after( block );
	const informationCards = document.querySelectorAll( '.product-information__grid > article' );
	if ( informationCards.length > 2 ) { const precautions = informationCards[2].querySelector( 'ul' ); if ( precautions ) { const heading = document.createElement( 'h3' ); heading.textContent = 'Precautions'; informationCards[0].append( heading, precautions.cloneNode( true ) ); } }
}() );

/** JSON-driven product gallery and ingredient artwork. */
( function () {
	'use strict';
	const config = window.vedcareProductGallery;
	const main = document.querySelector( '.product-hero__image' );
	const thumbnail = document.querySelector( '.product-hero__thumbnail' );
	if ( config && main && thumbnail && config.images && config.images.length ) {
		main.src = config.images[0];
		thumbnail.querySelector( 'img' ).src = config.images[0];
		thumbnail.classList.add( 'is-active' );
		config.images.slice( 1 ).forEach( function( src ) { const button = thumbnail.cloneNode( true ); button.classList.add( 'product-hero__thumbnail--extra' ); button.querySelector( 'img' ).src = src; thumbnail.parentNode.appendChild( button ); } );
		document.querySelectorAll( '.product-hero__thumbnail' ).forEach( function( item ) { item.addEventListener( 'click', function() { main.src = item.querySelector( 'img' ).src; document.querySelectorAll( '.product-hero__thumbnail' ).forEach( function( other ) { other.classList.toggle( 'is-active', other === item ); } ); } ); } );
	}
	if ( config && config.ingredients ) { document.querySelectorAll( '.ingredients-grid article:not(.ingredients-grid__more)' ).forEach( function( card, index ) { if ( config.ingredients[index] ) { const image = document.createElement( 'img' ); image.src = config.ingredients[index]; image.alt = ''; image.loading = 'lazy'; card.prepend( image ); } } ); }
	if ( config && config.highlights ) { document.querySelectorAll( '.product-hero__highlights span' ).forEach( function( circle, index ) { const item = config.highlights[index]; if ( item ) { circle.querySelector( 'b' ).textContent = item.value || ''; circle.querySelector( 'small' ).textContent = item.label || ''; } } ); }
}() );

/** Product ingredient-list modal. */
( function () {
	'use strict';
	const modal = document.querySelector( '.ingredient-modal' );
	if ( ! modal ) { return; }
	document.querySelectorAll( '[data-ingredient-modal-open]' ).forEach( function ( button ) { button.addEventListener( 'click', function () { modal.showModal(); } ); } );
	modal.querySelector( '[data-ingredient-modal-close]' ).addEventListener( 'click', function () { modal.close(); } );
	modal.addEventListener( 'click', function ( event ) { if ( event.target === modal ) { modal.close(); } } );
}() );

/**
 * Responsive customer-story carousel.
 */
( function () {
	'use strict';

	const carousels = document.querySelectorAll( '.testimonials-carousel' );

	if ( ! carousels.length ) {
		return;
	}

	carousels.forEach( function ( carousel ) {
	const track = carousel.querySelector( '.testimonials-carousel__track' );
	const slides = Array.from( carousel.querySelectorAll( '.testimonials-carousel__slide' ) );
	const pagination = carousel.querySelector( '.testimonials-carousel__pagination' );
	const previous = carousel.querySelector( '.testimonials-carousel__button--previous' );
	const next = carousel.querySelector( '.testimonials-carousel__button--next' );
	const reducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	let activeIndex = 0;
	let cardsPerView = getCardsPerView();
	let autoplayId;
	let touchStartX = 0;

	function getCardsPerView() {
		if ( window.matchMedia( '(max-width: 42rem)' ).matches ) {
			return 1;
		}

		return window.matchMedia( '(max-width: 64rem)' ).matches ? 2 : 3;
	}

	function maxIndex() {
		return Math.max( 0, slides.length - cardsPerView );
	}

	function renderPagination() {
		pagination.innerHTML = '';

		for ( let index = 0; index <= maxIndex(); index += 1 ) {
			const dot = document.createElement( 'button' );
			dot.type = 'button';
			dot.setAttribute( 'aria-label', 'Show testimonial set ' + ( index + 1 ) );
			dot.addEventListener( 'click', function () { showSlide( index ); startAutoplay(); } );
			pagination.appendChild( dot );
		}
	}

	function showSlide( index ) {
		const lastIndex = maxIndex();
		activeIndex = index < 0 ? lastIndex : index > lastIndex ? 0 : index;

		const gap = parseFloat( window.getComputedStyle( track ).columnGap ) || 0;
		const step = slides[0].offsetWidth + gap;
		track.style.transform = 'translateX(-' + ( activeIndex * step ) + 'px)';

		slides.forEach( function ( slide, slideIndex ) {
			slide.setAttribute( 'aria-hidden', String( slideIndex < activeIndex || slideIndex >= activeIndex + cardsPerView ) );
		} );

		Array.from( pagination.children ).forEach( function ( dot, dotIndex ) {
			const isActive = dotIndex === activeIndex;
			dot.classList.toggle( 'is-active', isActive );
			dot.setAttribute( 'aria-current', String( isActive ) );
		} );
	}

	function stopAutoplay() {
		window.clearInterval( autoplayId );
	}

	function startAutoplay() {
		if ( reducedMotion || slides.length <= cardsPerView ) {
			return;
		}

		stopAutoplay();
		autoplayId = window.setInterval( function () { showSlide( activeIndex + 1 ); }, 5500 );
	}

	previous.addEventListener( 'click', function () { showSlide( activeIndex - 1 ); startAutoplay(); } );
	next.addEventListener( 'click', function () { showSlide( activeIndex + 1 ); startAutoplay(); } );
	carousel.addEventListener( 'mouseenter', stopAutoplay );
	carousel.addEventListener( 'mouseleave', startAutoplay );
	carousel.addEventListener( 'focusin', stopAutoplay );
	carousel.addEventListener( 'focusout', function () { window.setTimeout( startAutoplay, 0 ); } );
	carousel.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'ArrowLeft' ) { event.preventDefault(); showSlide( activeIndex - 1 ); startAutoplay(); }
		if ( event.key === 'ArrowRight' ) { event.preventDefault(); showSlide( activeIndex + 1 ); startAutoplay(); }
	} );
	carousel.addEventListener( 'touchstart', function ( event ) { touchStartX = event.changedTouches[0].screenX; }, { passive: true } );
	carousel.addEventListener( 'touchend', function ( event ) {
		const distance = event.changedTouches[0].screenX - touchStartX;
		if ( Math.abs( distance ) > 40 ) { showSlide( activeIndex + ( distance < 0 ? 1 : -1 ) ); startAutoplay(); }
	}, { passive: true } );
	window.addEventListener( 'resize', function () {
		const nextCardsPerView = getCardsPerView();
		if ( nextCardsPerView !== cardsPerView ) {
			cardsPerView = nextCardsPerView;
			renderPagination();
		}
		showSlide( Math.min( activeIndex, maxIndex() ) );
	} );

	renderPagination();
	showSlide( 0 );
	startAutoplay();
	} );
}() );

/**
 * Lightweight, accessible featured-product hero slider.
 */
( function () {
	'use strict';

	const slider = document.querySelector( '.hero-slider' );

	if ( ! slider ) {
		return;
	}

	const track = slider.querySelector( '.hero-slider__slides' );
	const slides = Array.from( slider.querySelectorAll( '.hero-slider__slide' ) );
	const dots = Array.from( slider.querySelectorAll( '.hero-slider__pagination button' ) );
	const previous = slider.querySelector( '.hero-slider__button--previous' );
	const next = slider.querySelector( '.hero-slider__button--next' );
	const reducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	let activeIndex = 0;
	let autoplayId;
	let touchStartX = 0;

	function showSlide( index ) {
		activeIndex = ( index + slides.length ) % slides.length;
		track.style.transform = 'translateX(-' + ( activeIndex * 100 ) + '%)';

		slides.forEach( function ( slide, slideIndex ) {
			const isActive = slideIndex === activeIndex;
			slide.classList.toggle( 'is-active', isActive );
			slide.setAttribute( 'aria-hidden', String( ! isActive ) );
		} );

		dots.forEach( function ( dot, dotIndex ) {
			const isActive = dotIndex === activeIndex;
			dot.classList.toggle( 'is-active', isActive );
			dot.setAttribute( 'aria-current', String( isActive ) );
		} );
	}

	function stopAutoplay() {
		window.clearInterval( autoplayId );
	}

	function startAutoplay() {
		if ( reducedMotion ) {
			return;
		}
		stopAutoplay();
		autoplayId = window.setInterval( function () { showSlide( activeIndex + 1 ); }, 5000 );
	}

	previous.addEventListener( 'click', function () { showSlide( activeIndex - 1 ); startAutoplay(); } );
	next.addEventListener( 'click', function () { showSlide( activeIndex + 1 ); startAutoplay(); } );
	dots.forEach( function ( dot, index ) { dot.addEventListener( 'click', function () { showSlide( index ); startAutoplay(); } ); } );
	slider.addEventListener( 'mouseenter', stopAutoplay );
	slider.addEventListener( 'mouseleave', startAutoplay );
	slider.addEventListener( 'focusin', stopAutoplay );
	slider.addEventListener( 'focusout', function () { window.setTimeout( startAutoplay, 0 ); } );
	slider.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'ArrowLeft' ) { event.preventDefault(); showSlide( activeIndex - 1 ); startAutoplay(); }
		if ( event.key === 'ArrowRight' ) { event.preventDefault(); showSlide( activeIndex + 1 ); startAutoplay(); }
	} );
	slider.addEventListener( 'touchstart', function ( event ) { touchStartX = event.changedTouches[0].screenX; }, { passive: true } );
	slider.addEventListener( 'touchend', function ( event ) {
		const distance = event.changedTouches[0].screenX - touchStartX;
		if ( Math.abs( distance ) > 40 ) { showSlide( activeIndex + ( distance < 0 ? 1 : -1 ) ); startAutoplay(); }
	}, { passive: true } );

	showSlide( 0 );
	startAutoplay();
}() );
document.addEventListener('DOMContentLoaded', function () {
	const quantity = document.getElementById('vedcare-product-quantity');
	const buttons = document.querySelectorAll('.product-hero__actions a');

	if (!quantity || !buttons.length) {
		return;
	}

	buttons.forEach(function (button) {
		button.addEventListener('click', function () {
			const qty = Math.max(1, parseInt(quantity.value, 10) || 1);
			const url = new URL(button.href, window.location.origin);

			url.searchParams.set('quantity', qty);
			button.href = url.toString();
		});
	});
});