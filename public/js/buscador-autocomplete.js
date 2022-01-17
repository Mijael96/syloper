var path = "/buscar-posts";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { term: query }, function (data) {
            return process(data);
        });
    },
});