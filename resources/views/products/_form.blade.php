<div class="space-y-4">
	<div>
		<x-input-label for="nombre" value="Nombre" />
		<x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $product->nombre)" required maxlength="150" />
		<x-input-error class="mt-2" :messages="$errors->get('nombre')" />
	</div>

	<div>
		<x-input-label for="descripcion" value="Descripción (opcional)" />
		<textarea id="descripcion" name="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('descripcion', $product->descripcion) }}</textarea>
		<x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
	</div>

	<div>
		<x-input-label for="imagen_url" value="URL de imagen (opcional)" />
		<x-text-input id="imagen_url" name="imagen_url" type="url" class="mt-1 block w-full" :value="old('imagen_url', $product->imagen_url)" />
		<x-input-error class="mt-2" :messages="$errors->get('imagen_url')" />
	</div>

	<div class="grid gap-4 sm:grid-cols-2">
		<div>
			<x-input-label for="codigo" value="Código (opcional)" />
			<x-text-input id="codigo" name="codigo" type="text" class="mt-1 block w-full" :value="old('codigo', $product->codigo)" maxlength="20" />
			<x-input-error class="mt-2" :messages="$errors->get('codigo')" />
		</div>
		<div>
			<x-input-label for="stock" value="Stock" />
			<x-text-input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full" :value="old('stock', $product->stock ?? 0)" required />
			<x-input-error class="mt-2" :messages="$errors->get('stock')" />
		</div>
		<div>
			<x-input-label for="precio" value="Precio de venta" />
			<x-text-input id="precio" name="precio" type="number" min="0" step="0.01" class="mt-1 block w-full" :value="old('precio', $product->precio)" required />
			<x-input-error class="mt-2" :messages="$errors->get('precio')" />
		</div>
	</div>

	<div class="grid gap-4 sm:grid-cols-2">
		<div>
			<x-input-label for="proveedor_id" value="Proveedor" />
			<select id="proveedor_id" name="proveedor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
				<option value="">Selecciona un proveedor</option>
				@foreach ($proveedores as $proveedor)
					<option value="{{ $proveedor->id }}" @selected(old('proveedor_id', $product->proveedor_id) == $proveedor->id)>{{ $proveedor->name }}</option>
				@endforeach
			</select>
			<x-input-error class="mt-2" :messages="$errors->get('proveedor_id')" />
		</div>
		<div>
			<x-input-label for="categoria_id" value="Categoría" />
			<select id="categoria_id" name="categoria_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
				<option value="">Selecciona una categoría</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}" @selected(old('categoria_id', $product->categoria_id) == $category->id)>{{ $category->nombre }}</option>
				@endforeach
			</select>
			<x-input-error class="mt-2" :messages="$errors->get('categoria_id')" />
		</div>
	</div>
</div>