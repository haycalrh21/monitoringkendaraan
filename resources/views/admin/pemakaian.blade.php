<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>Halaman Pemakaian</p>
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
                                <form method="POST" action="{{ route('kirimpemakaian') }}">
                                    @csrf

                                    <select name="id_pemesanan" required class="w-full" @change="fetchData">
                                        <option value="">Pilih</option>
                                        @foreach ($pemesanans as $pemesanan)
                                            @if ($pemesanan->status1 === 'Disetujui' && $pemesanan->status2 === 'Disetujui')
                                                @if ($pemesanan->statuspemesanan === 'Belum Selesai')
                                                    <option value="{{ $pemesanan->id }}">
                                                        {{ $pemesanan->id }}
                                                    </option>
                                                @endif
                                            @else
                                                <p>tidak ada</p>
                                            @endif
                                        @endforeach
                                    </select>

                                    <label for="nama" class="block mb-2">Nama Pegawai:</label>
                                    <input type="text" x-model="" id="nama" name="nama">

                                    <label for="nama_kendaraan" class="block mb-2">Nama Kendaraan:</label>
                                    <input type="text" x-model="" id="nama_kendaraan" name="nama_kendaraan">


                                    <label for="konsumsi_bbm" class="block mb-2">Konsumsi BBM:</label>
                                    <input type="number" x-model="" id="konsumsi_bbm" name="bbm">
                                    <div>
                                        <span class="text-red-500">*harus angka</span>

                                    </div>

                                    <label for="pemakaian_hari" class="block mb-2">Pemakaian Hari:</label>
                                    <input type="number" x-model="" id="pemakaian_hari" name="hari">
                                    <div>
                                        <span class="text-red-500">*harus angka</span>

                                    </div>

                                    <label for="total_km" class="block mb-2">Total KM:</label>
                                    <input type="number" x-model="" id="total_km" name="total_km">
                                    <div>
                                        <span class="text-red-500">*harus angka</span>

                                    </div>
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
                    <div>

                        {{-- <a href="{{ route('pemesanan.export') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded ">Export
                            ke
                            Excel</a> --}}
                    </div>

                    <div class="overflow-x-auto mt-4">
                        <table class="w-full table-auto border-collapse border border-black">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-black">No</th>
                                    <th class="border border-black">Nama Pegawai</th>
                                    <th class="border border-black">Nama Kendaraan</th>
                                    <th class="border border-black">BBM</th>
                                    <th class="border border-black">Total Hari </th>

                                    <th class="border border-black">Jumlah KM</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemakaians as $key => $pemakaian)
                                    <tr class="border border-black">
                                        <td class="border border-black">{{ $key + 1 }}</td>
                                        <td class="border border-black text-center">{{ $pemakaian->nama }}</td>
                                        <td class="border border-black text-center">{{ $pemakaian->nama_kendaraan }}
                                        </td>
                                        <td class="border border-black text-center">{{ $pemakaian->bbm }}</td>

                                        <td class="border border-black text-center">{{ $pemakaian->hari }}</td>
                                        <td class="border border-black text-center">{{ $pemakaian->total_km }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>




</x-app-layout>
