<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>Halaman Pegawai</p>
        </h2>
    </x-slot>

    <div class="py-11">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <div x-data="{ openModal: false, message: '' }">


                        <button @click="openModal = true"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah
                            Data</button>


                        <div x-show="openModal" x-cloak
                            class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center backdrop-filter backdrop-blur-sm"
                            aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div @click="openModal = false" class="opacity-75"></div>

                            <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-md p-6 mx-auto">
                                <form method="POST" action="{{ route('kirimpegawai') }}">
                                    @csrf
                                    <label for="nama" class="block mb-2">Nama Pegawai:</label>
                                    <input type="text" x-model="name" id="nama" name="nama" class="w-full">

                                    <div>
                                        <button type="submit"
                                            class="mt-4 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Kirim</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($pegawais->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto border-collapse border border-black">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border border-black">No</th>

                                        <th class="border border-black">Nama</th>
                                        <th class="border border-black">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawais as $key => $pegawai)
                                        <tr class="border border-black">
                                            <td class="border border-black text-center">{{ $key + 1 }}</td>

                                            <td class="border border-black text-center">{{ $pegawai->nama }}</td>
                                            <td class="border border-black text-center">{{ $pegawai->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Tidak ada data pegawai.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
