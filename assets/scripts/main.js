$(document).ready(function()
{
    $('#make_dropdown').change(function()
    {
        $("#models > option").remove();
        var id = $('#make_dropdown').val();
        $.ajax({
            url: "/computers/get_models/"+id,
            type: "POST",
            datatype : "JSON",

            success: function(models)
            {
                $.each(models,function(id,model)
                {
                    var opt = $('<option />');
                    opt.val(model);
                    opt.text(model);
                    $('#models').append(opt);
                });
            }
        });
    });

    $('#mobile_make_dropdown').change(function()
    {
            if ($('#mobile_make_dropdown').val() == '5' )
            {

                $(".required_hide, .nonrequired_hide").hide();

            } else {

                $(".required_hide, .nonrequired_hide").show();

            }
        $("#mobile_model_dropdown > option").remove();
        var id = $('#mobile_make_dropdown').val();
        $.ajax({
            type: "POST",
            url: "/mobile/get_models/"+id,
            datatype : "JSON",

            success: function(models)
            {
                $.each(models,function(id,model)
                {
                    var opt = $('<option />');
                    opt.val(model);
                    opt.text(model);
                    $('#mobile_model_dropdown').append(opt);
                });
            }
        });
    });

    $('#manufacturer_dropdown').change(function()
    {

        $("#sw_names > option").remove();
        var id = $('#manufacturer_dropdown').val();
        $.ajax({
            type: "POST",
            url: "software/get_software_names/"+id,
            datatype : "JSON",

            success: function(sw_names)
            {
                $.each(sw_names,function(id,software_name)
                {
                    var opt = $('<option />');
                    opt.val(software_name);
                    opt.text(software_name);
                    $('#sw_names').append(opt);
                });
            }
        });
    });

    $('#action_type').change(function()
    {
            if ($('#action_type').val() == 'install' || $('#action_type').val() == 'uninstall')
            {

                $(".noshow").show();

            } else {

                $(".noshow").hide();

            }
    });

    $(".hover_table tr").hover(
		function()
		{
			$(this).addClass("highlight");
		},

		function()
		{
			$(this).removeClass("highlight");
		}
    )

	$('.chk_all_boxes').click(function()
	{
		$('.chk_box').prop('checked', this.checked);
	});

});

$(function() {
    $(".tip").tooltip();
});
$(function() {
    $( "#ced, #crd, #purchased_date, #csd, #scsd, #sced, #temp_date" ).datepicker();
});

setTimeout(function() {
$('.alerts').fadeOut('slow');
}, 5000); // time in milliseconds