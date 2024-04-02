// $('.owl-carousel').owlCarousel({
// 	loop:true,
// 	margin:10,
// 	nav:true,
// 	responsive:{
// 		0:{
// 			items:1
// 		},
// 		600:{
// 			items:3
// 		},
// 		1000:{
// 			items:5
// 		}
// 	}
// })

const scrollReveal = ScrollReveal({
	origin: 'top',
	distance: '60px',
	duration: 2500,
	delay: 400,
})

scrollReveal.reveal(`.centered-text, .title, .card, .testimonials h3,.testimonials p, .testimonial-body, .form-header h3, .form-header p, .form-body, .container h4, .form-floating,
					form button, .container h5, .container h, .container p, .text-start h6, .text-start p, .text-end a, .text-end h6, .text-end p` , {interval: 100});


scrollReveal.reveal(`.inner-div img, .col-1 img`,{origin: 'left'} )

scrollReveal.reveal(`.container iframe`, {origin: 'right'},{interval: 200},{duration: 4500},{delay: 2000});

