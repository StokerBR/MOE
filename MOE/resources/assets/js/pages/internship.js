$(function() {

    $('.page.page-internships.page-create-edit').each(function() {

        let $self = $(this);
        let $courseSelect = $self.find('.course-select');

        $courseSelect.select2({
            language: "pt-BR",
            placeholder : 'Pesquise pelos cursos disponíveis',
            maximumSelectionLength: 20,
        })

    });

});
