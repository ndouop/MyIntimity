


var currentIndex = 0;
var nbStepForm = 0;
var listStepForm = [];
var list_Step_Form = $('.step-form ul .nav-link');
window.list_Step_Form.each(function(item){
    window.listStepForm[window.nbStepForm] = item;
    window.nbStepForm++;
});

$('#next-form').on('click', function(){

        if(window.currentIndex == window.nbStepForm - 1) {
            $('#wizard_with_validation').submit();

        }

        for(i = 0; i <= window.currentIndex; i++){
            $('#tabs-2-tab-'+i).removeClass('active');
            $('#tabs-2-tab-'+i).removeClass('in');
            $('#tabs-2-tab-'+i).prop('aria-expanded', false);
            $('#tabs-1-tab-'+i).removeClass('active');
            $('#tabs-1-tab-'+i).prop('aria-expanded', false);
        }

        window.currentIndex++;
        window.currentIndex = (window.currentIndex >= window.nbStepForm) ? window.nbStepForm - 1 : window.currentIndex;

        $('#tabs-2-tab-'+(window.currentIndex)).addClass('active');
        $('#tabs-2-tab-'+(window.currentIndex)).addClass('in');
        $('#tabs-2-tab-'+(window.currentIndex)).prop('aria-expanded', true);
        $('#tabs-1-tab-'+(window.currentIndex)).addClass('active');
        $('#tabs-1-tab-'+(window.currentIndex)).prop('aria-expanded', true);

        for(i = window.currentIndex + 1; i < window.nbStepForm; i++){
            $('#tabs-2-tab-'+i).removeClass('active');
            $('#tabs-2-tab-'+i).removeClass('in');
            $('#tabs-2-tab-'+i).prop('aria-expanded', false);
            $('#tabs-1-tab-'+i).removeClass('active');
            $('#tabs-1-tab-'+i).prop('aria-expanded', false);
        }
        if(window.currentIndex == window.nbStepForm - 1) {
            $('#next-form').html('Terminé');
            $('#next-form').addClass('btn-success');
            $('#next-form').removeClass('btn-inline');

        }else {
            $('#next-form').html('Suivant');
            $('#next-form').removeClass('btn-success');
            $('#next-form').addClass('btn-inline');
        }

});

$('#prev-form').on('click', function(e){
    for(i = 0; i < window.currentIndex; i++){
        $('#tabs-2-tab-'+i).removeClass('active');
        $('#tabs-2-tab-'+i).removeClass('in');
        $('#tabs-2-tab-'+i).prop('aria-expanded', false);
        $('#tabs-1-tab-'+i).removeClass('active');
        $('#tabs-1-tab-'+i).prop('aria-expanded', false);
    }

    window.currentIndex--;
    window.currentIndex = (window.currentIndex < 0) ? 0 : window.currentIndex;

    $('#tabs-2-tab-'+(window.currentIndex)).addClass('active');
    $('#tabs-2-tab-'+(window.currentIndex)).addClass('in');
    $('#tabs-2-tab-'+(window.currentIndex)).prop('aria-expanded', true);
    $('#tabs-1-tab-'+(window.currentIndex)).addClass('active');
    $('#tabs-1-tab-'+(window.currentIndex)).prop('aria-expanded', true);

    for(i = window.currentIndex + 1; i < window.nbStepForm; i++){
        $('#tabs-2-tab-'+i).removeClass('active');
        $('#tabs-2-tab-'+i).removeClass('in');
        $('#tabs-2-tab-'+i).prop('aria-expanded', false);
        $('#tabs-1-tab-'+i).removeClass('active');
        $('#tabs-1-tab-'+i).prop('aria-expanded', false);
    }
    if(window.currentIndex == window.nbStepForm - 1) {
        $('#next-form').html('Terminé');
        $('#next-form').addClass('btn-success');
        $('#next-form').removeClass('btn-inline');

    }else {
        $('#next-form').html('Suivant');
        $('#next-form').removeClass('btn-success');
        $('#next-form').addClass('btn-inline');
    }
});

$(".step-form ul .nav-link").click(function(event){
    event.preventDefault();
    event.stopPropagation();
});

