<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>Halaman Kendaraan</p>
        </h2>
    </x-slot>

    <div class="py-11">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    <!-- Tambahkan properti x-data untuk inisialisasi data Alpine.js -->
                    <div x-data="{ openModal: false, message: '' }">

                        <!-- Button to Open Modal -->
                        <button @click="openModal = true"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buka
                            Modal</button>

                        <!-- Modal -->
                        <div x-show="openModal" x-cloak
                            class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center backdrop-filter backdrop-blur-sm"
                            aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div @click="openModal = false" class="opacity-75"></div>

                            <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-md p-6 mx-auto">
                                <form method="POST" action="{{ route('kirimkendaraan') }}">
                                    @csrf
                                    <label for="nama_kendaraan" class="block mb-2">Nama Kendaraan:</label>
                                    <input type="text" x-model="name" id="nama_kendaraan" name="nama_kendaraan">

                                    <label for="plat_nomor" class="block mb-2">Plat Nomor:</label>
                                    <input type="text" x-model="name" id="plat_nomor" name="plat_nomor">

                                    <label for="jenis" class="block mb-2">Jenis:</label>
                                    <select x-model="Jenis" name="jenis" class="w-full">
                                        <option value="">pilih</option>
                                        <option value="Angkutan Barang">Angkutan Barang</option>
                                        <option value="Angkutan Orang">Angkutan Orang</option>

                                    </select>

                                    <label for="service" class="block mb-2">Service:</label>
                                    <select x-model="Jenis" name="service" class="w-full">
                                        <option value="">pilih</option>
                                        <option value="Harus Service">Harus Service</option>
                                        <option value="Belum Service">Belum Service</option>
                                    </select>

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
                    @if ($kendaraans->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto border-collapse border border-black">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border border-black">No</th>
                                        {{-- <th class="border border-black">Id</th> --}}
                                        <th class="border border-black">Nama Kendaraan</th>
                                        <th class="border border-black">Plat Nomor</th>
                                        <th class="border border-black">Jenis</th>
                                        <th class="border border-black">Service</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kendaraans as $key => $kendaraan)
                                        <tr class="border border-black">
                                            <td class="border border-black">{{ $key + 1 }}</td>
                                            {{-- <td class="border border-black">{{ $kendaraan->id }}</td> --}}
                                            <td class="border border-black">{{ $kendaraan->nama_kendaraan }}</td>
                                            <td class="border border-black">{{ $kendaraan->plat_nomor }}</td>
                                            <td class="border border-black">{{ $kendaraan->jenis }}</td>
                                            <td class="border border-black">{{ $kendaraan->service }}</td>
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
