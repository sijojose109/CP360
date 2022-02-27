<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<table>
		<tr>
			<td>Name</td>
			<td></td>
			<td></td>
		</tr>
			
			@foreach($forms as $form)

				<tr>
					<td>{{ $form->name }}</td>
					<td><a href="{{ route('form.show', $form->id) }}">View</a></td>
				</tr>

			@endforeach

	</table>

</body>
</html>