$(function() {

	//Dar focus no campo de busca do select2 assim que ele abrir
	$('.select2').on('select2:open', () => {
        setTimeout(() => {
            var $searchBox = document.querySelector('.select2-search.select2-search--dropdown .select2-search__field') ?? null;
            if ($searchBox) {
                $searchBox.focus();
            }
        }, 100);
	});

});
