@extends('layouts.app')

@section('content')
    <h2 class="text-3xl text-blue-700 font-bold mb-3">Factura {{ $invoiceUser->id }}</h2>

    {{ Breadcrumbs::render('invoice', $invoiceUser) }}

    <div class="bg-white shadow overflow-hidden sm:rounded-lg my-5">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Factura {{ $invoiceUser->id }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Detalles de la factura
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nombre
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $invoiceUser->name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Descripción
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $invoiceUser->description }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Fecha
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $invoiceUser->date }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Documento de la factura
                    </dt>
                </div>
                <div class="mt-1 text-sm text-gray-900" style="--aspect-ratio: 16/9;">
                    <iframe width="1600" height="900" class="w-full h-auto relative"
                        src="{{ asset('storage/' . $invoiceUser->file) }}" frameborder="0"></iframe>
                </div>
            </dl>
        </div>
    </div>
@endsection
