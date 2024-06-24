jQuery(document).ready(function($){
    console.log('test');

    let reviewCardText = $('.review-card__text');
    reviewCardText.each(function () {
        let textHolder = $(this).find('.text-holder');
        let readmore = $(this).find('.readmore');

        if (textHolder.height() >= 110){
            textHolder.addClass('cropped');

            readmore.css('display', 'flex');

            readmore.click(function () {
                if (textHolder.hasClass('cropped')){
                    readmore.find('.readmore__text').text('Скрыть');
                }else{
                    readmore.find('.readmore__text').text('Читать полностью');
                }

                textHolder.toggleClass('cropped');
            })
        }
    })

    $('input[type=tel]').inputmask({"mask": "+7 999 999-99-99"}); //specifying options

    window.formPhoneValidator = function (input) {
        let tempInput = input.toString().replaceAll('_', '');
        tempInput = tempInput.replaceAll(' ', '');
        tempInput = tempInput.replaceAll('-', '');
        
        return tempInput.length === 12;
    }
    
    // $(document).scroll(function() {
    //     if ($(this).scrollTop() >= 50) {
    //     $('#header').addClass('painted');
    //     // console.log('scroll')
    //     }else{
    //     $('#header').removeClass('painted');
    //     }
    // });
    //

	// $("li.nav-menu-element a").click(function() { // ID откуда кливаем
	// 	let hash = $(this).attr('href');
	// 	if(hash.length > 1) {
	// 		$(this).parent().addClass('active');
	// 		$(this).parent().siblings().removeClass('active');
	// 		$('html, body').animate({
	//             scrollTop: $(hash).offset().top - 120 // класс объекта к которому приезжаем
	//         }, 1000); // Скорость прокрутки
	// 	}
	// });


    /*============ FUNCTIONS ===========*/

    // function getCallbackForm(modal, props) {
    //     let id = props['data-modal'].value;
    //     if($(modal).find('.form__holder').html() == '') {
    //         $.ajax({
    //             url: `/wp-admin/admin-ajax.php?action=get_modal_form&modal=${id}`,
    //             method: 'GET',
    //             success: function (data){
    //                 $(modal).find('.form__holder').html(data);
    //                 let form = $(modal).find('form').get(0);
                    
    //                 ThemeModal.reinitForms(form);
    //                 ThemeModal.getInstance().openModal(id);
    //             },
    //             error: function (data) {
    //                 ThemeModal.getInstance().openModal('error');
    //             }
    //         });
    //     }else{
    //         ThemeModal.getInstance().openModal(id);
    //     }
    // }
    
    let mobileMenu = new MobileMenu(); // Вызов объекта класса мобильного меню
    mobileMenu.init(); // Инициализация мобильного меню
    let themeModal = new ThemeModal({}); // Вызов объекта класса модалок
    
    // themeModal.modalsView['callback'] = {
    // 	callback: getCallbackForm
    // };
    themeModal.init(); // Инициализация модалок

});
