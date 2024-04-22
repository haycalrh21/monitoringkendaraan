<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>Halaman Pemesanan</p>
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
                                <form method="POST" action="{{ route('kirimpemesanan') }}">
                                    @csrf

                                    <label for="nama" class="block mb-2">Pilih Pegawai</label>
                                    <select name="nama" required class="w-full">
                                        <option value="">Pilih</option>

                                        @foreach ($pegawais as $pegawai)
                                            @if ($pegawai->status === 'Tidak Tersedia')
                                                Tidak ada yang tersedia
                                            @else
                                                <option value="{{ $pegawai->id }}"">
                                                    {{ $pegawai->nama }}
                                                </option>
                                            @endif
                                        @endforeach


                                    </select>


                                    <label for="nama" class="block mb-2">Pilih Kendaraan</label>
                                    <select name="nama_kendaraan" required class="w-full">
                                        <option value="">Pilih</option>
                                        @foreach ($kendaraans as $kendaraan)
                                            @if ($kendaraan->status === 'Tidak Tersedia')
                                                <p>Tidak ada yang tersedia</p>
                                            @else
                                                <option value="{{ $kendaraan->id }}">
                                                    {{ $kendaraan->nama_kendaraan }} ({{ $kendaraan->plat_nomor }})
                                                </option>
                                            @endif
                                        @endforeach
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
                    <div>

                        <a href="{{ route('pemesanan.export') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded ">Export
                            ke
                            Excel</a>
                    </div>

                    <div class="overflow-x-auto mt-4">
                        <table class="w-full table-auto border-collapse border border-black">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-black">No</th>
                                    {{-- <th class="border border-black">Id</th> --}}
                                    <th class="border border-black">Nama Pegawai</th>
                                    <th class="border border-black">Nama Kendaraan</th>
                                    <th class="border border-black">Status 1</th>
                                    <th class="border border-black">Nama Atasan 1</th>
                                    <th class="border border-black">Status 2</th>
                                    <th class="border border-black">Nama Atasan 2</th>
                                    <th class="border border-black">Status Pemesanan 2</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanans as $key => $pemesanan)
                                    <tr class="border border-black">
                                        <td class="border border-black">{{ $key + 1 }}</td>
                                        {{-- <td class="border border-black">{{ $pemesanan->id }}</td> --}}
                                        <td class="border border-black text-center">{{ $pemesanan->nama }}</td>
                                        <td class="border border-black text-center">{{ $pemesanan->nama_kendaraan }}
                                        </td>
                                        <td class="border border-black text-center">{{ $pemesanan->status1 }}</td>
                                        <td class="border border-black text-center">
                                            @if (optional($pemesanan->atasan1)->name)
                                                {{ $pemesanan->atasan1->name }}
                                            @else
                                                Belum Ada Yang Menyetujui
                                            @endif
                                        </td>
                                        <td class="border border-black text-center">{{ $pemesanan->status2 }}</td>
                                        <td class="border border-black text-center">
                                            @if (optional($pemesanan->atasan2)->name)
                                                {{ $pemesanan->atasan2->name }}
                                            @else
                                                Belum Ada Yang Menyetujui
                                            @endif
                                        </td>
                                        <td class="border border-black text-center">{{ $pemesanan->statuspemesanan }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- @else
                        <p>Tidak ada data pegawai.</p>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
