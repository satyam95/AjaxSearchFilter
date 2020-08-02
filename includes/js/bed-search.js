$ = jQuery;

var bedSearch = $("#bed-search");

var searchForm = bedSearch.find("form");

searchForm.submit(function(e){
    e.preventDefault();

    var pocket = 0;
    if(bedSearch.find("#with-pocket").prop("checked"))
         pocket = 1;

    var data = {
        action : "bed_search",
        type : bedSearch.find("#bed-type").val(),
        size : bedSearch.find("#bed-size").val(),
        with_pocket : bedSearch.find("#with-pocket").prop("checked"),

    };

    $.ajax({
        url : ajax_url,
        data : data,
        success : function(response) {
            bedSearch.find("ul").empty();

            for(var i = 0; i < response.length; i++){
                console.log(response[i]);

                var html = "<li id='bed-" + response[i] + "'><a href='" + response[i].permalink + "'>" + response[i].title + "</a></li>";

                bedSearch.find("ul").append(html);

            }
        }
    });

});