$(function() {

    $('.page.page-internships.page-create-edit').each(function() {

        let $page = $(this);
        let $courseSelect = $page.find('.course-select');

        $courseSelect.select2({
            language: "pt-BR",
            placeholder : 'Pesquise pelos cursos disponíveis',
            maximumSelectionLength: 20,
        })

    });

});
