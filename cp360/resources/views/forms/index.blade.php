<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>


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
                		<a href="{{Route('form.create')}}" style="background-color: green; padding: 10px 20px; color: #fff; float: right;">Add form</a>
                	</div>
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
									<td>

										<form method="post" action="{{ route('form.delete') }}">
											@csrf
											<input type="hidden" name="item" value={{ $form->id }}>
											<button type="submit">Delete</button>
										</form>

									</td>
								</tr>

							@endforeach

					</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

</body>
</html>