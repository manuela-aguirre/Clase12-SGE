<x-app-layout>
	<x-slot name="header">
		<h2 style="font-family:'Figtree',Arial,sans-serif;font-weight:600;font-size:1.25rem;color:#14532d;">
			Productos {{ $showTrashed ? '(papelera)' : '' }}
		</h2>
	</x-slot>

	@include('partials.crud-styles')

	<div class="cotec-panel crud-wrap">
		@if (session('success'))
			<div class="status-banner">{{ session('success') }}</div>
		@endif
		@if (session('error'))
			<div class="status-banner error">{{ session('error') }}</div>
		@endif

		<div class="crud-toolbar">
			<form method="GET" action="{{ route('products.index') }}" class="crud-search flex flex-wrap items-center gap-2">
				@if ($showTrashed)
					<input type="hidden" name="trashed" value="1">
				@endif
				<input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o descripción...">
				<select name="category" class="rounded-xl border border-[#dcfce7] px-3 py-2">
					<option value="">Todas las categorías</option>
					@foreach ($categories as $category)
						<option value="{{ $category->id }}" @selected(request('category') == $category->id)>
							{{ $category->nombre }}
						</option>
					@endforeach
				</select>
				<x-primary-button>Filtrar</x-primary-button>
			</form>

			<div class="flex flex-wrap items-center gap-3">
				@can('crear-productos')
					<a href="{{ route('products.create') }}" class="crud-btn-new">
						<i class="fa-solid fa-plus"></i> Nuevo producto
					</a>
				@endcan
				@can('eliminar-productos')
					@if ($showTrashed)
						<a href="{{ route('products.index') }}" class="text-sm font-semibold text-[#14532d] underline">Ver productos</a>
					@else
						<a href="{{ route('products.index', ['trashed' => 1]) }}" class="text-sm font-semibold text-[#14532d] underline">
							Papelera ({{ $trashedCount }})
						</a>
					@endif
				@endcan
			</div>
		</div>

		@if ($products->isEmpty())
			<div class="empty-state">No hay productos para mostrar.</div>
		@else
			<div class="overflow-x-auto">
				<table class="crud-table">
					<thead>
						<tr>
							<th>Código</th>
							<th>Producto</th>
							<th>Proveedor</th>
							<th>Categoría</th>
							<th>Stock</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $product)
							<tr>
								<td>{{ $product->codigo ?? '—' }}</td>
								<td style="font-weight:600;color:#0f172a;">
									{{ $product->nombre }}
									@if ($product->descripcion)
										<div style="font-size:0.78rem;font-weight:400;color:#64748b;">
											{{ Str::limit($product->descripcion, 70) }}
										</div>
									@endif
								</td>
								<td>{{ $product->proveedor?->name ?? '—' }}</td>
								<td>{{ $product->category?->nombre ?? '—' }}</td>
								<td>
									<span class="crud-badge {{ $product->stock <= 2 ? 'warn' : '' }}">
										{{ $product->stock }}
									</span>
								</td>
								<td class="crud-actions">
									@if ($product->trashed())
										<form method="POST" action="{{ route('products.restore', $product) }}" style="display:inline;">
											@csrf
											@method('PATCH')
											<button type="submit" class="pay">Restaurar</button>
										</form>
									@else
										@can('editar-productos')
											<a class="edit" href="{{ route('products.edit', $product) }}">
												<i class="fa-solid fa-pen"></i> Editar
											</a>
										@endcan
										@can('eliminar-productos')
											<form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline;" onsubmit="return confirm('¿Enviar este producto a la papelera?');">
												@csrf
												@method('DELETE')
												<button type="submit" class="delete">
													<i class="fa-solid fa-trash"></i> Eliminar
												</button>
											</form>
										@endcan
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div style="margin-top:1.25rem;">{{ $products->links() }}</div>
		@endif
	</div>
</x-app-layout>