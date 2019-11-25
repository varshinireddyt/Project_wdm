"use strict";
(function ($) {
	$(document).ready(function () {
		// Search page mobile tabs
		$('.trilisting-search-mobile-tab').on('click', function () {
			var self = $(this);
			if (self.hasClass('trilisting-search-mobile-listing-js')) {
				$('body').removeClass('trilisting-mobile-open-map trilisting-mobile-open-filter').addClass('trilisting-mobile-open-listing');
				$('.trilisting-search-mobile-tab').removeClass('active');
				self.addClass('active');
			} else if (self.hasClass('trilisting-search-mobile-map-js')) {
				$('body').removeClass('trilisting-mobile-open-listing trilisting-mobile-open-filter').addClass('trilisting-mobile-open-map');
				$('.trilisting-search-mobile-tab').removeClass('active');
				self.addClass('active');
			} else if (self.hasClass('trilisting-search-mobile-filter-js')) {
				$('body').removeClass('trilisting-mobile-open-listing trilisting-mobile-open-map').addClass('trilisting-mobile-open-filter');
				$('.trilisting-search-mobile-tab').removeClass('active');
				self.addClass('active');
			}
		});

		$('.trilisting-single-add-comment').on('click', function (e) {
			e.preventDefault();
			var commentForm = $("#commentform");
			$('html, body').animate({ scrollTop: commentForm.offset().top - 60 }, 'slow');
			commentForm.find('#comment').focus();
		});
	});
})(jQuery);