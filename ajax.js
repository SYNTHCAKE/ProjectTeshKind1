$( document ).ready(function() {
    $("#btn").click(
		function(){
			sendAjaxForm('result_form', 'contactForm', 'action_ajax_form.php');
			return false; 
		}
	);
});
 
function sendAjaxForm(result_form, contactForm, url) {
    $.ajax({
        url:     url, //url �������� (action_ajax_form.php)
        type:     "POST", //����� ��������
        dataType: "html", //������ ������
        data: $("#"+contactForm).serialize(),  // ����������� ������
        success: function(response) { //������ ���������� �������
        	result = $.parseJSON(response);
        	$('#result_form').html('���: '+result.name+'<br>�������: '+result.phonenumber);
    	},
    	error: function(response) { // ������ �� ����������
            $('#result_form').html('������. ������ �� ����������.');
    	}
 	});
}