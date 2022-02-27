<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body style="border:1px solid;">









<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<div>
						<table style="margin: 10px auto; border: 1px solid;">
							<tr>
								<td colspan="2">
									Add your fields from here.
								</td>
							</tr>
							<tr>
								<td>
									<label>
										Label
									</label>
								</td>
								<td>
									<input type="text" id="form_label">
								</td>
							</tr>
							<tr>
								<td>
									Field name
								</td>
								<td>
									<input type="text" id="form_name">
								</td>
							</tr>
							<tr>
								<td>
									Field type
								</td>
								<td>
									<select id="form_type">
										<option value="text">Text</option>
										<option value="number">Number</option>
										<option value="select">Select</option>
									</select>
								</td>
							</tr>
							<tr id="select" style="display:none;">
								<td>
									<label>Options for select box</label>
								</td>
								<td>
									<input type="text" id="options" name="form_select_values"><br><span>Add options as comma separated.</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<button id="btn-add" style="background-color: lightblue; padding: 5px 28px; float: right;">Add</button>
								</td>
							</tr>
						</table>
					</div>

					<div id="list_table" style="margin: 10px auto; width: 80%; border: 1px solid;">

						<table style="width:40%; margin: 50px auto;">
							<tr>
								<td><label>Form name</label></td>
								<td><input type="text" id="main_form_name"></td>
							</tr>
						</table>

						<table style="width:40%; margin: 50px auto;">
							<thead>
								<tr>
									<td>Label</td>
									<td>Type</td>
									<td>Name</td>
									<td>Options</td>
									<td></td>
								</tr>
							</thead>
							<tbody id="form_list">
								<tr>
									
								</tr>
							</tbody>
						</table>

					</div>

					<table id="submit_btn_section" style="width:40%; margin: 50px auto;">
						<tr>
							<td colspan="4">
								<button id="btn-submit" style="background-color: lightblue; padding: 5px 28px; float: right;">Submit</button>
							</td>
						</tr>
					</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>









<script type="text/javascript">
	
	$(document).ready(function() 
	{

		$("#form_type").change(()=>{

			let type = $("#form_type").val();

			if(type == 'select')
			{

				$("#select").show();

			}
			else
			{
				$("#select").hide();
			}

		});

		var form_data = [];
    	
		$("#btn-add").click(()=>{

			if($("#form_label").val() == '')
			{
				alert("Enter field label");
				return;
			}

			if($("#form_name").val() == '')
			{
				alert("Enter field name");
				return;
			}

			if($("#form_type").val() == '')
			{
				alert("Enter field type");
				return;
			}

			let blank_space 			= $("#form_name").val().indexOf(' ') >= 0;

			if(blank_space)
			{
				alert("Field name does not support white space");
				return;
			}

			let form_details 			= {};

			let option_data 			= {};

			form_details.label 			= $("#form_label").val(); 

			form_details.name  			= $("#form_name").val();

			form_details.type  			= $("#form_type").val();


			let type 					= $("#form_type").val();

			form_details.options 		= '';

			if(type == 'select')
			{

				if($("#options").val() == '')
				{
					alert("Enter options for the dropdown field.");

					return;
				}

				form_details.options  	= $("#options").val();

			}



			form_data.push(form_details);

			$("#form_list").empty();


			list_data();

		});

		$("#list_table").on( "click", ".btn-delete", function() {

		  	let field_index = $(this).attr('field_index');

			form_data.splice(field_index,1);

			list_data();

		});

		function list_data()
		{

			$("#form_list").empty();

			let html 				= ''; 

			form_data.map((data, index)=>{

				html+= `<tr><td>${data.label}</td><td>${data.type}</td><td>${data.name}</td><td>${data.options}</td><td><button class="btn-delete" style="background-color:red; color:#fff; padding: 5px;" field_index="${index}">Delete</button></td></tr>`;
				$("#form_list").html(html);

			});

		}



		$("#btn-submit").click(()=>{

			if($("#main_form_name").val() == '')
			{
				alert("Enter form name.");
				return;
			}

			if(form_data.length == 0)
			{
				alert("Atleast one field is required.");
				return;
			}

			var request = $.ajax({
			  url: "{{Route('form.store')}}",
			  method: "POST",
			  data: { form_data : form_data, _token: "{{ csrf_token() }}", main_form_name:$("#main_form_name").val() },
			  dataType: "JSON"
			});
			 
			request.done(function( msg ) 
			{

			  alert("Form saved successfully.");

			  location.reload();

			});
			 
			request.fail(function( jqXHR, textStatus ) 
			{

			  alert("Error in save form");

			});


		});


	});

</script>

</body>
</html>