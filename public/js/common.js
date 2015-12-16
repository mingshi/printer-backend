
function set_region(province_id, city_id, area_id) {
    _set_region('province_id', 0, province_id);
    _set_region('city_id', province_id, city_id);
    _set_region('area_id', city_id, area_id);
    $('#province_id').bind('change', function(){
        province_id = $('#province_id').val();
        _set_region('city_id', province_id, 0);
        $('#area_id').html('');
    });
    $('#city_id').bind('change', function(){
        city_id = $('#city_id').val();
        _set_region('area_id', city_id, 0);
    });
}

function _set_region(type, parent_id, selected_id) {
    $.ajax({
        url: '/region/ajax',
        data: { type: type, parent_id: parent_id },
        success: function(data) {
            var list = JSON.parse(data);
            var select_obj = $('#' + type);
            select_obj.html('');
            select_obj.append($('<option />').text('').val(0));
            append_options(select_obj, list, selected_id);
        }
    });
}

function append_options(select_obj, list, selected_id) {
    var keys = Object.keys(list);
    for (var i=0; i<keys.length; i++) {
        var key = keys[i];
        if (key == selected_id)
            var option = $('<option />').text(list[key]).val(key).attr('selected', 'selected');
        else
            var option = $('<option />').text(list[key]).val(key);
        select_obj.append(option);
    }
}
