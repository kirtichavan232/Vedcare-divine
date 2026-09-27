( function () {
	'use strict';

	var triggers = Array.prototype.slice.call( document.querySelectorAll( '.faq-trigger' ) );

	triggers.forEach( function ( trigger, index ) {
		trigger.addEventListener( 'click', function () {
			var panel = document.getElementById( trigger.getAttribute( 'aria-controls' ) );
			var isExpanded = 'true' === trigger.getAttribute( 'aria-expanded' );

			if ( ! panel ) {
				return;
			}

			trigger.setAttribute( 'aria-expanded', String( ! isExpanded ) );
			panel.hidden = isExpanded;
		} );

		trigger.addEventListener( 'keydown', function ( event ) {
			var nextIndex;

			if ( 'ArrowDown' === event.key || 'ArrowRight' === event.key ) {
				nextIndex = ( index + 1 ) % triggers.length;
			} else if ( 'ArrowUp' === event.key || 'ArrowLeft' === event.key ) {
				nextIndex = ( index - 1 + triggers.length ) % triggers.length;
			} else if ( 'Home' === event.key ) {
				nextIndex = 0;
			} else if ( 'End' === event.key ) {
				nextIndex = triggers.length - 1;
			} else {
				return;
			}

			event.preventDefault();
			triggers[ nextIndex ].focus();
		} );
	} );
}() );
