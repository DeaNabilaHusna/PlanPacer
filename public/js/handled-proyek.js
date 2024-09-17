$(document).ready(function () {
    $("#handled_by_id").select2();

    $("#handled_by_id").on("select2:select", function (e) {
        displaySelectedKolaborator();
    });

    $("#handled_by_id").on("select2:unselect", function (e) {
        displaySelectedKolaborator();
    });

    function displaySelectedKolaborator() {
        var selectedKolaborator = $("#handled_by_id").val();
        var selectedKolaboratorHTML = "";

        if (selectedKolaborator) {
            selectedKolaborator.forEach(function (id, index) {
                var username = $(
                    '#handled_by_id option[value="' + id + '"]'
                ).text();
                selectedKolaboratorHTML += username;
                if (index < selectedKolaborator.length - 1) {
                    selectedKolaboratorHTML += ", ";
                }
                selectedKolaboratorHTML +=
                    '<button type="button" class="text-red-500 font-bold" onclick="removeKolaborator(\'' +
                    id +
                    "')\">x</button>";
            });
        }

        $("#selected-kolaborator").html(selectedKolaboratorHTML);
    }

    function removeKolaborator(id) {
        var select = $("#handled_by_id").select2();
        var data = select.select2("data");

        var newData = data.filter(function (obj) {
            return obj.id !== id;
        });

        select.val(null).trigger("change");

        newData.forEach(function (obj) {
            select.append(
                '<option value="' +
                    obj.id +
                    '" selected>' +
                    obj.text +
                    "</option>"
            );
        });

        displaySelectedKolaborator();
    }
});
