<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<table>
		<tr>
			<td colspan="2">
				<h5>
					{{$forms->name}}
				</h5>
			</td>
		</tr>
		@foreach($forms->formElements as $form)
			<tr>
				<td>{{$form->label}}:</td>
				<td>
					@if($form->type != 'select')
						<input type="{{$form->type}}" name="{{$form->name}}">
					@else
						<select name="{{$form->name}}">

							@php

								$options 		= $form->options;

								$options_array 	= explode(",", $options);

							@endphp

							@foreach($options_array as $option)

								<option value="{{$option}}">{{ $option }}</option>

							@endforeach

						</select>
					@endif
				</td>
			</tr>
		@endforeach
	</table>

</body>
</html>