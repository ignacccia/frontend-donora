@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10">
    <div class="max-w-md mx-auto bg-white shadow-md overflow-hidden rounded-md">
        <div class="px-4 py-5 sm:p-6">
            <label for="image" class="block text-sm font-medium text-gray-700">Pilih Gambar</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <div class="mx-auto text-gray-500">
                        <i class="fa-solid fa-file-import"></i>
                    </div>
                    <div class="flex text-sm text-gray-600">
                        <label for="file-upload"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-[#2E61ED] hover:text-[#1E3A8A]">
                            <span>Unggah gambar</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only" accept="image/*">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 10MB</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection